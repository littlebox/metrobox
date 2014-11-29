<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Login Form 1</title>
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

	echo $this->Html->css('login');

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
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<?= $this->Html->image('logo-big.png');?>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->

	<?php echo $this->fetch('content'); ?>

</div>
<div class="copyright">
	 <?php echo date('Y').' © littlebox. '. __('Admin Dashboard');?>
</div>

<!-- END LOGIN -->
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
echo $this->Html->script('/plugins/bootstrap/js/bootstrap.min');
echo $this->Html->script('/plugins/jquery.blockui.min');
echo $this->Html->script('/plugins/uniform/jquery.uniform.min');
echo $this->Html->script('/plugins/jquery.cokie.min');
?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
echo $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');
?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
echo $this->Html->script('metronic');
echo $this->Html->script('layout');
echo $this->Html->script('demo');
echo $this->Html->script('login');
?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
