<div class="companies index">
	<h2><?php echo __('Employees'); ?></h2>
	<span style="float: right;"><?php echo $this->Html->link(__('Add Employee'),array('action'=>'add')); ?></span>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
	<thead>
	<tr role="row">
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Employee Name'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Email'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Last Login'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo $this->Paginator->sort('Active'); ?></th>
			<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 00px;" aria-sort="ascending" aria-label="Username: activate to sort column descending"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($users as $company):?>
	<tr>
		<td><?php echo h($company['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($company['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($company['User']['last_login']); ?>&nbsp;</td>
		<td><?php echo h($company['User']['active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $company['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $company['User']['id']), array(), __('Are you sure you want to delete # %s?', $company['User']['id'])); ?>
		</td>
	</tr>
	</tbody>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
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
		<li><?php //echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
