<div class="companies index">
	<h2><?php echo __('Companies'); ?></h2>
        <span style="float: right;"><?php echo $this->Html->link(__('Add Company'),array('action'=>'add')); ?></span>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
	<thead>
	<tr role="row">
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('companyID'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Company_Name'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Company_Domain'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Company_Group'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Last_updated'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Updated_by'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($companies as $company):?>
	<tr>
		<td><?php echo h($company['Company']['companyID']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['Company_Name']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['Company_Domain']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['Company_Group']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['Last_updated']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['Updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $company['Company']['companyID'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $company['Company']['companyID'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $company['Company']['companyID']), array(), __('Are you sure you want to delete # %s?', $company['Company']['companyID'])); ?>
		</td>
	</tr>
	</tbody>
<?php endforeach; ?>
	</table>
	<span>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</span>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Company'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
