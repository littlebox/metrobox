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
		<!-- END ERROR MESSAGE-->

		<?= $this->Form->input('email', array('placeholder' => __('Email')));?>
		<?= $this->Form->input('password', array('placeholder' => __('Password')));?>

		<?php if(!empty($attempts_count)):?>

			<?php if($attempts_count >= $min_attempts_show_captcha):?>

			<?= $this->Recaptcha->display(array(
				'recaptchaOptions' => array(
						'theme' => 'white'
				)
			));?>

			<?php endif;?>
		<?php endif;?>


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
	<?= $this->Form->create('User', array('url' => array('action' => 'forgetPassword', 'ext' => 'json'), 'inputDefaults' => $inputFormOptions, 'class' => 'forget-form', 'id' => 'forget-form')); ?>
		<h3><?= __("Forget Password?");?></h3>

		<!-- BEGIN ERROR MESSAGE-->
		<?= $this->Session->flash()?>

		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
				<?php //Javascript text ?>
			</span>
		</div>
		<!-- END ERROR MESSAGE-->

		<p>
			<?= __("Enter your e-mail address to reset your password");?>
		</p>
		<?= $this->Form->input('email', array('placeholder' => __('Email'), 'label' => false, 'id' => 'forget-input-email'));?>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default"><?= __("Back");?></button>
			<?= $this->Form->button($this->Html->tag('span', __('Submit'), array('class' => 'ladda-label')), array('id' => 'forget-submit-button', 'class' => 'btn btn-success uppercase pull-right ladda-button', 'data-style' => 'zoom-out'));?>
		</div>
	<?= $this->Form->end(); ?>
	<!-- END FORGOT PASSWORD FORM -->
</div>

<script>
	function sendForgetPasswordForm() {
		var button = $( '#forget-submit-button' ).ladda();
		button.ladda( 'start' ); //Show loader in button

		var targeturl = $('#forget-form').attr('action');
		var formData = $('#forget-form').serializeArray();

		$.ajax({
			type: 'put',
			cache: false,
			url: targeturl,
			data: formData,
			dataType: 'json',
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
			},
			success: function(response) {
				if (response.content) {
					//Show sweetalert
					swal({
						title: response.content.title,
						text: response.content.text,
						type: "success",
						confirmButtonText: "<?= __('Ok') ?>"
					});
					$('#forget-input-email').val(''); //Empty email input
				}
				if (response.error) {
					$('.alert-danger', $('.forget-form')).find('span').text(response.error);
					$('.alert-danger', $('.forget-form')).show();
				}
			},
			error: function(e) {
				$('.alert-danger', $('.forget-form')).find('span').text("<?= __('An error ocurred, please try later.') ?>");
				$('.alert-danger', $('.forget-form')).show();
				console.log(e.responseText.message);
			},
			complete: function(){
				button.ladda( 'stop' ); //Hide loader in button
			}
		});
	};
</script>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('login');?>
	<script>
		jQuery(document).ready(function() {
			Login.init();
		});
	</script>
<?php $this->end(); ?>
