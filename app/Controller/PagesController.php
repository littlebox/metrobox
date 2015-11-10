<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('send_email');
	}

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */

	public function send_email() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		header('Access-Control-Allow-Origin:*');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		if ($this->request->is('post')) {

			debug($this->request->data);die();

			$Email = new CakeEmail();
			$Email->config('smtp'); //read settings from config/email.php
			$Email->template('wineobs_contact', 'wineobs');
			$Email->emailFormat('html');
			$Email->to('info@wineobs.com');
			$Email->replyTo($this->request->data['email']);
			$Email->subject('Mensaje desde wineobs.com');
			$Email->viewVars(array('name' => $this->request->data['name']));
			$Email->viewVars(array('email' => $this->request->data['email']));
			$Email->viewVars(array('message' => $this->request->data['message']));
			$Email->send(); //If this fail, internally throw an exception

			$data = array(
				'content' => '',
				'error' => '',
			);

			$data['content'] = __('¡Gracias por colaborar con BeBusca!');

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{
			throw new MethodNotAllowedException(__('Only POST'));
		}
	}
}
