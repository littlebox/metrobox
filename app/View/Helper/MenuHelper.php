<?php

/**
 * Menu component
 * @author chris
 * @package DataTableComponent
 * @since version 1.1.1
 */

App::uses('AppHelper', 'View/Helper');

class MenuHelper extends AppHelper{

	public $helpers = array('Html');

	private $menu_html;

	public function itemMenu($item){

		// if there isn't a href, set 'javascript:;' to it, so that doesn't fire an action.
		if(empty($item['href'])) $item['href'] = 'javascript:;';

		$active = ($this->submenuActive($item) || $this->Html->url($item['href']) == Router::url()) ? true : false;

		$this->menu_html .= (($active)?'<li class="active">':'<li>');

		$this->menu_html .= '<a href="'.Router::url($item['href']).'">
				<i class="icon-'.$item['icon'].'"></i>
				<span class="title">'.__($item['title']).'</span>';

		if($active) $this->menu_html .='<span class="arrow open"></span><span class="selected"></span>';

		$this->menu_html .= '</a>';

		if(array_key_exists('submenu', $item)){
			$this->menu_html .= '<ul class="sub-menu">';
			foreach($item['submenu'] as $m){
				if(is_array($m)){
					$this->itemMenu($m);
				};
			};

			$this->menu_html .= '</ul>';
		}

		$this->menu_html .= '</li>';

	}

	/**
	 * Another recursive function that returns true if a child of an item have the same href than actual url.
	 *
	 * @var $item
	 */
	private function submenuActive($item){

		$response = false;

		if(array_key_exists('submenu', $item)){

			foreach ($item['submenu'] as $it) {

				$response = (Router::url($it['href']) == Router::url()) ? true : $this->submenuActive($it);

			}

		}

		return $response;

	}

	public function showMenu($menu){

		foreach($menu as $m){

				if(is_array($m)){
					$this->itemMenu($m);
				};

			};

		echo $this->menu_html;

	}

}

?>