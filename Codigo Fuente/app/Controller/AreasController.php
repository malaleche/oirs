<?php

App::uses('AppController', 'Controller');

/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {

    /**
     * index method
     *
     * @return void
     */

	 
    public function index() {
        $this->Area->recursive = 0;
        $this->set('areas', $this->paginate());
    }


    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Area->create();
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('The area has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The area could not be saved. Please, try again.'));
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
        $this->Area->id = $id;
        if (!$this->Area->exists()) {
            throw new NotFoundException(__('Invalid area'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('The area has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The area could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Area->read(null, $id);
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
        $this->Area->id = $id;
        if (!$this->Area->exists()) {
            throw new NotFoundException(__('Invalid area'));
        }
        if ($this->Area->delete()) {
            $this->Session->setFlash(__('Area deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Area was not deleted'));
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
