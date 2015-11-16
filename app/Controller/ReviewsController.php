<?php
App::uses('AppController', 'Controller');
/**
 * Reserves Controller
 *
 * @property Reserve $Reserve
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'get_wineries_to_review');
	}

	public function get_wineries_to_review() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		header('Access-Control-Allow-Origin:*');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		if (empty($this->request['named']['token'])){
			throw new NotFoundException(__('No token'));
		}

		$this->loadModel('Reserve');

		$reserves = $this->Reserve->find('all', array(
			'conditions' => array(
				'review_token' => $this->request['named']['token'],
			),
			'fields' => array(
				'id',
			),
			'contain' => array(
				'Tour' => array(
					'fields' => array(
						'id',
						'name',
					),
					'Winery' => array(
						'fields' => array(
							'id',
							'name',
							'has_logo'
						),
						'Image' => array(
							'fields' => array(
								'id',
							),
							'order' => 'Image.created desc',
							'limit' => 1,
						),
					),

				),
			),
		));

		$wineries = [];

		foreach ($reserves as $reserve) {
			$wineries[$reserve['Tour']['Winery']['id']] = $reserve['Tour']['Winery'];
		}

		unset($reserves);

		// debug($wineries);die();


		$this->set(compact('wineries')); // Pass $data to the view
		$this->set('_serialize', 'wineries'); // Let the JsonView class know what variable to use

	}

	public function add() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		header('Access-Control-Allow-Origin:*');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		//Check if request is post or put
		if ($this->request->is('post') || $this->request->is('put')) {

			//Prepare response array
			$data = array(
				'content' => '',
				'error' => array(),
			);
			$hasError = false;

			//Decode all data recived
			$json = json_decode($this->request->data['json'], true);
			// debug($json);die();


		// 	$this->request->data['Client'] = [];
		// 	$this->request->data['Client']['email'] = $json['personalData']['email'];
		// 	$this->request->data['Client']['full_name'] = $json['personalData']['fullName'];
		// 	$this->request->data['Client']['birth_date'] = $json['personalData']['birthDate'];
		// 	$this->request->data['Client']['country'] = $json['personalData']['country'];
		// 	$this->request->data['Client']['phone'] = $json['personalData']['phone'];
		// 	// $this->request->data['Client']['lodging'] = $json['personalData']['lodging'];

		// 	$this->request->data['Reserve'] = [];
		// 	$this->request->data['Reserve']['date'] = $json['reserves']['date'];
		// 	$this->request->data['Reserve']['language_id'] = $json['reserves']['language'];
		// 	$this->request->data['Reserve']['number_of_adults'] = $json['reserves']['adults'];
		// 	$this->request->data['Reserve']['number_of_minors'] = $json['reserves']['minors'];
		// 	$this->request->data['Reserve']['referer'] = 'Web Wineobs';
		// 	$this->request->data['Reserve']['from_web'] = true;
		// 	$this->request->data['Reserve']['review_token'] = Security::hash(String::uuid(),'sha512',true);

		// 	//TODO: Check quota available for each tour


		// 	$items = [];
		// 	$newIds = [];
		// 	require_once(APP.'Vendor/mercadopago-sdk/lib/mercadopago.php');
		// 	$mp = new MP('8915881018899740', 'VFVdIwFOZQLabpCDnN6AvgbTzVT2mqju');
		// 	$mp->sandbox_mode(true);

		// 	foreach ($json['reserves']['tours'] as $tour) {
		// 		$this->request->data['Reserve']['tour_id'] = $tour['id'];
		// 		$this->request->data['Reserve']['time'] = $tour['time'];
		// 		$this->request->data['Reserve']['mp_status'] = 'pending';

		// 		$this->Reserve->create();

		// 		if ($this->Reserve->saveAssociated($this->request->data)) {
		// 			$newIds[] = $this->Reserve->id;
		// 		}else{
		// 			// debug($this->Reserve->validationErrors); die();
		// 			$hasError = true;
		// 			$data['error'][] = array(
		// 				'tour' => $tour['id'],
		// 				'time' => $tour['time'],
		// 				'text' => __('The reserve could not be saved.')
		// 			);
		// 		}
		// 		if(!$hasError){
		// 			$data['content']['title'] = __('Good.');
		// 			$data['content']['text'] = __('Reservations were made successfully.');
		// 		}
		// 		$tourData = $this->Reserve->Tour->find('first',array(
		// 			'conditions' => array(
		// 				'Tour.id' => $tour['id'],
		// 			),
		// 			'contains' => false,
		// 		));

		// 		$price = $json['reserves']['adults']*$tourData['Tour']['price'] + $json['reserves']['minors']*$tourData['Tour']['minors_price'];

		// 		$title = $tourData['Tour']['name'].' ('.$json['reserves']['adults'].' adultos';
		// 		if($json['reserves']['minors'] > 0){
		// 			$title .=', '.$json['reserves']['minors'].' menores';
		// 		}
		// 		$title .=')';

		// 		array_push($items, array(
		// 			'title' => $title,
		// 			'currency_id' => 'ARS', // Available currencies at: https://api.mercadopago.com/currencies
		// 			'unit_price' => $price,
		// 			'quantity' => 1,
		// 		));
		// 	}

		// 	$preference_data = array(
		// 		'items' => $items,
		// 		'payer' => array(
		// 			'name' => $this->request->data['Client']['full_name'],
		// 			'email' => $this->request->data['Client']['email'],
		// 		),
		// 		'notification_url' => 'http://reservas.wineobs.com/reserves/mp_notification',
		// 		'external_reference' => array(
		// 			'reserves_ids' => $newIds,
		// 			'date' => $this->request->data['Reserve']['date'],
		// 			'language_id' => $this->request->data['Reserve']['language_id'],
		// 			'number_of_adults' => $this->request->data['Reserve']['number_of_adults'],
		// 			'number_of_minors' => $this->request->data['Reserve']['number_of_minors'],
		// 			'client_email' => $this->request->data['Client']['email'],
		// 			'client_name' => $this->request->data['Client']['full_name'],
		// 			'client_country' => $this->request->data['Client']['country'],
		// 			'client_phone' => $this->request->data['Client']['phone'],
		// 			'client_birth_date' => $this->request->data['Client']['birth_date'],
		// 			'total' => $price,
		// 		),
		// 		// 'external_reference' => $newIds,
		// 		'back_urls' => array(
		// 			'success' => 'http://alpha.wineobs.com/payment_success',
		// 			'pending' => 'http://alpha.wineobs.com/payment_pending',
		// 			'failure' => 'http://alpha.wineobs.com/payment_failure',
		// 		),
		// 	);
		// 	$preference = $mp->create_preference($preference_data);

		// 	$data['mp_url'] = $preference['response']['sandbox_init_point'];

		// 	$this->set(compact('data')); // Pass $data to the view
		// 	$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
		// }else{
		// 	throw new MethodNotAllowedException(__('Only POST or PUT'));
		// }

		}

	}

}
