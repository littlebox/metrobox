<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Add')?></span>
			<span class="caption-helper"><?= __('Wineries')?></span>
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

				<div class="form-group" id="gmap_geocoding_form">
					<label class="control-label col-md-3"><?= __('Address') ?></label>
					<div class="input-group col-md-9 row row-izq-padding">
						<input type="hidden" name="data[Winery][latitude]" value="" id="WineryLatitude"/>
						<input type="hidden" name="data[Winery][longitude]" value="" id="WineryLongitude"/>
						<div class="col-md-4" style="padding-left: 0px;">
							<input type="text" class="form-control" id="gmap_geocoding_city" name="data[Winery][city]" placeholder="<?= __('City') ?>">
							</span>
						</div>
						<div class="col-md-6" style="padding-left: 0px;">
							<input type="text" class="form-control" id="gmap_geocoding_address" name="data[Winery][address]" placeholder="<?= __('Address') ?>">
							</span>
						</div>
						<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
							<button class="btn blue" id="gmap_geocoding_btn" style="width: 100%;"><i class="fa fa-search"></i> <?= __('Search') ?> </button>
						</div>
						<div class="col-md-12"><span id="marker-help-text" style="display:none;" class="help-block">Podés corregir la posición arrastrando el marcador!</span></div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Map') ?></label>
					<div class="col-md-9">
						<div id="gmap_geocoding" class="gmaps"></div>
					</div>
				</div>

			</div>

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
		jQuery(document).ready(function() {
			WineryAdminAddEdit.init();
		});
	</script>
<?php $this->end(); ?>