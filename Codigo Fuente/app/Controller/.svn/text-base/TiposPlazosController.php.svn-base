<?php

App::uses('AppController', 'Controller');

/**
 * TiposPlazos Controller
 *
 * @property TiposPlazo $TiposPlazo
 */
class TiposPlazosController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->TiposPlazo->recursive = 0;
        $this->set('tiposPlazos', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->TiposPlazo->id = $id;
        if (!$this->TiposPlazo->exists()) {
            throw new NotFoundException(__('Invalid tipos plazo'));
        }
        $this->set('tiposPlazo', $this->TiposPlazo->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->TiposPlazo->create();
            if ($this->TiposPlazo->save($this->request->data)) {
                $this->Session->setFlash(__('The tipos plazo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tipos plazo could not be saved. Please, try again.'));
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
        $this->TiposPlazo->id = $id;
        if (!$this->TiposPlazo->exists()) {
            throw new NotFoundException(__('Invalid tipos plazo'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TiposPlazo->save($this->request->data)) {
                $this->Session->setFlash(__('The tipos plazo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tipos plazo could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->TiposPlazo->read(null, $id);
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
        $this->TiposPlazo->id = $id;
        if (!$this->TiposPlazo->exists()) {
            throw new NotFoundException(__('Invalid tipos plazo'));
        }
        if ($this->TiposPlazo->delete()) {
            $this->Session->setFlash(__('Tipos plazo deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Tipos plazo was not deleted'));
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
        if ($this->Session->read('Auth.User.Rol.rol') == 'admin') {
            if (in_array($this->action, array('edit', 'index', 'add', 'view', 'delete'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

}
