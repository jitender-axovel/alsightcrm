<?php echo $this->element('datatable'); ?>
<div class="companies index">
	<h2><?php echo __('Contacts'); ?></h2>
	<table class="display" id="example">
	<thead>
	<tr>
			<th>Number</th>
			<th>Contact_Name</th>
			<th>Contact_Email</th>
			<th>Detail</th>
			<th>CRM_Company_Name</th>
                        <!--<th>Company_Name</th>-->
			<th>Last_Update</th>
			<th>Updated_by</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $key=>$contact): ?>
	<tr>
		<td><?php echo h($key+1); ?>&nbsp;</td>
		<td><?php echo ucwords(h($contact['Contact']['Contact_Name'])); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['Contact_Email']); ?>&nbsp;</td>
		<td><?php echo ucwords(h($contact['Contact']['Detail'])); ?>&nbsp;</td>
		<td><?php echo ucwords(h($contact['CrmCompany']['Company_Name'])); ?>&nbsp;</td>
                <!--<td><?php //echo ucwords(h($contact['Company']['name'])); ?>&nbsp;</td>-->
		<td><?php echo h($contact['Contact']['Last_Update']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['Updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), array(), __('Are you sure you want to delete # %s?', $contact['Contact']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

<div class="add-company">
		<span><?php echo $this->Html->link(__('Add Contact'),array('action'=>'add')); ?></span>
</div>

