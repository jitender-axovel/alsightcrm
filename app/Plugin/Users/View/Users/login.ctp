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
<html>
    <head>

    </head>
    <!--<div class="users index">
            
        <h2><?php /*echo __d('users', 'Login'); ?></h2>
	<?php echo $this->Session->flash('auth');?>
	<fieldset>
		<?php
			echo $this->Form->create($model, array(
				'action' => 'login',
				'id' => 'LoginForm'));
			echo $this->Form->input('email', array(
				'label' => __d('users', 'Email')));
			echo $this->Form->input('password',  array(
				'label' => __d('users', 'Password')));
			echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' =>  __d('users', 'Remember Me'))) . '</p>';
			echo '<p>' . $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password')) . '</p>';
			echo $this->Form->hidden('User.return_to', array(
				'value' => $return_to));
			echo $this->Form->end(__d('users', 'Submit'));*/
		?>
            </fieldset>
    </div>-->
    <body style="padding-bottom: 26px;">
        <div id="sidebar" align='right'>
            <label>Don't have an <strong>account! </strong></label>
        <?php echo $this->Html->link(__d('users', 'Register'), array('class'=>'form-control','plugin' => 'users', 'controller' => 'users', 'action' => 'add')); ?>
            <label>with us.</label>
        </div>
        <div id="main">
            <div id="content">
                <div class="container">
                    <div class="page-header">
                        <h1>Login</h1>
                    </div>

                    <?php echo $this->Form->create($model, array('action' => 'login','id' => 'LoginForm'));?>
                        <div class="form-group">
                            <label for="email">Email:</label>	            
                            <?php echo $this->Form->input('email',array('class' => 'form-control','label' =>false));?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>	           
                            <?php echo $this->Form->input('password',array('class'=>'form-control','label' =>false));?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('remember_me', array('class'=>'form-group-sm','type' => 'checkbox', 'label' =>  __d('users', 'Remember Me')));?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Html->link(__d('users', 'I forgot my password'), array('class'=>'btn btn-default','action' => 'reset_password')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->end(__d('users', 'Submit'),array('class'=>'form-control btn btn-primary'));?>
                        </div>
                    <?php //echo $this->element('Users.Users/sidebar'); ?>
                </div>
            </div>
        </div>
    </body>
</html>