<!DOCTYPE html>
<!--
Template Name: Metrobox
Version: 0.0.1
Author: littlebox
Website: http://www.littlebox.com.ar/
Contact: info@littlebox.com.ar
Like: www.facebook.com/littlefacebox
-->
<!--[if IE 8]> <html lang="<?= substr(Configure::read('Config.language'), 0, 2) ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?= substr(Configure::read('Config.language'), 0, 2) ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= substr(Configure::read('Config.language'), 0, 2) ?>">
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
		echo $this->Html->css('themes/bebusca-colors');
		echo $this->Html->css('custom');
	?>
	<!-- END THEME STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<?php echo $this->fetch('pageStyles'); ?>
	<!-- END PAGE LEVEL STYLES -->
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
			<div class="page-content estates">

				<?= $this->Element('metrobox/page_header'); ?>

				<!--BEGIN PAGE ALERTS -->
				<?= $this->Session->flash(); ?>

				<div id="page-alert-success" class="alert alert-success" style="display:none;">
					<button class="close" data-close="alert"></button>
					<i class="fa-lg fa fa-check"></i>
					<span></span>
				</div>

				<div id="page-alert-danger" class="alert alert-danger" style="display:none;">
					<button class="close" data-close="alert"></button>
					<i class="fa-lg fa fa-times"></i>
					<span></span>
				</div>
				<div id="page-alert-warning" class="alert alert-warning" style="display:none;">
					<button class="close" data-close="alert"></button>
					<i class="fa-lg fa fa-warning"></i>
					<span></span>
				</div>
				<!-- END PAGE ALERTS -->

				<!-- BEGIN PAGE CONTENT-->
				<?= $this->fetch('content'); ?>
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
<!-- BEGIN PAGE PLUGINS -->
<?php echo $this->fetch('pagePlugins'); ?>
<!-- END PAGE PLUGINS -->
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

<?php //echo $this->fetch('pageScripts'); ?>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

