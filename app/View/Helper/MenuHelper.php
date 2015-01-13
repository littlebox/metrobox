<?php

/**
 * Menu component
 * @author chris
 * @package DataTableComponent
 * @since version 1.1.1
 */

App::uses('AppHelper', 'View/Helper');

class MenuHelper extends AppHelper{

	public $helpers = array('Html', 'Cache');

	private $menu_html;
	private $cached_menu;

	public function itemMenu($item){

		// if there isn't a href, set 'javascript:;' to it, so that doesn't fire an action.
		if(empty($item['href'])) $item['href'] = 'javascript:;';

		$active = ($this->submenuActive($item) || $this->Html->url($item['href']) == $this->Html->url()) ? true : false;

		$this->menu_html .= (($active)?'<li class="active">':'<li>');

		$this->menu_html .= '<a href="'.$this->Html->url($item['href']).'">
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

				$response = ($this->Html->url($it['href']) == $this->Html->url()) ? true : $this->submenuActive($it);

			}

		}

		return $response;

	}

	public function showMenu($menu){

		// $this->menu_html = Cache::read('main_menu','long');

		if(!$this->menu_html){

			// debug('not cached!!!');

			foreach($menu as $m){

					if(is_array($m)){
						$this->itemMenu($m);
						// Cache::write('main_menu',$this->menu_html,'long');
					};

				};

		}

		echo $this->menu_html;
	}

}

?>