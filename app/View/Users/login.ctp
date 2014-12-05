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
	<!-- BEGIN LOGIN FORM -->
	<?= $this->Form->create('User', array('inputDefaults' => $inputFormOptions,'class' => 'login-form')); ?>
		<h3 class="form-title"><?= __("Sign In");?></h3>

		<!-- BEGIN ERROR MESSAGE-->

		<?= $this->Session->flash()?>

		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			<?= __("Enter any username and password.");?> </span>
		</div>
		<!-- END ERROR MESSAGE-->

		<?= $this->Form->input('email', array('placeholder' => __('Email')));?>
		<?= $this->Form->input('password', array('placeholder' => __('Password')));?>

		<div class="form-actions">
			<?= $this->Form->button(__('Login'), array('class' => 'btn btn-success uppercase'));?>
			<label class="rememberme check">
				<input type="checkbox" name="remember" value="1"/><?= __("Remember");?>
			</label>
			<a href="javascript:;" id="forget-password" class="forget-password"><?= __("Forgot Password?");?></a>
		</div>
	<?= $this->Form->end(); ?>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<?= $this->Form->create('User', array('action' => 'forgetPassword', 'inputDefaults' => $inputFormOptions,'class' => 'forget-form')); ?>
		<h3><?= __("Forget Password?");?></h3>
		<p>
			<?= __("Enter your e-mail address below to reset your password.");?>
		</p>
		<?= $this->Form->input('email', array('placeholder' => __('Email'), 'label' => false));?>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default"><?= __("Back");?></button>
			<?= $this->Form->button(__("Submit"), array('class' => 'btn btn-success uppercase pull-right'));?>
		</div>
	<?= $this->Form->end(); ?>
	<!-- END FORGOT PASSWORD FORM -->