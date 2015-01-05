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
			'inputDefaults' => array(
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

<?= $this->Html->script('/plugins/select2/select2.min', array('block' => 'pagePlugins'));?>
<?= $this->Html->script('users-add.js', array('inline'=>false));?>