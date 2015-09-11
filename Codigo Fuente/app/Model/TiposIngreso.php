<?php
App::uses('AppModel', 'Model');
/**
 * TiposIngreso Model
 *
 * @property Anotacion $Anotacion
 */
class TiposIngreso extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'tipo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Anotacion' => array(
			'className' => 'Anotacion',
			'foreignKey' => 'tipo_ingreso_id',
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

}
