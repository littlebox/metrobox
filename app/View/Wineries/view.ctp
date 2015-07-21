<!-- BEGIN PROFILE SIDEBAR -->
<div class="profile-sidebar" style="width:250px;">
	<!-- PORTLET MAIN -->
	<div class="portlet light profile-sidebar-portlet">
		<!-- SIDEBAR USERPIC -->
		<div style="background-color: #9F4B55;">
			<?php if(file_exists(WWW_ROOT.'img'.DS.'wineries'.DS.'logos'.DS.AuthComponent::user('winery_id').'.png')) : ?>
				<?= $this->Html->image('wineries/logos/'.AuthComponent::user('winery_id').'.png', array('alt' => '', 'class' => 'img-responsive'));?>
			<?php else : ?>
				<?= $this->Html->image('wineries/logos/noimage.png', array('alt' => '', 'class' => 'img-responsive'));?>
			<?php endif; ?>
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name" id="profile-usertitle-name">
				<?= $winery['Winery']['name'];?>
			</div>
		</div>

		<!-- END SIDEBAR USER TITLE -->
		<!-- USER STATS -->
		<div class="row list-separated profile-stat">
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					<?= $countTours ?>
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Tours') ?>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					<?= $countReserves ?>
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Reserves') ?>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<div class="uppercase profile-stat-title">
					<?= $countReservesAttended ?>
				</div>
				<div class="uppercase profile-stat-text">
					<?= __('Attended Reserves') ?>
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
						<span class="caption-subject font-blue-madison bold uppercase"><?= __('Winery Profile') ?></span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#winery_info" data-toggle="tab"><?= __('Winery Info') ?></a>
						</li>
						<!-- <li>
							<a href="#change_avatar" data-toggle="tab"><?= __('Change Avatar') ?></a>
						</li>
						<li>
							<a href="#change_password" data-toggle="tab"><?= __('Change Password') ?></a>
						</li>
						<li>
							<a href="#user_settings" data-toggle="tab"><?= __('Account Settings') ?></a>
						</li> -->
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<!-- WINERY INFO TAB -->
						<div class="tab-pane active" id="winery_info">
							<?php echo $this->Form->create('Winery', array('url' => array('action' => 'edit'), 'id' => 'winery-profile-info-edit'));?>
								<?php
									//echo $this->Form->input('name', array("disabled" => "disabled"));
									echo $this->Form->input('description', array('disabled' => 'disabled', 'placeholder' => 'Ej: Fundada en 1897, Bodega Lagarde fue adquirida en el año 1969 por la familia Pescarmona, quien le imprimió un sello que marcaría su identidad de bodega familiar productora de vinos de alta gama, tanto en la Argentina como en el resto del mundo. Entre las décadas del ‘80 y del ‘90 Lagarde se dedicó a profundizar el estilo y la calidad de sus vinos. La innovación siempre fue un pilar fundamental, resultando en ser los primeros productores en plantar en Latinoamérica cepas no tradicionales como el Viognier ó el Moscato Bianco, con el objetivo de lograr vinos con un estilo propio de la bodega. Desde entonces se elaboran vinos con un toque artístico y creativo por parte de nuestro enólogo, Juan Roby, quien junto a los dueños hacen del proceso productivo un verdadero culto al vino.'));
									echo $this->Form->input('english_description', array('disabled' => 'disabled', 'placeholder' => 'Ej: Lagarde preserves its original winery that was built in 1897. It is a true reflection of what we wish to convey through our wines: a harmonious balance between past and future.'));
									echo $this->Form->input('portuguese_description', array('disabled' => 'disabled', 'placeholder' => 'Ej: Lagarde conserva sua bodega original construída em 1897. A mesma é um fiel reflexo da imagem que queremos transmitir através de nossos vinhos: o equilíbrio harmônico entre o passado e a inovação.'));
								?>

								<div class="margiv-top-10">
									<button id="winery-profile-info-edit-btn-edit" class="btn blue" type="button"><?= __('Edit') ?></button>
									<button id="winery-profile-info-edit-btn-cancel" class="btn" style="display:none;" type="button"><?= __('Cancel') ?></button>
									<button id="winery-profile-info-edit-btn-save" class="btn green-haze ladda-button disabled" data-style="zoom-out" style="display:none;" type="submit"><span class="ladda-label"><?= __('Save Changes') ?></span></button>
								</div>
							<?php echo $this->Form->end();?>
						</div>
						<!-- END WINERY INFO TAB -->

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
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('image-crop.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?php
		if(strtolower(substr(Configure::read('Config.language'), 0, 2)) == 'es'){
			echo $this->Html->script('/plugins/jquery-validation/js/localization/messages_es.js');
		}
	?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('users-view');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('wineries-view.js');?>
	<script>
		jQuery(document).ready(function() {
			WineryView.init();
		});
	</script>
<?php $this->end(); ?>
