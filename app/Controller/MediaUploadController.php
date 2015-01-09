<?php
App::uses('AppController', 'Controller');
/**
 * MediaUpload Controller
 *
 * @property MediaUpload $MediaUpload
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MediaUploadController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function upload(){

		// debug($this->request->data);
		debug($_FILES);

		$this->autoRender = false;

	}

}
