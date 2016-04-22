<div class="generals view">
<h2><?php echo __('General'); ?></h2>
	<dl>
		<dt><?php echo __('GeneralID'); ?></dt>
		<dd>
			<?php echo h($general['General']['GeneralID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('My Company'); ?></dt>
		<dd>
			<?php echo h($general['General']['My_company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Extension'); ?></dt>
		<dd>
			<?php echo h($general['General']['Email_extension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($general['General']['Last_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($general['General']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit General'), array('action' => 'edit', $general['General']['GeneralID'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete General'), array('action' => 'delete', $general['General']['GeneralID']), array(), __('Are you sure you want to delete # %s?', $general['General']['GeneralID'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Generals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New General'), array('action' => 'add')); ?> </li>
	</ul>
</div>
