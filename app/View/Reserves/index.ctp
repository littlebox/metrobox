<!-- CALENDAR PORTLET-->
<div class="portlet box purple-plum calendar">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-book"></i>Reserves
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<!-- BEGIN DRAGGABLE EVENTS PORTLET-->
				<h3 class="form-section" style="margin-top:3px;"><?= __('New Reserve') ?></h3>
				<div id="external-events">
					<?php echo $this->Form->create('Reserve', array(
						'enctype' => 'multipart/form-data',
						'inputDefaults' => array(
							'format' => array('before','label','between','input','error','after'),
							'autocomplete' => 'off',
							'div' => array(
								'class' => 'form-group',
							),
							'label' => array(
								'class' => 'control-label'
							),
							'class' => 'form-control',
							'error' => array('attributes' => array(
								'class' => 'help-block',
								'wrap' => 'span',
								))
						),
						'class' => 'inline-form',
						'id' => 'reserve-add-form',
					)); ?>
						<?php
							echo $this->Form->input('tour_id', array('id' => 'tour-selector', 'empty' => __('Select a tour...')));
							echo $this->Form->input('language_id', array('id' => 'language-selector', 'empty' => __('Select a tour first')));
							echo $this->Form->input('date', array('type' => 'text', 'class' => 'date-picker form-control', 'placeholder' => '--/--/----'));
							echo $this->Form->input('time', array('id' => 'time-selector', 'type' => 'select', 'placeholder' => '--:--', 'empty' => __('Select a tour first')));
							echo $this->Form->input('Client.name');
							echo $this->Form->input('Client.age');
							echo $this->Form->input('quantity');
							echo $this->Form->input('Client.country');
							echo $this->Form->input('Client.email');
							echo $this->Form->input('Client.phone');
						?>
						<button type="button" id="event_add" class="btn default">
						<?= __('Add') ?></button>
					<?php echo $this->Form->end(); ?>
					<hr/>
					<div id="event_box">
					</div>
					<hr class="visible-xs"/>
				</div>
				<!-- END DRAGGABLE EVENTS PORTLET-->
			</div>
			<div class="col-md-9 col-sm-12">
				<div id="calendar" class="has-toolbar">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CALENDAR PORTLET-->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/fullcalendar/fullcalendar.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/moment.min');?>
	<?= $this->Html->script('/plugins/fullcalendar/fullcalendar.min');?>
	<?= $this->Html->script('/plugins/fullcalendar/lang/es');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('reserves');?>
	<script>
		var toursData = <?= json_encode($toursData) ?>;

		jQuery(document).ready(function() {
			reserves.init();
		});

	</script>
<?php $this->end(); ?>