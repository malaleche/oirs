<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TransparenciaPasivaController
 *
 * @author JAVIER
 */
class TransparenciaPasivasController extends AppController {

    public $uses = array('Anotacion', 'User');
    public $paginate = array(
        'limit' => 25,
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

    public function index($estado = null) {
        $this->layout = 'oirs';
        $this->Anotacion->recursive = 0;
        $user = $this->User->findByUsername('transparenciapasiva');
        $estado = $this->Anotacion->Estado->findByEstado($estado);
        $this->set('anotaciones', $this->paginate('Anotacion', array('Anotacion.user_id' => $user['User']['id'], 'estado_id' => $estado['Estado']['id'])));
    }

    public function listPublic() {
        $this->layout = 'index';
        $this->Anotacion->recursive = 0;
        $user = $this->User->findByUsername('transparenciapasiva');
        $this->set('anotaciones', $this->paginate('Anotacion', array('Anotacion.user_id' => $user['User']['id'], 'publica' => 1)));
    }

    public function view($id = null) {
        $this->layout = 'index';
        $this->Anotacion->id = $id;
        $user = $this->User->findByUsername('transparenciapasiva');
        if (!$this->Anotacion->exists() || $this->Anotacion->field('user_id') != $user['User']['id']) {
            $this->Session->setFlash('<h2 class="alert alert-error">La Anotacion no Existe</h2>', 'default', array(), 'buscar');
            $this->redirect(array('controller' => 'home', 'action' => 'index/tab:3'));
        }
        $this->set('anotacion', $this->Anotacion->read(null, $id));
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

    public function submit() {
        if ($this->request->is('post')) {
            $cuerpo = null;
            $cuerpo = 'Nombre solicitante: ' . $this->request->data['TransparenciaPasiva']['nombre'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Direccion solicitante: ' . $this->request->data['TransparenciaPasiva']['direccion'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Correo solicitante: ' . $this->request->data['TransparenciaPasiva']['correo'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Nombre apoderado: ' . $this->request->data['TransparenciaPasiva']['nombre2'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Direccion apoderado: ' . $this->request->data['TransparenciaPasiva']['direccion2'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Correo apoderado: ' . $this->request->data['TransparenciaPasiva']['correo2'] . chr(10) . chr(13);
            $cuerpo = $cuerpo . 'Descripcion: ' . $this->request->data['TransparenciaPasiva']['descripcion'];

            $publica = $this->request->data['TransparenciaPasiva']['publica'];
            $correo = $this->request->data['TransparenciaPasiva']['correo'];
            $user_id = $this->User->find('first', array('field' => array('User.id'), 'conditions' => array('username' => 'transparenciapasiva')));
            $user_id = $user_id['User']['id'];

            $this->Anotacion->create();
            $this->Anotacion->set('titulo', 'transparencia pasiva');
            $this->Anotacion->set('cuerpo', $cuerpo);
            $this->Anotacion->set('correo', $correo);
            $this->Anotacion->set('publica', $publica);
            $this->Anotacion->set('user_id', $user_id);
            $this->Anotacion->set('estado_id', $this->Anotacion->Estado->field('id', array('estado' => 'Sin Asignar')));
            $this->Anotacion->set('tipo_plazo_id', $this->Anotacion->TiposPlazo->field('id', array('tipo' => 'Normal')));
            $this->Anotacion->set('extension_plazo', $this->Anotacion->TiposPlazo->field('dias', array('tipo' => 'Normal')));
            $this->Anotacion->set('tipo_ingreso_id', $this->Anotacion->TiposIngreso->field('id', array('tipo' => 'Digital')));
            if ($this->Anotacion->save()) {
                $nom = $this->request->data('TransparenciaPasiva.nombre');
                $viewVars = array('nombre' => $nom, 'id_anot' => $this->Anotacion->field('id'));
                $this->sendEmail($this->Anotacion->field('correo'), $viewVars, 'Anotacion de Transparencia Ingresada', 'anot_recibida');
                if ($this->request->data('TransparenciaPasiva.correo2') != null) {
                    $nom = $this->request->data('TransparenciaPasiva.nombre2');
                    $viewVars = array('nombre' => $nom, 'id_anot' => $this->Anotacion->field('id'));
                    $this->sendEmail($this->request->data('TransparenciaPasiva.correo2'), $viewVars, 'Anotacion de Transparencia Ingresada (La notificacion de respuesta será enviada al correo del solicitante)', 'anot_recibida');
                }
                $this->Session->setFlash('<h2 class="alert alert-success">Solicitud ingresada</h2>', 'default', array(), 'tpasiva');
                $this->redirect(array('controller' => 'home', 'action' => 'index/tab:2'));
            } else {
                $this->Session->setFlash('<h2 class="alert alert-error">No se ha podido ingresar la solicitud</h2>', 'default', array(), 'tpasiva');
                $this->redirect(array('controller' => 'home', 'action' => 'index/tab:2'));
            }
        }
        $this->autoRender = false;
    }

    public function beforeFilter() {
        $this->Auth->allow('submit', 'listPublic', 'view');
    }

    public function isAuthorized($user) {
        if ($this->action == 'index') {
            if ($this->Session->read('Auth.User.Rol.rol') == 'oirs') {
                return true;
            } else {
                return false;
            }
        }
    }

}

?>
