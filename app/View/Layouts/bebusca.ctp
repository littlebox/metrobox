<!DOCTYPE html>
<html lang="<?= substr(Configure::read('Config.language'), 0, 2) ?>">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $this->fetch('title'); ?></title>
	<meta name="description" itemprop="description" content="Descubre la mejor manera de encontrar casas, departamentos, oficinas, locales comerciales y terrenos a la venta o para alquiler." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<link rel="icon" type="image/png" href="/bebusca/img/favicon/favicon-196x196.png" sizes="196x196"/>
	<link rel="icon" type="image/png" href="/bebusca/img/favicon/favicon-160x160.png" sizes="160x160"/>
	<link rel="icon" type="image/png" href="/bebusca/img/favicon/favicon-96x96.png" sizes="96x96"/>
	<link rel="icon" type="image/png" href="/bebusca/img/favicon/favicon-16x16.png" sizes="16x16"/>
	<link rel="icon" type="image/png" href="/bebusca/img/favicon/favicon-32x32.png" sizes="32x32"/>

	<link rel="stylesheet" href="/bebusca/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/bebusca/css/fonts.css"/>
	<link rel="stylesheet" type="text/css" href="/bebusca/css/bebusca.css"/>
	<link rel="stylesheet" type="text/css" href="/bebusca/css/mixins-bootstrap-accounts-login.css" />
</head>
<body class="body ">

	<section id="content" class="content with-footer" push-state="pushState.ajax">
		<?= $this->Element('bebusca/header'); ?>

		<?= $this->fetch('content'); ?>

		<div class="clearfix"></div>
	</section>

	<!-- Google Maps -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.17&amp;sensor=false&amp;libraries=places,geometry"></script>

	<script src="/bebusca/js/jquery.min.js"></script>
	<script src="/bebusca/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bebusca/js/infobox.js"></script>
	<script type="text/javascript" src="/bebusca/js/bebusca-explore.js"></script>

</body>

</html>