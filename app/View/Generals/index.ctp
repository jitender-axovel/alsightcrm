<?php echo $this->element('datatable'); ?>
<div class="generals index">
	<h2><?php echo __('Generals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>GeneralID</th>
			<th>My_company</th>
			<th>Email_extension</th>
			<th>Last_updated</th>
			<th>Updated_by</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($generals as $general): ?>
	<tr>
		<td><?php echo h($general['General']['GeneralID']); ?>&nbsp;</td>
		<td><?php echo h($general['General']['My_company']); ?>&nbsp;</td>
		<td><?php echo h($general['General']['Email_extension']); ?>&nbsp;</td>
		<td><?php echo h($general['General']['Last_updated']); ?>&nbsp;</td>
		<td><?php echo h($general['General']['Updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $general['General']['GeneralID'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $general['General']['GeneralID'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $general['General']['GeneralID']), array(), __('Are you sure you want to delete # %s?', $general['General']['GeneralID'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

	
<div class="add-company">
		<span><?php echo $this->Html->link(__('Add General'),array('action'=>'add')); ?></span>
</div>

