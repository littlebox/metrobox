<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('DataTable');

	public $helpers = array(
		'Form' => array('className' => 'BootstrapForm')
	);

	public function initDB() {
		$group = $this->User->Group;

		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		// allow managers to posts and widgets
		// $group->id = 2;
		// $this->Acl->deny($group, 'controllers');
		// $this->Acl->allow($group, 'controllers/Posts');
		// $this->Acl->allow($group, 'controllers/Widgets');

		// allow users to only add and edit on posts and widgets
		// $group->id = 3;
		// $this->Acl->deny($group, 'controllers');
		// $this->Acl->allow($group, 'controllers/Users/login');
		// $this->Acl->allow($group, 'controllers/Users/logout');
		// $this->Acl->allow($group, 'controllers/Pages/index');
		// $this->Acl->allow($group, 'controllers/Posts/edit');
		// $this->Acl->allow($group, 'controllers/Widgets/add');
		// $this->Acl->allow($group, 'controllers/Widgets/edit');

		// allow basic users to log out
		$this->Acl->allow($group, 'controllers/users/logout');

		// we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'forgetPassword', 'resetPassword', 'login', 'initDB');

	}

	public function indexOld() {
		$this->layout = 'metrobox';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function index(){
		$this->layout = 'metrobox';

		$this->paginate = array(
			'fields' => array('User.full_name','User.email', 'User.created', 'User.id'),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

	public function view($id = null) {
		$this->layout = 'metrobox';
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->request->data = $this->User->read(null, $id);
		unset($this->request->data['User']['password']); //To don't show password on edit

		// $this->set('user', $this->User->read(null, $id));
	}

	public function admin_add() {
		$this->layout = 'metrobox';
		if ($this->request->is('post')) {

			// debug($this->request->data['User']);die();
			$profile_picture = $this->request->data['User']['profile_picture'];
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));

				$this->setProfilePicture($profile_picture, $this->User->id);

				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	public function edit($id = null) {
		$this->layout = 'metrobox';
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {

			if(empty($this->request->data['User']['password'])){

				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);

			}

			$profile = true;

			if(empty($this->request->data['User']['profile_picture']['name'])){

				unset($this->request->data['User']['profile_picture']);

				$profile = false;

			}

			if ($this->User->save($this->request->data)) {
				if($profile){
					$this->setProfilePicture($this->request->data['User']['profile_picture'], $this->User->id);
				}
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']); //To don't show password on edit
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->User->id = $id;
			if (!$this->User->exists()) {
				$data['error'] = __('Invalid user');
			} else {
				if ($this->User->delete()) {
					$data['content'] = __('User deleted');
				} else {
					$data['error'] = __('User was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->User->delete()) {
				$this->Session->setFlash(__('User deleted'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			return $this->redirect(array('action' => 'index'));
		}



	}


	public function login() {

		$this->layout = 'metrobox_login';

		$min_attempts_show_captcha = 2;
		$this->set('min_attempts_show_captcha',$min_attempts_show_captcha);
		$time_to_count_an_attempt = '-5 minutes';

		if($this->Auth->loggedIn()){
			return $this->redirect($this->Auth->redirect());
		}

		if ($this->request->is('post')) {

			$user = $this->User->find('first', array(

					'conditions' => array(
						'User.email' => $this->request->data['User']['email'],
					),

					'fields' => array(
						'id','login_last_attempt','login_last_attempts_count'
					)

				));

			if($user){

				$attempts_count = $user['User']['login_last_attempts_count'];

				$this->set('attempts_count',$attempts_count);

				if( $attempts_count >= $min_attempts_show_captcha &&
					strtotime($user['User']['login_last_attempt']) > strtotime($time_to_count_an_attempt)){

					if (!$this->Recaptcha->verify()) {

						$this->Session->setFlash($this->Recaptcha->error, 'metrobox_flash_login');
						return null;
					}
				}

			}

			if ($this->Auth->login()) {

				$this->_setCookie($this->Auth->user('id'));
				return $this->redirect($this->Auth->redirect());

			}else{

				$this->Session->setFlash(__('Invalid username or password, try again'), 'metrobox_flash_login');

				if($user){

					$this->User->id = $user['User']['id'];

					if( strtotime($user['User']['login_last_attempt']) > strtotime($time_to_count_an_attempt) ){

						$this->User->data['User']['login_last_attempts_count'] = $attempts_count + 1;

					}else{

						$this->User->data['User']['login_last_attempts_count'] = 1;

						$this->set('attempts_count',1);

					}

					$this->User->data['User']['login_last_attempt'] = date('Y-m-d H:i:s');


					$this->User->save($this->User->data);

				}

			}

		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	function forgetPassword(){
		$this->request->onlyAllow('ajax');

		$data = array(
			'content' => '',
			'error' => '',
		);

		$this->User->recursive=-1;

		if(!empty($this->data))	{
			if(empty($this->data['User']['email']))	{
				$data['error'] = __('Please provide email adress that you used to register');
			}
			else{
				$email = $this->data['User']['email'];
				$user = $this->User->find('first',array('conditions' => array('User.email' => $email)));
				if($user)	{
					$token = Security::hash(String::uuid(),'sha512',true);
					$url = Router::url( array('controller'=>'users','action'=>'resetPassword'), true ).'/'.$token;

					$this->User->id = $user['User']['id'];

					if( $this->User->saveField('reset_password_token', $token) && $this->User->saveField('reset_password_token_created', date('Y-m-d H:i:s')) ){

						//============Email================//
						/* SMTP Options */
						$this->Email->smtpOptions = array(
							'port'=>'465',
							'timeout'=>'30',
							'host' => 'ssl://smtp.gmail.com',
							'username'=>'francisco@publinet.com.ar',
							'password'=>'05890589'
							);
						$this->Email->template = 'metrobox_reset_password';
						$this->Email->from = 'Littlebox <info@littlebox.com.ar>';
						$this->Email->to = $user['User']['email'];
						$this->Email->subject = __('Reset Your Password');
						$this->Email->sendAs = 'both';

						$this->Email->delivery = 'smtp';
						$this->set('url', $url);
						$this->Email->send();
						$this->set('smtp_errors', $this->Email->smtpError);

						$data['content']['title'] = __('Mail sended');
						$data['content']['text'] = __('Check your email to reset your password');

						//============EndEmail=============//
					}
					else{
						$data['error'] = __('Error generating reset link');
					}
				}
				else{
					$data['error'] = __('User with this email does not exist');
				}
			}

		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	function resetPassword($token = null){
		$this->layout = 'metrobox_login';

		$this->User->recursive=-1;


		do {

			//Check if token is empty
			if( empty($this->request->token) ){
				$this->Session->setFlash(__('No reset token provided.'), 'metrobox_flash_login');
				break;
			}

			$user = $this->User->find('first',array('conditions'=>array('User.reset_password_token' => $this->request->token), 'fields' => array('id', 'reset_password_token_created', 'full_name')));

			//Check if a user has been founded in DB
			if( !$user ){
				$this->Session->setFlash(__('The token has been used or is not valid.'), 'metrobox_flash_login');
				break;
			}

			//Check if token have less than one day since generated
			if( strtotime($user['User']['reset_password_token_created']) < strtotime('-3 hours') ){
				$this->Session->setFlash(__('The token has expired.'), 'metrobox_flash_login');
				break;
			}

			$this->set('user', $user); //Pass user variable to the view

			if ($this->request->is('post')) {

				$this->User->id = $user['User']['id'];
				$this->request->data['User']['reset_password_token'] = null;
				$this->User->data = $this->request->data;

				//Validate password fields with validations in model
				if(!$this->User->validates(array('fieldList'=>array('password','password_confirm')))){
					$this->set('errors', $this->User->invalidFields());
					break;
				}

				//Save new password in DB
				if($this->User->save($this->User->data)){
					$this->Session->setFlash(__('Your password has been updated!'), 'metrobox_flash_login_success');
					$this->redirect(array('controller'=>'users','action'=>'login'));
				}

			}
		} while (false); //Runs only once

	}

/*
 * Set remember login cookies ir remember checkbox was marked
 */
	protected function _setCookie($id) {
		if (!$this->request->data('remember')) {
			return false;
		}
		$data = array(
			'email' => $this->request->data('User.email'),
			'password' => $this->request->data('User.password')
		);

		$this->Cookie->write('RememberMe', $data, true, '+2 week');

		return true;
	}

	protected function setProfilePicture($profile_picture, $user_id){

		$oml = ini_get('memory_limit'); //stands for O.M.L.
		ini_set('memory_limit', '-1');

		if(empty($profile_picture['name'])){

			copy(WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.'profile_picture_default.jpg',WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.'profile_picture_'.$user_id.'.jpg');
			return true;

		}

		$src = $profile_picture['tmp_name'];

		$img_info = getimagesize($src);

		switch ($img_info[2]) {
			case IMAGETYPE_JPEG : $image = imagecreatefromjpeg($src); break;
			case IMAGETYPE_GIF: $image = imagecreatefromgif($src);break;
			case IMAGETYPE_PNG: $image = imagecreatefrompng($src);break;
		}

		// Set a maximum height and width
		$width = intval($_POST['profile_picture_ow']);
		$height = intval($_POST['profile_picture_oh']);

		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($src);

		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
			$width = $height*$ratio_orig;
		} else {
			$height = $width/$ratio_orig;
		}

		// Resample the image to browser pixels
		$image_p = imagecreatetruecolor($width, $height);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		imagedestroy($image);

		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;

		$src = $profile_picture['tmp_name'];

		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$image_p,0,0,intval($_POST['profile_picture_x']),intval($_POST['profile_picture_y']), $targ_w,$targ_h, intval($_POST['profile_picture_w']),intval($_POST['profile_picture_h']));

		imagejpeg($dst_r, WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.'profile_picture_'.$user_id.'.jpg' ,$jpeg_quality);

		imagedestroy($image_p);
		imagedestroy($dst_r);

		ini_set('memory_limit', $oml);

	}

}