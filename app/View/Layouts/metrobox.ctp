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
?>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<?php
	echo $this->Html->css('components-rounded');
	echo $this->Html->css('plugins');
	echo $this->Html->css('layout');
	echo $this->Html->css('themes/default');
	echo $this->Html->css('custom');
?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-menu-fixed">
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<?= $this->Element('metrobox_header'); ?>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<?= $this->Element('metrobox_main_menu'); ?>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Blank Page Layout <small>blank page sample</small></h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				<!-- PAGE TOOLBAR -->
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
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
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="layout_blank_page.html">Features</a>
					<i class="fa fa-circle"></i>
				</li>
				<li class="active">
					Blank Page Layout
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<?= $this->fetch('content'); ?>
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN PRE-FOOTER -->
<?= $this->Element('metrobox_pre_footer'); ?>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<?= $this->Element('metrobox_footer'); ?>
<!-- END FOOTER -->
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
?>
<!-- END CORE PLUGINS -->
<?php
echo $this->Html->script('metrobox');
echo $this->Html->script('layout');
?>

<script>
	jQuery(document).ready(function() {
		Metrobox.init(); // init metrobox core components
		Layout.init(); // init current layout
	});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>