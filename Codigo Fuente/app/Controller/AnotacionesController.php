<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Anotaciones Controller
 *
 * @property Anotacion $Anotacion
 */
class AnotacionesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public $paginate = array(
        'limit' => 10000,
        'order' => array(
            'Anotacion.id' => 'desc'
        )
    );
	
    public function sendEmail($to, $vars, $asunto, $template) {
        $email = new CakeEmail('smtp');
        $email->to($to)
                ->template($template, 'default')
                ->viewVars($vars)
                ->subject($asunto)
                ->emailFormat('html')
                ->send();
    }

    public function index($condicion = null) {
        $this->Anotacion->recursive = 1;
        $this->Anotacion->Unidad->recursive = -1;
        $unidad = $this->Anotacion->Unidad->findByUnidad($condicion);
        if (!empty($unidad)) {
            $unidad_id = $this->Anotacion->Unidad->findByUnidad($condicion, array('Unidad.id'));
            $unidad_id = $unidad_id['Unidad'];
            $li = array();
            $list_anotaciones = $this->Anotacion->AnotacionesUnidad->findAllByUnidadId($unidad_id['id']);
            foreach ($list_anotaciones as $key1 => $value) {
                foreach ($list_anotaciones[$key1] as $key2 => $value) {
                    $li[] = $list_anotaciones[$key1][$key2]['anotacion_id'];
                }
            }
            $condicion = $li == array() ? ' ' : $li;
        }
        $user = $this->Anotacion->User->findByUsername('transparenciapasiva');
        if ($condicion != null) {
            $where = array('OR' => array('User.id' => $condicion, 'Anotacion.id' => $condicion, 'Estado.estado' => $condicion, 'TiposAnotacion.tipo' => $condicion, 'Area.area' => $condicion, 'TiposPlazo.tipo' => $condicion), 'Anotacion.user_id !=' => $user['User']['id']);
        } else {
            $where = array('Anotacion.user_id !=' => $user['User']['id'], 'User.username' => 'oirsdigital');
        }
        $this->set('anotaciones', $this->paginate('Anotacion', $where));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Anotacion->recursive = 2;
        if ($id) {
            $this->Anotacion->id = $id;
        } else if ($this->params['url']['id'] && $this->params['url']['id'] != '') {
            $this->Anotacion->id = $this->params['url']['id'];
        }
        if (!$this->Anotacion->exists()) {
            if (!isset($this->params['url']['correo'])) {
                //$this->Session->setFlash('<h2 class="alert alert-error">La Anotacion no Existe</h2>', 'default', array(), 'buscar');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('<h2 class="alert alert-error">La Anotacion no Existe</h2>', 'default', array(), 'buscar');
                $this->redirect(array('controller' => 'home', 'action' => 'index/tab:3'));
            }
            //throw new NotFoundException(__('Invalid anotacion'));
        }
        if ($this->Session->check('Auth.User')) {
            $this->set('anotacion', $this->Anotacion->read(null, $id));
        } else {
            $a = $this->Anotacion->findByIdAndUserId($this->Anotacion->id, $this->Anotacion->User->find('list', array('fields' => array('id'), 'conditions' => array('User.username' => 'transparenciapasiva'))));
            if ($a != null && ($a['Anotacion']['correo'] == $this->params['url']['correo']))
                $this->set('anotacion', $a);
            else {
                $this->Session->setFlash('<h2 class="alert alert-error">No se puede acceder a la anotación</h2>', 'default', array(), 'buscar');
                $this->redirect(array('controller' => 'home', 'action' => 'index/tab:3'));
            }
        }
        $folder_anot = new Folder(WWW_ROOT . 'files' . DS . 'Anotaciones' . DS . 'anot_' . $this->Anotacion->id);
        $files_url = array();
        foreach ($folder_anot->find('.*') as $file) {
            $files_url[] = basename($folder_anot->pwd()) . DS . $file;
        }
        $this->set('files', $files_url);
        ////////////////////////////////////////////////////////////////////
        $folder_anot = new Folder(WWW_ROOT . 'files' . DS . 'Anotaciones' . DS . 'anot_' . $this->Anotacion->id . DS . 'Respuestas');
        $files_url = array();
        $dir = $folder_anot->read(true, false, true);
        foreach ($dir[0] as $key => $value) {
            $folder = new Folder($value);
            foreach ($folder->find('.*') as $file) {
                $files_url[basename($folder->pwd())][] = $file;
            }
        }
        $this->set('files_res', $files_url);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Anotacion->create();
            $this->Anotacion->set('user_id', $this->Auth->user('id'));
            if (!isset($this->request->data['Anotacion']['estado_id'])) {
                $this->request->data['Anotacion']['estado_id'] = $this->Anotacion->Estado->field('id', array('estado' => 'Sin Asignar'));
            }
            if (!isset($this->request->data['Anotacion']['tipo_plazo_id'])) {
                $this->request->data['Anotacion']['tipo_plazo_id'] = $this->Anotacion->TiposPlazo->field('id', array('tipo' => 'Normal'));
            }
            if (!isset($this->request->data['Anotacion']['tipo_ingreso_id'])) {
                $this->request->data['Anotacion']['tipo_ingreso_id'] = $this->Anotacion->TiposIngreso->field('id', array('tipo' => 'Digital'));
            }
            if ($this->request->data('tipo_plazo_id') != $this->Anotacion->TiposPlazo->field('id', array('tipo' => 'Extendido'))) {
                $this->request->data['Anotacion']['extension_plazo'] = $this->Anotacion->TiposPlazo->field('dias', array('id' => $this->request->data['Anotacion']['tipo_plazo_id']));
            }
            if ($this->Anotacion->save($this->request->data)) {
                if (isset($this->request->data['Anotacion']['archivo']))
                    $this->guardar_archivo($this->request->data['Anotacion']['archivo'], $this->Anotacion->id);
                $nom = $this->Session->read('Auth.User.Perfil.nombre') != null ? $this->Session->read('Auth.User.Perfil.nombre') : 'oirs';
                $viewVars = array('nombre' => $nom, 'id_anot' => $this->Anotacion->id);
				//CORREO DE NOTIFICACION DE ANOTACION INGRESADA
                $this->sendEmail($this->request->data('Anotacion.correo'), $viewVars, 'Anotación Ingresada', 'anot_recibida');
                $this->Session->setFlash('<h2 class="alert alert-success">La solicitud ha sido ingresada exitosamente</h2>');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('<h2 class="alert alert-error">Anotación no ingresada</h2>');
            }
        }
        $users = $this->Anotacion->User->find('list');
        $tipoIngresos = $this->Anotacion->TiposIngreso->find('list');
        $tipoAnotaciones = $this->Anotacion->TiposAnotacion->find('list');
        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
        $estados = $this->Anotacion->Estado->find('list');
        $areas = $this->Anotacion->Area->find('list');
        $unidades = $this->Anotacion->Unidad->find('list');
        $correo = $this->Anotacion->User->findByUsername($this->Session->read('Auth.User.username'));
        $this->set('correo', $correo['User']['correo']);
        $this->set(compact('users', 'tipoIngresos', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'areas', 'unidades'));
    }

    public function guardar_archivo($files = null, $id_anot) {
        if ($files != null) {
            foreach ($files as $file) {
                if (is_uploaded_file($file['tmp_name'])) {
                    $nombre = $file['name'];
                    $tmp_name = $file['tmp_name'];
                    $pathFiles = WWW_ROOT . 'files';

                    $archivo = new File($tmp_name);
                    $destino = new Folder($pathFiles . DS . 'Anotaciones' . DS . 'anot_' . $id_anot, true);
                    $archivo->copy($destino->pwd() . DS . $nombre);
                }
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Anotacion->id = $id;
        if (!$this->Anotacion->exists()) {
            throw new NotFoundException(__('Invalid anotacion'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data('Anotacion.tipo_plazo_id') != $this->Anotacion->TiposPlazo->field('id', array('tipo' => 'Extendido'))) {
                $this->request->data['Anotacion']['extension_plazo'] = $this->Anotacion->TiposPlazo->field('dias', array('id' => $this->request->data['Anotacion']['tipo_plazo_id']));
            }

            $oldUnitAnot = $this->Anotacion->findById($this->Anotacion->id);
			
            if ($this->Anotacion->save($this->request->data)) {
                //if (isset($oldUnitAnot['Unidad']['0']['id']) && ($this->request->data('Unidad.Unidad') != $oldUnitAnot['Unidad']['0']['id'])) {
				
				if ($this->request->data('Unidad.Unidad') != $oldUnitAnot['Unidad']['0']['id']) {
                    $this->Anotacion->User->recursive = 0;
                    $unidad_id = $this->Anotacion->AnotacionesUnidad->findByAnotacionId($this->Anotacion->field('id'), array('AnotacionesUnidad.unidad_id'));
				
					$nom = $this->Anotacion->query('select unidad from unidades where id = '. $this->request->data['Unidad']['Unidad']);	
					
					date_default_timezone_set("America/Santiago");
                    $dateb  = new DateTime();
                    $dymb 	= $dateb->format('d-m-Y');
                    $hb  	= $dateb->format('h:i');
					
					$this->Anotacion->ComentariosInterno->create();
                    $this->Anotacion->ComentariosInterno->set('comentario', 'Se deriva Anotación a Unidad <b>' . $nom['0']['unidades']['unidad'] . '</b> el día '. $dymb .' a las '. $hb .'.');
                    $this->Anotacion->ComentariosInterno->set('user_id', $this->Auth->user('id'));
                    $this->Anotacion->ComentariosInterno->set('anotacion_id', $this->Anotacion->id);
                    $this->Anotacion->ComentariosInterno->save();		
					
                    $responsables = $this->Anotacion->User->find('all', array('conditions' => array('unidad_id' => $unidad_id['AnotacionesUnidad']['unidad_id'])));
                    foreach ($responsables as $resp) {
                        $nom = $resp['Perfil']['nombre'] != null ? $resp['Perfil']['nombre'] : $resp['User']['username'];
                        $viewVars = array('nombre' => $nom, 'id_anot' => $this->Anotacion->id);
						//CORREO DE NOTIFICACION DE ANOTACION ASIGNADA!!!
                        $this->sendEmail($resp['User']['correo'], $viewVars, 'Anotación Asignada', 'anot_asig_unid');
                    }
                }
                if ($this->request->data['ComentariosInterno']['comentario'] != '') {
                    $this->Anotacion->ComentariosInterno->create();
                    $this->Anotacion->ComentariosInterno->set('comentario', $this->request->data['ComentariosInterno']['comentario']);
                    $this->Anotacion->ComentariosInterno->set('user_id', $this->Auth->user('id'));
                    $this->Anotacion->ComentariosInterno->set('anotacion_id', $this->Anotacion->id);
                    $this->Anotacion->ComentariosInterno->save();
                }
                if (trim($this->request->data['Respuesta']['respuesta']) != '') {
                    $this->Anotacion->Respuesta->create();
                    $this->Anotacion->Respuesta->set('respuesta', $this->request->data['Respuesta']['respuesta']);
                    $this->Anotacion->Respuesta->set('user_id', $this->Auth->user('id'));
                    $this->Anotacion->Respuesta->set('anotacion_id', $this->Anotacion->id);
                    if ($this->Anotacion->Respuesta->save()) {
                        if (isset($this->request->data['Respuesta']['archivo'])) {
                            $this->guardar_archivo($this->request->data['Respuesta']['archivo'], $this->Anotacion->id . DS . 'Respuestas' . DS . 'resp_' . $this->Anotacion->Respuesta->id);
                        }
                        $this->Anotacion->User->recursive = 0;
                        $user_id = $this->Anotacion->field('user_id');
                        $user = $this->Anotacion->User->findById($user_id);
                        $nom = $user['Perfil']['nombre'] != null ? $user['Perfil']['nombre'] : $user['User']['username'];
                        $viewVars = array('nombre' => $nom, 'id_anot' => $this->Anotacion->id);
						//CORREO DE NOTIFICACION DE ANOTACION CON RESPUESTA
                        $this->sendEmail($this->Anotacion->field('correo'), $viewVars, 'Anotación Con Respuesta', 'anot_con_res');
                    }
                }
                $this->Session->setFlash('<h2 class="alert alert-success">Solicitud editada</h2>');
                $this->redirect(array('action' => 'view', $this->Anotacion->id));
				
            } else {
                $this->Session->setFlash('<h2 class="alert alert-error">Solicitud no editada. Intentar de nuevo</h2>');
            }
        }
        $this->request->data = $this->Anotacion->read(null, $id);
        $users = $this->Anotacion->User->find('list');
        $tipoIngresos = $this->Anotacion->TiposIngreso->find('list');
        $tipoAnotaciones = $this->Anotacion->TiposAnotacion->find('list');
        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
        $estados = $this->Anotacion->Estado->find('list');
        $areas = $this->Anotacion->Area->find('list');
        $unidades = $this->Anotacion->Unidad->find('list');
        $this->set(compact('users', 'tipoIngresos', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'areas', 'unidades'));
        $this->Anotacion->recursive = 2;
        $this->set('anotacion', $this->Anotacion->read(null, $id));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Anotacion->id = $id;
        if (!$this->Anotacion->exists()) {
            throw new NotFoundException(__('Invalid anotacion'));
        }
        if ($this->Anotacion->delete()) {
            $this->Session->setFlash(__('<h2 class="alert alert-success">Anotacion deleted</h2>'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Anotacion was not deleted'));
        $this->redirect($this->referer());
    }

    public function beforeRender() {
        parent::beforeRender();
        $usuario = $this->Auth->user('Rol.rol');
        if ($usuario == 'user') {
            $this->layout = 'usuario';
        } else if ($usuario == 'oirs') {
            $this->layout = 'oirs';
        } else if ($usuario == 'admin') {
            $this->layout = 'default';
        } else if ($usuario == 'unidad') {
            $this->layout = 'unidad';
        } else {
            $this->layout = 'index';
        }
    }

    public function buscar() {
        if ($this->request->is('post')) {
            $this->Anotacion->recursive = 1;
            $datos = $this->request->data;
            $flagConditions = false;
            if ($this->Session->read('Auth.User.Rol.rol') == 'user') {
                $conditions = array('conditions' => array('Anotacion.id' => $datos['Anotacion']['id1'], 'Anotacion.user_id' => $this->Session->read('Auth.User.id')));
            } else {
                if ($this->Session->read('Auth.User.Rol.rol') == 'unidad') {
                    
                    $anotacion_id = array();
                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
                    foreach ($array as $key1 => $value) {
                        foreach ($array[$key1] as $key => $value) {
                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
                        }
                    }
                    if ($datos['Anotacion']['id1'] != '') {//se busca por id
                        if (in_array($datos['Anotacion']['id1'], $anotacion_id)) {
                            $conditions['conditions']['Anotacion.id'] = $datos['Anotacion']['id1'];
                            $flagConditions = true;
                        } else {
                            $conditions['conditions']['Anotacion.id'] = '';
                        }
                    } else {
                        $conditions['conditions']['Anotacion.id'] = $anotacion_id;
                    }
                } else {
                    if ($datos['Anotacion']['id1'] != '') {//se busca por id
                        $conditions['conditions']['Anotacion.id'] = $datos['Anotacion']['id1'];
                    } else {
                        if ($datos['AnotacionesUnidad']['unidad_id']!='') {
                            $anotacion_id = array();
                            $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $datos['AnotacionesUnidad']['unidad_id'])));
                            foreach ($array as $key1 => $value) {
                                foreach ($array[$key1] as $key => $value) {
                                    $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
                                }
                            }
                            $conditions['conditions']['Anotacion.id']=$anotacion_id;
                            $flagConditions = true;
                        }
                    }
                }

                if ($datos['Anotacion']['id1'] == '') {
                    foreach ($datos['Anotacion'] as $key => $value) {
                        if ($datos['Anotacion'][$key] != '' && !in_array($key, array('desde', 'hasta', 'id1'))) {
                            $conditions['conditions']['Anotacion' . '.' . $key] = $value;
                            $flagConditions = true;
                        }
                    }
                    if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] != '') {
                        $flagConditions = true;
                        $conditions['conditions']['DATE(Anotacion.created) BETWEEN ? AND ?'] = array($datos['Anotacion']['desde'], $datos['Anotacion']['hasta']);
                    }
                    if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] == '') {
                        $flagConditions = true;
                        $conditions['conditions']['DATE(Anotacion.created) >='] = $datos['Anotacion']['desde'];
                    }
                    if ($datos['Anotacion']['desde'] == '' && $datos['Anotacion']['hasta'] != '') {
                        $flagConditions = true;
                        $conditions['conditions']['DATE(Anotacion.created) <='] = $datos['Anotacion']['hasta'];
                    }
                }
            }
            if ($flagConditions == false) {
                $conditions['conditions']['Anotacion.id'] = '';
            }
            $conditions['order']=array('Anotacion.id'=>'desc');
            $this->set('anotaciones', $this->Anotacion->find('all', $conditions));
        }
