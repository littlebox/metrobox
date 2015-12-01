<?php //echo debug($wineries);die(); ?>

<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-blue-hoki">
			<i class="icon-share font-blue-hoki"></i>
			<span class="caption-subject bold uppercase"> <?= __('Statistics') ?></span>
			<span class="caption-helper"><?= __('Wineries') ?></span>
		</div>
		<div class="actions">
			<div class="btn-group">
				<a class="btn btn-default btn-circle" href="#" data-toggle="dropdown">
					<i class="fa fa-share"></i>
					<span class="hidden-480">
					<?= __('Export') ?> </span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="#">
						<?= __('Export to Excel') ?> </a>
					</li>
					<li>
						<a href="#">
						<?= __('Export to CSV') ?> </a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-container">
			<div class="table-actions-wrapper">
				<span>
				</span>
				<select class="table-group-action-input form-control input-inline input-small input-sm">
					<option value=""><?= __('Select...') ?></option>
					<option value="enero">Enero</option>
					<option value="febrero">Febrero</option>
					<option value="marzo">Marzo</option>
					<option value="Abril">Abril</option>
				</select>
				<button class="btn btn-sm green-haze table-group-action-submit"><i class="fa fa-search"></i> Buscar</button>
			</div>
			<table class="table table-striped table-bordered table-hover" id="wineries_statistics_datatable_ajax">
			<thead>
			<tr role="row" class="heading">
				<th width="15%">
					Bodega
				</th>
				<th width="10%">
					Reservas Totales
				</th>
				<th width="10%">
					Reservas Web
				</th>
				<th width="10%">
					Personas
				</th>
				<th width="10%">
					Personas Web
				</th>
				<th width="10%">
					% Web
				</th>
				<th width="10%">
					Total %
				</th>
				<th width="10%">
					Total a Cobrar
				</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('wineries-statistics.js');?>
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


	</script>
<?php $this->end(); ?>