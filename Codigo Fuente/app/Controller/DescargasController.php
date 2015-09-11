<?php

App::uses('AppController', 'Controller');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Descargas
 *
 * @author JAVIER
 */
class DescargasController extends AppController {

    //put your code here
    public $uses = array();

    public function download($path=null) {
        $this->viewClass = 'Media';
        $path = base64_decode($path);
        $pathinfo = pathinfo($path);
        debug($pathinfo);
        $params = array(
            'id'        => $pathinfo['basename'],
            'name'      => $pathinfo['filename'],
            'download'  => true,
            'extension' => $pathinfo['extension'],
            'path'      => 'files'.DS.'Anotaciones' . DS . $pathinfo['dirname'].DS
        );
        $this->set($params);
    }
    
    public function isAuthorized($user) {
        return true;
    }

}

?>
