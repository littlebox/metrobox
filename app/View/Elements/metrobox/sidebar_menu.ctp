<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->

		<?php

			/* TODO:
				-check permissions,
				-check first and last item and put classes,
			*/

			$menu = array(
				array(
					'title'=>'Dashboard',
					'href' =>array('controller'=>'pages','action'=>'index'),
					'icon'=>'home'
					),
				array(
					'title'=>'Test',
					'href'=> array('controller'=>'pages','action'=>'test'),
					'icon'=>'chemistry',
					),
				array(
					'title' => 'Users',
					'href' => array('controller' => 'users'),
					'icon' => 'users',
					'submenu'=>array(
						array(
							'title'=>'View users',
							'href'=>array('controller'=>'users', 'action' => 'index'),
							'icon'=>'users',
						),
						array(
							'title'=>'Add user',
							'href'=>array('controller'=>'users', 'action' => 'add'),
							'icon'=>'users',
							'submenu'=>array(
								array(
								'title'=>'View users',
								'href'=>array('controller'=>'pages', 'action' => 'test'),
								'icon'=>'users')
								)
						)
					),
				)
			);


			/**
			 * Recursive function for rendering item menu.
			 *
			 * @var $item
			 */
			function item_menu($item){

				// if there isn't a href, set 'javascript:;' to it, so that doesn't fire an action.
				if(empty($item['href'])) $item['href'] = 'javascript:;';

				$active = (submenu_active($item) || Router::url($item['href']) == Router::url()) ? true : false;

				echo (($active)?'<li class="active">':'<li>');

				echo '<a href="'.Router::url($item['href']).'">
						<i class="icon-'.$item['icon'].'"></i>
						<span class="title">'.__($item['title']).'</span>';

				if($active) echo'<span class="arrow open"></span><span class="selected"></span>';

				echo '</a>';

				if(array_key_exists('submenu', $item)){
					echo '<ul class="sub-menu">';
					foreach($item['submenu'] as $m){
						if(is_array($m)){
							item_menu($m);
						};
					};

					echo '</ul>';
				}

				echo '</li>';

			}

			/**
			 * Another recursive function that returns true if a child of an item have the same href than actual url.
			 *
			 * @var $item
			 */
			function submenu_active($item){

				$response = false;

				if(array_key_exists('submenu', $item)){

					foreach ($item['submenu'] as $it) {

						$response = (Router::url($it['href']) == Router::url()) ? true : submenu_active($it);

					}

				}

				return $response;

			}

		?>

		<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

			<?php

			foreach($menu as $m){

				if(is_array($m)){
					item_menu($m);
				};

			};
			?>

		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->