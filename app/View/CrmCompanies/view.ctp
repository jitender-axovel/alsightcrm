<div class="companies view">
<h2><?php echo __('CRM_Company'); ?></h2>
    <fieldset>
        <!--<legend><?php echo __('Edit CRM Company'); ?></legend>-->
	<dl>
		<dt><?php echo __('CRM_CompanyID'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Domain'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Domain']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Group'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Last_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
    </fieldset>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['CrmCompany']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['CrmCompany']['id']), array(), __('Are you sure you want to delete # %s?', $company['CrmCompany']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
	</ul>
</div>-->
