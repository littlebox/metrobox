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
					'title'=>'Inicio',
					'href' =>array('controller'=>'pages','action'=>'index'),
					'icon'=>'screen-desktop'
					),
				array(
					'title'=>'Propiedades',
					'href'=> array('controller'=>'estates','action'=>'index'),
					'icon'=>'home',
					'submenu' => array(
						array(
							'title'=>'Ver propiedades',
							'href'=> array('controller'=>'estates','action'=>'index'),
							'icon'=>'home'),
						array(
							'title'=>'Añadir propiedad',
							'href'=> array('controller'=>'estates','action'=>'add'),
							'icon'=>'home')
						)
					),
				array(
					'title'=>'Mensajes',
					'href'=> array('controller'=>'messages','action'=>'index'),
					'icon'=>'envelope',
					),
				array(
					'title'=>'Estadisticas',
					'href'=>array('controller'=>'pages', 'action' => 'stats'),
					'icon'=>'bar-chart',
					),
				//Admin Menu
				array(
					'title'=>'Usuarios',
					'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
					'icon'=>'users',
					'submenu' => array(
						array(
							'title'=>__('View users'),
							'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
							'icon'=>'users',
						),
						array(
							'title'=>__('Add user'),
							'href'=>array('controller'=>'users', 'action' => 'add', 'admin' => true),
							'icon'=>'users',
						),
					)
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

			);
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