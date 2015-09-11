<?php

App::uses('AppController', 'Controller');

/**
 * Encuestas Controller
 *
 * @property Encuesta $Encuesta
 */
class EncuestasController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Encuesta->recursive = 1;
        $this->set('encuestas', $this->paginate());
    }
    
    public function selectEncuesta($id='0'){
        $this->autoRender = false;
        $this->Encuesta->query('
            UPDATE encuestas SET active = 0;
        ');
        $this->Encuesta->query('
           UPDATE encuestas SET active = 1
                WHERE encuestas.id = '.$id.';
        ');
        $this->redirect($this->referer());
    }
    
    
    public function desactivarEncuesta($id){
        if($this->request->is('post')){
        $this->Encuesta->query('
            UPDATE encuestas SET active = 0
            WHERE encuestas.id = '.$id.'
        ');}
        $this->redirect($this->referer());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Encuesta->create();
            if ($this->Encuesta->save($this->request->data)) {
                foreach ($this->request->data['Pregunta'] as $preg) {
                    $this->Encuesta->Pregunta->create();
                    $this->Encuesta->Pregunta->set('pregunta', $preg['pregunta']);
                    $this->Encuesta->Pregunta->set('encuesta_id', $this->Encuesta->id);
                    if ($this->Encuesta->Pregunta->save()) {
                        foreach ($preg['Alternativa'] as $alt) {
                            $this->Encuesta->Pregunta->Alternativa->create();
                            $this->Encuesta->Pregunta->Alternativa->set('alternativa', $alt['alternativa']);
                            $this->Encuesta->Pregunta->Alternativa->set('pregunta_id', $this->Encuesta->Pregunta->id);
                            $this->Encuesta->Pregunta->Alternativa->save();
                        }
                    }
                }
                $this->Session->setFlash(__('The encuesta has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The encuesta could not be saved. Please, try again.'));
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
        $this->Encuesta->id = $id;
        $this->Encuesta->recursive = 2;
        if (!$this->Encuesta->exists()) {
            throw new NotFoundException(__('Invalid encuesta'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Encuesta->save($this->request->data)) {
                foreach ($this->request->data['Pregunta'] as $preg) {
                    if (isset($preg['id'])) {
                        $this->Encuesta->Pregunta->id = $preg['id'];
                    } else {
                        $this->Encuesta->Pregunta->create();
                        $this->Encuesta->Pregunta->set('encuesta_id', $this->Encuesta->id);
                    }
                    $this->Encuesta->Pregunta->set('pregunta', $preg['pregunta']);
                    if ($this->Encuesta->Pregunta->save()) {
                        foreach ($preg['Alternativa'] as $alt) {
                            if (isset($alt['id'])) {
                                $this->Encuesta->Pregunta->Alternativa->id = $alt['id'];
                            } else {
                                $this->Encuesta->Pregunta->Alternativa->create();
                                $this->Encuesta->Pregunta->Alternativa->set('pregunta_id', $this->Encuesta->Pregunta->id);
                            }
                            $this->Encuesta->Pregunta->Alternativa->set('alternativa', $alt['alternativa']);
                            $this->Encuesta->Pregunta->Alternativa->save();
                        }
                    }
                }
                $this->Session->setFlash(__('The encuesta has been saved'));
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The encuesta could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Encuesta->read(null, $id);
        }
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
        $this->Encuesta->id = $id;
        if (!$this->Encuesta->exists()) {
            //throw new NotFoundException(__('Invalid encuesta'));
            $this->redirect($this->referer());
        }
        if ($this->Encuesta->delete()) {
            $this->Session->setFlash(__('Encuesta deleted'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Encuesta was not deleted'));
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
        }
        return parent::isAuthorized($user);
    }


}
