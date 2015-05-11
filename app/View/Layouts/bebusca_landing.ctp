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
	<link rel="stylesheet" type="text/css" href="/bebusca/css/mixins-accounts-login-home.css" media="all"/>
</head>
<body class="body ">
	<div class="landing-page">
		<?= $this->Element('bebusca/header'); ?>
		<div id="value-proposition" style="background-image:url('/bebusca/img/home/home_background.jpg')" class="location-ab-test">
			<div class="flush-top container vertical-align-wrapper relative-wrapper text-center">
				<div class="vertical-align-content">
					<h1 class="text-header">Encontrá un lugar que ames</h1>
					<h2 class="text-header">Comprá o alquilá una casa, departamento, oficina o terreno de la manera más fácil.</h2>

					<form method="post" action="<?= $this->Html->Url(array('controller' => 'pages', 'action' => 'explore'));?>">
						<fieldset class="search-type-bar">
							<div class="ut-iblock pull-left ut-btn-group">
								<div class="btn-group btn-group-justified btn-group-toggle">
									<a type="button" class="btn btn-primary btn-xs btn-block btn-rb-switch active">
										<input type="checkbox" name="listing_type" value="rent" checked="checked">Alquiler
									</a>
									<a type="button" class="btn btn-primary btn-xs btn-block btn-rb-switch ">
										<input type="checkbox" name="listing_type" value="sale">Venta
									</a>
								</div>
							</div>
							<div class="ut-iblock pull-left ut-nice-select">
								<select style="opacity: 0" name="listing_type" type="select" class="form-control jsLandingSelect">
									<option value="1" selected="selected">Casa</option>
									<option value="2">Departamento</option>
									<option value="3">Oficina</option>
									<option value="4">Local Comercial</option>
									<option value="5">Terreno</option>
								</select>
								<div class="btn-rb-dropdown">
									<span>Casa</span><b>&nbsp;▾</b>
								</div>
							</div>
							<div class="input-group rb-input-group text-left">
								<span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
									<input type="text" value="" class="form-control landing-input typeahead tt-hint" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255);">
									<input type="text" placeholder="Lugar, ciudad o barrio" value="" class="form-control landing-input typeahead tt-input" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
									<pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Lato, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizeLegibility; text-transform: none;"></pre>
									<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;">
										<div class="tt-dataset-0"></div>
									</span>
								</span>
								<span class="input-group-btn">
									<button type="submit" class="btn btn-rb-search"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</fieldset>
						<div class="jsMapSacrifice"></div>
					</form>

				</div>
			</div>
		</div>
		<?= $this->Element('bebusca/footer'); ?>
	</div>

	<?= $this->Element('bebusca/signup_form'); ?>
	<?= $this->Element('bebusca/login_form'); ?>


	<script src="/bebusca/js/jquery.min.js"></script>
	<script src="/bebusca/js/angular.min.js"></script>
	<script src="/bebusca/js/bootstrap.min.js"></script>
	<script src="/bebusca/js/bebusca-landing.js"></script>
</body>
</html>