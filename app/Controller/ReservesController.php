<?php
App::uses('AppController', 'Controller');
/**
 * Reserves Controller
 *
 * @property Reserve $Reserve
 * @property PaginatorComponent $Paginator
 */
class ReservesController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('api_add','mp_notification', 'cancel');
	}


	public function index() {
		$this->layout = 'metrobox';
		if (empty($this->Auth->user('winery_id'))) {
			throw new NotFoundException(__('Missed Winery ID in Argument'));
		}
		$wineryId = $this->Auth->user('winery_id');
		$this->loadModel('Winery', 'Language');
		if (!$this->Winery->exists($wineryId)) {
			throw new NotFoundException(__('Invalid Winery'));
		}
		$this->Winery->id = $wineryId;
		//To show Winery's Tours in view
		$tours = $this->Winery->Tour->find('list', array('contain' => false, 'conditions' => array('winery_id' => $wineryId)));
		$this->set('tours', $tours);
		//To use Tour's Lnaguajes and Reserves in view
		$toursData = $this->Winery->Tour->find('all', array('contain' => array('Language', 'Reserve', 'Time', 'Day'), 'conditions' => array('winery_id' => $wineryId)));
		$this->set('toursData', $toursData);
		//debug($toursData);die();
	}

	public function getQuotaAvailable($date, $tourId){
		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		$options = array('conditions' => array('Tour.id' => $tourId), 'contain' => array('Time'), 'fields' => array('id'));
		$tour = $this->Winery->Tour->find('first', $options);

		foreach ($tour['Time'] as &$time) {
			$timeHour = $time['hour'];
			//Query to calculate quota available of tour un specific date y specific
			$query = $this->Winery->Tour->Time->query("SELECT (tours.quota - (SELECT COALESCE(SUM(reserves.number_of_adults)+SUM(reserves.number_of_minors), 0) FROM reserves WHERE reserves.tour_id = $tourId AND reserves.date = '$date' AND reserves.time = '$timeHour')) AS quota_available FROM tours WHERE tours.id = $tourId");
			$time['quota_available'] = $query[0][0]['quota_available'];
		}

		$this->set(compact('tour')); // Pass $data to the view
		$this->set('_serialize', 'tour'); // Let the JsonView class know what variable to use

	}

	public function add() {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		//Check if request is post or put
		if ($this->request->is('post') || $this->request->is('put')) {

			if (!$this->Reserve->Tour->exists($this->request->data['Reserve']['tour_id'])) {
				throw new NotFoundException(__('Invalid Tour'));
			}

			$this->requestAction(Router::url(array('controller'=>'tours', 'action'=>'tourSecurityCheck')).'/'.$this->request->data['Reserve']['tour_id']);

			$data = array(
				'content' => '',
				'reserve' => '',
				'error' => '',
			);

			//Bring prices
			$tour_prices = $this->Reserve->Tour->find('first', array(
				'conditions' => array(
					'Tour.id' => $this->request->data['Reserve']['tour_id'],
				),
				'fields' => array(
					'id',
					'price',
					'minors_price',
				)
			));
			//Set actual prices in reserve
			$this->request->data['Reserve']['price'] = $tour_prices['Tour']['price'];
			$this->request->data['Reserve']['minors_price'] = $tour_prices['Tour']['minors_price'];

			//Convert date d/m/Y to Y-m-d format tosave in DB
			$this->request->data['Reserve']['date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Reserve']['date'])->format('Y-m-d');

			if(!empty($this->request->data['Client']['birth_date'])){
				$this->request->data['Client']['birth_date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Client']['birth_date'])->format('Y-m-d');
			}

			//Generate token for review
			$this->request->data['Reserve']['review_token'] = Security::hash(String::uuid(),'sha512',true);

			//if the client exist, put the id in the request data array
			// if(!empty($client = $this->Reserve->Client->find('first', array('conditions' => array('Client.email' => $this->request->data['Client']['email']), 'contain' => false)))){
			// 	//WARING!! All Client data will be overwritten!!
			// 	$this->request->data['Client']['id'] = $client['Client']['id'];
			// }

			//debug($this->request->data);debug($client);die();
			$this->Reserve->create();
			if ($this->Reserve->saveAssociated($this->request->data)) {
				$data['content']['title'] = __('Good.');
				$data['content']['text'] = __('The reserve has been saved.');

				//Build the title for show reserve
				$title = '';
				$title = $title.$this->request->data['Client']['full_name'];
				$title = $title.' ('.$this->request->data['Reserve']['number_of_adults'].'a';
				if($this->request->data['Reserve']['number_of_minors'] > 0){
					$title = $title.' '.$this->request->data['Reserve']['number_of_minors'].'m';
				}
				$title = $title.')';

				//Bring tour for color
				$tour = $this->Reserve->Tour->find('first', array('fields' => array('color'), 'conditions' => array('Tour.id' => $this->request->data['Reserve']['tour_id'])));

				//Prepare array to show new reserve in view
				$data['reserve']['id'] = $this->Reserve->id;
				$data['reserve']['title'] = $title;
				$data['reserve']['start'] = $this->request->data['Reserve']['date'].' '.$this->request->data['Reserve']['time'];
				$data['reserve']['tour'] = $this->request->data['Reserve']['tour_id'];
				$data['reserve']['language'] = $this->request->data['Reserve']['language_id'];
				$data['reserve']['date'] = $this->request->data['Reserve']['date'];
				$data['reserve']['time'] = $this->request->data['Reserve']['time'];
				$data['reserve']['clientEmail'] = $this->request->data['Client']['email'];
				$data['reserve']['clientName'] = $this->request->data['Client']['full_name'];
				$data['reserve']['clientBirthDate'] = $this->request->data['Client']['birth_date'];
				$data['reserve']['clientCountry'] = $this->request->data['Client']['country'];
				$data['reserve']['clientPhone'] = $this->request->data['Client']['phone'];
				$data['reserve']['numberOfAdults'] = $this->request->data['Reserve']['number_of_adults'];
				$data['reserve']['numberOfMinors'] = $this->request->data['Reserve']['number_of_minors'];
				$data['reserve']['note'] = $this->request->data['Reserve']['note'];
				$data['reserve']['referer'] = $this->request->data['Reserve']['referer'];
				$data['reserve']['backgroundColor'] = $tour['Tour']['color'];
			} else {
				// debug($this->Reserve->validationErrors); die();
				$data['error'] = __('The reserve could not be saved. Please, try again.');
			}
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	public function api_add() {
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


			$this->request->data['Client'] = [];
			$this->request->data['Client']['email'] = $json['personalData']['email'];
			$this->request->data['Client']['full_name'] = $json['personalData']['fullName'];
			$this->request->data['Client']['birth_date'] = $json['personalData']['birthDate'];
			$this->request->data['Client']['country'] = $json['personalData']['country'];
			$this->request->data['Client']['phone'] = $json['personalData']['phone'];
			// $this->request->data['Client']['lodging'] = $json['personalData']['lodging'];

			$this->request->data['Reserve'] = [];
			$this->request->data['Reserve']['date'] = $json['reserves']['date'];
			$this->request->data['Reserve']['language_id'] = $json['reserves']['language'];
			$this->request->data['Reserve']['number_of_adults'] = $json['reserves']['adults'];
			$this->request->data['Reserve']['number_of_minors'] = $json['reserves']['minors'];
			$this->request->data['Reserve']['referer'] = 'Web Wineobs';
			$this->request->data['Reserve']['from_web'] = true;
			$this->request->data['Reserve']['review_token'] = Security::hash(String::uuid(),'sha512',true);

			//TODO: Check quota available for each tour


			$items = [];
			$newIds = [];
			require_once(APP.'Vendor/mercadopago-sdk/lib/mercadopago.php');
			$mp = new MP('8915881018899740', 'VFVdIwFOZQLabpCDnN6AvgbTzVT2mqju');
			$mp->sandbox_mode(false);

			foreach ($json['reserves']['tours'] as $tour) {
				$this->request->data['Reserve']['tour_id'] = $tour['id'];
				$this->request->data['Reserve']['time'] = $tour['time'];
				$this->request->data['Reserve']['mp_status'] = 'pending';

				//Bring prices
				$tour_prices = $this->Reserve->Tour->find('first', array(
					'conditions' => array(
						'Tour.id' => $this->request->data['Reserve']['tour_id'],
					),
					'fields' => array(
						'id',
						'price',
						'minors_price',
					)
				));
				//Set actual prices in reserve
				$this->request->data['Reserve']['price'] = $tour_prices['Tour']['price'];
				$this->request->data['Reserve']['minors_price'] = $tour_prices['Tour']['minors_price'];

				$this->Reserve->create();

				if ($this->Reserve->saveAssociated($this->request->data)) {
					$newIds[] = $this->Reserve->id;
				}else{
					// debug($this->Reserve->validationErrors); die();
					$hasError = true;
					$data['error'][] = array(
						'tour' => $tour['id'],
						'time' => $tour['time'],
						'text' => __('The reserve could not be saved.')
					);
				}
				if(!$hasError){
					$data['content']['title'] = __('Good.');
					$data['content']['text'] = __('Reservations were made successfully.');
				}
				$tourData = $this->Reserve->Tour->find('first',array(
					'conditions' => array(
						'Tour.id' => $tour['id'],
					),
					'contains' => false,
				));

				$price = $json['reserves']['adults']*$tourData['Tour']['price'] + $json['reserves']['minors']*$tourData['Tour']['minors_price'];

				$title = $tourData['Tour']['name'].' ('.$json['reserves']['adults'].' adultos';
				if($json['reserves']['minors'] > 0){
					$title .=', '.$json['reserves']['minors'].' menores';
				}
				$title .=')';

				array_push($items, array(
					'title' => $title,
					'currency_id' => 'ARS', // Available currencies at: https://api.mercadopago.com/currencies
					'unit_price' => $price,
					'quantity' => 1,
				));
			}

			$preference_data = array(
				'items' => $items,
				'payer' => array(
					'name' => $this->request->data['Client']['full_name'],
					'email' => $this->request->data['Client']['email'],
				),
				'notification_url' => 'http://reservas.wineobs.com/reserves/mp_notification',
				'external_reference' => array(
					'reserves_ids' => $newIds,
					'date' => $this->request->data['Reserve']['date'],
					'language_id' => $this->request->data['Reserve']['language_id'],
					'number_of_adults' => $this->request->data['Reserve']['number_of_adults'],
					'number_of_minors' => $this->request->data['Reserve']['number_of_minors'],
					'client_email' => $this->request->data['Client']['email'],
					'client_name' => $this->request->data['Client']['full_name'],
					'client_country' => $this->request->data['Client']['country'],
					'client_phone' => $this->request->data['Client']['phone'],
					'client_birth_date' => $this->request->data['Client']['birth_date'],
					'total' => $price,
				),
				// 'external_reference' => $newIds,
				'back_urls' => array(
					'success' => 'http://wineobs.com/payment_success',
					'pending' => 'http://wineobs.com/payment_pending',
					'failure' => 'http://wineobs.com/payment_failure',
				),
			);
			$preference = $mp->create_preference($preference_data);

			$data['mp_url'] = $preference['response']['sandbox_init_point'];

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
		}else{
			throw new MethodNotAllowedException(__('Only POST or PUT'));
		}

	}

	public function mp_notification(){

		require_once(APP.'Vendor/mercadopago-sdk/lib/mercadopago.php');
		$this->autoRender = false;

		$mp = new MP('8915881018899740', 'VFVdIwFOZQLabpCDnN6AvgbTzVT2mqju');
		$mp->sandbox_mode(true);
		$params = ["access_token" => $mp->get_access_token()];
		$payment_info = $mp->get_payment_info($_GET["id"]);

		// file_put_contents(APP.'/mp_notifications.txt', json_encode($payment_info), FILE_APPEND);

		//Set language
		if ($payment_info['response']['collection']['external_reference']['language_id'] == 1) {
			Configure::write('Config.language', 'es');
			$language = __('Spanish');
			//Convert date Y-m-d to d/m/Y format to show in frontend
			$formated_date = DateTime::createFromFormat('Y-m-d', $payment_info['response']['collection']['external_reference']['date'])->format('d/m/Y');
		}elseif($payment_info['response']['collection']['external_reference']['language_id'] == 2){
			Configure::write('Config.language', 'eng');
			$language = __('English');
			//Convert date Y-m-d to d/m/Y format to show in frontend
			$formated_date = DateTime::createFromFormat('Y-m-d', $payment_info['response']['collection']['external_reference']['date'])->format('m/d/Y');
		}elseif($payment_info['response']['collection']['external_reference']['language_id'] == 3){
			Configure::write('Config.language', 'pt');
			$language = __('Portuguese');
			//Convert date Y-m-d to d/m/Y format to show in frontend
			$formated_date = DateTime::createFromFormat('Y-m-d', $payment_info['response']['collection']['external_reference']['date'])->format('d/m/Y');
		}
		//Spanish format date
		$spanish_formated_date = DateTime::createFromFormat('Y-m-d', $payment_info['response']['collection']['external_reference']['date'])->format('d/m/Y');
		$spanish_formated_birth_date = DateTime::createFromFormat('Y-m-d', $payment_info['response']['collection']['external_reference']['client_birth_date'])->format('d/m/Y');

		//Encode data for cancel button
		$encoded_data = urlencode($this->encrypt_decrypt('encrypt', json_encode($payment_info['response']['collection']['external_reference'])));

		$ids = $payment_info['response']['collection']['external_reference']['reserves_ids'];

		foreach ($ids as &$id) {
			$reserve = $this->Reserve->find('first',array(
				'conditions' => array('Reserve.id' => $id),
			));
			$reserve['Reserve']['mp_status'] = $payment_info['response']['collection']['status'];
			$this->Reserve->save($reserve);
			//Possibles mp_status:
			// pending: El usuario aún no completó el proceso de pago.
			// approved: El pago fue aprobado y acreditado.
			// in_process: El pago está siendo revisado.
			// in_mediation: Los usuarios tienen iniciada una disputa.
			// rejected: El pago fue rechazado. El usuario puede intentar pagar nuevamente.
			// cancelled: El pago fue cancelado por una de las partes, o porque el tiempo expiró.
			// refunded: El pago fue devuelto al usuario.
			// charged_back: Fue hecho un contracargo en la tarjeta del pagador.
		}

		$reserves = $this->Reserve->find('all', array(
			'fields' => array(
				'id',
				'time',
			),
			'contain' => array(
				'Tour' => array(
					'Winery' => array(
						'fields' => array(
							'id',
							'name',
							'email',
							'address',
							'latitude',
							'longitude',
						),
					),
					'fields' => array(
						'id',
						'name',
						'length',
					),
				),
			),
			'conditions' => array(
				'Reserve.id' => $ids
			),
		));

		// file_put_contents(APP.'/reserves.txt', json_encode($reserves), FILE_APPEND);

		//Client Email
		$clientEmail = new CakeEmail();
		$clientEmail->config('smtp'); //read settings from config/email.php
		$clientEmail->emailFormat('html');
		$clientEmail->to($payment_info['response']['collection']['external_reference']['client_email']);

		$clientEmail->viewVars(array('reserves' => $reserves));
		$clientEmail->viewVars(array('client_name' => $payment_info['response']['collection']['external_reference']['client_name']));
		$clientEmail->viewVars(array('payment_id' => $payment_info['response']['collection']['id']));
		$clientEmail->viewVars(array('date' => $formated_date));
		$clientEmail->viewVars(array('language' => $language));
		$clientEmail->viewVars(array('number_of_adults' => $payment_info['response']['collection']['external_reference']['number_of_adults']));
		$clientEmail->viewVars(array('number_of_minors' => $payment_info['response']['collection']['external_reference']['number_of_minors']));
		$clientEmail->viewVars(array('total' => $payment_info['response']['collection']['total_paid_amount']));
		$clientEmail->viewVars(array('encoded_data' => $encoded_data));


		//Winery Email
		$wineryEmail = new CakeEmail();
		$wineryEmail->config('smtp'); //read settings from config/email.php
		$wineryEmail->emailFormat('html');

		$wineryEmail->viewVars(array('reserves' => $reserves));
		$wineryEmail->viewVars(array('client_name' => $payment_info['response']['collection']['external_reference']['client_name']));
		$wineryEmail->viewVars(array('client_email' => $payment_info['response']['collection']['external_reference']['client_email']));
		$wineryEmail->viewVars(array('client_country' => $payment_info['response']['collection']['external_reference']['client_country']));
		$wineryEmail->viewVars(array('client_phone' => $payment_info['response']['collection']['external_reference']['client_phone']));
		$wineryEmail->viewVars(array('client_birth_date' => $spanish_formated_birth_date));
		$wineryEmail->viewVars(array('payment_id' => $payment_info['response']['collection']['id']));
		$wineryEmail->viewVars(array('date' => $spanish_formated_date));
		$wineryEmail->viewVars(array('language' => $language));
		$wineryEmail->viewVars(array('number_of_adults' => $payment_info['response']['collection']['external_reference']['number_of_adults']));
		$wineryEmail->viewVars(array('number_of_minors' => $payment_info['response']['collection']['external_reference']['number_of_minors']));
		$wineryEmail->viewVars(array('total' => $payment_info['response']['collection']['total_paid_amount']));

		switch ($payment_info['response']['collection']['status']) {
			case "approved":
				//Client Email
				$clientEmail->template('wineobs_user_reserve_confirmation', 'wineobs');
				$clientEmail->subject(__('WineObs - Booking confirmation'));
				//Wineries Emails
				$wineryEmail->template('wineobs_winery_reserve_confirmation', 'wineobs');
				$wineryEmail->subject('Nueva Reserva: '.$payment_info['response']['collection']['external_reference']['client_name']);
				foreach ($reserves as $reserve) {
					$wineryEmail->to($reserve['Tour']['Winery']['email']);
					$wineryEmail->viewVars(array('winery_name' => $reserve['Tour']['Winery']['name']));
					$wineryEmail->viewVars(array('tour_name' => $reserve['Tour']['name']));
					$wineryEmail->viewVars(array('time' => $reserve['Reserve']['time']));

					$wineryEmail->send();
				}
				break;
			// case "pending":
			// 	//Enviar mail
			// 	$clientEmail->template('wineobs_payment_pending', 'wineobs');
			// 	$clientEmail->subject(__('Pago pendiente'));
			// 	break;
			// case "in_process":
			// 	//Enviar mail
			// 	$clientEmail->template('wineobs_payment_in_process', 'wineobs');
			// 	$clientEmail->subject(__('Procesando pago'));
			// 	break;
			// case "rejected":
			// 	//Enviar mail
			// 	$clientEmail->template('wineobs_payment_rejected', 'wineobs');
			// 	$clientEmail->subject(__('Pago rechazado'));
			// 	break;
			// case "refunded":
			// 	//Enviar mail
			// 	$clientEmail->template('wineobs_payment_refunded', 'wineobs');
			// 	$clientEmail->subject(__('Pago reintegrado'));
			// 	break;
			// case "charged_back":
			// 	//Enviar mail
			// 	$clientEmail->template('wineobs_payment_charged_back', 'wineobs');
			// 	$clientEmail->subject(__('Pago reintegrado'));
			// 	break;
			case "cancelled":
				//Enviar mail
				$clientEmail->template('wineobs_user_reserve_payment_canceled', 'wineobs');
				$clientEmail->subject(__('WineObs - Your Booking could not be confirmed'));
				break;
		}

		$clientEmail->send();
	}

	public function edit() {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		if (!$this->request->is(array('post', 'put'))) {
			throw new MethodNotAllowedException(__('Only POST or PUT methods allowed.'));
		}

		if (!$this->Reserve->exists($this->request->data['Reserve']['id'])) {
			throw new NotFoundException(__('Invalid reserve'));
		}

		$this->reserveSecurityCheck($this->request->data['Reserve']['id']);

		$data = array(
			'content' => '',
			'reserve' => '',
			'error' => '',
		);

		$hasClientData = !empty($this->request->data['Client']);

		//if the client exist, put the id in the request data array
		if($hasClientData){
			if(!empty($client = $this->Reserve->Client->find('first', array('conditions' => array('Client.email' => $this->request->data['Client']['email']), 'contain' => false)))){
				//WARING!! All Client data will be overwritten!!
				$this->request->data['Client']['id'] = $client['Client']['id'];
			}
		}

		//Convert date d/m/Y to Y-m-d format tosave in DB
		$this->request->data['Reserve']['date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Reserve']['date'])->format('Y-m-d');
		if($hasClientData){
			if(!empty($this->request->data['Client']['birth_date'])){
				$this->request->data['Client']['birth_date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Client']['birth_date'])->format('Y-m-d');
			}
		}

		if ($this->Reserve->saveAssociated($this->request->data)) {
			$data['content']['title'] = __('Good.');
			$data['content']['text'] = __('The reserve has been saved.');

			if($hasClientData){

				//Build the title for show reserve
				$title = '';
				$title = $title.$this->request->data['Client']['full_name'];
				$title = $title.' ('.$this->request->data['Reserve']['number_of_adults'].'a';
				if($this->request->data['Reserve']['number_of_minors'] > 0){
					$title = $title.' '.$this->request->data['Reserve']['number_of_minors'].'m';
				}
				$title = $title.')';
				//Bring tour for color
				$tour = $this->Reserve->Tour->find('first', array('fields' => array('color'), 'conditions' => array('Tour.id' => $this->request->data['Reserve']['tour_id'])));

				//Prepare array to show new reserve in view
				$data['reserve']['id'] = $this->Reserve->id;
				$data['reserve']['title'] = $title;
				$data['reserve']['start'] = $this->request->data['Reserve']['date'].' '.$this->request->data['Reserve']['time'];
				$data['reserve']['tour'] = $this->request->data['Reserve']['tour_id'];
				$data['reserve']['language'] = $this->request->data['Reserve']['language_id'];
				$data['reserve']['date'] = $this->request->data['Reserve']['date'];
				$data['reserve']['time'] = $this->request->data['Reserve']['time'];
				$data['reserve']['clientEmail'] = $this->request->data['Client']['email'];
				$data['reserve']['clientName'] = $this->request->data['Client']['full_name'];
				$data['reserve']['clientBirthDate'] = $this->request->data['Client']['birth_date'];
				$data['reserve']['clientCountry'] = $this->request->data['Client']['country'];
				$data['reserve']['clientPhone'] = $this->request->data['Client']['phone'];
				$data['reserve']['numberOfAdults'] = $this->request->data['Reserve']['number_of_adults'];
				$data['reserve']['numberOfMinors'] = $this->request->data['Reserve']['number_of_minors'];
				$data['reserve']['note'] = $this->request->data['Reserve']['note'];
				$data['reserve']['referer'] = $this->request->data['Reserve']['referer'];
				$data['reserve']['backgroundColor'] = $tour['Tour']['color'];

			}
		} else {
			$data['error'] = __('The reserve could not be saved. Please, try again.');
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

	}

	//Return a JSON encode respons with reserves to show in calendar (http://fullcalendar.io/docs/event_data/events_json_feed/)
	public function get() {
		//$this->request->allowMethod('ajax'); //Call only with .json at end on url

		//Bring al IDs of user winery's tour
		$tours = $this->Reserve->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursIds = [];

		foreach ($tours as $tour) {
			$toursIds[] = $tour['Tour']['id'];
		}

		//If tour filter is seted
		if(!empty($this->params['url']['tour'])){
			//Bring only reserves of those tours
			$conditions = array(
				'Reserve.tour_id' => $this->params['url']['tour']
			);
		} else{
			//Bring only reserves of winery's tours
			$conditions = array(
				'Reserve.tour_id' => $toursIds,
				'Reserve.tour_id IS NOT NULL',
			);
		}

		//Get GET request parameters (start and end date)
		if(!empty($this->params['url']['start']) && !empty($this->params['url']['end'])){
			//If start and end exist in the request, set between dates conditions
			$startEndConditions = array(
				'Reserve.date BETWEEN ? AND ?' => array(
					$this->params['url']['start'],
					$this->params['url']['end'],
				)
			);
			$conditions = array_merge($conditions, $startEndConditions);
		}

		//Bring reserves from DB
		$reserves = $this->Reserve->find('all', array('conditions' => $conditions, 'contain' => array('Client','Tour.color')));
		//debug($reserves);die();

		//Prepare response for fullcalendar
		$response = [];
		foreach ($reserves as $reserve) {
			//Build the title for show reserve
			$title = '';
			$title = $title.$reserve['Client']['full_name'];
			$title = $title.' ('.$reserve['Reserve']['number_of_adults'].'a';
			if($reserve['Reserve']['number_of_minors'] > 0){
				$title = $title.' '.$reserve['Reserve']['number_of_minors'].'m';
			}
			$title = $title.')';

			$arrayToPush = array(
				'id' => $reserve['Reserve']['id'],
				'title' => $title,
				'start' => $reserve['Reserve']['date'].' '.$reserve['Reserve']['time'],
				'tour' => $reserve['Reserve']['tour_id'],
				'language' => $reserve['Reserve']['language_id'],
				'date' => $reserve['Reserve']['date'],
				'time' => $reserve['Reserve']['time'],
				'clientEmail' => $reserve['Client']['email'],
				'clientName' => $reserve['Client']['full_name'],
				'clientBirthDate' => $reserve['Client']['birth_date'],
				'clientCountry' => $reserve['Client']['country'],
				'clientPhone' => $reserve['Client']['phone'],
				'numberOfAdults' => $reserve['Reserve']['number_of_adults'],
				'numberOfMinors' => $reserve['Reserve']['number_of_minors'],
				'note' => $reserve['Reserve']['note'],
				'referer' => $reserve['Reserve']['referer'],
				'backgroundColor' => $reserve['Tour']['color'],
				'attended' => $reserve['Reserve']['attended'],
				'from_web' => $reserve['Reserve']['from_web'],
				'paid' => $reserve['Reserve']['paid'],
			);
			$response[] = $arrayToPush;
		}

		$this->set(compact('response')); // Pass $data to the view
		$this->set('_serialize', 'response'); // Let the JsonView class know what variable to use
	}

	public function checkAttend($id = null) {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		if (!$this->request->is(array('post', 'put'))) {
			throw new MethodNotAllowedException(__('Only POST or PUT methods allowed.'));
		}

		if (!$this->Reserve->exists($id)) {
			throw new NotFoundException(__('Invalid reserve'));
		}

		$this->reserveSecurityCheck($id);

		$this->request->data['Reserve']['id'] = $id;

		$data = array(
			'content' => '',
			'error' => '',
		);

		if ($this->Reserve->save($this->request->data)) {
			$data['content'] = __('The reserve has been modified.');
		} else {
			$data['error'] = __('The reserve could not be modified. Please, try again.');
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->Reserve->id = $id;
			if (!$this->Reserve->exists()) {
				$data['error'] = __('Invalid Reserve');
			} else {

				$this->reserveSecurityCheck($id);

				if ($this->Reserve->delete()) {
					$data['content'] = __('Reserve deleted');
				} else {
					$data['error'] = __('Reserve was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Reserve->id = $id;
			if (!$this->Reserve->exists()) {
				throw new NotFoundException(__('Invalid Reserve'));
			}

			$this->reserveSecurityCheck($id);

			if ($this->Reserve->delete()) {
				$this->Session->setFlash(__('Reserve deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Reserve was not deleted'), 'metrobox/flash_danger');
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function cancel() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		header('Access-Control-Allow-Origin:*');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		//Check if request is post or put
		if ($this->request->is('post') || $this->request->is('put')) {

			if(empty($this->request->data['code'])){
				throw new NotFoundException(__('No parameters.'));
			}

			//Prepare response array
			$data = array(
				'content' => '',
				'error' => array(),
			);

			$decoded_array = json_decode($this->encrypt_decrypt('decrypt', urldecode($this->request->data['code'])), true);
			// debug($decoded_array);die();

			//Spanish format date
			$spanish_formated_date = DateTime::createFromFormat('Y-m-d', $decoded_array['date'])->format('d/m/Y');
			$spanish_formated_birth_date = DateTime::createFromFormat('Y-m-d', $decoded_array['client_birth_date'])->format('d/m/Y');

			//Set language
			if ($decoded_array['language_id'] == 1) {
				$language = 'Español';
			}elseif($decoded_array['language_id'] == 2){
				$language = 'Inglés';
			}elseif($decoded_array['language_id'] == 3){
				$language = 'Portugués';
			}

			//Get all reserves
			$reserves = $this->Reserve->find('all', array(
				'fields' => array(
					'id',
					'time',
				),
				'contain' => array(
					'Tour' => array(
						'Winery' => array(
							'fields' => array(
								'id',
								'name',
								'email',
								'address',
								'latitude',
								'longitude',
							),
						),
						'fields' => array(
							'id',
							'name',
							'length',
						),
					),
				),
				'conditions' => array(
					'Reserve.id' => $decoded_array['reserves_ids'],
				),
			));

			//Admin Email
			$Email = new CakeEmail();
			$Email->config('smtp'); //read settings from config/email.php
			$Email->emailFormat('html');
			$Email->to('info@wineobs.com');
			$Email->template('wineobs_admin_reserve_cancelation', 'wineobs');;
			$Email->subject('Solicitud de cancelación de reserva(s)');

			$Email->viewVars(array('reserves' => $reserves));
			$Email->viewVars(array('client_name' => $decoded_array['client_name']));
			$Email->viewVars(array('client_email' => $decoded_array['client_email']));
			$Email->viewVars(array('client_country' => $decoded_array['client_country']));
			$Email->viewVars(array('client_phone' => $decoded_array['client_phone']));
			$Email->viewVars(array('client_birth_date' => $spanish_formated_birth_date));
			$Email->viewVars(array('date' => $spanish_formated_date));
			$Email->viewVars(array('language' => $language));
			$Email->viewVars(array('number_of_adults' => $decoded_array['number_of_adults']));
			$Email->viewVars(array('number_of_minors' => $decoded_array['number_of_minors']));
			$Email->viewVars(array('total' => $decoded_array['total']));

			$Email->send();

			$data['content'] = __('The cancellation request was sent successfully. We will contact you soon.');

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use


		}else{
			throw new MethodNotAllowedException(__('Only POST or PUT'));
		}

	}

	private function encrypt_decrypt($action, $string) {
		$output = false;

		$encrypt_method = "AES-256-CBC";
		$secret_key = Configure::read('Security.salt');
		$secret_iv = Configure::read('Security.cipherSeed');

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}

	/* SECURITY CHECK */
	/* Verify if the logged user isn't admin and the reserve atempted to modify is inside a winery that he manages */
	private function reserveSecurityCheck($reserveId){


		//Bring al IDs of user winery's tour
		$tours = $this->Reserve->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursAllowedIds = [];

		foreach ($tours as $tour) {
			$toursAllowedIds[] = $tour['Tour']['id'];
		}

		$reserveToModify = $this->Reserve->find('first', array(
			'conditions' => array(
				'Reserve.id' => $reserveId,
			),
			'fields' => array('id', 'tour_id'),
			'contain' => false)
		);

		if ((AuthComponent::user('Group.id') != 1) && !in_array($reserveToModify['Reserve']['tour_id'], $toursAllowedIds)) {
			throw new ForbiddenException(__('Not allowed to touch this reserve.'));
		}

	}



}
