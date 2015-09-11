<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property Anotacion $Anotacion
 */
class Area extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'area';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'area' => array(
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
			'foreignKey' => 'area_id',
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
