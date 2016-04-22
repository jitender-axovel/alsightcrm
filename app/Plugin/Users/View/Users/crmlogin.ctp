<div class="container center"><!--removed ch-container added container-->
    <div class="row center">
        <div class="row center">
            <div class="well col-md-12 center login-box">
                <div class="center login-header">
                    <h2>Welcome to CRM </h2>
                </div>
                <div class="alert alert-info">
                    <?php echo $this->Session->flash(); ?>
                    Please login with your Email and Password.
                    <?php //echo $this->Session->flash('auth');?>
                </div>
                <?php echo $this->Form->create($model, array('action' => '','id' => 'LoginForm'));?>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user gray"></i></span>
                        <!--<input type="text" class="form-control" placeholder="Username">-->
                        <?php echo $this->Form->input('email', array(
				'label' =>false,'class'=>"form-control",'placeholder'=>"Username","div"=>false));?>
                    </div>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock gray"></i></span>
                       <?php echo $this->Form->input('password',  array(
				'label' =>false,'class'=>"form-control",'placeholder'=>"Password","div"=>false));?>
                    </div>

<!--                    <div class="input-prepend">
                            <label class="remember" for="remember">
                                <input type="checkbox" id="remember" name="data['User']['remember_me']"> Remember me
                            </label>
                        </div>-->
                    <p class="center col-md-6 forgotmessage"><?php  echo $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password'));?></p>
                    <?php echo $this->Form->hidden('User.return_to', array('value' => $return_to)); ?>
                    <p class="center col-md-0">
                        <?php 
                            $options = array('label' => 'Login', 'class' => 'btn btn-success');
                            echo $this->Form->end($options); ?>
                        <!--<button type="submit" class="btn btn-primary">Login</button>-->
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->
