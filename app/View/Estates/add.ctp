<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="form_wizard_1">
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

				<?php echo $this->Form->create('User', array(
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
					'id' => 'user-form',
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
											<div class="icheck-inline">
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="operation" value="venta" data-title="Male"/>Venta </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="operation" value="alquiler" data-title="Female"/>Alquiler </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="operation" value="alquiler-temporal" data-title="Female"/>Alquiler Temporal </label>
											</div>
											<div id="form_operation_error"></div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3"><?= __('Tipo de Propiedad') ?><span class="required">
										* </span>
										</label>
										<div class="col-md-8">
											<div class="icheck-inline">
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="type" value="venta" data-title="Male"/>Casa </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="type" value="departamento" data-title="Male"/>Departamento </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="type" value="oficina" data-title="Male"/>Oficina </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="type" value="local-comercial" data-title="Female"/>Local Comercial </label>
												<label><input type="radio" class="icheck" data-radio="iradio_square-blue" name="type" value="terreno" data-title="Female"/>Terreno </label>
											</div>
											<div id="form_type_error"></div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Dirección <span class="required">
										* </span>
										</label>
										<div class="input-group col-md-9 row row-izq-padding">
											<div class="col-md-4">
												<input type="text" class="form-control" id="gmap_geocoding_city" name="gmap_geocoding_city" placeholder="Ciudad o Barrio...">
												</span>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" id="gmap_geocoding_street" name="gmap_geocoding_street" placeholder="Calle">
												</span>
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" id="gmap_geocoding_number" name="gmap_geocoding_number" placeholder="Número">
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

									<h3 class="form-section">Caracerísticas</h3>

									<div id="caracteristicas-casa">
										<?php
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
										<?php
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
											echo $this->Form->input('floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
											echo $this->Form->input('apartments_per_floor', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10+'), 'empty' => __('Seleccionar...')));
											echo $this->Form->input('number_of_floors', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', 21 => '21', 22 => '22', 23 => '23', 24 => '24', 25 => '25', 26 => '26', 27 => '27', 28 => '28', 29 => '29', 30 => '30', 31 => '31', 32 => '32', 33 => '33', 34 => '34', 35 => '35', 36 => '36', 37 => '37', 38 => '38', 39 => '39', 40 => '40', 41 => '41', 42 => '42', 43 => '43', 44 => '44', 45 => '45', 46 => '46', 47 => '47', 48 => '48', 49 => '49', 50 => '50+'), 'empty' => __('Seleccionar...')));
											echo $this->Form->input('number_of_elevators', array('options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'), 'empty' => __('Seleccionar...')));
											echo $this->Form->input('expenses');
											echo $this->Form->input('commercial_use', array('type' => 'checkbox', 'class' => 'icheck', 'data-checkbox' => 'icheckbox_square-blue'));
											echo $this->Form->input('brightness', array('options' => array('Muy Luminoso' => 'Muy Luminoso','Luminoso' => 'Luminoso','Poco Luminoso' => 'Poco Luminoso'), 'empty' => __('Seleccionar...')));
										?>
									</div>
									<div id="caracteristicas-oficina">
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

								<div class="tab-pane" id="tab3">

									<div class="dropzone" id="imagesDropzone"></div>

								</div>

								<div class="tab-pane" id="tab4">
									<h3 class="block">Confirm your account</h3>
									<h4 class="form-section">Account</h4>
									<div class="form-group">
										<label class="control-label col-md-3">Username:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="username">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Email:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="email">
											</p>
										</div>
									</div>
									<h4 class="form-section">Profile</h4>
									<div class="form-group">
										<label class="control-label col-md-3">Fullname:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="fullname">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Gender:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="gender">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Phone:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="phone">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Address:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="address">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">City/Town:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="city">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Country:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="country">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Remarks:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="remarks">
											</p>
										</div>
									</div>
									<h4 class="form-section">Billing</h4>
									<div class="form-group">
										<label class="control-label col-md-3">Card Holder Name:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="card_name">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Card Number:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="card_number">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">CVC:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="card_cvc">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Expiration:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="card_expiry_date">
											</p>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Payment Options:</label>
										<div class="col-md-4">
											<p class="form-control-static" data-display="payment">
											</p>
										</div>
									</div>
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

		jQuery(document).ready(function() {
			FormWizard.init();
			MapsGoogle.init();
			EstateAdd.init();
		});
	</script>
<?php $this->end(); ?>
