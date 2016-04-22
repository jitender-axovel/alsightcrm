<div class="companies view">
<h2><?php echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('CompanyID'); ?></dt>
		<dd>
			<?php echo h($company['Company']['companyID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['Company_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Domain'); ?></dt>
		<dd>
			<?php echo h($company['Company']['Company_Domain']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Group'); ?></dt>
		<dd>
			<?php echo h($company['Company']['Company_Group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($company['Company']['Last_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($company['Company']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['companyID'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['companyID']), array(), __('Are you sure you want to delete # %s?', $company['Company']['companyID'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
	</ul>
</div>-->
