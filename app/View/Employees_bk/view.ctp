<div class="companies view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($employee['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($employee['User']['last_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($employee['User']['active']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
