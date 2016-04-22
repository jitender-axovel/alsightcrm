<div class="companyEmailConfigs view">
<h2><?php echo __('Company Email Config'); ?></h2>
	<dl>
		<dt><?php echo __('CompemailconfigID'); ?></dt>
		<dd>
			<?php echo h($companyEmailConfig['CompanyEmailConfig']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('EmailID'); ?></dt>
		<dd>
			<?php echo h($companyEmailConfig['CompanyEmailConfig']['EmailID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($companyEmailConfig['CompanyEmailConfig']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Server'); ?></dt>
		<dd>
			<?php echo h($companyEmailConfig['CompanyEmailConfig']['server']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Company Email Config'), array('action' => 'edit', $companyEmailConfig['CompanyEmailConfig']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Company Email Config'), array('action' => 'delete', $companyEmailConfig['CompanyEmailConfig']['id']), array(), __('Are you sure you want to delete # %s?', $companyEmailConfig['CompanyEmailConfig']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('List Company Email Configs'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Company Email Config'), array('action' => 'add')); ?> </li>
	</ul>
</div>
-->