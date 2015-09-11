<?php
App::uses('AppController', 'Controller');
/**
 * TiposAnotaciones Controller
 *
 * @property TiposAnotacion $TiposAnotacion
 */
class TiposAnotacionesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TiposAnotacion->recursive = 0;
		$this->set('tiposAnotaciones', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TiposAnotacion->id = $id;
		if (!$this->TiposAnotacion->exists()) {
			throw new NotFoundException(__('Invalid tipos anotacion'));
		}
		$this->set('tiposAnotacion', $this->TiposAnotacion->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TiposAnotacion->create();
			if ($this->TiposAnotacion->save($this->request->data)) {
				$this->Session->setFlash(__('The tipos anotacion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipos anotacion could not be saved. Please, try again.'));
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
		$this->TiposAnotacion->id = $id;
		if (!$this->TiposAnotacion->exists()) {
			throw new NotFoundException(__('Invalid tipos anotacion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TiposAnotacion->save($this->request->data)) {
				$this->Session->setFlash(__('The tipos anotacion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipos anotacion could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TiposAnotacion->read(null, $id);
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
		$this->TiposAnotacion->id = $id;
		if (!$this->TiposAnotacion->exists()) {
			throw new NotFoundException(__('Invalid tipos anotacion'));
		}
		if ($this->TiposAnotacion->delete()) {
			$this->Session->setFlash(__('Tipos anotacion deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tipos anotacion was not deleted'));
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
