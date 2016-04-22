<div class="activities view">
<h2><?php echo __('Activity'); ?></h2>
	<dl>
		<dt><?php echo __('ActivityID'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Body'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Email_Body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opportunity_ID'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['opportunity_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact_ID'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['contact_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification Time'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Notification_Time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification Detail'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Notification_Detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification Email'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Notification_Email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criteria'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Criteria']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['File']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Last_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['Updated_By']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Activity'), array('action' => 'edit', $activity['Activity']['ActivityID'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Activity'), array('action' => 'delete', $activity['Activity']['ActivityID']), array(), __('Are you sure you want to delete # %s?', $activity['Activity']['ActivityID'])); ?> </li>
		<li><?php //echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Activity'), array('action' => 'add')); ?> </li>
	</ul>
</div>-->
