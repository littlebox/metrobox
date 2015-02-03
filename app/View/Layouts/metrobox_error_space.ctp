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
<?php
	echo $this->Html->css('googlefonts');
	echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');
	echo $this->Html->css('/plugins/simple-line-icons/simple-line-icons.min');
	echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min');
	echo $this->Html->css('/plugins/uniform/css/uniform.default');
?>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
	echo $this->Html->css('metrobox_error');
?>
<!-- END PAGE LEVEL STYLES -->
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
<body class="page-error-space">


	<?= $this->fetch('content'); ?>


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
	Metrobox.init(); // init metronic core components
	Layout.init(); // init current layout
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>