<div class="generals form">
<?php echo $this->Form->create('General'); ?>
	<fieldset>
		<legend><?php echo __('Add General'); ?></legend>
	<?php
		echo $this->Form->input('My_company');
		echo $this->Form->input('Email_extension');
		//echo $this->Form->input('Last_updated');
		echo $this->Form->input('Updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Html->link(__('List Generals'), array('action' => 'index')); ?></li>
	</ul>
</div>-->
