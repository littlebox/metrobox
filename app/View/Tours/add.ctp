<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Add')?></span>
			<span class="caption-helper"><?= __('Tours')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Tour', array(
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
			'id' => 'tour-add-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name');
					echo $this->Form->input('lenght');
					echo $this->Form->input('quota');
					echo $this->Form->input('price');
					echo $this->Form->input('Language', array('multiple' => 'checkbox', 'class' => ''));
					echo $this->Form->input('Day', array('multiple' => 'checkbox', 'class' => ''));
					echo $this->Form->input('description');
					//Languages
					//Days
					//Times
				?>

			</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
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
				</div>
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
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('tours-add-edit.js');?>
	<script>
		jQuery(document).ready(function() {
			TourAdminAddEdit.init();
		});
	</script>
<?php $this->end(); ?>