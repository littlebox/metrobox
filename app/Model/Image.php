<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property Winery $Winery
 */
class Image extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Winery' => array(
			'className' => 'Winery',
			'foreignKey' => 'winery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
