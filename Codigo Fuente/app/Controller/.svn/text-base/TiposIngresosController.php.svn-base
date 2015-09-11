<?php

App::uses('AppController', 'Controller');

/**
 * TiposIngresos Controller
 *
 * @property TiposIngreso $TiposIngreso
 */
class TiposIngresosController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->TiposIngreso->recursive = 0;
        $this->set('tiposIngresos', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->TiposIngreso->id = $id;
        if (!$this->TiposIngreso->exists()) {
            throw new NotFoundException(__('Invalid tipos ingreso'));
        }
        $this->set('tiposIngreso', $this->TiposIngreso->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->TiposIngreso->create();
            if ($this->TiposIngreso->save($this->request->data)) {
                $this->Session->setFlash(__('The tipos ingreso has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tipos ingreso could not be saved. Please, try again.'));
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
        $this->TiposIngreso->id = $id;
        if (!$this->TiposIngreso->exists()) {
            throw new NotFoundException(__('Invalid tipos ingreso'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TiposIngreso->save($this->request->data)) {
                $this->Session->setFlash(__('The tipos ingreso has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tipos ingreso could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->TiposIngreso->read(null, $id);
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
        $this->TiposIngreso->id = $id;
        if (!$this->TiposIngreso->exists()) {
            throw new NotFoundException(__('Invalid tipos ingreso'));
        }
        if ($this->TiposIngreso->delete()) {
            $this->Session->setFlash(__('Tipos ingreso deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Tipos ingreso was not deleted'));
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
