<?php //debug($this->request->data);die();?>

<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Winerie')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Winery', array(
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
				'between' => '<div class="col-md-9">',
				'after' => '</div>',
				'error' => array('attributes' => array(
					'class' => 'help-block',
					'wrap' => 'span',
					))
			),
			'class' => 'form-horizontal form-bordered form-row-stripped',
			'id' => 'winery-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name');
				?>
				<div id="gmap_geocoding_all">
					<div class="form-group" id="gmap_geocoding_form">
						<label class="control-label col-md-3"><?= __('Address') ?></label>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-4">
										<input type="text" class="form-control" id="gmap_geocoding_city" name="data[Winery][city]" placeholder="<?= __('City') ?>" value="<?= $this->request->data['Winery']['city'] ?>">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" id="gmap_geocoding_address" name="data[Winery][address]" placeholder="<?= __('Address') ?>" value="<?= $this->request->data['Winery']['address'] ?>">
								</div>
								<div class="col-md-2">
										<button class="btn blue" id="gmap_geocoding_btn" style="width: 100%;"><i class="fa fa-search"></i> <?= __('Search') ?> </button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" id="gmap_geocoding_coordenates">
						<label class="control-label col-md-3"><?= __('Coordenates') ?></label>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-5">
									<input type="text" class="form-control" name="data[Winery][latitude]" placeholder="<?= __('Latitude') ?>" value="<?= $this->request->data['Winery']['latitude'] ?>" id="WineryLatitude"/>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="data[Winery][longitude]" placeholder="<?= __('Longitude') ?>" value="<?= $this->request->data['Winery']['longitude'] ?>" id="WineryLongitude"/>
								</div>

								<div class="col-md-2">
										<button class="btn red-sunglo" id="gmap_localize_coordenates_btn" style="width: 100%;"><i class="fa fa-map-marker"></i> <?= __('Localize') ?> </button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Map') ?></label>
					<div class="col-md-9">
						<div id="gmap_geocoding" class="gmaps"></div>
						<span id="marker-help-text" style="display:none;" class="help-block"><?= __('You can change the location dragging the marker!') ?></span>
					</div>
				</div>

			</div>

			<?php
				echo $this->Form->input('description');
				echo $this->Form->input('priority');
				echo $this->Form->input('visible');
			?>

			<div class="form-actions right">
				<?php
					echo $this->Form->Button(__('Cancel'),array(
						'div' => false,
						'class' => 'btn default',
						'type' => 'button'
					));
					echo $this->Form->Button(__('Save'),array(
						'div' => false,
						'class' => 'btn green',
						'type' => 'submit'
					));

				?>
			</div>
		<?= $this->Form->end(); ?>
		<!-- END FORM-->
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');?>
	<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput');?>
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('image-crop.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
	<?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&libraries=places'); //Para los mapas de google ?>
	<?= $this->Html->script('/plugins/gmaps/gmaps'); //Para los mapas de google ?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('wineries-admin-add-edit.js');?>
	<script>
		initialLatitude = $('#WineryLatitude').val();
		initialLongitude = $('#WineryLongitude').val();

		jQuery(document).ready(function() {
			WineryAdminAddEdit.init();
		});
	</script>
<?php $this->end(); ?>