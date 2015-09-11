<?php
App::uses('AppModel', 'Model');
/**
 * Encuesta Model
 *
 * @property Pregunta $Pregunta
 * @property EncuestasUser $EncuestasUser
 */
class Encuesta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'encuesta';

/**
 * Validation rules
 *
 * @var array
 */

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'encuesta_id',
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
			'foreignKey' => 'encuesta_id',
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
