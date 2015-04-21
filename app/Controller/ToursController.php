<?php
App::uses('AppController', 'Controller');
/**
 * Tours Controller
 *
 * @property Tour $Tour
 * @property PaginatorComponent $Paginator
 */
class ToursController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'DataTable');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'metrobox';

		$this->paginate = array(
			'fields' => array('Tour.name','Tour.price', 'Tour.quota', 'Tour.length', 'Tour.id'),
			'contain' => false
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}
		$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
		$this->set('tour', $this->Tour->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Tour->create();
			if ($this->Tour->save($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		}
		//To show wineries, days and languages avaiables in view
		$wineries = $this->Tour->Winery->find('list');
		$days = $this->Tour->Day->find('list');
		$languages = $this->Tour->Language->find('list');
		$this->set(compact('wineries', 'days', 'languages'));



	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tour->save($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
			$this->request->data = $this->Tour->find('first', $options);
		}
		$wineries = $this->Tour->Winery->find('list');
		$days = $this->Tour->Day->find('list');
		$languages = $this->Tour->Language->find('list');
		$this->set(compact('wineries', 'days', 'languages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->Tour->id = $id;
			if (!$this->Tour->exists()) {
				$data['error'] = __('Invalid Tour');
			} else {
				if ($this->Tour->delete()) {
					$data['content'] = __('Tour deleted');
				} else {
					$data['error'] = __('Tour was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Tour->id = $id;
			if (!$this->Tour->exists()) {
				throw new NotFoundException(__('Invalid Tour'));
			}
			if ($this->Tour->delete()) {
				$this->Session->setFlash(__('Tour deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Tour was not deleted', 'metrobox/flash_danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
