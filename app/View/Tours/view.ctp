<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-pencil font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Tour')?></span>
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
			'id' => 'tour-add-edit-form',
		)); ?>
			<div class="form-body">

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Name') ?></label>
					<div class="col-md-9">
						<p class="form-control-static"><?= $tour['Tour']['name']; ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Length') ?></label>
					<div class="col-md-9">
						<p class="form-control-static"><?= substr($tour['Tour']['length'], 0, 5); ?> <?= __('Hs.') ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Quota') ?></label>
					<div class="col-md-9">
						<p class="form-control-static"><?= $tour['Tour']['quota']; ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Price') ?></label>
					<div class="col-md-9">
						<p class="form-control-static">$<?= $tour['Tour']['price']; ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Minors Price') ?></label>
					<div class="col-md-9">
						<p class="form-control-static">$<?= $tour['Tour']['minors_price']; ?></p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Languages') ?></label>
					<div class="col-md-9">
						<?php foreach ($tour['Language'] as $language) : ?>
							<p class="form-control-static"><?= $language['name']; ?></p>
							<?php if (end($tour['Language']) !== $language) : ?>
								<br>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Days') ?></label>
					<div class="col-md-9">
						<?php foreach ($tour['Day'] as $day) : ?>
							<p class="form-control-static"><?= $day['name']; ?></p>
							<?php if (end($tour['Day']) !== $day) : ?>
								<br>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Times') ?></label>
					<div class="col-md-9">
						<?php foreach ($tour['Time'] as $time) : ?>
							<p class="form-control-static"><?= substr($time['hour'], 0, 5); ?> <?= __('Hs.') ?></p>
							<?php if (end($tour['Time']) !== $time) : ?>
								<br>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Color') ?></label>
					<div class="col-md-9">
						<div style="width: 32px;height: 32px;background-color: <?= $tour['Tour']['color']; ?>;"></div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Description') ?></label>
					<div class="col-md-9">
						<p class="form-control-static"><?= $tour['Tour']['description']; ?></p>
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
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/colorpicker/colorPicker.min');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>
	<?= $this->Html->script('/plugins/colorpicker/colorPicker.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<script>
		jQuery(document).ready(function() {
			TourAddEdit.init();
		});
	</script>
<?php $this->end(); ?>