<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box grey-cascade">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Managed Table
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green">
						Add New <i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="col-md-6">
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#">
								Print </a>
							</li>
							<li>
								<a href="#">
								Save as PDF </a>
							</li>
							<li>
								<a href="#">
								Export to Excel </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="users_table">
			<thead>
				<th>Username</th>
				<th>Email</th>
				<th>Created</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

<?= $this->Html->css('/plugins/select2/select2', array('inline'=>false));?>
<?= $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap', array('inline'=>false));?>

<?= $this->Html->script('/plugins/select2/select2.min', array('block' => 'pagePlugins'));?>
<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min', array('block' => 'pagePlugins'));?>
<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap', array('block' => 'pagePlugins'));?>

<?= $this->Html->script('table-managed.js', array('inline'=>false));?>

<?php
$initScripts =
<<<JS
jQuery(document).ready(function() {
	TableManaged.init();
});
JS;
?>

<?= $this->Html->scriptBlock($initScripts, array('inline'=>false));?>