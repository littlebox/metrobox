<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property Estate $Estate
 */
class Image extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Estate' => array(
			'className' => 'Estate',
			'foreignKey' => 'estate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
