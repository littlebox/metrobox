<!DOCTYPE html>
<!--
Template Name: Metrobox
Version: 0.0.1
Author: littlebox
Website: http://www.littlebox.com.ar/
Contact: info@littlebox.com.ar
Like: www.facebook.com/littlefacebox
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang=<?= Configure::read('Config.language') ?>>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title><?= $this->fetch('title'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<?php
		echo $this->Html->css('googlefonts');
		echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');
		echo $this->Html->css('/plugins/simple-line-icons/simple-line-icons.min');
		echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min');
		echo $this->Html->css('/plugins/uniform/css/uniform.default');
		echo $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');
	?>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES -->
	<?php
		echo $this->Html->css('components');
		echo $this->Html->css('plugins');
		echo $this->Html->css('layout');
		echo $this->Html->css('themes/dark');
		echo $this->Html->css('custom');
	?>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-container-bg-solid page-sidebar-closed-hide-logo">

	<?= $this->Element('metrobox/header'); ?>

	<div class="clearfix"></div>

	<div class="page-container">

		<?= $this->Element('metrobox/sidebar_menu'); ?>

		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">
							Widget settings form goes here
							</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				Blank Page <small>blank page</small>
				</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Page Layouts</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Blank Page</a>
						</li>
					</ul>
					<div class="page-toolbar">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							Actions <i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">Separated link</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<?= $this->fetch('content'); ?>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
	</div>

	<?= $this->Element('metrobox/footer')?>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<?php
echo $this->Html->script('/plugins/respond.min');
echo $this->Html->script('/plugins/excanvas.min');
?>
<![endif]-->
<?php
echo $this->Html->script('/plugins/jquery.min');
echo $this->Html->script('/plugins/jquery-migrate.min');
echo $this->Html->script('/plugins/jquery-ui/jquery-ui-1.10.3.custom.min');
echo $this->Html->script('/plugins/bootstrap/js/bootstrap.min');
echo $this->Html->script('/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min');
echo $this->Html->script('/plugins/jquery-slimscroll/jquery.slimscroll.min');
echo $this->Html->script('/plugins/jquery.blockui.min');
echo $this->Html->script('/plugins/jquery.cokie.min');
echo $this->Html->script('/plugins/uniform/jquery.uniform.min');
echo $this->Html->script('/plugins/bootstrap-switch/js/bootstrap-switch.min');
?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
echo $this->Html->script('metrobox');
echo $this->Html->script('layout');
?>
<script>
	jQuery(document).ready(function() {
		Metrobox.init(); // init metronic core components
		Layout.init(); // init current layout
	});
</script>

<?php echo $this->fetch('script'); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

