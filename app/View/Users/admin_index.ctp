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
						<?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Add New'), array('action' => 'add'), array('class' => 'btn green-haze', 'escape' => false)); ?>
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
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-index-table');?>
	<script>
		var LocalVar = {};
		LocalVar.dataTable = '';
		LocalVar.deleting = false;
		LocalVar.ajaxSource = ('<?= $this->Html->url(array('controller'=>'users', 'action' => 'index', 'ext' => 'json', 'admin' => true)) ?>');
		LocalVar.userEditUrl = ('<?= $this->Html->url(array('controller'=>'users', 'action' => 'edit', 'admin' => true)) ?>');
		LocalVar.userDeleterUrl = ('<?= $this->Html->url(array('controller'=>'users', 'action' => 'delete', 'admin' => true)) ?>');
		LocalVar.userViewrUrl = ('<?= $this->Html->url(array('controller'=>'users', 'action' => 'view')) ?>');
		LocalVar.userEditText = ('<?= __("Edit") ?>');
		LocalVar.userDeleteText = ('<?= __("Delete") ?>');
		LocalVar.userViewText = ('<?= __("Details") ?>');

		jQuery(document).ready(function() {
			UsersIndexTable.init();
		});

		function confirmAlert(url){
			swal(
				{
					title: "<?= __('Are you sure?') ?>",
					text: "<?= __('You will not be able to recover this imaginary file!') ?>",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "<?= __('Yes, delete it!') ?>",
					closeOnConfirm: false
				},
				function(){
					if(!LocalVar.deleting){
						LocalVar.deleting = true;
						$.ajax({
							type: 'post',
							cache: false,
							url: url+'.json',
							beforeSend: function(xhr) {
								xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
								xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
							},
							success: function(response) {
								if (response.content) {
									swal({
										title: "<?= __('Deleted!') ?>",
										text: response.content,
										type: "success",
									},
									function(){
										LocalVar.dataTable.fnDraw();
									})
								}
								if (response.error) {
									swal("<?= __('Error') ?>", response.error, "error");
								}
							},
							error: function(e) {
								swal("<?= __('Error') ?>", "<?= __('User hasn\'t been deleted.') ?>", "error");
							},
							complete: function() {
								LocalVar.deleting = false;
							}
						});
					}



				});
		}

	</script>
<?php $this->end(); ?>