<?php

App::uses('AppController', 'Controller');

/**
 * EncuestasUsers Controller
 *
 * @property EncuestasUser $EncuestasUser
 */
class EncuestasUsersController extends AppController {

    /**
     * index method
     *
     * @return void
     * 
     *
     */
    
     public $paginate = array(
        'limit' => 25,
        'fields' => array(
            'Encuesta.encuesta',
            'Encuesta.id'
        ),
        'group' => 'Encuesta.encuesta'
    );
     
    public function index() {
        $this->layout = 'index';
        $this->EncuestasUser->recursive = 1;
        $this->set('encuestasUsers', $this->paginate());
    }

    public function view($encuesta = null) {
        $datos = $this->EncuestasUser->query('
            SELECT E.encuesta, P.pregunta, A.alternativa, COUNT(A.id) AS Cant
            FROM encuestas AS E
            INNER JOIN encuestas_users AS EU ON E.id = EU.encuesta_id
            INNER JOIN preguntas AS P ON P.id = EU.pregunta_id
            INNER JOIN alternativas AS A ON A.id = EU.alternativa_id
            WHERE E.id = ' . $encuesta . '
            GROUP BY E.encuesta, P.pregunta, A.alternativa
        ');
        $array = array($datos['0']['E']['encuesta'] => array());
        $votos=0;
        foreach ($datos as $row) {
            if (!array_key_exists($row['P']['pregunta'], $array[$datos['0']['E']['encuesta']])) {
                $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']] = array();
                if (!array_key_exists($row['A']['alternativa'], $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']])) {
                    $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']]['Total Votos'] = $row[0]['Cant'];
                    $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']][$row['A']['alternativa']] = $row[0]['Cant'];
                    
                }
            }else{
                $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']]['Total Votos'] += $row[0]['Cant'];
                $array[$datos['0']['E']['encuesta']][$row['P']['pregunta']][$row['A']['alternativa']] = $row[0]['Cant'];
                
            }
        }
//        
//        debug($array);
//        debug($datos);
        $this->set('array',$array);
        //$this->autoRender = false;
    }

//    /**
//     * view method
//     *
//     * @throws NotFoundException
//     * @param string $id
//     * @return void
//     */
//    public function view($id = null) {
//        $this->EncuestasUser->id = $id;
//        if (!$this->EncuestasUser->exists()) {
//            throw new NotFoundException(__('Invalid encuestas user'));
//        }
//        $this->set('encuestasUser', $this->EncuestasUser->read(null, $id));
//    }

    /**
     * add method
     *
     * @return void
     */
    public function add($id = null) {
        $this->layout = 'index';
        if ($this->request->is('post')) {
            //debug($this->request->data);
            //$this->request->data['EncuestasUser.encuesta_id'] = $this->EncuestasUser->Encuesta->id;
            foreach ($this->request->data['Pregunta'] as $key => $value) {
                $this->EncuestasUser->create();
                $this->EncuestasUser->set('encuesta_id', $this->request->data('EncuestasUser.encuesta_id'));
                $this->EncuestasUser->set('user_id', $this->request->data('EncuestasUser.user_id'));
                $this->EncuestasUser->set('pregunta_id', $key);
                $this->EncuestasUser->set('alternativa_id', $value['Alternativa']);
                $this->EncuestasUser->save();
            }
            $this->redirect(array('controller'=>'users','action' => 'logout', true));
        }
        $this->EncuestasUser->Encuesta->recursive = 2;
        $encuestas = $this->EncuestasUser->Encuesta->read(null, $id);
        $this->set('encuestas', $encuestas);
    }

    
    
    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->EncuestasUser->id = $id;
        if (!$this->EncuestasUser->exists()) {
            throw new NotFoundException(__('Invalid encuestas user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->EncuestasUser->save($this->request->data)) {
                $this->Session->setFlash(__('<h2 class="alert alert-success">Cambios guardados</h2>'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('<h2 class="alert alert-error">Los cambios no se han realizado</h2>'));
            }
        } else {
            $this->request->data = $this->EncuestasUser->read(null, $id);
        }
        $encuestas = $this->EncuestasUser->Encuestum->find('list');
        $users = $this->EncuestasUser->User->find('list');
        $preguntas = $this->EncuestasUser->Preguntum->find('list');
        $alternativas = $this->EncuestasUser->Alternativa->find('list');
        $this->set(compact('encuestas', 'users', 'preguntas', 'alternativas'));
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
        $this->EncuestasUser->query('
            DELETE FROM encuestas_users AS EU WHERE E.encuesta_id = '.$id.'
        ');
        $this->Session->setFlash(__('Encuestas user was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function beforeRender() {
        parent::beforeRender();
        $usuario = $this->Auth->user('Rol.rol');
        if ($usuario == 'user') {
            $this->layout = 'usuario';
        } else if ($usuario == 'oirs') {
            $this->layout = 'oirs';
        } else if ($usuario == 'admin') {
            $this->layout = 'admin';
        } else {
            $this->layout = 'index';
        }
    }
    
    public function isAuthorized($user) {
        if($this->Session->read('Auth.User.Rol.rol')=='admin'){
            if(in_array($this->action,array('edit','index','add','delete'))){
                return true;
            }
        }else if($this->Session->read('Auth.User.Rol.rol')=='user'){
            if(in_array($this->action,array('add'))){
                return true;
            }
        }else if($this->Session->read('Auth.User.Rol.rol')=='unidad'){
            if(in_array($this->action,array('add'))){
                return true;
            }
        }
        
        return parent::isAuthorized($user);
    }

}
