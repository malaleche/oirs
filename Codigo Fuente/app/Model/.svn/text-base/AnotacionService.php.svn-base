<?php

App::uses('AppModel', 'Model');

class AnotacionService extends AppModel {

    var $name = 'AnotacionService';
    var $useTable = 'anotaciones';

    /**
     * Entrega una anotacion que corresponda al $id suministrado
     * @param int $id
     * @return AnotacionType[]
     */
    function anotacion($id) {
        $this->recursive = -1;
        $a = $this->find('first', array('conditions' => array('id' => $id)));
        if (!is_null($a)) {
            if ($a['AnotacionService']['area_id']) {
                $test = $this->query('Select area from areas where id =' . $a['AnotacionService']['area_id']);
                $a['AnotacionService']['area_id'] = $test[0]['areas']['area'];
            }
            if ($a['AnotacionService']['estado_id']) {
                $test = $this->query('Select estado from estados where id = ' . $a['AnotacionService']['estado_id']);
                $a['AnotacionService']['estado_id'] = $test[0]['estados']['estado'];
            }
            if ($a['AnotacionService']['tipo_anotacion_id']) {
                $test = $this->query('Select tipo from tipos_anotaciones where id = ' . $a['AnotacionService']['tipo_anotacion_id']);
                $a['AnotacionService']['tipo_anotacion_id'] = $test[0]['tipos_anotaciones']['tipo'];
            }
            if ($a['AnotacionService']['tipo_ingreso_id']) {
                $test = $this->query('Select tipo from tipos_ingresos where id = ' . $a['AnotacionService']['tipo_ingreso_id']);
                $a['AnotacionService']['tipo_ingreso_id'] = $test[0]['tipos_ingresos']['tipo'];
            }
            if ($a['AnotacionService']['tipo_plazo_id']) {
                $test = $this->query('Select tipo from tipos_plazos where id = ' . $a['AnotacionService']['tipo_plazo_id']);
                $a['AnotacionService']['tipo_plazo_id'] = $test[0]['tipos_plazos']['tipo'];
            }
            if ($a['AnotacionService']['user_id']) {
                $test = $this->query('Select username from users where id = ' . $a['AnotacionService']['user_id']);
                $a['AnotacionService']['user_id'] = $test[0]['users']['username'];
            }
        }
        return $a;
    }

}

?>