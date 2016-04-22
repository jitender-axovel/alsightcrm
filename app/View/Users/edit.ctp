<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('company_id');
		echo $this->Form->input('username');
		echo $this->Form->input('slug');
		echo $this->Form->input('password');
		echo $this->Form->input('password_token');
		echo $this->Form->input('email');
		echo $this->Form->input('email_verified');
		echo $this->Form->input('email_token');
		echo $this->Form->input('email_token_expires');
		echo $this->Form->input('tos');
		echo $this->Form->input('active');
		echo $this->Form->input('last_login');
		echo $this->Form->input('last_action');
		echo $this->Form->input('is_admin');
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
