<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-static-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/">
				<?= $this->Html->image('logo-default.png', array('alt' => 'logo', 'class' => 'logo-default'));?>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions -->
		<div class="page-actions">

			<div class="btn-group">
				<button type="button" class="btn btn-circle purple-soft dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-plus"></i>&nbsp;<span class="hidden-sm hidden-xs"><?= __('New') ?>&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?= $this->Html->Url(array('controller' => 'tours', 'action' => 'add')); ?>">
						<i class="icon-direction"></i> <?= __('New Tour') ?> </a>
					</li>

					<?php //Admin Part ?>
					<?php if(AuthComponent::user('Group.id') == 1): ?>

					<li class="divider">
					</li>
					<li>
						<a href="<?= $this->Html->Url(array('controller' => 'wineries', 'action' => 'add', 'admin' => 'true')); ?>">
						<i class="icon-directions"></i> <?= __('New Winery') ?> </a>
					</li>
					<li>
						<a href="<?= $this->Html->Url(array('controller' => 'users', 'action' => 'add', 'admin' => 'true')); ?>">
						<i class="icon-user"></i> <?= __('New User') ?> </a>
					</li>

					<?php endif; ?>

				</ul>
			</div>
			<?php
			if(AuthComponent::user('Group.id') == 1) {
				echo $this->Form->select('WineryToManage.winery_id', $wineriesList, array('id' => 'winery-to-manage-selector', 'class' => 'form-control', 'style' => 'width: 220px; display: none;'));
			}
			?>

		</div>
		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN INBOX DROPDOWN
					<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-default">
						4 </span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3><?= __('Tenes') ?> <span class="bold">4 Nuevos</span> <?= __('Mensajes') ?></h3>
								<a href="page_inbox.html"><?= __('ver todo') ?></a>
							</li>
							<li>
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 275px;"><ul class="dropdown-menu-list scroller" style="height: 275px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<?= $this->Html->image('media/profile/profile_picture_7.jpg', array('alt' => '', 'class' => 'img-circle'));?>
										</span>
										<span class="subject">
										<span class="from">
										Nicolás Pennesi </span>
										<span class="time">Just Now </span>
										</span>
										<span class="message">
										Peru ponete a laburar! </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<?= $this->Html->image('media/profile/profile_picture_2.jpg', array('alt' => '', 'class' => 'img-circle'));?>
										</span>
										<span class="subject">
										<span class="from">
										Admin </span>
										<span class="time">16 mins </span>
										</span>
										<span class="message">
										Haciendo magia </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<?= $this->Html->image('media/profile/profile_picture_2.jpg', array('alt' => '', 'class' => 'img-circle'));?>
										</span>
										<span class="subject">
										<span class="from">
										Admin </span>
										<span class="time">30 mins </span>
										</span>
										<span class="message">
										Prueba?? </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<?= $this->Html->image('media/profile/profile_picture_2.jpg', array('alt' => '', 'class' => 'img-circle'));?>
										</span>
										<span class="subject">
										<span class="from">
										Admin </span>
										<span class="time">1 hs </span>
										</span>
										<span class="message">
										Si esto se ve, es que funciona </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
											<?= $this->Html->image('media/profile/profile_picture_2.jpg', array('alt' => '', 'class' => 'img-circle'));?>
										</span>
										<span class="subject">
										<span class="from">
										Admin </span>
										<span class="time">2 hs </span>
										</span>
										<span class="message">
										Prueba? </span>
										</a>
									</li>

								</ul><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(99, 114, 131);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
							</li>
						</ul>
					</li>
					 END INBOX DROPDOWN -->

					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<?= $this->Html->image('media/profile/profile_picture_'.AuthComponent::user('id').'.jpg', array('alt' => '', 'class' => 'img-circle'));?>
						<span class="username username-hide-on-mobile">
							<?= (AuthComponent::user('full_name')) ? AuthComponent::user('full_name') : "WTF?";?>
						</span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<?= $this->Html->link(
									'<i class="icon-user"></i> '.__('My profile').' ',
									array('controller' => 'users', 'action' => 'view', AuthComponent::user('id')),
									array('escape' => false)
								); ?>
							</li>
							<!-- <li>
								<?= $this->Html->link(
									'<i class="icon-directions"></i> '.__('Winery profile').' ',
									array('controller' => 'wineries', 'action' => 'view'),
									array('escape' => false)
								); ?>
							</li> -->
							<li class="divider">
							</li>
							<li>
								<?= $this->Html->link(
									'<i class="icon-key"></i> '.__('Log Out').' ',
									array('controller' => 'users', 'action' => 'logout'),
									array('escape' => false)
								); ?>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->