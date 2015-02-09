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
			<h1>List a New Property</h1>
			<form role="form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Price</label>
							<div class="input-group">
								<div class="input-group-addon">$</div>
								<input class="form-control" type="text">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" rows="4"></textarea>
				</div>
				<div class="form-group">
					<label>Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
					<input class="form-control" type="text" id="address" placeholder="Enter a Location" autocomplete="off">
					<p class="help-block">You can drag the marker to property position</p>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Bedrooms</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Bathrooms</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Area</label>
							<div class="input-group">
								<input class="form-control" type="text">
								<div class="input-group-addon">Sq Ft</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="btn-group">
							<label>Type</label>
							<select>
								<option>For Sale</option>
								<option>For Rent</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>Image Gallery</label>
							<input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">
							<p class="help-block">You can select multiple images at once</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Amenities</label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garage</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Security System</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Air Conditioning</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Balcony</label></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Outdoor Pool</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Internet</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Heating</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> TV Cable</label></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garden</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Telephone</label></div>
							<div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Fireplace</label></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="#" class="btn btn-green btn-lg">Add Property</a>
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
	LocalVar.markerGreen = "<?php echo ('http://localhost/metrobox/img/estates-add/marker-green.png');?>"
	LocalVar.markerNew = "<?php echo ('http://localhost/metrobox/img/estates-add/marker-new.png');?>"
	LocalVar.infoBox = "<?php echo ('http://localhost/metrobox/img/estates-add/infobox-bg.png');?>"
</script>