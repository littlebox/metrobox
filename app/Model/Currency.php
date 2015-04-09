<?php
App::uses('AppModel', 'Model');
/**
 * Estate Model
 *
 * @property Type $Type
 * @property Operation $Operation
 */
class Currency extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasMany = array('Estate');
}