<?php

App::uses('AppController', 'Controller');

/**
 * Unidades Controller
 *
 * @property Unidad $Unidad
 */
class UnidadesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Unidad->recursive = 0;
        $this->set('unidades', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Unidad->id = $id;
        if (!$this->Unidad->exists()) {
            throw new NotFoundException(__('Invalid unidad'));
        }
        $this->set('unidad', $this->Unidad->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Unidad->create();
            if ($this->Unidad->save($this->request->data)) {
                $this->Session->setFlash(__('The unidad has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unidad could not be saved. Please, try again.'));
            }
        }
        $anotaciones = $this->Unidad->Anotacion->find('list');
        $this->set(compact('anotaciones'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Unidad->id = $id;
        if (!$this->Unidad->exists()) {
            throw new NotFoundException(__('Invalid unidad'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Unidad->save($this->request->data)) {
                $this->Session->setFlash(__('The unidad has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unidad could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Unidad->read(null, $id);
        }
        $anotaciones = $this->Unidad->Anotacion->find('list');
        $this->set(compact('anotaciones'));
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
        $this->Unidad->id = $id;
        if (!$this->Unidad->exists()) {
            throw new NotFoundException(__('Invalid unidad'));
        }
        if ($this->Unidad->delete()) {
            $this->Session->setFlash(__('Unidad deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unidad was not deleted'));
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
