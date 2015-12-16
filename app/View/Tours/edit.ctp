<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-pencil font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Tour')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Tour', array(
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
			'id' => 'tour-add-edit-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name', array('placeholder' => 'Ej: Descubriendo Varietales'));
					echo $this->Form->input('length', array('type' => 'text', 'class' => 'timepicker timepicker-length form-control', 'placeholder' => '--:--'));
					echo $this->Form->input('quota', array('placeholder' => '25'));
					echo $this->Form->input('price', array('placeholder' => '150'));
					echo $this->Form->input('minors_price', array('placeholder' => '0'));
					echo $this->Form->input('Language', array('multiple' => 'checkbox', 'class' => ''));
					echo $this->Form->input('Day', array('label' => array('class' => 'control-label col-md-3', 'text' => __('Days')), 'multiple' => 'checkbox', 'class' => ''));
				?>
					<div class="form-group">
						<label for="TimeTime" class="control-label col-md-3"><?= __('Times') ?></label>
						<div class="col-md-9">
							<div id="all-timepickers-div">
								<div class="timepicker-div" style="display:none;">
									<div class="col-md-10" style="padding:0px;">
										<input name="data[Time][Time][]" autocomplete="off" class="timepicker timepicker-time form-control" placeholder="--:--" style="margin-bottom:10px;" type="text" id="TimeTime">
									</div>
									<div class="col-md-2">
										<button type="button" class="btn red remove-time-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
									</div>
								</div>
								<?php foreach($this->request->data['Time'] as $time):?>
									<div class="timepicker-div">
										<div class="col-md-10" style="padding:0px;">
											<input name="data[Time][Time][]" autocomplete="off" class="timepicker timepicker-time form-control" placeholder="--:--" style="margin-bottom:10px;" type="text" id="TimeTime" value="<?= $time['hour'];?>">
										</div>
										<div class="col-md-2">
											<button type="button" class="btn red remove-time-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
										</div>
									</div>
								<?php endforeach;?>
							</div>
							<div class="col-md-12" style="padding:0px;">
								<button type="button" class="btn green" id="add-time-button"><?= __('Add Time') ?> <i class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="TourColor" class="control-label col-md-3">Color</label>
						<div class="col-md-9">
							<div id="tour-colorpicker" class="input-group color" data-color-format="rgba">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i style="background-color: <?= $this->request->data['Tour']['color'];?>;"></i>&nbsp;</button>
								</span>
								<input name="data[Tour][color]" type="text" class="form-control" value="<?= $this->request->data['Tour']['color'];?>" readonly="">
							</div>
						</div>
					</div>
				<?php
					echo $this->Form->input('description', array('placeholder' => 'Ej: Viví una experiencia inolvidable en tu visita por la bodega. Los visitantes degustarán vino desde un tanque de fermentación y desde una barrica de roble llegando hasta nuestra cava tradicional, donde serán protagonistas al elegir y descorchar su propia botella de vino en estiba.'));
					echo $this->Form->input('english_description', array('placeholder' => 'Ej: Live an unforgettable experience in your visit to the winery. Visitors will taste wine from a fermentation tank and from an oak barrel reaching our traditional cava, which will be protagonists to choose and uncorked his own bottle of wine in bottle.'));
					echo $this->Form->input('portuguese_description', array('placeholder' => 'Ej: Uma experiência inesquecível durante a sua visita à vinícola. Os visitantes poderão provar o vinho a partir de um tanque de fermentação e de um barril de carvalho alcançar o nosso cava tradicional, que serão protagonistas para escolher e desarrolhou sua própria garrafa de vinho em garrafa.'));
				?>
				<div class="form-group">
					<label for="Disabled Days" class="control-label col-md-3"><?= __('Disabled Days') ?></label>
					<div class="col-md-9">
						<div id="all-datepickers-div">
							<div class="datepicker-div" style="display:none;">
								<div class="col-md-10" style="padding:0px;">
									<input name="data[DisableDaysToFormat][]" autocomplete="off" class="date-picker form-control" placeholder="--/--/----" style="margin-bottom:10px;" type="text">
								</div>
								<div class="col-md-2">
									<button type="button" class="btn red remove-day-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
								</div>
							</div>
							<?php foreach($this->request->data['DisabledDay'] as $disabled_day):?>
								<div class="datepicker-div">
									<div class="col-md-10" style="padding:0px;">
										<input name="data[DisableDaysToFormat][]" autocomplete="off" class="date-picker form-control" placeholder="--/--/----" style="margin-bottom:10px;" type="text" value="<?= date_format(date_create_from_format('Y-m-d', $disabled_day['day']), 'd/m/Y');?>">
									</div>
									<div class="col-md-2">
										<button type="button" class="btn red remove-day-button" tabindex="-1"><?= __('Remove') ?> <i class="fa fa-trash-o"></i></button>
									</div>
								</div>
							<?php endforeach;?>
						</div>
						<div class="col-md-12" style="padding:0px;">
							<button type="button" class="btn green" id="add-day-button"><?= __('Add Disabled Day') ?> <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
				<?php
					echo $this->Form->input('visible');
				?>

			</div>

			<div class="form-actions right">
				<?php
					echo $this->Form->Button(__('Cancel'),array(
						'div' => false,
						'class' => 'btn default',
						'type' => 'button'
					));
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
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/colorpicker/colorPicker.min');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>
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
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>
	<?= $this->Html->script('/plugins/colorpicker/colorPicker.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('tours-add-edit.js');?>
	<script>
		jQuery(document).ready(function() {
			TourAddEdit.init();
		});
	</script>
<?php $this->end(); ?>