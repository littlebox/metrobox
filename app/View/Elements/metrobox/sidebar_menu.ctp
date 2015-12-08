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
					'title'=>__('Reserves'),
					'href'=> array('controller'=>'reserves','action'=>'index'),
					'icon'=>'book-open',
				),
				array(
					'title'=>__('Tours'),
					'href'=> array('controller'=>'tours','action'=>'index'),
					'icon'=>'direction',
				),
				array(
					'title'=>__('Winery profile'),
					'href'=> array('controller' => 'wineries', 'action' => 'view'),
					'icon'=>'directions',
				),
				// array(
				// 	'title'=>'Estadisticas',
				// 	'href'=>array('controller'=>'pages', 'action' => 'stats'),
				// 	'icon'=>'bar-chart',
				// 	)

			);

			//If logged user is administrator
			if(AuthComponent::user('Group.id') == 1){
				$menuAdmin = array(
					//Admin Menu
					array(
						'title'=>__('Administrate'),
						'href'=>array('controller'=>'wineries', 'action' => 'index', 'admin' => true),
						'icon'=>'layers',
						'submenu' => array(
							array(
								'title'=>__('Wineries'),
								'href'=>array('controller'=>'wineries', 'action' => 'index', 'admin' => true),
								'icon'=>'directions',
							),
							array(
								'title'=>__('Users'),
								'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
								'icon'=>'users',
							),
							array(
								'title'=>__('Holidays'),
								'href'=>array('controller'=>'holidays', 'action' => 'edit', 'admin' => true),
								'icon'=>'calendar',
							),
							array(
								'title'=>__('Statistics'),
								'href'=>array('controller'=>'wineries', 'action' => 'general_statistics', 'admin' => true),
								'icon'=>'bar-chart',
							),
							// array(
							// 	'title'=>__('Site'),
							// 	'href'=>array('controller'=>'pages', 'action' => 'site_options', 'admin' => true),
							// 	'icon'=>'equalizer',
							// ),
							// array(
							// 	'title'=>__('Site Statistics'),
							// 	'href'=>array('controller'=>'pages', 'action' => 'site_stats', 'admin' => true),
							// 	'icon'=>'bar-chart',
							// ),
						)
					)

				);

				$menu = array_merge($menu, $menuAdmin);
			}
		?>

		<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

			<?php

				$this->Menu->showMenu($menu);

			?>

		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->