<?php
App::uses('AppModel', 'Model');
/**
 * Language Model
 *
 * @property Tour $Tour
 */
class Language extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Tour' => array(
			'className' => 'Tour',
			'joinTable' => 'tours_languages',
			'foreignKey' => 'language_id',
			'associationForeignKey' => 'tour_id',
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
