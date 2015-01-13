
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
			<div class="profile-usertitle-job">
				Developer
			</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- SIDEBAR BUTTONS -->
		<div class="profile-userbuttons">
			<button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
			<button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
		</div>
		<!-- END SIDEBAR BUTTONS -->
		<!-- SIDEBAR MENU -->
		<div class="profile-usermenu">
			<ul class="nav">
				<li>
					<a href="extra_profile.html">
					<i class="icon-home"></i>
					Overview </a>
				</li>
				<li class="active">
					<a href="extra_profile_account.html">
					<i class="icon-settings"></i>
					Account Settings </a>
				</li>
				<li>
					<a href="page_todo.html" target="_blank">
					<i class="icon-check"></i>
					Tasks </a>
				</li>
				<li>
					<a href="extra_profile_help.html">
					<i class="icon-info"></i>
					Help </a>
				</li>
			</ul>
		</div>
		<!-- END MENU -->
	</div>
	<!-- END PORTLET MAIN -->
	<!-- PORTLET MAIN -->
	<div class="portlet light">
		<!-- STAT -->
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
		<!-- END STAT -->
		<div>
			<h4 class="profile-desc-title">About Marcus Doe</h4>
			<span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
			<div class="margin-top-20 profile-desc-link">
				<i class="fa fa-globe"></i>
				<a href="http://www.keenthemes.com">www.keenthemes.com</a>
			</div>
			<div class="margin-top-20 profile-desc-link">
				<i class="fa fa-twitter"></i>
				<a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
			</div>
			<div class="margin-top-20 profile-desc-link">
				<i class="fa fa-facebook"></i>
				<a href="http://www.facebook.com/keenthemes/">keenthemes</a>
			</div>
		</div>
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
							<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab">Change Password</a>
						</li>
						<li>
							<a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
						</li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<!-- PERSONAL INFO TAB -->
						<div class="tab-pane active" id="tab_1_1">
							<!-- <form role="form" action="#"> -->
							<?php echo $this->Form->create('User');?>
								<?php
									echo $this->Form->input('full_name');
									echo $this->Form->input('email');
								?>

								<div class="margiv-top-10">
									<?= $this->Form->button(__('Save Changes'), array('class' => 'btn green-haze'));?>
								</div>
							<?php echo $this->Form->end();?>
							<!-- </form> -->

						</div>
						<!-- END PERSONAL INFO TAB -->
						<!-- CHANGE AVATAR TAB -->
						<div class="tab-pane" id="tab_1_2">
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
						<div class="tab-pane" id="tab_1_3">
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
						<div class="tab-pane" id="tab_1_4">
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


<!--------------------------------- ORIGINAL ------------------------------------>
<?php if(false): ?>
<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reset Password Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['reset_password_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reset Password Token Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['reset_password_token_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login Last Attempt'); ?></dt>
		<dd>
			<?php echo h($user['User']['login_last_attempt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login Last Attempts Count'); ?></dt>
		<dd>
			<?php echo h($user['User']['login_last_attempts_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php endif; ?>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('profile');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
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
	</script>
<?php $this->end(); ?>
