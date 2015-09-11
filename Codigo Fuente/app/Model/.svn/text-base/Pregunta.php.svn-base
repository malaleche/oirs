<?php
App::uses('AppModel', 'Model');
/**
 * Pregunta Model
 *
 * @property Encuesta $Encuesta
 * @property Alternativa $Alternativa
 * @property EncuestasUser $EncuestasUser
 */
class Pregunta extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
//	public $validate = array(
//		'pregunta' => array(
//			'notempty' => array(
//				'rule' => array('notempty'),
//				//'message' => 'Your custom message here',
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
		'Encuesta' => array(
			'className' => 'Encuesta',
			'foreignKey' => 'encuesta_id',
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
		'Alternativa' => array(
			'className' => 'Alternativa',
			'foreignKey' => 'pregunta_id',
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
		'EncuestasUser' => array(
			'className' => 'EncuestasUser',
			'foreignKey' => 'pregunta_id',
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
