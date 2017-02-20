<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Winerie')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Winery', array(
			'enctype' => 'multipart/form-data',
			'inputDefaults' => array(
				'format' => array('before','label','between','input','error','after'),
				'autocomplete' => 'off',
				'div' => array(
					'class' => 'form-group',
				),
				'label' => array(
					'class' => 'control-label col-md-3'
				),
				'class' => 'form-control',
				'between' => '<div class="col-md-9">',
				'after' => '</div>',
				'error' => array('attributes' => array(
					'class' => 'help-block',
					'wrap' => 'span',
					))
			),
			'class' => 'form-horizontal form-bordered form-row-stripped',
			'id' => 'winery-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name');
					echo $this->Form->input('email');
				?>
				<div id="gmap_geocoding_all">
					<div class="form-group" id="gmap_geocoding_form">
						<label class="control-label col-md-3"><?= __('Address') ?></label>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-4">
										<input type="text" class="form-control" id="gmap_geocoding_city" name="data[Winery][city]" placeholder="<?= __('City') ?>" value="<?= $this->request->data['Winery']['city'] ?>">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" id="gmap_geocoding_address" name="data[Winery][address]" placeholder="<?= __('Address') ?>" value="<?= $this->request->data['Winery']['address'] ?>">
								</div>
								<div class="col-md-2">
										<button class="btn blue" id="gmap_geocoding_btn" style="width: 100%;"><i class="fa fa-search"></i> <?= __('Search') ?> </button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" id="gmap_geocoding_coordenates">
						<label class="control-label col-md-3"><?= __('Coordenates') ?></label>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-5">
									<input type="text" class="form-control" name="data[Winery][latitude]" placeholder="<?= __('Latitude') ?>" value="<?= $this->request->data['Winery']['latitude'] ?>" id="WineryLatitude"/>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="data[Winery][longitude]" placeholder="<?= __('Longitude') ?>" value="<?= $this->request->data['Winery']['longitude'] ?>" id="WineryLongitude"/>
								</div>

								<div class="col-md-2">
										<button class="btn red-sunglo" id="gmap_localize_coordenates_btn" style="width: 100%;"><i class="fa fa-map-marker"></i> <?= __('Localize') ?> </button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3"><?= __('Map') ?></label>
					<div class="col-md-9">
						<div id="gmap_geocoding" class="gmaps"></div>
						<span id="marker-help-text" style="display:none;" class="help-block"><?= __('You can change the location dragging the marker!') ?></span>
					</div>
				</div>

			</div>

			<?php
				// echo $this->Form->input('description', array('placeholder' => 'Ej: Fundada en 1897, Bodega Lagarde fue adquirida en el año 1969 por la familia Pescarmona, quien le imprimió un sello que marcaría su identidad de bodega familiar productora de vinos de alta gama, tanto en la Argentina como en el resto del mundo. Entre las décadas del ‘80 y del ‘90 Lagarde se dedicó a profundizar el estilo y la calidad de sus vinos. La innovación siempre fue un pilar fundamental, resultando en ser los primeros productores en plantar en Latinoamérica cepas no tradicionales como el Viognier ó el Moscato Bianco, con el objetivo de lograr vinos con un estilo propio de la bodega. Desde entonces se elaboran vinos con un toque artístico y creativo por parte de nuestro enólogo, Juan Roby, quien junto a los dueños hacen del proceso productivo un verdadero culto al vino.'));
				// echo $this->Form->input('english_description', array('placeholder' => 'Ej: Lagarde preserves its original winery that was built in 1897. It is a true reflection of what we wish to convey through our wines: a harmonious balance between past and future.'));
				// echo $this->Form->input('portuguese_description', array('placeholder' => 'Ej: Lagarde conserva sua bodega original construída em 1897. A mesma é um fiel reflexo da imagem que queremos transmitir através de nossos vinhos: o equilíbrio harmônico entre o passado e a inovação.'));
				echo $this->Form->input('priority');
				echo $this->Form->input('visible');
			?>

			<div class="form-group last">
				<label class="control-label col-md-3"><?= __('Logo');?></label>
				<div class="col-md-9">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="width:310px; height:160px; background-color:#9F4B55;">
							<?php if(file_exists(WWW_ROOT.'img'.DS.'wineries'.DS.'logos'.DS.$this->request->data['Winery']['id'].'.png')) : ?>
								<?= $this->Html->image('wineries/logos/'.$this->request->data['Winery']['id'].'.png', array('alt' => ''));?>
							<?php else : ?>
								<?= $this->Html->image('wineries/logos/noimage.png', array('alt' => ''));?>
							<?php endif; ?>
						</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="width:310px; height:160px; background-color:#9F4B55;">
						</div>
						<div>
							<span class="btn default btn-file">
								<span class="fileinput-new"><?= __('Select image');?></span>
								<span class="fileinput-exists"><?= __('Change');?></span>
								<?php echo $this->Form->file('logo', array(
									'id' => 'upload-logo',
									'required' => false)
								);?>
							</span>
							<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"><?= __('Remove');?></a>
						</div>
					</div>
					<span class="help-block"><?= __('The image has to be 300x150 px. PNG Only.') ?></span>

					<?php if ($this->Form->isFieldError('logo')) {
						echo $this->Form->error('logo');
					}?>

				</div>
			</div>

			<div class="form-group" id="gmap_geocoding_form">
				<label class="control-label col-md-3"><?= __('Add Photos') ?></label>
				<div class="col-md-9">
					<div class="dropzone" id="imagesDropzone"></div>
					<div id="hiddenImagesInputs"></div>
				</div>
			</div>

			<div class="form-actions right">
				<?php
					// echo $this->Form->Button(__('Cancel'),array(
					// 	'div' => false,
					// 	'class' => 'btn default',
					// 	'type' => 'button'
					// ));
					echo $this->Form->Button(__('Save'),array(
						'div' => false,
						'class' => 'btn green',
						'type' => 'submit'
					));

				?>
			</div>
		<?= $this->Form->end(); ?>
		<!-- END FORM-->
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');?>
	<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput');?>
	<?= $this->Html->css('/plugins/dropzone/dropzone');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?php
		if(strtolower(substr(Configure::read('Config.language'), 0, 2)) == 'es'){
			echo $this->Html->script('/plugins/jquery-validation/js/localization/messages_es.js');
		}
	?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('http://maps.google.com/maps/api/js?key=AIzaSyDEDXVukpE4oEEhjfWmhaZctW3SobbJYV4&sensor=false&libraries=places'); //Para los mapas de google ?>
	<?= $this->Html->script('/plugins/gmaps/gmaps'); //Para los mapas de google ?>
	<?= $this->Html->script('/plugins/dropzone/dropzone'); //Dropzone para las imagesnes ?>
	<style>
		#dropzone { margin-bottom: 3rem; }
		.dropzone { border: 2px dashed #9f4b55; border-radius: 5px; background: white; }
		.dropzone .dz-message { font-weight: 400; color: #8877a9; font-size: 1.5em;}
		.dropzone .dz-message .dz-note { font-size: 0.8em; font-weight: 200; display: block; margin-top: 1.4rem; }
	</style>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('wineries-admin-add-edit.js?20172002');?>
	<script>
		initialLatitude = $('#WineryLatitude').val();
		initialLongitude = $('#WineryLongitude').val();

		//drop zone variables
		imageCounter = 0;
		imagesIdArray = []; //This array will contain all IDs of images to asociate with the estate
		Dropzone.autoDiscover = false; //Prevent auto init dropzone
		wineryAddImageUrl = '<?= $this->Html->Url(array("action" => "add_image"));?>';
		existingImages = <?= $images;?>;

		jQuery(document).ready(function() {
			WineryAdminAddEdit.init();
		});
	</script>
<?php $this->end(); ?>
