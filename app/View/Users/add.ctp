<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Add')?></span>
			<span class="caption-helper"><?= __('Users')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
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
				'between' => '<div class="col-md-9">',
				'after' => '</div>',
				'error' => array('attributes' => array(
					'class' => 'help-block',
					'wrap' => 'span',
					))
			),
			'class' => 'form-horizontal form-bordered',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('full_name');
					echo $this->Form->input('email');
					echo $this->Form->input('password');
					echo $this->Form->input('group_id');
				?>

				<div class="form-group last">
					<label class="control-label col-md-3"><?= __('Profile picture');?></label>
					<div class="col-md-9">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
								<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="min-width:100px; min-height:100px;max-width: 500px; max-height: 500px;">
							</div>
							<div>
								<span class="btn default btn-file">
								<span class="fileinput-new"><?= __('Select image');?></span>
								<span class="fileinput-exists"><?= __('Change');?></span>

								<?php echo $this->Form->file('profile_picture', array(
									'id' => 'profile_picture',
									'required' => false)
								);?>

								<input id="profile_picture_x" type="hidden" name="profile_picture_x">
								<input id="profile_picture_y" type="hidden" name="profile_picture_y">
								<input id="profile_picture_w" type="hidden" name="profile_picture_w">
								<input id="profile_picture_h" type="hidden" name="profile_picture_h">
								<input id="profile_picture_ow" type="hidden" name="profile_picture_ow">
								<input id="profile_picture_oh" type="hidden" name="profile_picture_oh">
								</span>
								<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>

						<?php if ($this->Form->isFieldError('profile_picture')) {
							echo $this->Form->error('profile_picture');
						}?>

					</div>
				</div>
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
							));
							echo $this->Form->end();
						?>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>


<?= $this->Html->css('/plugins/select2/select2', array('inline' => false));?>
<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput', array('inline' => false));?>
<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min', array('inline' => false));?>
<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput', array('inline' => false));?>
<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min', array('inline' => false));?>
<?= $this->Html->css('image-crop.css', array('inline' => false));?>

<?= $this->Html->script('/plugins/select2/select2.min', array('block' => 'pagePlugins'));?>

<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput', array('inline' => false));?>
<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js', array('inline' => false));?>
<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js', array('inline' => false));?>

<?= $this->Html->script('users-add.js', array('inline'=>false));?>