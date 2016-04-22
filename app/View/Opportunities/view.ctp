<div class="opportunities view">
<h2><?php echo __('Opportunity'); ?></h2>
	<dl>
		<dt><?php echo __('OpportunityId'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opportunity'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Opportunity_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Details'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Status_details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keywords'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Keywords']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CRM Company ID'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['crm_company_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Last_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($opportunity['Opportunity']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Opportunity'), array('action' => 'edit', $opportunity['Opportunity']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Opportunity'), array('action' => 'delete', $opportunity['Opportunity']['id']), array(), __('Are you sure you want to delete # %s?', $opportunity['Opportunity']['id'])); ?> </li>
                <li><?php //echo $color;?></li>
                <li><?php //echo $this->Html->link(__('List Opportunities'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Opportunity'), array('action' => 'add')); ?> </li>
	</ul>
        
</div>
-->