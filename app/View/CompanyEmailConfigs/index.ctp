<?php echo $this->element('datatable'); ?>
<div class="companies index">
	<h2><?php echo __('Company Email Configs'); ?></h2>
        
	<table class="display" id="example">
	<thead>
        <tr role="row">
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Number'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('EmailID'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('password'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('server'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($companyEmailConfigs as $key=>$companyEmailConfig): ?>
	<tr>
		<td><?php echo h($key+1); ?>&nbsp;</td>
		<td><?php echo h($companyEmailConfig['CompanyEmailConfig']['EmailID']); ?>&nbsp;</td>
		<td><?php echo h($companyEmailConfig['CompanyEmailConfig']['password']); ?>&nbsp;</td>
		<td><?php echo h($companyEmailConfig['CompanyEmailConfig']['server']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $companyEmailConfig['CompanyEmailConfig']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $companyEmailConfig['CompanyEmailConfig']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $companyEmailConfig['CompanyEmailConfig']['id']), array(), __('Are you sure you want to delete # %s?', $companyEmailConfig['CompanyEmailConfig']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
</div>
<div class="add-company">
		<span><?php echo $this->Html->link(__('Add Account'),array('action'=>'add')); ?></span>
</div>

<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Company Email Config'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
