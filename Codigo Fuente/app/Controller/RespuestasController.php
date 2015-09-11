<?php

App::uses('AppController', 'Controller');

/**
 * Respuestas Controller
 *
 * @property Respuesta $Respuesta
 */
class RespuestasController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Respuesta->recursive = 0;
        $this->set('respuestas', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Respuesta->id = $id;
        if (!$this->Respuesta->exists()) {
            throw new NotFoundException(__('Invalid respuesta'));
        }
        $this->set('respuesta', $this->Respuesta->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Respuesta->create();
            if ($this->Respuesta->save($this->request->data)) {
                $this->Session->setFlash(__('The respuesta has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The respuesta could not be saved. Please, try again.'));
            }
        }
        $useres = $this->Respuesta->User->find('list');
        $anotaciones = $this->Respuesta->Anotacion->find('list');
        $this->set(compact('useres', 'anotaciones'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Respuesta->id = $id;
        if (!$this->Respuesta->exists()) {
            throw new NotFoundException(__('Invalid respuesta'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Respuesta->save($this->request->data)) {
                $this->Session->setFlash(__('<h2>La respuesta al usuario ha sido modificada</h2>'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The respuesta could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Respuesta->read(null, $id);
        }
        $useres = $this->Respuesta->User->find('list');
        $anotaciones = $this->Respuesta->Anotacion->find('list');
        $this->set(compact('useres', 'anotaciones'));
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
        $this->Respuesta->id = $id;
        if (!$this->Respuesta->exists()) {
            throw new NotFoundException(__('Invalid respuesta'));
        }
        if ($this->Respuesta->delete()) {
        //    $this->Session->setFlash(__('Respuesta deleted'));
            $this->redirect($this->referer());
        }
        //$this->Session->setFlash(__('Respuesta was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        if ($this->Session->read('Auth.User.Rol.rol') == 'unidad') {
            if (in_array($this->action, array('delete', 'edit'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

}
