<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('fileinput.min');?>
	<?= $this->Html->css('/plugins/jquery-ui/jquery-ui-1.10.3.custom.min');?>
	<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput');?>
	<?= $this->Html->css('datepicker');?>
	<?= $this->Html->css('estate-add');?>
<?php $this->end(); ?>
<div>
	<div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Loading map...</div></div>
	<div id="content" class="mob-max">
		<div class="rightContainer">
			<h1><?= __('Añadir una propiedad') ?></h1>
			<form role="form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="form-group">
							<label><?= __('Titulo') ?></label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label><?= __('Precio') ?></label>
							<div class="input-group">
								<div class="input-group-addon">$</div>
								<input class="form-control" type="text">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label><?= __('Descripción') ?></label>
					<textarea class="form-control" rows="4"></textarea>
				</div>
				<div class="form-group">
					<label><?= __('Dirección') ?> <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
					<input class="form-control" type="text" id="address" placeholder="Ingresa una localidad" autocomplete="off">
					<p class="help-block"><?= __('Arrastrá el marcador del mapa hasta el lugar exacto de la propiedad') ?></p>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label><?= __('Habitaciones') ?></label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label><?= __('Baños') ?></label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label><?= __('Area cubierta') ?></label>
							<div class="input-group">
								<input class="form-control" type="text">
								<div class="input-group-addon"><?= __('m2') ?></div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="btn-group">
							<label><?= __('Tipo') ?></label>
							<select>
								<option><?= __('Venta') ?></option>
								<option><?= __('Alquiler') ?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label><?= __('Galeria de imágenes') ?></label>
							<input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="<?= __('Buscar Imágenes') ?>">
							<p class="help-block"><?= __('Podés seleccionar varias imagenes') ?></p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label><?= __('Comodidades') ?></label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Garage') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Alarma') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Aire acondicionado') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Balcon') ?></label></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Piscina') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Internet') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Calefacción') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('TV por cable/satelite') ?></label></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Jardín') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Teléfono') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Sotano') ?></label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> <?= __('Patio interno') ?></label></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="#" class="btn btn-green btn-lg"><?= __('Añadir propiedad') ?></a>
				</div>
			</form>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true&amp;libraries=geometry&amp;libraries=places');?>
	<?= $this->Html->script('/plugins/estates-add/json2');?>
	<?= $this->Html->script('/plugins/estates-add/jquery-2.1.1.min');?>
	<?= $this->Html->script('/plugins/estates-add/underscore');?>
	<?= $this->Html->script('/plugins/estates-add/moment-2.5.1');?>
	<?= $this->Html->script('/plugins/estates-add/jquery-ui.min');?>
	<?= $this->Html->script('/plugins/estates-add/jquery-ui-touch-punch');?>
	<?= $this->Html->script('/plugins/estates-add/jquery.placeholder');?>
	<?= $this->Html->script('/plugins/estates-add/bootstrap');?>
	<?= $this->Html->script('/plugins/estates-add/jquery.touchSwipe.min');?>
	<?= $this->Html->script('/plugins/estates-add/jquery.slimscroll.min');?>
	<?= $this->Html->script('/plugins/estates-add/jquery.visible');?>
	<?= $this->Html->script('/plugins/estates-add/infobox');?>
	<?= $this->Html->script('/plugins/estates-add/clndr');?>
	<?= $this->Html->script('/plugins/estates-add/jquery.tagsinput.min');?>
	<?= $this->Html->script('/plugins/estates-add/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/estates-add/fileinput.min');?>
	<?= $this->Html->script('/plugins/estates-add/app');?>
	<?= $this->Html->script('/plugins/estates-add/calendar');?>
<?php $this->end(); ?>
<script>
	var LocalVar = {};
	LocalVar.markerGreen = "<?php echo ('http://localhost/metrobox/img/estates-add/marker-blue.png');?>"
	LocalVar.markerNew = "<?php echo ('http://localhost/metrobox/img/estates-add/marker-new.png');?>"
	LocalVar.infoBox = "<?php echo ('http://localhost/metrobox/img/estates-add/infobox-bg.png');?>"
</script>