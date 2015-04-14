
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="estate_add_form_wizard">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-home"></i> <?= __('Publicá Tu Propiedad') ?> - <span class="step-title">
					Paso 1 de 4 </span>
				</div>
				<div class="tools hidden-xs">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body form">

				<?php echo $this->Form->create('Estate', array(
					'enctype' => 'multipart/form-data',
					'inputDefaults' => array(
						'format' => array('before','label','between','input','error','after'),
						'autocomplete' => 'off',
						'div' => array(
							'class' => 'form-group',
						),
						'label' => array(
							'class' => 'control-label col-md-3'
						),
						'class' => 'form-control',
						'between' => '<div class="col-md-5">',
						'after' => '</div>',
						'error' => array('attributes' => array(
							'class' => 'help-block',
							'wrap' => 'span',
							))
					),
					'class' => 'form-horizontal',
					'id' => 'estate-add-form',
				)); ?>
				<!-- <form action="#" class="form-horizontal" id="submit_form" method="POST"> -->
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
									<span class="number">
									1 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Ubicación </span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number">
									2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Características </span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">
									<span class="number">
									3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Información Adicional </span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<span class="number">
									4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Detalles Publicación </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>
							<div class="tab-content">
								<div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									<?= __('Hay algún error en el formulario.') ?>
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									<?= __('Bien!') ?>
								</div>
								<div class="tab-pane active" id="tab1">

									<div class="form-group">
										<label class="control-label col-md-3"><?= __('Tipo de Operación') ?><span class="required">
										* </span>
										</label>
										<div class="col-md-8">
											<?php
												echo $this->Form->input('operation_id', array(
													'type' => 'radio',
													'before' => '<fieldset>',
													'between' => '',
													'after' => '</fieldset>',
													'separator' => '&nbsp&nbsp',
													'escape' => false, //For no html escape
													'legend' => false,
													'fieldset' => true,
													'div' => array(
														'class' => 'icheck-inline'
													),
													'label' => array(
														'class' => ''
													),
													'class' => 'icheck',
													'data-radio'=> 'iradio_square-blue',
													'options' => array(1 => 'Venta', 2 => 'Alquiler', 3 => 'Alquiler Temporal')

												));
											?>
											<div id="form_operation_id_error"></div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3"><?= __('Tipo de Propiedad') ?><span class="required">
										* </span>
										</label>
										<div class="col-md-8">
											<?php
												echo $this->Form->input('type_id', array(
													'type' => 'radio',
													'before' => '<fieldset>',
													'between' => '',
													'after' => '</fieldset>',
													'separator' => '&nbsp&nbsp',
													'escape' => false, //For no html escape
													'legend' => false,
													'fieldset' => true,
													'div' => array(
														'class' => 'icheck-inline'
													),
													'label' => array(
														'class' => ''
													),
													'class' => 'icheck',
													'data-radio'=> 'iradio_square-blue',
													'options' => array(1 => 'Casa', 2 => 'Departamento', 3 => 'Oficina', 4 => 'Local Comercial', 5 => 'Terreno')

												));
											?>
											<div id="form_type_id_error"></div>
										</div>
									</div>

									<div class="form-group" id="gmap_geocoding_form">
										<label class="control-label col-md-3">Dirección <span class="required">
										* </span>
										</label>
										<div class="input-group col-md-9 row row-izq-padding">
											<input type="hidden" name="data[Estate][latitude]" value="" id="EstateLatitude"/>
											<input type="hidden" name="data[Estate][longitude]" value="" id="EstateLongitude"/>
											<div class="col-md-4">
												<input type="text" class="form-control" id="gmap_geocoding_city" name="data[Estate][city]" placeholder="Ciudad o Barrio...">
												</span>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" id="gmap_geocoding_street" name="data[Estate][street_name]" placeholder="Calle">
												</span>
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" id="gmap_geocoding_number" name="data[Estate][street_number]" placeholder="Número">
												</span>
											</div>
											<div class="col-md-1">
												<input type="number" class="form-control" id="gmap_geocoding_postal_code" name="data[Estate][postal_code]" placeholder="C.P.">
												</span>
											</div>
											<div class="col-md-2">
												<button class="btn blue" id="gmap_geocoding_btn"><i class="fa fa-search"></i> Buscar </button>
											</div>
											<div class="col-md-12"><span id="marker-help-text" style="display:none;" class="help-block">Podés corregir la posición arrastrando el marcador!</span></div>
										</div>

									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Mapa</label>

										<div class="col-md-8">
											<div id="gmap_geocoding" class="gmaps"></div>
										</div>

									</div>

								</div>
								<div class="tab-pane" id="tab2">
									<h3 class="form-section">Pago y Financioación</h3>
									<?php
										echo $this->Form->input('price');
										echo $this->Form->input('currency_id');
										echo $this->Form->input('show_price', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
										echo $this->Form->input('offers_funding', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
									?>


									<div id="caracteristicas-inmueble">
										<div id="caracteristicas-casa">
											<h3 class="form-section">Caracerísticas Casa</h3>
											<?php
												echo $this->Form->input('subtype_id', array('options' => $subtypes_casa,'empty' => __('Seleccionar...')));
												echo $this->Form->input('total_surface');
												echo $this->Form->input('covered_surface');
												echo $this->Form->input('is_new', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('bedrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('bathrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('garages', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('orientation', array('options' => array('Norte' => 'Norte', 'Sur' => 'Sur', 'Este' => 'Este', 'Oeste' => 'Oeste', 'Noreste' => 'Noreste', 'Noroeste' => 'Noroeste', 'Sudeste' => 'Sudeste', 'Sudoeste' => 'Sudoeste'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('commercial_use', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
											?>
										</div>
										<div id="caracteristicas-departamento">
											<h3 class="form-section">Caracerísticas Departamento</h3>
											<?php
												echo $this->Form->input('subtype_id', array('options' => $subtypes_departamento,'empty' => __('Seleccionar...')));
												echo $this->Form->input('total_surface');
												echo $this->Form->input('covered_surface');
												echo $this->Form->input('is_new', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('rooms_number', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('bedrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('bathrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('garages', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('orientation', array('options' => array('Norte' => 'Norte', 'Sur' => 'Sur', 'Este' => 'Este', 'Oeste' => 'Oeste', 'Noreste' => 'Noreste', 'Noroeste' => 'Noroeste', 'Sudeste' => 'Sudeste', 'Sudoeste' => 'Sudoeste'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('disposition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_type_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_category_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('No especifico')));
												echo $this->Form->input('apartments_per_floor', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10+'), 'empty' => __('No especifico')));
												echo $this->Form->input('number_of_floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', 21 => '21', 22 => '22', 23 => '23', 24 => '24', 25 => '25', 26 => '26', 27 => '27', 28 => '28', 29 => '29', 30 => '30', 31 => '31', 32 => '32', 33 => '33', 34 => '34', 35 => '35', 36 => '36', 37 => '37', 38 => '38', 39 => '39', 40 => '40', 41 => '41', 42 => '42', 43 => '43', 44 => '44', 45 => '45', 46 => '46', 47 => '47', 48 => '48', 49 => '49', 50 => '50+'), 'empty' => __('No especifico')));
												echo $this->Form->input('number_of_elevators', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('expenses');
												echo $this->Form->input('commercial_use', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
											?>
										</div>
										<div id="caracteristicas-oficina">
											<h3 class="form-section">Caracerísticas Oficina</h3>
											<?php
												echo $this->Form->input('total_surface');
												echo $this->Form->input('covered_surface');
												echo $this->Form->input('is_new', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('bathrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('garages', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('orientation', array('options' => array('Norte' => 'Norte', 'Sur' => 'Sur', 'Este' => 'Este', 'Oeste' => 'Oeste', 'Noreste' => 'Noreste', 'Noroeste' => 'Noroeste', 'Sudeste' => 'Sudeste', 'Sudoeste' => 'Sudoeste'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('disposition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_type_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('building_category_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('apartments_per_floor', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('number_of_floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', 21 => '21', 22 => '22', 23 => '23', 24 => '24', 25 => '25', 26 => '26', 27 => '27', 28 => '28', 29 => '29', 30 => '30', 31 => '31', 32 => '32', 33 => '33', 34 => '34', 35 => '35', 36 => '36', 37 => '37', 38 => '38', 39 => '39', 40 => '40', 41 => '41', 42 => '42', 43 => '43', 44 => '44', 45 => '45', 46 => '46', 47 => '47', 48 => '48', 49 => '49', 50 => '50+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('number_of_elevators', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('expenses');
												echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
											?>
										</div>
										<div id="caracteristicas-local-comercial">
											<h3 class="form-section">Caracerísticas Local Comercial</h3>
											<?php
												echo $this->Form->input('total_surface');
												echo $this->Form->input('covered_surface');
												echo $this->Form->input('is_new', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('bathrooms', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('garages', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('orientation', array('options' => array('Norte' => 'Norte', 'Sur' => 'Sur', 'Este' => 'Este', 'Oeste' => 'Oeste', 'Noreste' => 'Noreste', 'Noroeste' => 'Noroeste', 'Sudeste' => 'Sudeste', 'Sudoeste' => 'Sudoeste'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('disposition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('condition_id', array('empty' => __('Seleccionar...')));
												echo $this->Form->input('floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
												echo $this->Form->input('expenses');
												echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
											?>
										</div>
										<div id="caracteristicas-terreno">
											<h3 class="form-section">Caracerísticas Terreno</h3>
											<?php
												echo $this->Form->input('total_surface');
												echo $this->Form->input('front');
												echo $this->Form->input('back');
												echo $this->Form->input('expenses');
												echo $this->Form->input('commercial_use', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
												echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
											?>
										</div>
									</div>

								</div>

								<div class="tab-pane" id="tab3">

									<div id="services-section">
										<h3 class="form-section">Servicios</h3>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<div class="icheck-inline">
														<input type="hidden" name="data[Service][Service]" value="" id="ServiceService"/>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="1" id="ServiceService1">
															Agua Corriente
														</label>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="2" id="ServiceService2">
															Desagüe cloacal
														</label>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="3" id="ServiceService3">
															Gas natural
														</label>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="4" id="ServiceService4">
															Internet
														</label>
														<label class="services-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="5" id="ServiceService5">
															Luz
														</label>
														<label class="services-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="6" id="ServiceService6">
															Pavimento
														</label>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="7" id="ServiceService7">
															Teléfono
														</label>
														<label class="services-item no-in-terreno">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Service][Service][]" value="8" id="ServiceService8">
															Video cable
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>


									<div id="rooms-section">
										<h3 class="form-section">Ambientes</h3>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<div class="icheck-inline">
														<input type="hidden" name="data[Room][Room]" value="" id="RoomRoom"/>
														<label class="rooms-item no-in-departamento no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="1" id="RoomRoom1">
															Altillo
														</label>
														<label class="rooms-item no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="2" id="RoomRoom2">
															Balcón
														</label>
														<label class="rooms-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="3" id="RoomRoom3">
															Baulera
														</label>
														<label class="rooms-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="4" id="RoomRoom4">
															Cocina
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="5" id="RoomRoom5">
															Comedor
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="6" id="RoomRoom6">
															Comedor de diario
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="7" id="RoomRoom7">
															Dependencia servicio
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="8" id="RoomRoom8">
															Dormitorio en suite
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="9" id="RoomRoom9">
															Escritorio
														</label>
														<label class="rooms-item no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="10" id="RoomRoom10">
															Hall
														</label>
														<label class="rooms-item no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="11" id="RoomRoom11">
															Jardín
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="12" id="RoomRoom12">
															Lavadero
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="13" id="RoomRoom13">
															Living
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="14" id="RoomRoom14">
															Living comedor
														</label>
														<label class="rooms-item no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="15" id="RoomRoom15">
															Patio
														</label>
														<label class="rooms-item no-in-departamento">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="16" id="RoomRoom16">
															Sótano
														</label>
														<label class="rooms-item no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="17" id="RoomRoom17">
															Terraza
														</label>
														<label class="rooms-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="18" id="RoomRoom18">
															Toilette
														</label>
														<label class="rooms-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Room][Room][]" value="19" id="RoomRoom19">
															Vestidor
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div id="extras-section">
										<h3 class="form-section">Adicionales</h3>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<div class="icheck-inline">
														<input type="hidden" name="data[Extra][Extra]" value="" id="ExtraExtra"/>
														<label class="extras-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="1" id="ExtraExtra1">
															Aire acondicionado
														</label>
														<label class="extras-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="2" id="ExtraExtra2">
															Alarma
														</label>
														<label class="extras-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="3" id="ExtraExtra3">
															Amoblado
														</label>
														<label class="extras-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="4" id="ExtraExtra4">
															Calefacción
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="5" id="ExtraExtra5">
															Cancha deportes
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="6" id="ExtraExtra6">
															Gimnasio
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="7" id="ExtraExtra7">
															Hidromasaje
														</label>
														<label class="extras-item no-in-casa no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="8" id="ExtraExtra8">
															Laundry
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="9" id="ExtraExtra9">
															Parrilla
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="10" id="ExtraExtra10">
															Piscina
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="11" id="ExtraExtra11">
															Quincho
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="12" id="ExtraExtra12">
															Sala de juegos
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="13" id="ExtraExtra13">
															Sauna
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="14" id="ExtraExtra14">
															Solarium
														</label>
														<label class="extras-item no-in-oficina no-in-local-comercial">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="15" id="ExtraExtra15">
															SUM
														</label>
														<label class="extras-item">
															<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="data[Extra][Extra][]" value="16" id="ExtraExtra16">
															Vigilancia
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="tab-pane" id="tab4">
									<h3 class="form-section">Fotos de la Propiedad</h3>
									<div class="dropzone" id="imagesDropzone"></div>

								</div>


							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="javascript:;" class="btn default button-previous">
									<i class="m-icon-swapleft"></i> Back </a>
									<a href="javascript:;" class="btn blue button-next">
									Continue <i class="m-icon-swapright m-icon-white"></i>
									</a>
									<a href="javascript:;" class="btn green button-submit">
									Submit <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->



<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/icheck/skins/square/_all');?>
	<?= $this->Html->css('/plugins/dropzone/dropzone');?>
	<?= $this->Html->css('estate-add');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/icheck/icheck.min'); //Para poner bonitos los radio buttons ?>
	<?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&libraries=places'); //Para los mapas de google ?>
	<?= $this->Html->script('/plugins/gmaps/gmaps'); //Para los mapas de google ?>
	<?= $this->Html->script('/plugins/dropzone/dropzone'); //Dropzone para las imagesnes ?>


<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('form-wizard');?>
	<?= $this->Html->script('maps-google');?>
	<?= $this->Html->script('estates-add');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<script>
		Dropzone.autoDiscover = false; //Prevent auto init dropzone
		estateAddImageUrl = '<?= $this->Html->Url(array("action" => "add_image"));?>';

		caracteristicasCasa = $('#caracteristicas-casa').html();
		caracteristicasDepartamento = $('#caracteristicas-departamento').html();
		caracteristicasOficina = $('#caracteristicas-oficina').html();
		caracteristicasLocalComercial = $('#caracteristicas-local-comercial').html();
		caracteristicasTerreno = $('#caracteristicas-terreno').html();

		//Vacío div de características del inmueble
		$('#caracteristicas-inmueble').html('');
		//Activo listeners para que al cambiar el tipo de propiedad se cambien las características en el formulario
		$('input[name="data[Estate][type_id]"]:radio').on('ifChecked', function(event){
			switch(parseInt(this.value)) {
				case 1: //Casa
					$('#caracteristicas-inmueble').html(caracteristicasCasa);
					$('#services-section').show();
					$('.services-item',$('#services-section')).show();
					$('.no-in-casa',$('#services-section')).hide();
					$('#rooms-section').show();
					$('.rooms-item',$('#rooms-section')).show();
					$('.no-in-casa',$('#rooms-section')).hide();
					$('#extras-section').show();
					$('.extras-item',$('#extras-section')).show();
					$('.no-in-casa',$('#extras-section')).hide();
					break;
				case 2: //Departamento
					$('#caracteristicas-inmueble').html(caracteristicasDepartamento);
					$('#services-section').show();
					$('.services-item',$('#services-section')).show();
					$('.no-in-departamento',$('#services-section')).hide();
					$('#rooms-section').show();
					$('.rooms-item',$('#rooms-section')).show();
					$('.no-in-departamento',$('#rooms-section')).hide();
					$('#extras-section').show();
					$('.extras-item',$('#extras-section')).show();
					$('.no-in-departamento',$('#extras-section')).hide();
					break;
				case 3: //Oficina
					$('#caracteristicas-inmueble').html(caracteristicasOficina);
					$('#services-section').show();
					$('.services-item',$('#services-section')).show();
					$('.no-in-oficina',$('#services-section')).hide();
					$('#rooms-section').show();
					$('.rooms-item',$('#rooms-section')).show();
					$('.no-in-oficina',$('#rooms-section')).hide();
					$('#extras-section').show();
					$('.extras-item',$('#extras-section')).show();
					$('.no-in-oficina',$('#extras-section')).hide();
					break;
				case 4: //Local Comercial
					$('#caracteristicas-inmueble').html(caracteristicasLocalComercial);
					$('#services-section').show();
					$('.services-item',$('#services-section')).show();
					$('.no-in-local-comercial',$('#services-section')).hide();
					$('#rooms-section').show();
					$('.rooms-item',$('#rooms-section')).show();
					$('.no-in-local-comercial',$('#rooms-section')).hide();
					$('#extras-section').show();
					$('.extras-item',$('#extras-section')).show();
					$('.no-in-local-comercial',$('#extras-section')).hide();
				case 5: //Terreno
					$('#caracteristicas-inmueble').html(caracteristicasTerreno);
					$('#services-section').show();
					$('.services-item',$('#services-section')).show();
					$('.no-in-terreno',$('#services-section')).hide();
					$('#rooms-section').hide();
					$('.rooms-item',$('#rooms-section')).show();
					$('.no-in-terreno',$('#rooms-section')).hide();
					$('#extras-section').hide();
					$('.extras-item',$('#extras-section')).show();
					$('.no-in-terreno',$('#extras-section')).hide();
					break;
				default:
					alert('Operación Incorrecta');
					break;
			}
			$('#caracteristicas-inmueble input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
			});
		});



		jQuery(document).ready(function() {
			FormWizard.init();
			MapsGoogle.init();
			EstateAdd.init();
		});
	</script>
<?php $this->end(); ?>
