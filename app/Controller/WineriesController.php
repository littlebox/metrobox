<?php
App::uses('AppController', 'Controller');
/**
 * Wineries Controller
 *
 * @property Winery $Winery
 * @property PaginatorComponent $Paginator
 */
class WineriesController extends AppController {

	public $components = array('Paginator', 'DataTable');

	public $helpers = array(
		'Form' => array('className' => 'BootstrapForm')
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('get');
	}

	public function admin_index(){
		$this->layout = 'metrobox';

		$this->paginate = array(
			'fields' => array('Winery.name', 'Winery.priority', 'Winery.visible', 'Winery.created', 'Winery.id', 'Winery.reserve_count'),
			'order' => array('Winery.created' => 'desc'),
			'contain' => false,
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

	public function view() {
		$this->layout = 'metrobox';

		$id = $this->Auth->user('winery_id');
		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id), 'contain' => false);
		$winery = $this->Winery->find('first', $options);
		unset($winery['Winery']['id']);//For no generating parameter (id) in url of form helper in view
		$this->request->data = $winery;
		$this->set('winery', $this->request->data);

		$this->loadModel('Reserve');
		//Bring al IDs of user winery's tour
		$tours = $this->Reserve->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursIds = [];
		foreach ($tours as $tour) {
			$toursIds[] = $tour['Tour']['id'];
		}

		$countTours = $this->Reserve->Tour->find('count', array(
			'conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id'))
		));
		$countReserves = $this->Reserve->find('count', array(
			'conditions' => array('Reserve.tour_id' => $toursIds, 'Reserve.tour_id IS NOT NULL')
		));
		$countReservesAttended = $this->Reserve->find('count', array(
			'conditions' => array('Reserve.tour_id' => $toursIds, 'Reserve.attended' => true, 'Reserve.tour_id IS NOT NULL')
		));
		$this->set('countTours', $countTours);
		$this->set('countReserves', $countReserves);
		$this->set('countReservesAttended', $countReservesAttended);
	}

	public function edit() {
		$this->layout = 'metrobox';

		$id = $this->Auth->user('winery_id');

		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Winery->id = $id;
			$this->request->data['Winery']['id'] = $id;

			if ($this->Winery->saveAssociated($this->request->data, array('deep' => true))) {
				$this->Session->setFlash(__('The winery has been saved.'), 'metrobox/flash_success');
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		} else {
			throw new MethodNotAllowedException(__('Only POST or PUT.'));
		}
		return $this->redirect(array('action' => 'view'));
	}

	public function get() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		// $this->Security->csrfCheck = false;
		header('Access-Control-Allow-Origin:*');
		header('Access-Control-Allow-Methods:*');
		header('Access-Control-Allow-Headers:X-Requested-With');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		if (empty($this->request['named']['date'])){
			throw new NotFoundException(__('Invalid Date'));
		}

		$date = $this->request['named']['date']; //Has to be AAAA-MM-DD
		$language = !empty($this->request['named']['language']) ? $this->request['named']['language'] : 1; //Has to be a language id(if not setted, set to 1 (spanish)

		//Set day of week number (1-7) from date
		$dateObject = DateTime::createFromFormat('Y-m-d', $date);
		$dayOfWeek = $dateObject->format('N');

		//This unbind and bind association allow bringing only tours that have the selected languaje and day of week
		$this->Winery->unbindModel(array('hasMany' => array('Tour')));
		$this->Winery->bindModel(
			array('hasMany' => array(
					'Tour' => array(
						'className' => 'Tour',
						'foreignKey' => 'winery_id',
						'dependent' => false,
						'finderQuery' => "SELECT Tour.* FROM tours AS Tour INNER JOIN tours_languages AS ToursLanguage ON ToursLanguage.tour_id = Tour.id AND ToursLanguage.language_id = '$language' INNER JOIN tours_days AS ToursDay ON ToursDay.tour_id = Tour.id AND ToursDay.day_id = '$dayOfWeek' ORDER BY Tour.price ASC"
					)
				)
			)
		);

		//Set recursive to -1 for correct joins
		$this->Winery->recursive = -1;

		$options = array(
			'fields' => array(
				'id',
				'name',
				'latitude',
				'longitude',
				'address',
				'description',
				'priority',
				'has_logo',
			),
			'joins'=>array( //Estos Joins descartan las bodegas que no tienen ningun tour en el idioma especificado o no tienen tour en el día especificado, pero de las bodegas que no descarta trae todos los tours, icluso los que no tienen el idioma o el día
				array(
					'table'=>'tours',
					'alias'=>'Tour',
					'type'=>'inner',
					'conditions'=>array(
						'Tour.winery_id = Winery.id',
						// 'Tour.visible = true'
					)
				),
				array(
					'table'=>'tours_languages',
					'alias'=>'ToursLanguage',
					'type'=>'inner',
					'conditions'=>array(
						'ToursLanguage.tour_id = Tour.id',
						'ToursLanguage.language_id = ' . $language
					)
				),
				array(
					'table'=>'tours_days',
					'alias'=>'ToursDay',
					'type'=>'inner',
					'conditions'=>array(
						'ToursDay.tour_id = Tour.id',
						'ToursDay.day_id = ' . $dayOfWeek
					)
				),
			),
			'contain' => array(
				'Image' => array(
					'id',
					'order' => 'Image.created desc',
				),
				'Tour' => array(
					'fields' => array(
						'id',
						'name',
						'length',
						'quota',
						'price',
						'minors_price',
						'description'
					),
					'conditions' => array(
						'Tour.visible' => true,
					),
					'Time' => array(
						'id',
						'hour',
						'quota_available',
					),
					'Language'=> array(
						'id',
						'name',
					)
				),
			),
			'group' => 'Winery.id',
			'conditions'=> array(
				'Winery.visible' => true,
			),
			'order' => array(
				'Winery.priority ASC' //Minor priority number first
			),

		);

		$wineries = $this->Winery->find('all', $options);

		//Split array in base of wineries priorities
		$priorities = [];
		foreach ($wineries as $winery) {
			$priorities[$winery['Winery']['priority']][] = $winery;
		}
		unset($wineries);
		$wineries = [];
		//Shuffle each priority array
		arsort($priorities); //Sort array by keys (priority number in this case)
		foreach ($priorities as $priority) {
			shuffle($priority);
			//And put each winery in $wineries array again
			foreach ($priority as $winery) {
				$wineries[] = $winery;
			}
		}
		unset($priorities);

		//Add quota available in each tour
		foreach ($wineries as &$winery) {
			foreach ($winery['Tour'] as &$tour) {
				foreach ($tour['Time'] as &$time) {
					$tourId = $tour['id'];
					$timeHour = $time['hour'];
					//Query to calculate quota available of tour un specific date y specific
					$query = $this->Winery->Tour->Time->query("SELECT (tours.quota - (SELECT COALESCE(SUM(reserves.number_of_adults)+SUM(reserves.number_of_minors), 0) FROM reserves WHERE reserves.tour_id = $tourId AND reserves.date = '$date' AND reserves.time = '$timeHour')) AS quota_available FROM tours WHERE tours.id = $tourId");
					$time['quota_available'] = $query[0][0]['quota_available'];
					//And Remove Seconds From Time
					$time['hour'] = date('H:i', strtotime($time['hour']));
				}
				//And Remove Seconds From Time
				$tour['length'] = date('H:i', strtotime($tour['length']));
			}
		}

		// $log = $this->Winery->getDataSource()->getLog(false, false);debug($log);

		$this->set(compact('wineries')); // Pass $data to the view
		$this->set('_serialize', 'wineries'); // Let the JsonView class know what variable to use

		// debug($wineries);die();
		// echo json_encode($wineries);
		// die();
	}


	public function admin_add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Winery->create();

			if ($this->Winery->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The winery has been saved.'), 'metrobox/flash_success');

				//Check if image has been uploaded
				if(!empty($this->data['Winery']['logo'])){
					$file = $this->data['Winery']['logo']; //put the data into a var for easy use

					$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
					$arr_ext = array('png'); //set allowed extensions

					//only process if the extension is valid
					if(in_array($ext, $arr_ext)){
						//do the actual uploading of the file. First arg is the tmp name, second arg is

						//Rezize and crop image at 300x150
						$imagickImage = new Imagick($file['tmp_name']);
						$imagickImage->cropThumbnailImage(300, 150);
						unlink($file['tmp_name']);
						$imagickImage->writeImage($file['tmp_name']);

						//Save image on disk
						$imagesPath = WWW_ROOT.'img'.DS.'wineries'.DS.'logos'.DS;
						move_uploaded_file($file['tmp_name'], $imagesPath.$this->Winery->id.'.png');

					}else{
						$this->Session->setFlash(__('The logo could not be saved. Invalid file extension.'), 'metrobox/flash_danger');
					}

				}

				return $this->redirect(array('action' => 'index'));

			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		}
	}

	public function add_image() {

		$this->request->allowMethod('ajax');



		$data = array(
			'content' => [],
			'error' => '',
		);

		// $this->params->form['file']

		//Check if image has been uploaded
		if(!empty($this->params->form['file']['name'])){
			$file = $this->params->form['file']; //put the data into a var for easy use

			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
			$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions

			//only process if the extension is valid
			if(in_array($ext, $arr_ext)){
				//do the actual uploading of the file. First arg is the tmp name, second arg is
				//where we are putting it

				//Create new image model
				$this->Winery->Image->create();
				$imageData = array('winery_id' => NULL);
				//Save the image model in DB and get the ID
				if ($this->Winery->Image->save($imageData)) {
					$imagesPath = WWW_ROOT.'img'.DS.'wineries'.DS;
					//Rezize and crop image at 4:3 (800x600)
					$imagickImage = new Imagick($file['tmp_name']);

					unlink($file['tmp_name']);
					$imagickImage->setImageFormat("jpg");
					$imagickImage->cropThumbnailImage(800, 600);
					$imagickImage->writeImage($file['tmp_name']);
					//Save image on disk
					copy($file['tmp_name'], $imagesPath.$this->Winery->Image->id.'.jpg');

					$imagickImage->cropThumbnailImage(120, 120);
					$imagickImage->writeImage($file['tmp_name']);
					move_uploaded_file($file['tmp_name'], $imagesPath.$this->Winery->Image->id.'-120x120.jpg');

					$data['content']['msg'] = __('The image has been saved.');
					$data['content']['id'] = $this->Winery->Image->id;
				} else {
					// $data['error'] = $this->Winery->Image->validationErrors;
					throw new InternalErrorException(__('The image could not be saved.'));
				}
			}else{
				// $data['error'] = __('Invalid file extension.');
				throw new ForbiddenException(__('Invalid file extension.'));
			}

		}else{
			$data['error'] = __('No Data Sended');
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}


	public function admin_edit($id = null) {
		$this->layout = 'metrobox';

		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Winery->id = $id;
			$this->request->data['Winery']['id'] = $id;

			//Removeall previous relationships
			$this->Winery->Image->updateAll(array('winery_id' => null), array('winery_id' => $id));

			if ($this->Winery->saveAssociated($this->request->data, array('deep' => true))) {
				$this->Session->setFlash(__('The winery has been saved.'), 'metrobox/flash_success');

				//Check if image for logo has been uploaded
				if(!empty($this->data['Winery']['logo']['name'])){
					$file = $this->data['Winery']['logo']; //put the data into a var for easy use

					$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
					$arr_ext = array('png'); //set allowed extensions

					//only process if the extension is valid
					if(in_array($ext, $arr_ext)){
						//do the actual uploading of the file. First arg is the tmp name, second arg is

						//Rezize and crop image at 300x150
						$imagickImage = new Imagick($file['tmp_name']);
						$imagickImage->cropThumbnailImage(300, 150);
						unlink($file['tmp_name']);
						$imagickImage->writeImage($file['tmp_name']);

						//Save image on disk
						$imagesPath = WWW_ROOT.'img'.DS.'wineries'.DS.'logos'.DS;
						move_uploaded_file($file['tmp_name'], $imagesPath.$this->Winery->id.'.png');

					}else{
						$this->Session->setFlash(__('The logo could not be saved. Invalid file extension.'), 'metrobox/flash_danger');
					}
				}

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		} else {
			$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id), 'contain' => array('Image.id'));
			$this->request->data = $this->Winery->find('first', $options);

			$this->set('images', json_encode($this->request->data['Image']));

		}
	}

	public function delete($id = null) {
		$this->Winery->id = $id;
		if (!$this->Winery->exists()) {
			throw new NotFoundException(__('Invalid winery'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Winery->delete()) {
			$this->Session->setFlash(__('The winery has been deleted.'));
		} else {
			$this->Session->setFlash(__('The winery could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->Winery->id = $id;
			if (!$this->Winery->exists()) {
				$data['error'] = __('Invalid Winery');
			} else {
				if ($this->Winery->delete()) {
					$data['content'] = __('Winery deleted');
				} else {
					$data['error'] = __('Winery was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Winery->id = $id;
			if (!$this->Winery->exists()) {
				throw new NotFoundException(__('Invalid winery'));
			}
			if ($this->Winery->delete()) {
				$this->Session->setFlash(__('Winery deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Winery was not deleted'), 'metrobox/flash_danger');
			return $this->redirect(array('action' => 'index'));
		}

	}
}
