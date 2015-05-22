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
					'title'=>'Reservas',
					'href'=> array('controller'=>'reserves','action'=>'index'),
					'icon'=>'book-open',
					),
				array(
					'title'=>'Tours',
					'href'=> array('controller'=>'tours','action'=>'index'),
					'icon'=>'direction',
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
						'title'=>'Administrar',
						'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
						'icon'=>'layers',
						'submenu' => array(
							array(
								'title'=>'Bodegas',
								'href'=>array('controller'=>'wineries', 'action' => 'index', 'admin' => true),
								'icon'=>'directions',
							),
							array(
								'title'=>'Usuarios',
								'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
								'icon'=>'users',
							),
							array(
								'title'=>'Sitio',
								'href'=>array('controller'=>'pages', 'action' => 'site_options', 'admin' => true),
								'icon'=>'equalizer',
							),
							array(
								'title'=>'Estadisticas del Sitio',
								'href'=>array('controller'=>'pages', 'action' => 'site_stats', 'admin' => true),
								'icon'=>'bar-chart',
							),
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