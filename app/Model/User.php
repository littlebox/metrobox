<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $validate = array(
		'email' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A username is required'
				),
			'email'=> array(
				'rule' => 'email',
				'message' => 'Username must be an email'

				)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please confirm your password'
			),
			'equaltofield' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'Passwords don\'t match.'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'author')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);

	public function equaltofield($check,$otherfield){
		//get name of field
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
	}

	public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
		$passwordHasher = new BlowfishPasswordHasher();
		$this->data[$this->alias]['password'] = $passwordHasher->hash(
			$this->data[$this->alias]['password']
		);
	}
	return true;
	}

}
