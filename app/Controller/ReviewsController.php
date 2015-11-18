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

		if(empty($reserves)){
			throw new NotFoundException(__('No reserves to review'));
		}

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

			$this->loadModel('Reserve');

			$reserves = $this->Reserve->find('all', array(
				'conditions' => array(
					'review_token' => $this->request->data['token'],
				),
				'fields' => array(
					'id',
				),
				'contain' => array(
					'Tour' => array(
						'fields' => array(
							'id',
							'winery_id',
						),

					),
					'Client' => array(
						'fields' => array(
							'id',
						),
					)
				),
			));

			if(empty($reserves)){
				throw new NotFoundException(__('No reserves to review'));
			}

			//Check if reviews are correspondent to token allowed wineries
			$allowed_wineries_ids = [];
			$reserves_ids = [];

			foreach ($reserves as $reserve) {
				$allowed_wineries_ids[] = $reserve['Tour']['winery_id'];
				$reserves_ids[] = $reserve['Reserve']['id'];
			}

			$clientId = $reserves[0]['Client']['id'];

			unset($reserves);

			$wineries_ids = [];

			foreach ($this->request->data['review'] as $key => $value) {
				$wineries_ids[] = $key;
			}

			$allowed_wineries_ids = array_unique($allowed_wineries_ids);
			$wineries_ids = array_unique($wineries_ids);

			sort($allowed_wineries_ids);
			sort($wineries_ids);

			if($allowed_wineries_ids != $wineries_ids){
				throw new MethodNotAllowedException(__('Not allowed to review this wineries'));
			}


			$review = [];
			$hasError = false;

			foreach ($this->request->data['review'] as $key => $value) {
				$review['Review']['winerie_id'] = $key;
				$review['Review']['review'] = $value;
				$review['Review']['client_id'] = $clientId;

				if(!$this->Review->save($review)){
					$hasError = true;
				}
			}

			if(!$hasError){
				$data['content']['title'] = __('Good');
				$data['content']['text'] = __('Reviews were made successfully.');

				foreach ($reserves_ids as $reserve_id) {
					$this->Reserve->create();
					$this->Reserve->id = $reserve_id;
					$this->Reserve->saveField('review_token', NULL);
				}

			}else{
				$data['error']['title'] = __('Error');
				$data['error']['text'] = __('Some review could not be saved.');
			}

		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

	}

}
