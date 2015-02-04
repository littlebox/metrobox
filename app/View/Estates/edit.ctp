<div class="estates form">
<?php echo $this->Form->create('Estate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Estate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('id_image');
		echo $this->Form->input('id_type');
		echo $this->Form->input('id_operation');
		echo $this->Form->input('street_number');
		echo $this->Form->input('street_name');
		echo $this->Form->input('province');
		echo $this->Form->input('city');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
		echo $this->Form->input('surface_total');
		echo $this->Form->input('surface_covered');
		echo $this->Form->input('rooms');
		echo $this->Form->input('expenses');
		echo $this->Form->input('currency');
		echo $this->Form->input('description');
		echo $this->Form->input('antiqueness');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Estate.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Estate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Estates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Estate Operations'), array('controller' => 'estate_operations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Operation'), array('controller' => 'estate_operations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estate Types'), array('controller' => 'estate_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'estate_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
