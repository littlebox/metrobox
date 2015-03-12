<?php
App::uses('AppController', 'Controller');
/**
 * Wineries Controller
 *
 * @property Winery $Winery
 * @property PaginatorComponent $Paginator
 */
class WineriesController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->Winery->recursive = 0;
		$this->set('wineries', $this->Paginator->paginate());
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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
}
