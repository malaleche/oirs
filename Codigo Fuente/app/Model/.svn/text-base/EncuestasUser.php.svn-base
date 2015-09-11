<?php
App::uses('AppModel', 'Model');
/**
 * EncuestasUser Model
 *
 * @property Encuesta $Encuesta
 * @property User $User
 * @property Pregunta $Pregunta
 * @property Alternativa $Alternativa
 */
class EncuestasUser extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'encuestas_users';


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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Pregunta' => array(
			'className' => 'Pregunta',
			'foreignKey' => 'pregunta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Alternativa' => array(
			'className' => 'Alternativa',
			'foreignKey' => 'alternativa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
