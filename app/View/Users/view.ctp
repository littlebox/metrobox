
<!-- BEGIN PROFILE SIDEBAR -->
<div class="profile-sidebar" style="width:250px;">
	<!-- PORTLET MAIN -->
	<div class="portlet light profile-sidebar-portlet">
		<!-- SIDEBAR USERPIC -->
		<div class="profile-userpic">
			<?= $this->Html->image('media/profile/profile_picture_'.AuthComponent::user('id').'.jpg', array('alt' => '', 'class' => 'img-responsive'));?>
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				<?= (AuthComponent::user('full_name')) ? AuthComponent::user('full_name') : "WTF?";?>
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
					Projects
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					51
				</div>
				<div class="uppercase profile-stat-text">
					Tasks
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					61
				</div>
				<div class="uppercase profile-stat-text">
					Uploads
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
						<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#user_info" data-toggle="tab">Personal Info</a>
						</li>
						<li>
							<a href="#change_avatar" data-toggle="tab">Change Avatar</a>
						</li>
						<li>
							<a href="#change_password" data-toggle="tab">Change Password</a>
						</li>
						<li>
							<a href="#user_settings" data-toggle="tab">Privacy Settings</a>
						</li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<!-- PERSONAL INFO TAB -->
						<div class="tab-pane active" id="user_info">
							<!-- <form role="form" action="#"> -->
							<?php echo $this->Form->create('User', array('url' => array('action' => 'edit', 'ext' => 'json'), 'id' => 'user-profile-edit'));?>
								<?php
									echo $this->Form->input('full_name', array("disabled" => "disabled"));
									echo $this->Form->input('email', array("disabled" => "disabled"));
								?>

								<div class="margiv-top-10">
									<button id="user-profile-edit-btn-edit" class="btn blue" onclick="makeEditable(); return false;"><?= __('Edit') ?></button>
									<button id="user-profile-edit-btn-cancel" class="btn" onclick="unmakeEditable(); return false;" style="display:none;"><?= __('Cancel') ?></button>
									<button id="user-profile-edit-btn-save" class="btn green-haze ladda-button" onclick="sendProfileInfoForm(); return false;" style="display:none;"><span class="ladda-label"><?= __('Save Changes') ?></span></button>
								</div>
							<?php echo $this->Form->end();?>
							<!-- </form> -->

						</div>
						<!-- END PERSONAL INFO TAB -->
						<!-- CHANGE AVATAR TAB -->
						<div class="tab-pane" id="change_avatar">
							<p>
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
							</p>
							<form action="#" role="form">
								<div class="form-group">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
										</div>
										<div>
											<span class="btn default btn-file">
											<span class="fileinput-new">
											Select image </span>
											<span class="fileinput-exists">
											Change </span>
											<input type="file" name="...">
											</span>
											<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
											Remove </a>
										</div>
									</div>
									<div class="clearfix margin-top-10">
										<span class="label label-danger">NOTE! </span>
										<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
									</div>
								</div>
								<div class="margin-top-10">
									<a href="#" class="btn green-haze">
									Submit </a>
									<a href="#" class="btn default">
									Cancel </a>
								</div>
							</form>
						</div>
						<!-- END CHANGE AVATAR TAB -->
						<!-- CHANGE PASSWORD TAB -->
						<div class="tab-pane" id="change_password">
							<form action="#">
								<div class="form-group">
									<label class="control-label">Current Password</label>
									<input type="password" class="form-control"/>
								</div>
								<div class="form-group">
									<label class="control-label">New Password</label>
									<input type="password" class="form-control"/>
								</div>
								<div class="form-group">
									<label class="control-label">Re-type New Password</label>
									<input type="password" class="form-control"/>
								</div>
								<div class="margin-top-10">
									<a href="#" class="btn green-haze">
									Change Password </a>
									<a href="#" class="btn default">
									Cancel </a>
								</div>
							</form>
						</div>
						<!-- END CHANGE PASSWORD TAB -->
						<!-- PRIVACY SETTINGS TAB -->
						<div class="tab-pane" id="user_settings">
							<form action="#">
								<table class="table table-light table-hover">
								<tr>
									<td>
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
									</td>
									<td>
										<label class="uniform-inline">
										<input type="radio" name="optionsRadios1" value="option1"/>
										Yes </label>
										<label class="uniform-inline">
										<input type="radio" name="optionsRadios1" value="option2" checked/>
										No </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
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
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-view');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-view.js');?>
	<script>
		jQuery(document).ready(function() {
			//UsersView.init(); //Momentaneamente no hay nada
		});

		//Save all original insputs values on an object
		var LocalVar = {};
		$("form#user-profile-edit input[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			LocalVar[input.attr('name')]=input.val();
		});


		function makeEditable(){
			$("form#user-profile-edit input[type!='hidden']").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				input.removeAttr('disabled');
			});
			$("#user-profile-edit-btn-cancel").show();
			$("#user-profile-edit-btn-save").show();
			$("#user-profile-edit-btn-edit").hide();
		}

		function unmakeEditable(){
			$("form#user-profile-edit input[type!='hidden']").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				input.val(LocalVar[input.attr('name')]);
				input.attr('disabled', 'disabled');

			});
			$("#user-profile-edit-btn-edit").show();
			$("#user-profile-edit-btn-cancel").hide();
			$("#user-profile-edit-btn-save").hide();
		}

		function sendProfileInfoForm() {
			//var button = $( '#user-profile-edit-btn-save' ).ladda();
			//button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#user-profile-edit').attr('action');
			var formData = $('#user-profile-edit').serializeArray();

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
						console.log(response.content);
						$('#page-alert-success').find('span').text(response.content);
						$('#page-alert-success').show();
					}
					if (response.error) {
						console.log(response.error);
						$('#page-alert-danger').find('span').text(response.error);
						$('#page-alert-danger').show();
					}
				},
				error: function(e) {
					console.log('ajaxerror');
					$('#page-alert-danger').find('span').text("<?= __('An error ocurred, please try later.') ?>");
					$('#page-alert-danger').show();
				},
				complete: function(){
					//button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};
	</script>
<?php $this->end(); ?>
