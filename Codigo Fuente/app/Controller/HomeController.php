<?php
App::uses('AppController', 'Controller');
/**
 * Home Controller
 *
 * @property Home $Home
 */
class HomeController extends AppController {

    public $uses = array('User', 'Comuna');
    
    public function index() {
        $this->layout = 'index';
    }   
    
    public function menu() {
        if($this->Auth->user('Rol.rol')=='oirs'){
            $this->redirect(array('controller'=>'Oirs','action'=>'index'));
        }else if($this->Auth->user('Rol.rol')=='user'){
            $this->redirect(array('controller'=>'Anotaciones', 'action'=>'add'));
        }else if($this->Auth->user('Rol.rol')=='unidad'){
            $this->redirect(array('controller'=>'UserUnidad', 'action'=>'index'));
        }else if($this->Auth->user('Rol.rol')== 'admin'){
            $this->redirect(array('controller'=>'Users','action'=>'index'));
        }else{
            $this->redirect(array('action'=>'index'));
        }
        $this->autoRender = false;
    }
    
    public function registrarse(){
        $this->layout = 'index';
        if($this->request->is('post')){
            if(!empty($this->request->data)){

			//rescata datos desde el formulario para guardarlo .  (Perfil (rut, nombre, telefono, celular, direccion, comuna_id, sexo, id))
                $perfil = $this->User->Perfil->save($this->request->data['Perfil']);
				
                if(!empty($perfil)){
                    $this->request->data['User']['perfil_id'] = $this->User->Perfil->id;
					$rut = $this->request->data['Perfil']['rut'];
					
					//Comprueba si el usuario existe en la base de datos.
					$opciones	= array('conditions' => array('User.username' => $rut));
					$user 		= $this->User->find('all',$opciones);
					
					//Si user es vacio realiza la insersión con el método save.
					if(empty($user)){
					
						if(!isset($this->request->data['User']['username'])){
							$this->request->data['User']['username'] = $this->request->data['Perfil']['rut'];
						}
						
						if(!isset($this->request->data['User']['rol_id'])){
							$rolid = $this->User->Rol->find('first', array('fields'=>array('Rol.id'),'conditions'=>array('Rol.rol'=>'user')));
							$this->request->data['User']['rol_id'] = $rolid['Rol']['id'];
						}
										
						$this->User->save($this->request->data['User']);
						$this->Session->setFlash('Usuario registrado correctamente.  ');
						$this->redirect('index');
						
					}else{					
						$this->Session->setFlash('Usuario ya existe en la base de datos.');
						$this->redirect('index');
					}
					
                }else{
                    $this->Session->setFlash('No se ha podido registrar, intentelo nuevamente');
                }
            }
        }
        $comunas = $this->Comuna->find('list');
        $roles = $this->User->Rol->find('list');
        $unidades = $this->User->Unidad->find('list');
        $this->set(compact('comunas','roles','unidades'));
    }


    public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow();
    }
}
?>
