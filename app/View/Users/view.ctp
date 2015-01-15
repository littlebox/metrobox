
<!-- BEGIN PROFILE SIDEBAR -->
<div class="profile-sidebar" style="width:250px;">
	<!-- PORTLET MAIN -->
	<div class="portlet light profile-sidebar-portlet">
		<!-- SIDEBAR USERPIC -->
		<div class="profile-userpic">
			<?= $this->Html->image('media/profile/profile_picture_'.$user['User']['id'].'.jpg', array('alt' => '', 'class' => 'img-responsive'));?>
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name" id="profile-usertitle-name">
				<?= $user['User']['full_name'];?>
			</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- USER STATS -->
		<div class="row list-separated profile-stat">
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					37
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Something') ?>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					51
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Something Else') ?>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					61
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Thing') ?>
				</div>
			</div>
		</div>
		<!-- END USER STATS -->
	</div>
	<!-- END PORTLET MAIN -->

</div>
<!-- END BEGIN PROFILE SIDEBAR -->

<!-- BEGIN PROFILE CONTENT -->
<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i>
						<span class="caption-subject font-blue-madison bold uppercase"><?= __('Profile Account') ?></span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#user_info" data-toggle="tab"><?= __('Personal Info') ?></a>
						</li>
						<li>
							<a href="#change_avatar" data-toggle="tab"><?= __('Change Avatar') ?></a>
						</li>
						<li>
							<a href="#change_password" data-toggle="tab"><?= __('Change Password') ?></a>
						</li>
						<li>
							<a href="#user_settings" data-toggle="tab"><?= __('Account Settings') ?></a>
						</li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<!-- PERSONAL INFO TAB -->
						<div class="tab-pane active" id="user_info">
							<?php echo $this->Form->create('User', array('url' => array('action' => 'edit', 'ext' => 'json'), 'id' => 'user-profile-info-edit'));?>
								<?php
									echo $this->Form->input('full_name', array("disabled" => "disabled"));
									echo $this->Form->input('email', array("disabled" => "disabled"));
								?>

								<div class="margiv-top-10">
									<button id="user-profile-info-edit-btn-edit" class="btn blue" onclick="makeEditable(); return false;"><?= __('Edit') ?></button>
									<button id="user-profile-info-edit-btn-cancel" class="btn" onclick="unmakeEditable(); return false;" style="display:none;"><?= __('Cancel') ?></button>
									<button id="user-profile-info-edit-btn-save" class="btn green-haze ladda-button" data-style="zoom-out" onclick="sendProfileInfoForm(); return false;" style="display:none;"><span class="ladda-label"><?= __('Save Changes') ?></span></button>
								</div>
							<?php echo $this->Form->end();?>
						</div>
						<!-- END PERSONAL INFO TAB -->

						<!-- CHANGE AVATAR TAB -->
						<div class="tab-pane" id="change_avatar">
							<?php echo $this->Form->create('User', array(
								'url' => array('action' => 'edit', 'ext' => 'json'),
								'id' => 'user-profile-picture-edit',
								'enctype' => 'multipart/form-data')
							);?>
								<div class="form-group">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<?php
											if(file_exists(WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.'profile_picture_'.$user['User']['id'].'.jpg')){
												echo $this->Html->image('media/profile/profile_picture_'.$user['User']['id'].'.jpg', array('alt' => ''));
											}else{
												echo $this->Html->image('media/profile/noimage.jpg', array('alt' => ''));
											}
											?>
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="min-width:100px; min-height:100px;max-width: 500px; max-height: 500px;"></div>
										<div>
											<span class="btn default btn-file">
											<span class="fileinput-new"><?= __('Select image');?></span>
											<span class="fileinput-exists"><?= __('Change image');?></span>

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
								</div>
								<div class="margin-top-10">
									<button id="user-profile-picture-edit-btn-save" class="btn green-haze ladda-button" data-style="zoom-out" onclick="UsersView.sendProfilePictureForm(); return false;" style="display:none;"><span class="ladda-label"><?= __('Change') ?></span></button>
								</div>
							<?php echo $this->Form->end();?>
						</div>
						<!-- END CHANGE AVATAR TAB -->

						<!-- CHANGE PASSWORD TAB -->
						<div class="tab-pane" id="change_password">
							<?php echo $this->Form->create('User', array('url' => array('action' => 'edit', 'ext' => 'json'), 'id' => 'user-profile-password-edit'));?>
								<?php
									echo $this->Form->input('current_password', array('type' => 'password'));
									echo $this->Form->input('password');
									echo $this->Form->input('password_confirm', array('type' => 'password'));

								?>

								<div class="margiv-top-10">
									<button id="user-profile-info-edit-btn-save" class="btn green-haze ladda-button" data-style="zoom-out" onclick="sendProfilePasswordForm(); return false;"><span class="ladda-label"><?= __('Change Password') ?></span></button>
								</div>
							<?php echo $this->Form->end();?>
						</div>
						<!-- END CHANGE PASSWORD TAB -->
						<!-- PRIVACY SETTINGS TAB -->
						<div class="tab-pane" id="user_settings">
							<form action="#">
								<table class="table table-light table-hover">
								<tr>
									<td>
										<?= __('I want recive newslwtter.') ?>
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
								</table>
								<!--end profile-settings-->
								<div class="margin-top-10">
									<a href="#" class="btn green-haze">
									Save Changes </a>
									<a href="#" class="btn default">
									Cancel </a>
								</div>
							</form>
						</div>
						<!-- END PRIVACY SETTINGS TAB -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PROFILE CONTENT -->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('profile');?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('image-crop.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-view');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-view.js');?>
	<script>
		jQuery(document).ready(function() {
			UsersView.init();
		});

		//Save all original inputs values on an object
		var LocalVar = {};
		$("form#user-profile-info-edit input[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			LocalVar[input.attr('name')]=input.val();
		});


		function makeEditable(){
			$("form#user-profile-info-edit input[type!='hidden']").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				input.removeAttr('disabled');
			});
			$("#user-profile-info-edit-btn-cancel").show();
			$("#user-profile-info-edit-btn-save").show();
			$("#user-profile-info-edit-btn-edit").hide();
		}

		function unmakeEditable(){
			$("form#user-profile-info-edit input[type!='hidden']").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				input.val(LocalVar[input.attr('name')]);
				input.attr('disabled', 'disabled');

			});
			$("#user-profile-info-edit-btn-edit").show();
			$("#user-profile-info-edit-btn-cancel").hide();
			$("#user-profile-info-edit-btn-save").hide();
		}

		function sendProfileInfoForm() {
			var button = $( '#user-profile-info-edit-btn-save' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#user-profile-info-edit').attr('action');
			var formData = $('#user-profile-info-edit').serializeArray();

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
						$('#page-alert-success').find('span').html(response.content);
						$('#page-alert-success').show();
						//Save new insputs values on an object LocalVar
						$("form#user-profile-info-edit input[type!='hidden']").each(function(){
							var input = $(this); // This is the jquery object of the input, do what you will
							LocalVar[input.attr('name')]=input.val();
						});
						unmakeEditable();
						$('#profile-usertitle-name').html(LocalVar['data[User][full_name]']);
					}
					if (response.error) {
						$('#page-alert-danger').find('span').html(response.error);
						$('#page-alert-danger').show();
					}
				},
				error: function(e) {
					$('#page-alert-danger').find('span').html(e.responseJSON.message);
					$('#page-alert-danger').show();
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};

		function sendProfilePictureForm() {
			var button = $( '#user-profile-picture-edit-btn-save' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#user-profile-picture-edit').attr('action');
			var formData = $('#user-profile-picture-edit').serializeArray();

			$.ajax({
				type: 'post',
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
						$('#page-alert-success').find('span').html(response.content);
						$('#page-alert-success').show();
						//Save new insputs values on an object LocalVar
						$("form#user-profile-info-edit input[type!='hidden']").each(function(){
							var input = $(this); // This is the jquery object of the input, do what you will
							LocalVar[input.attr('name')]=input.val();
						});
						unmakeEditable();
						$('#profile-usertitle-name').html(LocalVar['data[User][full_name]']);
					}
					if (response.error) {
						$('#page-alert-danger').find('span').html(response.error);
						$('#page-alert-danger').show();
					}
				},
				error: function(e) {
					$('#page-alert-danger').find('span').html(e.responseJSON.message);
					$('#page-alert-danger').show();
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};

		

		function sendProfilePasswordForm() {
			var button = $( '#user-profile-password-edit-btn-save' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#user-profile-password-edit').attr('action');
			var formData = $('#user-profile-password-edit').serializeArray();

			$.ajax({
				type: 'post',
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
						$('#page-alert-success').find('span').html(response.content);
						$('#page-alert-success').show();
						//Empty fields
						$("form#user-profile-password-edit input[type!='hidden']").each(function(){
							var input = $(this); // This is the jquery object of the input, do what you will
							input.val('');
						});
					}
					if (response.error) {
						$('#page-alert-danger').find('span').html(response.error);
						$('#page-alert-danger').show();
					}
				},
				error: function(e) {
					$('#page-alert-danger').find('span').html(e.responseJSON.message);
					$('#page-alert-danger').show();
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};

	</script>
<?php $this->end(); ?>
