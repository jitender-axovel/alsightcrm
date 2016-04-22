<div class="users form">
	<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __d('users', 'Add Employee'); ?></legend>
        <div class="form-group">
            <label>&nbsp;</label>
			<?php
				echo $this->Form->input('User.username', array(
					'label' => __d('users', 'Employee Name')));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
			<?php	echo $this->Form->input('User.email', array(
					'label' => __d('users', 'E-mail'),
					'error' => array('isValid' => __d('users', 'Must be a valid email address'),
						'isUnique' => __d('users', 'An account with that email already exists'))));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
                 <?php
                        echo $this->Form->input('User.password', array(
					'label' => __d('users', 'Password'),
					'type' => 'password')); ?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
		<?php		echo $this->Form->input('User.temppassword', array(
					'label' => __d('users', 'Password (confirm)'),
					'type' => 'password'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
                 <?php
                        echo $this->Form->input('role', array(
					'value'=>'employee',
					'type' => 'hidden')); ?>
        </div>
</fieldset>
	<?php echo $this->Form->end('Submit'); ?>
</div>
<?php //echo $this->element('Users.Users/admin_sidebar'); ?>