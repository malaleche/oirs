<?php
App::uses('AppModel', 'Model');
/**
 * Anotacion Model
 *
 * @property User $User
 * @property TipoIngreso $TipoIngreso
 * @property TipoAnotacion $TipoAnotacion
 * @property TipoPlazo $TipoPlazo
 * @property Estado $Estado
 * @property Area $Area
 * @property ComentariosInterno $ComentariosInterno
 * @property Respuesta $Respuesta
 * @property Unidad $Unidad
 */
class Anotacion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'titulo';

/**
 * Validation rules
 *
 * @var array
 */
//	public $validate = array(
//		'titulo' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				'message' => 'Titulo obligatorio',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'cuerpo' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				'message' => 'Descripción obligatoria',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'correo' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				'message' => 'Correo obligatorio',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TiposIngreso' => array(
			'className' => 'TiposIngreso',
			'foreignKey' => 'tipo_ingreso_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TiposAnotacion' => array(
			'className' => 'TiposAnotacion',
			'foreignKey' => 'tipo_anotacion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TiposPlazo' => array(
			'className' => 'TiposPlazo',
			'foreignKey' => 'tipo_plazo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ComentariosInterno' => array(
			'className' => 'ComentariosInterno',
			'foreignKey' => 'anotacion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Respuesta' => array(
			'className' => 'Respuesta',
			'foreignKey' => 'anotacion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Unidad' => array(
			'className' => 'Unidad',
			'joinTable' => 'anotaciones_unidades',
			'foreignKey' => 'anotacion_id',
			'associationForeignKey' => 'unidad_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
        
            /** 
     * Divide two numbers 
     * 
     * @param float $a 
     * @param float $b 
     * @return float 
     */ 
    
    function divide($a, $b) 
    { 
        if ($b != 0) { 
            return ($a / $b); 
        }
        return 0;
    } 

}
