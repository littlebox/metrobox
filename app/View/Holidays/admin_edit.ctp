<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-pencil font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Holidays')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Holiday', array(
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
			'id' => 'holiday-edit-form',
		)); ?>
			<div class="form-body">
					<div class="form-group">
						<label for="Holidays" class="control-label col-md-3"><?= __('Holidays') ?></label>
						<div class="col-md-9">
							<div id="all-datepickers-div">
								<div class="datepicker-div" style="display:none;">
									<div class="col-md-10" style="padding:0px;">
										<input name="data[Holiday][]" autocomplete="off" class="date-picker form-control" placeholder="--/--/----" style="margin-bottom:10px;" type="text">
									</div>
									<div class="col-md-2">
										<button type="button" class="btn red remove-day-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
									</div>
								</div>
								<?php foreach($holidays as $holiday):?>
									<div class="datepicker-div">
										<div class="col-md-10" style="padding:0px;">
											<input name="data[Holiday][]" autocomplete="off" class="date-picker form-control" placeholder="--/--/----" style="margin-bottom:10px;" type="text" value="<?= date_format(date_create_from_format('Y-m-d', $holiday['Holiday']['day']), 'd/m/Y');?>">
										</div>
										<div class="col-md-2">
											<button type="button" class="btn red remove-day-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
										</div>
									</div>
								<?php endforeach;?>
							</div>
							<div class="col-md-12" style="padding:0px;">
								<button type="button" class="btn green" id="add-day-button"><?= __('Add Holiday') ?> <i class="fa fa-plus"></i></button>
							</div>
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
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?php
		if(strtolower(substr(Configure::read('Config.language'), 0, 2)) == 'es'){
			echo $this->Html->script('/plugins/jquery-validation/js/localization/messages_es.js');
		}
	?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('holidays-edit.js');?>
	<script>
		jQuery(document).ready(function() {
			HolidayEdit.init();
		});
	</script>
<?php $this->end(); ?>