<?php
App::uses('AppController', 'Controller');
/**
 * Alternativas Controller
 *
 * @property Alternativa $Alternativa
 */
class AlternativasController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Alternativa->create();
			if ($this->Alternativa->save($this->request->data)) {
				$this->Session->setFlash(__('The alternativa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alternativa could not be saved. Please, try again.'));
			}
		}
		$preguntas = $this->Alternativa->Pregunta->find('list');
		$this->set(compact('preguntas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Alternativa->id = $id;
		if (!$this->Alternativa->exists()) {
			throw new NotFoundException(__('Invalid alternativa'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Alternativa->save($this->request->data)) {
				$this->Session->setFlash(__('The alternativa has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alternativa could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Alternativa->read(null, $id);
		}
		$preguntas = $this->Alternativa->Preguntum->find('list');
		$this->set(compact('preguntas'));
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
            debug($this->request->params['pass'][0]);
		if (!$this->request->is('post')) {
			//throw new MethodNotAllowedException();
                    $id = $this->request->params['pass'][0];
                    //debug($this->request->params['pass'][0]);
		}
		$this->Alternativa->id = $id;
		if (!$this->Alternativa->exists()) {
			//throw new NotFoundException(__('Invalid alternativa'));
                    $this->redirect($this->referer());
		}
		if ($this->Alternativa->delete()) {
			//$this->Session->setFlash(__('Alternativa deleted'));
			$this->redirect($this->referer());
		}
		//$this->Session->setFlash(__('Alternativa was not deleted'));
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
