<?php

App::uses('AppController', 'Controller');
App::uses('AnotacionesController', 'Controller');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OirsController
 *
 * @author JAVIER
 */
class OirsController extends AppController {

    //put your code here

	public $paginate = array(
        'limit' => 100000,
		'maxLimit' => 100000,
        'order' => array(
            'Anotacion.id' => 'desc'
        )
    );
	
    public $uses = array('Anotacion');

    public function index() {
        $this->Anotacion->recursive = 1;

        $anotacionesNormal = $this->Anotacion->query('SELECT Estado.estado,COUNT(Anotacion.id) AS C
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE User.username != "transparenciapasiva"
                                                    GROUP BY Estado.estado
                                                    UNION
                                                    SELECT Estado.estado, 0 AS C
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE Estado.estado NOT IN (SELECT Estado.estado
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE User.username != "transparenciapasiva"
                                                    GROUP BY Estado.estado)
                                                    GROUP BY Estado.estado');
        $anotacionesTrans = $this->Anotacion->query('SELECT Estado.estado,COUNT(Anotacion.id) AS C
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE User.username = "transparenciapasiva"
                                                    GROUP BY Estado.estado
                                                    UNION
                                                    SELECT Estado.estado, 0 AS C
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE Estado.estado NOT IN (SELECT Estado.estado
                                                    FROM estados AS Estado Left JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id
                                                    left JOIN users AS User ON User.id = Anotacion.user_id                                            
                                                    WHERE User.username = "transparenciapasiva"
                                                    GROUP BY Estado.estado)
                                                    GROUP BY Estado.estado');
        $estadosAnotNormalPrioriRoja = $this->Anotacion->query('SELECT Estado.estado
                                                FROM ((estados AS Estado INNER JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id)
                                                      INNER JOIN users AS User ON User.id = Anotacion.user_id)
                                                      INNER JOIN tipos_plazos AS TiposPlazos ON TiposPlazos.id = Anotacion.tipo_plazo_id  
                                                WHERE User.username != "transparenciapasiva" AND TiposPlazos.tipo = "Urgente"
                                                GROUP BY Estado.estado');
        $estadosAnotTransPrioriRoja = $this->Anotacion->query('SELECT Estado.estado
                                                FROM ((estados AS Estado INNER JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id)
                                                      INNER JOIN users AS User ON User.id = Anotacion.user_id)
                                                      INNER JOIN tipos_plazos AS TiposPlazos ON TiposPlazos.id = Anotacion.tipo_plazo_id  
                                                WHERE User.username = "transparenciapasiva" AND TiposPlazos.tipo = "Urgente"
                                                GROUP BY Estado.estado');
        $estadosAnotNormalPrioriAmarilla = $this->Anotacion->query('SELECT Estado.estado
                                                FROM ((estados AS Estado INNER JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id)
                                                      INNER JOIN users AS User ON User.id = Anotacion.user_id)
                                                      INNER JOIN tipos_plazos AS TiposPlazos ON TiposPlazos.id = Anotacion.tipo_plazo_id  
                                                WHERE User.username != "transparenciapasiva" 
                                                AND DATE_ADD(DATE(Anotacion.created), INTERVAL Anotacion.extension_plazo DAY) < DATE(NOW())
                                                AND Estado.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente")
                                                GROUP BY Estado.estado');
        $estadosAnotTransPrioriAmarilla = $this->Anotacion->query('SELECT Estado.estado
                                                FROM ((estados AS Estado INNER JOIN anotaciones AS Anotacion ON Estado.id = Anotacion.estado_id)
                                                      INNER JOIN users AS User ON User.id = Anotacion.user_id)
                                                      INNER JOIN tipos_plazos AS TiposPlazos ON TiposPlazos.id = Anotacion.tipo_plazo_id  
                                                WHERE User.username = "transparenciapasiva" 
                                                AND DATE_ADD(DATE(Anotacion.created), INTERVAL Anotacion.extension_plazo DAY) < DATE(NOW())
                                                AND Estado.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente")
                                                GROUP BY Estado.estado');

        $this->set(compact('anotacionesNormal', 'anotacionesTrans', 'estadosAnotNormalPrioriRoja', 'estadosAnotTransPrioriRoja', 'estadosAnotNormalPrioriAmarilla', 'estadosAnotTransPrioriAmarilla'));
    }

    public function desempenoMunicipal() {
        //$this->layout = 'oirs';
        $this->Anotacion->recursive = 2;
        //Anotaciones POR unidad
        if ($this->request->is('post')) {
            $unidad = $this->Session->read('Auth.User.unidad_id') != '' ? ' AND U.id = ' . $this->Session->read('Auth.User.unidad_id') : '';
//            $anotUni = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS Total
//                                       FROM ((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
//                                       WHERE DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
//                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
//                                       GROUP BY U.id');
            if ($this->Session->read('Auth.User.Rol.rol') == 'unidad') {
                $anotUni = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS Total
                                       FROM unidades AS U
                                        LEFT JOIN anotaciones_unidades AS A_U ON U.id = A_U.unidad_id
                                        LEFT JOIN anotaciones AS A ON A.id = A_U.anotacion_id
                                        LEFT JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id
                                        WHERE DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                        AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                        GROUP BY U.unidad
                                        UNION
                                        SELECT U.unidad, 0 AS Total
                                        FROM unidades as U
                                        WHERE U.unidad = "nada"
                                        GROUP BY U.unidad');
            } else {
                $anotUni = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS Total
                                       FROM unidades AS U
                                        LEFT JOIN anotaciones_unidades AS A_U ON U.id = A_U.unidad_id
                                        LEFT JOIN anotaciones AS A ON A.id = A_U.anotacion_id
                                        LEFT JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id
                                        WHERE DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                        AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                        GROUP BY U.unidad
                                        UNION
                                        SELECT U.unidad, 0 AS Total
                                        FROM unidades as U
                                        WHERE U.unidad NOT IN (SELECT U.unidad
                                                                FROM unidades AS U
                                                                LEFT JOIN anotaciones_unidades AS A_U ON U.id = A_U.unidad_id
                                                                LEFT JOIN anotaciones AS A ON A.id = A_U.anotacion_id
                                                                LEFT JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id
                                                                WHERE DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                                                AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                                                GROUP BY U.unidad)
                                        GROUP BY U.unidad');
										
            }
			
			//echo "Origen: ".$this->request->data('DesempenoMunicipal.origen');
			//echo "Unidad: ". $unidad;
			//exit();
			
            //Anotaciones Por Unidad Abiertas
            $anotUniAbi = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS Abiertas
                                       FROM (((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                       GROUP BY U.id');

            //Anotaciones Abiertas Fuera de plazo
            $anotUniAbiFP = $this->Anotacion->query('SELECT U.unidad,COUNT(A.id) AS AbiFP
                                       FROM ((((anotaciones AS A INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) < DATE(NOW())   
                                       GROUP BY U.id');
									   
            //Anotaciones Abiertas Dentro de Plazo
            $anotUniAbiDP = $this->Anotacion->query('SELECT U.unidad,COUNT(A.id) AS AbiDP
                                       FROM ((((anotaciones AS A INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) >= DATE(NOW())  
                                       GROUP BY U.id');

            //Anotaciones POR Unidad COn respuesta
            $anotUniConRes = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS "Con Respuesta"
                                       FROM (((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado IN ("Con Respuesta", "Cerrado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                       GROUP BY U.id');
            //Anotaciones con respuestas Fuera de plazo
            $anotUniConResFP = $this->Anotacion->query('SELECT U.unidad,COUNT(A.id) AS ConResFP
                                       FROM (((((anotaciones AS A INNER JOIN respuestas AS R ON A.id = R.anotacion_id) INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado IN ("Con Respuesta", "Cerrado", "Solucion Pendiente")
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) < DATE(R.created)   
                                       GROUP BY U.id');
            //Anotaciones con respuesta Dentro de Plazo
            $anotUniConResDP = $this->Anotacion->query('SELECT U.unidad,COUNT(A.id) AS ConResDP
                                       FROM (((((anotaciones AS A INNER JOIN respuestas AS R ON A.id = R.anotacion_id) INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado IN ("Con Respuesta", "Cerrado", "Solucion Pendiente")
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) >= DATE(R.created)  
                                       GROUP BY U.id'); //Promedio dias retraso ConRes
            $sumConRes = $this->Anotacion->query('SELECT U.unidad, SUM(DATEDIFF(DATE(R.created),DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY))) AS sumConRes
                                       FROM (((((anotaciones AS A INNER JOIN respuestas AS R ON A.id = R.anotacion_id) INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado IN ("Con Respuesta", "Cerrado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) < DATE(R.created)   
                                       GROUP BY U.id');
            $sumAbi = $this->Anotacion->query('SELECT U.unidad, SUM(DATEDIFF(DATE(NOW()),DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY))) AS sumAbi
                                       FROM ((((anotaciones AS A INNER JOIN tipos_plazos AS T_P ON A.tipo_plazo_id = T_P.id) INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado NOT IN ("Con Respuesta", "Cerrado", "Rechazado", "Solucion Pendiente") 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                           AND DATE_ADD(DATE(A.created), INTERVAL A.extension_plazo DAY) < DATE(NOW())   
                                       GROUP BY U.id');
            //Anotaciones Rechazadas
            $anotRech = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS Rechazadas
                                       FROM (((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado = "Rechazado" 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                       GROUP BY U.id');
            //Anotaciones Cerradas
            $anotCerr = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS anotCerr
                                       FROM (((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado = "Cerrado" 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                       GROUP BY U.id');
            //Anotaciones Solucion Pendiente
            $anotSolPen = $this->Anotacion->query('SELECT U.unidad, COUNT(A.id) AS anotSolPen
                                       FROM (((anotaciones AS A INNER JOIN tipos_ingresos AS T_I ON A.tipo_ingreso_id = T_I.id) INNER JOIN estados AS E ON A.estado_id = E.id) INNER JOIN anotaciones_unidades AS A_U ON A.id = A_U.anotacion_id) INNER JOIN unidades as U ON U.id = A_U.unidad_id
                                       WHERE E.estado = "Solucion Pendiente" 
                                           AND DATE(A.created) BETWEEN "' . $this->request->data('DesempenoMunicipal.desde') . '" AND "' . $this->request->data('DesempenoMunicipal.hasta') . '"
                                           AND T_I.tipo LIKE "%' . $this->request->data('DesempenoMunicipal.origen') . '%"' . $unidad . '
                                       GROUP BY U.id');
        }
        $resultados = array();
		
        if (!empty($anotUni)) {
            foreach ($anotUni as $key => $value) {
                $resultados['U'][$key]['unidad'] = $value[0]['unidad'];
                $resultados['U'][$key]['Total'] = $value[0]['Total'];
                $resultados['forma'] = $this->request->data('DesempenoMunicipal.forma');
                if (!empty($anotUniAbi)) {
                    foreach ($anotUniAbi as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['Abiertas'] = $value1[0]['Abiertas'];
                        }
                    }
                }
                if (!empty($anotUniConRes)) {
                    foreach ($anotUniConRes as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['ConRes'] = $value1[0]['Con Respuesta'];
                        }
                    }
                }
                if (!empty($anotRech)) {
                    foreach ($anotRech as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['Rechazadas'] = $value1[0]['Rechazadas'];
                        }
                    }
                }
                if (!empty($anotUniAbiFP)) {
                    foreach ($anotUniAbiFP as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['AbiFP'] = $value1[0]['AbiFP'];
                        }
                    }
                }
                if (!empty($anotUniAbiDP)) {
                    foreach ($anotUniAbiDP as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['AbiDP'] = $value1[0]['AbiDP'];
                        }
                    }
                }
                if (!empty($anotUniConResFP)) {
                    foreach ($anotUniConResFP as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['ConResFP'] = $value1[0]['ConResFP'];
                        }
                    }
                }
                if (!empty($anotUniConResDP)) {
                    foreach ($anotUniConResDP as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['ConResDP'] = $value1[0]['ConResDP'];
                        }
                    }
                }

                if (!empty($sumAbi)) {
                    foreach ($sumAbi as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['sumAbi'] = $value1[0]['sumAbi'];
                        }
                    }
                }

                if (!empty($sumConRes)) {
                    foreach ($sumConRes as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['sumConRes'] = $value1[0]['sumConRes'];
                        }
                    }
                }

                if (!empty($anotCerr)) {
                    foreach ($anotCerr as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['anotCerr'] = $value1[0]['anotCerr'];
                        }
                    }
                }

                if (!empty($anotSolPen)) {
                    foreach ($anotSolPen as $key1 => $value1) {
                        if ($value[0]['unidad'] == $value1['U']['unidad']) {
                            $resultados['U'][$key]['anotSolPen'] = $value1[0]['anotSolPen'];
                        }
                    }
                }
            }
        }
		
        $this->Session->write('Resultados', $resultados);
        $this->set(compact('resultados'));
    }

    public function reporteDesempeno() {
        if ($this->request->is('post')) {
            $this->layout = 'export_xls';
            $resultados = $this->Session->read('Resultados');
            $this->set(compact('resultados'));
            $this->Session->delete('Resultados');
        }else{
            $this->redirect($this->referer());
        }
    }

    public function categorizacion() {
        //$this->layout = 'oirs';
        $this->Anotacion->recursive = 2;
        $porEstado = $this->Anotacion->Estado->query('SELECT E.estado,COUNT( A.id ) AS Cant
                                                        FROM estados AS E
                                                        LEFT JOIN anotaciones AS A ON E.id = A.estado_id
                                                        GROUP BY E.estado');
        $porUnidad = $this->Anotacion->Unidad->query('SELECT U.unidad, count(A.id)  AS Cant
                                                        FROM unidades AS U Left join anotaciones_unidades AS AU ON U.id = AU.unidad_id 
                                                        left JOIN anotaciones AS A ON AU.anotacion_id = A.id 
                                                        left join estados AS E ON A.estado_id = E.id
                                                        where E.id IN (Select estados.id 
                                                                        from estados 
                                                                        where estados.estado NOT IN ("Cerrado","Rechazado","Con Respuesta")) 
                                                                            Or E.id is NULL
                                                        GROUP BY U.unidad');

        $porArea = $this->Anotacion->Area->query('SELECT Ar.area,Ar.id, count(A.id)  AS Cant
                                                    FROM (areas AS Ar Left join anotaciones AS A ON Ar.id = A.area_id)left join estados AS E ON A.estado_id = E.id
                                                    where E.id IN (Select estados.id from estados where estados.estado NOT IN ("Cerrado","Rechazado","Con Respuesta")) OR A.area_id is null
                                                    GROUP BY Ar.area');
        $porTipo = $this->Anotacion->TiposAnotacion->query('SELECT T.tipo, T.id, count(A.id)  AS Cant
                                                            FROM (tipos_anotaciones AS T Left join anotaciones AS A ON T.id = A.tipo_anotacion_id)left join estados AS E ON A.estado_id = E.id
                                                            where E.id IN (Select estados.id from estados where estados.estado NOT IN ("Cerrado","Rechazado","Con Respuesta")) OR A.tipo_anotacion_id is null
                                                            GROUP BY T.tipo');
        $porPlazo = $this->Anotacion->TiposPlazo->query('SELECT T.tipo, T.id, count(A.id)  AS Cant
                                                        FROM (tipos_plazos AS T Left join anotaciones AS A ON T.id = A.tipo_plazo_id)left join estados AS E ON A.estado_id = E.id
                                                        where E.id IN (Select estados.id from estados where estados.estado NOT IN ("Cerrado","Rechazado","Con Respuesta")) or A.tipo_plazo_id is null
                                                        GROUP BY T.tipo');

        $this->set(compact('porEstado', 'porUnidad', 'porArea', 'porTipo', 'porPlazo'));
    }

    public function controlAnotaciones() {
        //$this->layout = 'oirs';
        $this->Anotacion->recursive = 1;
		
        if ($this->request->is('post')) {  //Pregunta si viene desde una petición tipo post formulario
            $datos = $this->request->data;
            $conditions = array('conditions' => array());
            if ($datos['Anotacion']['id1'] != '') {
                $conditions['conditions']['Anotacion.id'] = $datos['Anotacion']['id1'];
                if ($this->Session->read('Auth.User.Rol.rol') == 'user') {
                    $conditions['conditions']['Anotacion.user_id'] = $this->Auth->user('id');
                }
                if (!array_key_exists('AnotacionesUnidad', $datos)) {
                    $anotacion_id = array();
                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
                    foreach ($array as $key1 => $value) {
                        foreach ($array[$key1] as $key => $value) {
                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
                        }
                    }
                    if (!in_array($datos['Anotacion']['id1'], $anotacion_id)) {
                        $conditions['conditions']['Anotacion.id'] = -1;
                    }
                }
                $this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
            } else {
                foreach ($datos['Anotacion'] as $key => $value) {
                    if ($datos['Anotacion'][$key] != '' && !in_array($key, array('desde', 'hasta', 'id'))) {
                        $conditions['conditions']['Anotacion' . '.' . $key] = $value;
                    }
                }
                if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] != '') {
                    $conditions['conditions']['DATE(Anotacion.created) BETWEEN ? AND ?'] = array($datos['Anotacion']['desde'], $datos['Anotacion']['hasta']);
                }
                if ($datos['Anotacion']['desde'] != '' && $datos['Anotacion']['hasta'] == '') {
                    $conditions['conditions']['DATE(Anotacion.created) >='] = $datos['Anotacion']['desde'];
                }
                if ($datos['Anotacion']['desde'] == '' && $datos['Anotacion']['hasta'] != '') {
                    $conditions['conditions']['DATE(Anotacion.created) <='] = $datos['Anotacion']['hasta'];
                }


                if (isset($datos['AnotacionesUnidad']) && $datos['AnotacionesUnidad']['unidad_id'] != '') {
                    $anotacion_id = array();
                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $datos['AnotacionesUnidad']['unidad_id'])));
                    foreach ($array as $key1 => $value) {
                        foreach ($array[$key1] as $key => $value) {
                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
                        }
                    }
                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
                } else if (!isset($datos['AnotacionesUnidad']) && !empty($conditions['conditions'])) {
                    $anotacion_id = array();
                    $array = $this->Anotacion->AnotacionesUnidad->find('all', array('fields' => array('anotacion_id'), 'conditions' => array('AnotacionesUnidad.unidad_id' => $this->Session->read('Auth.User.unidad_id'))));
                    foreach ($array as $key1 => $value) {
                        foreach ($array[$key1] as $key => $value) {
                            $anotacion_id[] = $array[$key1][$key]['anotacion_id'];
                        }
                    }
                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
                }
                $this->Anotacion->User->recursive = -1;
                if ($this->Auth->user('Rol.rol') == 'user' && !empty($conditions['conditions'])) {
                    $conditions['conditions']['Anotacion.user_id'] = $this->Auth->user('id');
                } else {
                    //$user = $this->Anotacion->User->findByUsername($datos['User']['id']);
                    if (!empty($datos['User']['id'])) {
                        $user = $this->Anotacion->User->findByUsername($datos['User']['id']);
                        $conditions['conditions']['Anotacion.user_id'] = $user['User']['id'];
                    }
                }
//                if ($datos['AnotacionesUnidad']['unidad_id'] != '') {
//                    $conditions['conditions']['Anotacion.id'] = $anotacion_id;
//                    //debug($conditions);
//                    //$this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
//                }
                if (!empty($conditions['conditions'])) {
                    $this->set('anotaciones', $this->paginate('Anotacion', $conditions['conditions']));
                }
            }
        }
		
        $areas = $this->Anotacion->Area->find('list');
        $tipoAnotaciones = $this->Anotacion->TiposAnotacion->find('list');
        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
        $estados = $this->Anotacion->Estado->find('list');
        $unidades = $this->Anotacion->Unidad->find('list');
        $this->set(compact('areas', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'unidades'));
    }
	

    public function beforeFilter() {
        parent::beforeFilter();
        //parent::beforeRender();
        $usuario = $this->Auth->user('Rol.rol');
        if ($usuario == 'user') {
            $this->layout = 'usuario';
        } else if ($usuario == 'oirs') {
            $this->layout = 'oirs';
        } else if ($usuario == 'admin') {
            $this->layout = 'default';
        } else if ($usuario == 'unidad') {
            $this->layout = 'unidad';
        } else {
            $this->layout = 'index';
        }
    }

    public function isAuthorized($user) {
        if ($this->Session->read('Auth.User.Rol.rol') == 'unidad') {
            if (in_array($this->action, array('controlAnotaciones', 'buscar', 'desempenoMunicipal', 'reporteDesempeno'))) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
	
	public function filtrounidades(){
	
		$this->Anotacion->recursive = 1;
		
		$dfplazo 	= ( isset( $this->params['url']['dfplazo'] ) )? $this->params['url']['dfplazo']: $this->passedArgs['dfplazo'];
		$desde 		= ( isset( $this->params['url']['desde'] ) )? $this->params['url']['desde']: $this->passedArgs['desde'];
		$hasta 		= ( isset( $this->params['url']['hasta'] ) )? $this->params['url']['hasta']: $this->passedArgs['hasta'];
		$unidad_id 	= ( isset( $this->params['url']['unidad_id'] ) )? $this->params['url']['unidad_id']: $this->passedArgs['unidad_id'];
		$fch_now    = date('Y-m-d');
		
		if(($desde != '')&&($hasta != '')){		
		
			if($dfplazo == 0){
			
				$this->paginate = array('conditions' => array('Anotacion.estado_id NOT IN (?, ?, ?, ?)'  => array(3, 2, 5, 9),
															  'DATE(Anotacion.created) BETWEEN ? AND ?' => array($desde,$hasta),
															  'Anotacion.tipo_ingreso_id' => 1,
															  'DATE_ADD(DATE(Anotacion.created), INTERVAL Anotacion.extension_plazo DAY) <' => $fch_now,
															  'anotacionesunidad.unidad_id LIKE' =>  '%'. $unidad_id .'%'),
										'joins' => array(
														array(
															'alias' => 'anotacionesunidad',
															'table' => 'anotaciones_unidades',
															'type' => 'INNER',
															'conditions' => '`anotacionesunidad`.`anotacion_id` = `Anotacion`.`id`')),
										'limit' => 30,
										'order' => array('Anotacion.id' => 'asc'),
										
										);	
				
			}elseif($dfplazo == 1){
			
				$this->paginate = array('conditions' => array('Anotacion.estado_id NOT IN (?, ?, ?, ?)'  => array(3, 2, 5, 9),
															  'DATE(Anotacion.created) BETWEEN ? AND ?' => array($desde,$hasta),
															  'Anotacion.tipo_ingreso_id' => 1,
															  'DATE_ADD(DATE(Anotacion.created), INTERVAL Anotacion.extension_plazo DAY) >=' => $fch_now,
															  'anotacionesunidad.unidad_id LIKE' =>  '%'. $unidad_id .'%'),
										'joins' => array(
														array(
															'alias' => 'anotacionesunidad',
															'table' => 'anotaciones_unidades',
															'type' => 'INNER',
															'conditions' => '`anotacionesunidad`.`anotacion_id` = `Anotacion`.`id`')),
										'limit' => 30,
										'order' => array('Anotacion.id' => 'asc'),
										
										);			
				
			}
			
			$anotaciones = $this->paginate($this->Anotacion);
			$this->Session->write('Anotaciones', $anotaciones);
			$this->set(compact('anotaciones'));			

		}
		
        $tipoPlazos = $this->Anotacion->TiposPlazo->find('list');
        $estados = $this->Anotacion->Estado->find('list');
        $unidades = $this->Anotacion->Unidad->find('list');
        $this->set(compact('areas', 'tipoAnotaciones', 'tipoPlazos', 'estados', 'unidades'));
	
	}
	
    public function reporteanot() {

            $this->layout = 'export_xls';
            $anotaciones = $this->Session->read('Anotaciones');

            $this->set(compact('anotaciones'));
            $this->Session->delete('Anotaciones');
			
    }	

}
?>

