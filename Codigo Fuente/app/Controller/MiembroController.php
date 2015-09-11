<?php

App::uses('AppController', 'Controller');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MiembroController
 *
 * @author JAVIER
 */
class MiembroController extends AppController {

    //put your code here
    public $uses = array('Anotacion');

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Anotacion.id' => 'desc'
        )
    );

    public function index() {     
        $this->layout = 'usuario';
        $this->Anotacion->recursive = 1;
        $this->set('anotaciones', $this->paginate('Anotacion',array('Anotacion.user_id'=>$this->Auth->user('id'))));
    }
    
    public function isAuthorized($user) {
        if($this->Session->read('Auth.User.Rol.rol')=='user'){
            if(in_array($this->action,array('index'))){
                return true;
            }
        }
        //return parent::isAuthorized($user);
    }

}

?>
