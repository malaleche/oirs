<?php

App::uses('AppController', 'Controller');

/**
 * ComentariosInternos Controller
 *
 * @property ComentariosInterno $ComentariosInterno
 */
class ComentariosInternosController extends AppController {

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->ComentariosInterno->create();
            if ($this->ComentariosInterno->save($this->request->data)) {
                $this->Session->setFlash(__('The comentarios interno has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The comentarios interno could not be saved. Please, try again.'));
            }
        }
        $useres = $this->ComentariosInterno->User->find('list');
        $anotaciones = $this->ComentariosInterno->Anotacion->find('list');
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
        $this->ComentariosInterno->id = $id;
        if (!$this->ComentariosInterno->exists()) {
            throw new NotFoundException(__('Invalid comentarios interno'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ComentariosInterno->save($this->request->data)) {
                $this->Session->setFlash(__('<h2 class="alert alert-success">El comentario ha sido modificado</h2>'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The comentarios interno could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->ComentariosInterno->read(null, $id);
        }
        $useres = $this->ComentariosInterno->User->find('list');
        $anotaciones = $this->ComentariosInterno->Anotacion->find('list');
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
        $this->ComentariosInterno->id = $id;
        if (!$this->ComentariosInterno->exists()) {
           // throw new NotFoundException(__('Invalid comentarios interno'));
        }
        if ($this->ComentariosInterno->delete()) {
          //  $this->Session->setFlash(__('Comentarios interno deleted'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Comentarios interno was not deleted'));
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
