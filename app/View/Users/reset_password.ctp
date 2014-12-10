<?php
	$inputFormOptions = array(
				'div' => array(
					'class' => 'form-group'
					),
				'label' => array(
					'class' => 'control-label visible-ie8 visible-ie9',
					),
				/* input */
				'class' => 'form-control form-control-solid placeholder-no-fix'
			);

	$this->assign('title',__('Login'));
?>

<div class="content">
	<!-- BEGIN RESET PASSWORD FORM -->
	<?= $this->Form->create('User', array('inputDefaults' => $inputFormOptions,'class' => 'reset-form')); ?>
		<h3 class="form-title"><?= __("Reset Password");?></h3>

		<!-- BEGIN ERROR MESSAGE-->
		<?= $this->Session->flash()?>
		<!-- END ERROR MESSAGE-->
		<p>
			<?= __("Enter a new password");?>
		</p>
		<?= $this->Form->input('password', array('placeholder' => __('Password')));?>
		<?= $this->Form->input('password_confirm', array('placeholder' => __('Repeat Password'), 'type' => 'password'));?>
		<?= $this->Form->hidden('token', array('value' => $token));?>

		<div class="form-actions">
			<?= $this->Form->button(__('Submit'), array('class' => 'btn btn-success uppercase'));?>
		</div>
	<?= $this->Form->end(); ?>
	<!-- END RESET PASSWORD FORM -->
</div>

<?= $this->Html->script('reset-password', array('inline'=>false));?>

<?php
$initScripts =
<<<JS
jQuery(document).ready(function() {
	Reset.init();
});
JS;
?>

<?= $this->Html->scriptBlock($initScripts, array('inline'=>false));?>