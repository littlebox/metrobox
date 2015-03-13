<!-- CALENDAR PORTLET-->
<div class="portlet box purple-plum calendar">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i>Reserves
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<!-- BEGIN DRAGGABLE EVENTS PORTLET-->
				<h3 class="event-form-title"><?= __('New Reserve') ?></h3>
				<div id="external-events">
					<form class="inline-form">
						<input type="text" value="" class="form-control" placeholder="Tour" id="event_title"/><br/>
						<input type="text" value="" class="form-control" placeholder="Fecha"/><br/>
						<input type="text" value="" class="form-control" placeholder="Hora"/><br/>
						<input type="text" value="" class="form-control" placeholder="Cantidad"/><br/>
						<input type="text" value="" class="form-control" placeholder="Nombre"/><br/>
						<input type="text" value="" class="form-control" placeholder="Mail"/><br/>
						<input type="text" value="" class="form-control" placeholder="Teléfono"/><br/>
						<input type="text" value="" class="form-control" placeholder="Edad"/><br/>
						<input type="text" value="" class="form-control" placeholder="Origen"/><br/>
						<a href="javascript:;" id="event_add" class="btn default">
						<?= __('Add') ?></a>
					</form>
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
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/moment.min');?>
	<?= $this->Html->script('/plugins/fullcalendar/fullcalendar.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('reserves-calendar');?>
	<script>
		jQuery(document).ready(function() {
			Calendar.init();
		});

	</script>
<?php $this->end(); ?>