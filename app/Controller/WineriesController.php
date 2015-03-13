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

	public function index() {
		$this->Winery->recursive = 0;
		$this->set('wineries', $this->Paginator->paginate());
	}

	public function admin_index(){
		$this->layout = 'metrobox';
		$this->Winery->recursive = 0;

		$this->paginate = array(
			'fields' => array('Winery.name', 'Winery.created', 'Winery.id'),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}




	public function view($id = null) {
		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id));
		$this->set('winery', $this->Winery->find('first', $options));
	}


	public function admin_add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Winery->create();
			if ($this->Winery->save($this->request->data)) {
				$this->Session->setFlash(__('The winery has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'));
			}
		}
	}


	public function edit($id = null) {
		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Winery->save($this->request->data)) {
				$this->Session->setFlash(__('The winery has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id));
			$this->request->data = $this->Winery->find('first', $options);
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
			$this->Session->setFlash(__('Winery was not deleted', 'metrobox/flash_danger'));
			return $this->redirect(array('action' => 'index'));
		}

	}
}
