<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ImagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public function add() {
		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The image has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.'));
			}
		}
		$wineries = $this->Image->Winery->find('list');
		$this->set(compact('wineries'));
	}

	public function delete($id = null) {
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Image->delete()) {
			$this->Session->setFlash(__('The image has been deleted.'));
		} else {
			$this->Session->setFlash(__('The image could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function clean() {
		$imagesPath = WWW_ROOT.'img'.DS.'wineries'.DS;
		$imagesToDelete = $this->Image->find('all', array('contain' => false,'conditions' => array('Image.winery_id IS NULL')));
		if(empty($imagesToDelete)){
			die(__('Nothing to clean.'));
		}
		foreach ($imagesToDelete as $image) {
			$this->Image->id = $image['Image']['id'];
			if ($this->Image->delete()) {
				//Delete image from disk
				unlink($imagesPath.$image['Image']['id'].'.jpg');
				unlink($imagesPath.$image['Image']['id'].'-120x120.jpg');

				echo 'Image id: '.$image['Image']['id'].' deleted<br>';
			} else {
				echo 'Image id: '.$image['Image']['id'].' NOT deleted!<br>';
			}
		}
		die(__('All cleaned!'));
	}
}
