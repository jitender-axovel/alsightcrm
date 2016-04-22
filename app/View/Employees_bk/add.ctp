<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
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
	<div class="form-group">
             <label>&nbsp;</label>
                 <?php
                        echo $this->Form->input('User.password', array(
					'label' => __d('users', 'Password'),
					'type' => 'password')); ?>
                 <?php
                        echo $this->Form->input('role', array(
					'value'=>'employee',
					'type' => 'hidden')); ?>
        </div>
		<?php		echo $this->Form->input('User.temppassword', array(
					'label' => __d('users', 'Password (confirm)'),
					'type' => 'password'));?>
                        </div>
                <?php
//				if (!empty($roles)) {
//					echo $this->Form->input('role', array(
//						'label' => __d('users', 'Role'), 'values' => $roles));
//				}
//				echo $this->Form->input('is_admin', array(
//						'label' => __d('users', 'Is Admin')));
//				echo $this->Form->input('active', array(
//					'label' => __d('users', 'Active')));
			?>
		</fieldset>
	<?php echo $this->Form->end('Submit'); ?>
</div>
<?php //echo $this->element('Users.Users/admin_sidebar'); ?>