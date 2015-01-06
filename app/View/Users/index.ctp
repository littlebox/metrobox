<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-blue-hoki">
			<i class="icon-share font-blue-hoki"></i>
			<span class="caption-subject bold uppercase"> <?= __('List') ?></span>
			<span class="caption-helper"><?= __('Users') ?></span>
		</div>
		<div class="actions">
			<a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
		</div>

	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green-haze">
						<?= __('Add New') ?> <i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="col-md-6">
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown"><?= __('Tools') ?> <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#">
								<?= __('Print') ?> </a>
							</li>
							<li>
								<a href="#">
								<?= __('Save as PDF') ?> </a>
							</li>
							<li>
								<a href="#">
								<?= __('Export to Excel') ?> </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="users_table">
			<thead>
				<th><?= __('Username') ?></th>
				<th><?= __('Email') ?></th>
				<th><?= __('Created') ?></th>
				<th><?= __('Actions') ?></th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-index-table');?>
	<script>
		jQuery(document).ready(function() {
			UsersIndexTable.init();
		});
	</script>
<?php $this->end(); ?>