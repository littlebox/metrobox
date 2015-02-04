<?php
App::uses('AppModel', 'Model');
/**
 * Estate Model
 *
 * @property OperationEstate $Operation
 * @property TypeEstate $Type
 */
class Estate extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Operation' => array(
			'className' => 'EstateOperation',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'EstateType',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
