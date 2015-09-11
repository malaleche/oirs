<?php

App::uses('AppController', 'Controller');

/**
 * Perfiles Controller
 *
 * @property Perfil $Perfil
 */
class PerfilesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Perfil->recursive = 0;
        $this->set('perfiles', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Perfil->id = $id;
        if (!$this->Perfil->exists()) {
            throw new NotFoundException(__('Invalid perfil'));
        }
        $this->set('perfil', $this->Perfil->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Perfil->create();
            if ($this->Perfil->save($this->request->data)) {
                $this->Perfil->User->read(null, $this->request->data('User.id'));
                $this->Perfil->User->set('perfil_id',$this->Perfil->id);
                $this->Perfil->User->save();
                $this->Session->setFlash(__('The perfil has been saved'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The perfil could not be saved. Please, try again.'));
            }
        }
        $comunas = $this->Perfil->Comuna->find('list');
        
        if(isset($this->request->params['pass'][0])){
            $user_id = $this->request->params['pass'][0];
            $this->set(compact('comunas','user_id'));
        }else{
            $this->set(compact('comunas'));
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
        $this->Perfil->id = $id;
        if (!$this->Perfil->exists()) {
            throw new NotFoundException(__('Invalid perfil'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Perfil->save($this->request->data)) {
                $this->Perfil->User->id = $this->Perfil->User->findByPerfilId($this->Perfil->field('id'));
                $this->Perfil->User->set('correo',$this->request->data('User.correo'));
                $this->Perfil->User->save();
                $this->Session->setFlash('<h2 class="alert alert-success">Su Perfil ha sido actualizado satisfactoriamente</h2>');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('<h2 class="alert alert-success">Su Perfil no ha podido ser actualizado</h2>');
            }
        } else {
            $this->request->data = $this->Perfil->read(null, $id);
        }
        $comunas = $this->Perfil->Comuna->find('list');
        $this->set(compact('comunas'));
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
        $this->Perfil->id = $id;
        if (!$this->Perfil->exists()) {
            throw new NotFoundException(__('Invalid perfil'));
        }
        if ($this->Perfil->delete()) {
            $this->Session->setFlash(__('Perfil deleted'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Perfil was not deleted'));
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
            $this->layout = 'default';
        }  else if ($usuario == 'unidad') {
                $this->layout = 'unidad';
            }else {
            $this->layout = 'index';
        }
    }
    
    public function isAuthorized($user) {
        if($this->Session->read('Auth.User.Rol.rol')=='user'){
            if(in_array($this->action,array('edit'))){
                return true;
            }
        }else if($this->Session->read('Auth.User.Rol.rol')=='unidad'){
            if(in_array($this->action,array('add', 'edit'))){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

}
