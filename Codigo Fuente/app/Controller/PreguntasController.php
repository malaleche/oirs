<?php
App::uses('AppController', 'Controller');
/**
 * Preguntas Controller
 *
 * @property Pregunta $Pregunta
 */
class PreguntasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Invalid pregunta'));
		}
		$this->set('pregunta', $this->Pregunta->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pregunta->create();
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pregunta has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.'));
			}
		}
		$encuestas = $this->Pregunta->Encuesta->find('list');
		$this->set(compact('encuestas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Pregunta->id = $id;
		if (!$this->Pregunta->exists()) {
			throw new NotFoundException(__('Invalid pregunta'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pregunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pregunta has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Pregunta->read(null, $id);
		}
		$encuestas = $this->Pregunta->Encuestum->find('list');
		$this->set(compact('encuestas'));
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
//		if (!$this->request->is('post')) {
//			throw new MethodNotAllowedException();
//		}
		$this->Pregunta->id = $id;
//		if (!$this->Pregunta->exists()) {
//			throw new NotFoundException(__('Invalid pregunta'));
//		}
		if ($this->Pregunta->delete()) {
			//$this->Session->setFlash(__('Pregunta deleted'));
			$this->redirect($this->referer());
		}
		//$this->Session->setFlash(__('Pregunta was not deleted'));
		$this->redirect($this->referer());
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
