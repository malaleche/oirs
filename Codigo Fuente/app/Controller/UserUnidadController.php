<?php

App::uses('AppController', 'Controller');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserUnidadControllers
 *
 * @author JAVIER
 */
class UserUnidadController extends AppController {

    //put your code here
    public $uses = array('Anotacion');

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Anotacion.id' => 'desc'
        )
    );
    
    public function index($condicion = null) {
        $this->layout = 'unidad';
        $this->Anotacion->recursive = 0;
        //$this->set(compact('anotaciones'));
        $li = array();
        $list_anotaciones = $this->Anotacion->AnotacionesUnidad->findAllByUnidadId($this->Session->read('Auth.User.unidad_id'));
        foreach ($list_anotaciones as $key1 => $value) {
            foreach ($list_anotaciones[$key1] as $key2 => $value) {
                $li[] = $list_anotaciones[$key1][$key2]['anotacion_id'];
            }
        }
        if ($condicion != null) {
            $this->set('anotaciones',$this->paginate('Anotacion',array('Anotacion.id' => $li,'OR'=>array('Estado.estado'=>$condicion, 'TiposAnotacion.tipo'=>$condicion,'TiposPlazo.tipo'=>$condicion))));
        } else {
            $this->set('anotaciones', $this->paginate('Anotacion', array('NOT' => array('estado_id' => $this->Anotacion->Estado->find('list', array('fields' => array('id'), 'conditions' => array('estado' => array('Cerrado', 'Con Respuesta', 'Rechazado'))))), 'Anotacion.id' => $li)));
        }
    }

    public function respuesta() {
        $this->layout = 'unidad';
        $this->Anotacion->recursive = 2;
        //$this->set(compact('anotaciones'));
        $li = array();
        $list_anotaciones = $this->Anotacion->AnotacionesUnidad->findAllByUnidadId($this->Session->read('Auth.User.unidad_id'));
        foreach ($list_anotaciones as $key1 => $value) {
            foreach ($list_anotaciones[$key1] as $key2 => $value) {
                $li[] = $list_anotaciones[$key1][$key2]['anotacion_id'];
            }
        }
        $this->set('anotaciones', $this->paginate('Anotacion', array('estado_id' => $this->Anotacion->Estado->find('list', array('fields' => array('id'), 'conditions' => array('estado' => 'Con Respuesta'))), 'Anotacion.id' => $li)));
        //debug($this->Anotacion->Estado->find('list',array('fields'=>array('id'),'conditions'=>array('estado'=>'Con Respuesta'))));
    }

    public function pendiente() {
        $this->layout = 'unidad';
        $this->Anotacion->recursive = 2;
        //$this->set(compact('anotaciones'));
        $li = array();
        $list_anotaciones = $this->Anotacion->AnotacionesUnidad->findAllByUnidadId($this->Session->read('Auth.User.unidad_id'));
        foreach ($list_anotaciones as $key1 => $value) {
            foreach ($list_anotaciones[$key1] as $key2 => $value) {
                $li[] = $list_anotaciones[$key1][$key2]['anotacion_id'];
            }
        }
        $this->set('anotaciones', $this->paginate('Anotacion', array('estado_id' => $this->Anotacion->Estado->find('list', array('fields' => array('id'), 'conditions' => array('estado' => 'Solucion Pendiente'))), 'Anotacion.id' => $li)));
        //debug($this->Anotacion->Estado->find('list',array('fields'=>array('id'),'conditions'=>array('estado'=>'Con Respuesta'))));
    }

    public function categorizacion() {
        $this->layout = 'unidad';
        $this->Anotacion->recursive = 2;
        $estados_abiertos = $this->Anotacion->Estado->find('list', array('fields' => 'id', 'conditions' => array('NOT' => array('Estado.estado' => array('Cerrado', 'Con Respuesta', 'Rechazado')))));
        //$this->Anotacion->TiposAnotacion->recursive = 2;
        $tipos = $this->Anotacion->TiposAnotacion->query('SELECT T_A.tipo, COUNT(A.id) AS Cant
                                        FROM tipos_anotaciones AS T_A 
                                        LEFT JOIN anotaciones AS A ON T_A.id = A.tipo_anotacion_id 
                                        LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id 
                                        LEFT JOIN unidades AS U ON A_U.unidad_id = U.id 
                                        LEFT JOIN estados AS E ON E.id = A.estado_id
                                        WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . ' AND E.id IN (' . implode(',', $estados_abiertos) . ') 
                                        GROUP BY T_A.tipo  
                                        UNION
                                        SELECT T_A.tipo, 0 AS Cantidad 
                                        FROM tipos_anotaciones AS T_A 
                                        LEFT JOIN anotaciones AS A ON T_A.id = A.tipo_anotacion_id 
                                        LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id 
                                        LEFT JOIN unidades AS U ON A_U.unidad_id = U.id 
                                        LEFT JOIN estados AS E ON E.id = A.estado_id
                                        WHERE T_A.tipo NOT IN (SELECT T_A.tipo
                                        FROM tipos_anotaciones AS T_A 
                                        LEFT JOIN anotaciones AS A ON T_A.id = A.tipo_anotacion_id 
                                        LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id
                                        LEFT JOIN unidades AS U ON A_U.unidad_id = U.id 
                                        LEFT JOIN estados AS E ON E.id = A.estado_id
                                        WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . ' AND E.id IN (' . implode(',', $estados_abiertos) . ') 
                                        GROUP BY T_A.tipo)
                                        GROUP BY T_A.tipo
            ');
        //debug($tipo);
        $estados = $this->Anotacion->Estado->query('SELECT E.estado, COUNT(A.id) AS Cant
                                            FROM estados AS E
                                            LEFT JOIN anotaciones AS A ON E.id = A.estado_id
                                            LEFT JOIN anotaciones_unidades AS AU ON AU.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON U.id = AU.unidad_id
                                            WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . ' 
                                            GROUP BY E.estado
                                            UNION
                                            SELECT E.estado, 0 AS Cant
                                            FROM estados AS E
                                            LEFT JOIN anotaciones AS A ON E.id = A.estado_id
                                            LEFT JOIN anotaciones_unidades AS AU ON AU.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON U.id = AU.unidad_id
                                            WHERE E.estado NOT IN (SELECT E.estado FROM estados AS E
                                            LEFT JOIN anotaciones AS A ON E.id = A.estado_id
                                            LEFT JOIN anotaciones_unidades AS AU ON AU.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON U.id = AU.unidad_id
                                            WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . '
                                            GROUP BY E.estado) 
                                            GROUP BY E.estado
            ');
        //debug($estado);
        $plazos = $this->Anotacion->TiposPlazo->query('SELECT P.tipo, COUNT(A.id) AS Cant
                                            FROM tipos_plazos AS P 
                                            LEFT JOIN anotaciones AS A ON P.id = A.tipo_plazo_id
                                            LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON A_U.unidad_id = U.id
                                            LEFT JOIN estados AS E ON E.id = A.estado_id
                                            WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . ' AND E.id IN (' . implode(',', $estados_abiertos) . ') 
                                            GROUP BY P.tipo
                                            UNION
                                            SELECT P.tipo, 0 AS Cantidad 
                                            FROM tipos_plazos AS P 
                                            LEFT JOIN anotaciones AS A ON P.id = A.tipo_plazo_id
                                            LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON A_U.unidad_id = U.id
                                            LEFT JOIN estados AS E ON E.id = A.estado_id
                                            WHERE P.tipo NOT IN (SELECT P.tipo
                                            FROM tipos_plazos AS P 
                                            LEFT JOIN anotaciones AS A ON P.id = A.tipo_plazo_id
                                            LEFT JOIN anotaciones_unidades AS A_U ON A_U.anotacion_id = A.id
                                            LEFT JOIN unidades AS U ON A_U.unidad_id = U.id
                                            LEFT JOIN estados AS E ON E.id = A.estado_id
                                            WHERE U.id = ' . $this->Session->read('Auth.User.unidad_id') . ' AND E.id IN (' . implode(',', $estados_abiertos) . ') 
                                            GROUP BY P.tipo) 
                                            GROUP BY P.tipo
            ');
        //debug($plazo);
        //$this->autoRender=false;
        $this->set(compact('estados', 'tipos', 'plazos'));
    }

    
    public function beforeFilter() {
        if ($this->Session->read('Auth.User.Rol.rol') == 'unidad')
            $this->Auth->allow();
        else
            $this->Auth->deny();
    }

}

?>
