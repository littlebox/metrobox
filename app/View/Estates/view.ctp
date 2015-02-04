<div class="estates view">
<h2><?php echo __('Estate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Image'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['id_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Type'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['id_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Operation'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['id_operation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street Number'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['street_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street Name'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['street_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Province'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['province']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surface Total'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['surface_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surface Covered'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['surface_covered']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rooms'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['rooms']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expenses'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['expenses']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Antiqueness'); ?></dt>
		<dd>
			<?php echo h($estate['Estate']['antiqueness']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Estate'), array('action' => 'edit', $estate['Estate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Estate'), array('action' => 'delete', $estate['Estate']['id']), array(), __('Are you sure you want to delete # %s?', $estate['Estate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estate Operations'), array('controller' => 'estate_operations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Operation'), array('controller' => 'estate_operations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estate Types'), array('controller' => 'estate_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'estate_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Estate Operations'); ?></h3>
	<?php if (!empty($estate['Operation'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $estate['Operation']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Operation'); ?></dt>
		<dd>
	<?php echo $estate['Operation']['operation']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Operation'), array('controller' => 'estate_operations', 'action' => 'edit', $estate['Operation']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Estate Types'); ?></h3>
	<?php if (!empty($estate['Type'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $estate['Type']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
	<?php echo $estate['Type']['type']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Type'), array('controller' => 'estate_types', 'action' => 'edit', $estate['Type']['id'])); ?></li>
			</ul>
		</div>
	</div>
	