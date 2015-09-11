<?php  
//App::import('Component', 'Component');
App::import('Vendor','IPReflectionClass',array('file'=>'wshelper'.DS.'IPReflectionClass.class.php'));
App::import('Vendor','IPReflectionCommentParser',array('file'=>'wshelper'.DS.'IPReflectionCommentParser.class.php')); 
App::import('Vendor','IPXMLSchema',array('file'=>'wshelper'.DS.'IPXMLSchema.class.php'));
App::import('Vendor','IPReflectionProperty',array('file'=>'wshelper'.DS.'IPReflectionProperty.class.php'));
App::import('Vendor','IPReflectionMethod',array('file'=>'wshelper'.DS.'IPReflectionMethod.class.php'));
App::import('Vendor','WSDLStruct',array('file'=>'wshelper'.DS.'WSDLStruct.class.php')); 
App::import('Vendor','WSDLException',array('file'=>'wshelper'.DS.'WSDLException.class.php'));

//clases definidas por el usuario
App::import('Vendor','AnotacionType',array('file'=>'wshelper'.DS.'AnotacionType.php'));

/** 
 * Class SoapComponent 
 * 
 * Generate WSDL and handle SOAP calls 
 */ 
class SoapComponent extends Component 
{ 
    var $params = array();
    //Definir tipo de datos personales luago hacerles un APP::import
    var $cm = array(
        'classmap'=>array(
            'AnotacionType'=>'AnotacionType'
            )
        );
    /**
     * 
     * @param type $controller
     * 
     */
    function initialize(Controller $controller) 
    { 
        $this->params = $controller->params; 
    } 
     
    /** 
     * Get WSDL for specified model. 
     * 
     * @param string $modelClass : model name in camel case 
     * @param string $serviceMethod : method of the controller that will handle SOAP calls 
     */ 
    function getWSDL($modelId, $serviceMethod = 'call') 
    { 
        $modelClass = $this->__getModelClass($modelId);
        $expireTime = '+1 year'; 
        $cachePath = $modelClass . '.wsdl'; 
         
        // Check cache if exist 
        $wsdl = cache($cachePath, null, $expireTime); 
        // If DEBUG > 0, compare cache modified time to model file modified time 
        if ((Configure::read() > 0) && (! is_null($wsdl))) { 
            $cacheFile = CACHE . $cachePath; 
            if (is_file($cacheFile)) { 
                $modelMtime = filemtime($this->__getModelFile($modelId)); 
                $cacheMtime = filemtime(CACHE . $cachePath); 
                if ($modelMtime > $cacheMtime) { 
                    $wsdl = null; 
                } 
            } 

        }
        // Generate WSDL if not cached 
        if (is_null($wsdl)) { 
            $refl = new IPReflectionClass($modelClass);
            $controllerName = $this->params['controller']; 
            $serviceURL = Router::url("/$controllerName/$serviceMethod", true); 

            $wsdlStruct = new WSDLStruct('http://schema.example.com',  
                                         $serviceURL . '/' . $modelId,  
                                         SOAP_RPC,  
                                         SOAP_LITERAL); 
            $wsdlStruct->setService($refl); 
            try { 
                $wsdl = $wsdlStruct->generateDocument(); 
                // cache($cachePath, $wsdl, $expireTime); 
            } catch (WSDLException $exception) { 
                if (Configure::read() > 0) { 
                    $exception->Display(); 
                    exit(); 
                } else { 
                    return null; 
                } 
            } 
        } 

        return $wsdl; 
    } 

    /** 
     * Handle SOAP service call 
     * 
     * @param string $modelId : underscore notation of the called model 
     *                          without _service ending 
     * @param string $wsdlMethod : method of the controller that will generate the WSDL 
     */ 
    function handle($modelId, $wsdlMethod = 'wsdl') 
    { 
        $modelClass = $this->__getModelClass($modelId); 
        $wsdlCacheFile = CACHE . $modelClass . '.wsdl'; 

        // Try to create cache file if not exists 
        if (! is_file($wsdlCacheFile)) { 
            $this->getWSDL($modelId); 
        } 

        if (is_file($wsdlCacheFile)) { 
            $server = new SoapServer($wsdlCacheFile); 
        } else { 
            $controllerName = $this->params['controller']; 
            $wsdlURL = Router::url("/$controllerName/$wsdlMethod", true); 
            $server = new SoapServer($wsdlURL . '/' . $modelId, $this->cm); 
        } 
        $server->setClass($modelClass); 
        $server->handle(); 
    } 

    /** 
     * Get model class for specified model id 
     * 
     * @access private 
     * @return string : the model id 
     */ 
    function __getModelClass($modelId) 
    { 
        $inflector = new Inflector; 
        return ($inflector->camelize($modelId) . 'Service'); 
    } 

    /** 
     * Get model id for specified model class 
     * 
     * @access private 
     * @return string : the model id 
     */ 
    function __getModelId($modelClass) 
    { 
        $inflector = new Inflector; 
        return $inflector->underscore(substr($class, 0, -7)); 
    } 

    /** 
     * Get model file for specified model id 
     * 
     * @access private 
     * @return string : the filename 
     */ 
    function __getModelFile($modelId) 
    { 
        $modelDir = dirname(dirname(dirname(__FILE__))) . DS . 'models'; 
        return $modelDir . DS . $modelId . '_service.php'; 
    } 
} 
?>