<?php
App::uses('AppModel', 'Model');
/**
 * Time Model
 *
 * @property ToursDay $ToursDay
 */
class Time extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hour';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'ToursDay' => array(
			'className' => 'ToursDay',
			'joinTable' => 'tours_days_times',
			'foreignKey' => 'time_id',
			'associationForeignKey' => 'tours_day_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
