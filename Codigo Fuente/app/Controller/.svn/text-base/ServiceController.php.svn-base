<?php  
App::uses('AppController', 'Controller');


class ServiceController extends AppController 
{ 
    public $name = 'Service'; 
    public $uses = array('AnotacionService'); 
    public $helpers = array(); 
    public $components = array('Soap'); 


    /** 
     * Handle SOAP calls 
     */ 
    
    function call($model) 
    { 
        $this->autoRender = FALSE; 
        $this->Soap->handle($model, 'wsdl'); 
    } 

    /** 
     * Provide WSDL for a model 
     */ 
    public function wsdl($model) 
    { 
        $this->autoRender = FALSE; 
        header('Content-Type: text/xml'); // Add encoding if this doesn't work e.g. header('Content-Type: text/xml; charset=UTF-8');  
        echo $this->Soap->getWSDL($model, 'call'); 
    }
    
    public function beforeFilter() {
        $this->Auth->allow();
    }
    
} 
?>
