<!-- <div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your email and password'); ?>
        </legend>
        <?php echo $this->Form->input('email');
    ?>
    </fieldset>
</div> -->

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
			)
?>

<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?php echo $this->Form->create('User', array('inputDefaults' => $inputFormOptions,'class' => 'login-form')); ?>
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
	<?php echo $this->Form->end(); ?>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="index.html" method="post">
		<h3><?= __("Forget Password?");?></h3>
		<p>
			 <?= __("Enter your e-mail address below to reset your password.");?>
		</p>
		<div class="form-group">
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default"><?= __("Back");?></button>
			<button type="submit" class="btn btn-success uppercase pull-right"><?= __("Submit");?></button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->