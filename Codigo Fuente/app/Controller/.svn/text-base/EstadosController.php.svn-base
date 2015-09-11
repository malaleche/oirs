<?php

App::uses('AppController', 'Controller');

/**
 * Estados Controller
 *
 * @property Estado $Estado
 */
class EstadosController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Estado->recursive = 0;
        $this->set('estados', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Estado->id = $id;
        if (!$this->Estado->exists()) {
            throw new NotFoundException(__('Invalid estado'));
        }
        $this->set('estado', $this->Estado->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Estado->create();
            if ($this->Estado->save($this->request->data)) {
                $this->Session->setFlash(__('The estado has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The estado could not be saved. Please, try again.'));
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
        $this->Estado->id = $id;
        if (!$this->Estado->exists()) {
            throw new NotFoundException(__('Invalid estado'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Estado->save($this->request->data)) {
                $this->Session->setFlash(__('The estado has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The estado could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Estado->read(null, $id);
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
        $this->Estado->id = $id;
        if (!$this->Estado->exists()) {
            throw new NotFoundException(__('Invalid estado'));
        }
        if ($this->Estado->delete()) {
            $this->Session->setFlash(__('Estado deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Estado was not deleted'));
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
            if(in_array($this->action,array('edit','index','add','view','delete'))){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }


}