//        if (!empty($this->request->params['named']['page'])) {
//            $this->set('anotaciones', $this->paginate('Anotacion'));
//        }
        $areas = $this->Anotacion->Area->find('list');
        $tipoAnotaciones = $this->Anotacion->TiposAnotacion->find('list');
        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
        $estados = $this->Anotacion->Estado->find('list');
        $unidades = $this->Anotacion->Unidad->find('list');
        $this->set(compact('areas', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'unidades'));
    }

//    public function buscar() {
//        $this->Anotacion->recursive = 1;
//        if ($this->request->is('post')) {
//            $datos = $this->request->data;
//            $conditions = array('conditions' => array());
//            if ($datos['Anotacion']['id1'] != '') {
//                $conditions['conditions']['Anotacion.id'] = $datos['Anotacion']['id1'];
//                if ($this->Session->read('Auth.User.Rol.rol') == 'user') {
//                    $conditions['conditions']['Anotacion.user_id'] = $this->Auth->user('id');
//                }
//                if (!array_key_exists('AnotacionesUnidad', $datos)) {
//                    $anotacion_id = array();
//                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
//                    foreach ($array as $key1 => $value) {
//                        foreach ($array[$key1] as $key => $value) {
//                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
//                        }
//                    }
//                    if (!in_array($datos['Anotacion']['id1'], $anotacion_id))
//                        $conditions['conditions']['Anotacion.id'] = -1;
//                }
////                else if (!isset($datos['AnotacionesUnidad']) && !empty($conditions['conditions'])) {
////                    $anotacion_id = array();
////                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
////                    foreach ($array as $key1 => $value) {
////                        foreach ($array[$key1] as $key => $value) {
////                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
////                        }
////                    }
////                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
////                }
//                
//                $this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
//            } else {
//                foreach ($datos['Anotacion'] as $key => $value) {
//                    if ($datos['Anotacion'][$key] != '' && !in_array($key, array('desde', 'hasta', 'id'))) {
//                        $conditions['conditions']['Anotacion' . '.' . $key] = $value;
//                    }
//                }
//                if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] != '') {
//                    $conditions['conditions']['DATE(Anotacion.created) BETWEEN ? AND ?'] = array($datos['Anotacion']['desde'], $datos['Anotacion']['hasta']);
//                }
//                if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] == '') {
//                    $conditions['conditions']['DATE(Anotacion.created) >='] = $datos['Anotacion']['desde'];
//                }
//                if ($datos['Anotacion']['desde'] == '' && $datos['Anotacion']['hasta'] != '') {
//                    $conditions['conditions']['DATE(Anotacion.created) <='] = $datos['Anotacion']['hasta'];
//                }
//                if (isset($datos['AnotacionesUnidad']) && $datos['AnotacionesUnidad']['unidad_id'] != '') {
//                    $anotacion_id = array();
//                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $datos['AnotacionesUnidad']['unidad_id'])));
//                    foreach ($array as $key1 => $value) {
//                        foreach ($array[$key1] as $key => $value) {
//                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
//                        }
//                    }
//                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
//                } else if (!isset($datos['AnotacionesUnidad']) && !empty($conditions['conditions'])) {
//                    $anotacion_id = array();
//                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
//                    foreach ($array as $key1 => $value) {
//                        foreach ($array[$key1] as $key => $value) {
//                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
//                        }
//                    }
//                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
//                }
//                $this->Anotacion->User->recursive = -1;
//                if ($this->Auth->user('Rol.rol') == 'user' && !empty($conditions['conditions'])) {
//                    $conditions['conditions']['Anotacion.user_id'] = $this->Auth->user('id');
//                } else {
//                    //$user = $this->Anotacion->User->findByUsername($datos['User']['id']);
//                    if (!empty($datos['User']['id'])) {
//                        $user = $this->Anotacion->User->findByUsername($datos['User']['id']);
//                        $conditions['conditions']['Anotacion.user_id'] = $user['User']['id'];
//                    }
//                }
////                if ($datos['AnotacionesUnidad']['unidad_id'] != '') {
////                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
////                    //debug($conditions);
////                    //$this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
////                }
//                if (!empty($conditions['conditions'])) {
//                    $this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
//                }
//            }
//        }
//        $areas = $this->Anotacion->Area->find('list');
//        $tipoAnotaciones = $this->Anotacion->TiposAnotacion->find('list');
//        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
//        $estados = $this->Anotacion->Estado->find('list');
//        $unidades = $this->Anotacion->Unidad->find('list');
//        $this->set(compact('areas', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'unidades'));
//    }

    public function isAuthorized($user) {
        if ($this->Session->read('Auth.User.Rol.rol') == 'user') {
            if (in_array($this->action, array('add', 'view', 'buscar'))) {
                return true;
            }
        }
        if ($this->Session->read('Auth.User.Rol.rol') == 'unidad') {
            if (in_array($this->action, array('buscar', 'view', 'edit'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function beforeFilter() {
        $this->Auth->allow('view');
    }

}
