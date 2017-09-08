<?php //echo debug($data);die(); ?>

<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-blue-hoki">
			<i class="icon-bar-chart font-blue-hoki"></i>
			<span class="caption-subject bold uppercase"> <?= $tour['Tour']['name']; ?></span>
			<span class="caption-helper"><?= __('Statistics') ?></span>
		</div>
		<div class="actions">
			<a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
		</div>

	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-5">
					<div class="btn-group">
						<?php //echo $this->Html->link('<i class="fa fa-plus"></i> '.__('Add New'), array('action' => 'add'), array('class' => 'btn green-haze', 'escape' => false)); ?>
					</div>
				</div>
				<div class="col-md-7">
					<div class="btn-group pull-right">
						<div class="col-md-5" style="padding-right: 0px;">
							<div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
								<input type="text" class="form-control form-filter input-sm" id="date_from_picker" name="date_from" placeholder="Desde: dd/mm/yyyy" value="<?= $dates['from']; ?>">
								<span class="input-group-btn">
									<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
						<div class="col-md-5" style="padding-right: 0px;">
							<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
								<input type="text" class="form-control form-filter input-sm" id="date_to_picker" name="date_to" placeholder="Hasta: dd/mm/yyyy" value="<?= $dates['to']; ?>">
								<span class="input-group-btn">
									<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
						<div class="col-md-2" style="padding-right: 0px;">
							<button onclick="filterByDate();" class="btn btn-sm green-haze table-group-action-submit"><i class="fa fa-search"></i> Mostrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="wineries_statistics_datatable">
			<thead>
				<th>Fecha Visita</th>
				<th>Fecha Reserva</th>
				<th>Cliente</th>
				<th>Adultos</th>
				<th>Precio Adultos</th>
				<th>Menores</th>
				<th>Precio Menores</th>
				<th>Web</th>
				<th>Iframe</th>
				<th>Total $</th>
			</thead>
			<tbody>
				<?php foreach ($data as $element): ?>
				<tr>
					<td><?= $element['tour_date']; ?></td>
					<td><?= $element['reserve_date']; ?></td>
					<td><?= $element['client_name']; ?></td>
					<td><?= $element['count_adults']; ?></td>
					<td><?= $element['price_adults']; ?></td>
					<td><?= $element['count_minors']; ?></td>
					<td><?= $element['price_minors']; ?></td>
					<td><?= $element['from_web']; ?></td>
					<td><?= $element['from_iframe']; ?></td>
					<td><?= $element['total']; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('statistics-datatable.js');?>
	<script>
		var LocalVar = {};
		LocalVar.langFile = '<?= substr(Configure::read('Config.language'), 0, 2) ?>';
		LocalVar.dataTable = '';
		LocalVar.ajaxSource = ('<?= $this->Html->url(array('controller'=>'wineries', 'action' => 'general_statistics', 'ext' => 'json', 'admin' => true)) ?>');
		LocalVar.wineryViewrUrl = ('<?= $this->Html->url(array('controller'=>'wineries', 'action' => 'view', 'admin' => true)) ?>');
		LocalVar.wineryViewText = ('<?= __("Details") ?>');

		jQuery(document).ready(function() {
			WineriesStatistics.init();
		});

		function filterByDate(){
			var url = '<?= $this->Html->url(array('controller'=>'tours', 'action' => 'statistics', 'admin' => true)) ?>';
			url += "/"+<?= $tour['Tour']['id']; ?>;
			url += "?from="+$('#date_from_picker').val()+"&to="+$('#date_to_picker').val();
			window.location.href = url;
		}


	</script>
<?php $this->end(); ?>
