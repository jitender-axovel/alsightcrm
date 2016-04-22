<div class="users form">
    <?php echo $this->Form->create('Employee'); ?>
    <fieldset>
        <legend><?php echo __d('users', 'Edit User'); ?></legend>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Employee.username',array('required'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>&nbsp;</label>
            <?php echo $this->Form->checkbox('Employee.ChangePassword', array('hiddenField' => false,'class'=>'ChangePassword'));?>&nbsp;Click To Change Password
        </div>
        <div id="changepassword">
            <div class="form-group">
                <label>&nbsp;</label>
            <?php echo $this->Form->input('User.old_password',array('type'=>'password'));?>
            </div>  
            <div class="form-group">
                <label>&nbsp;</label>
            <?php echo $this->Form->input('User.new_password',array('type'=>'password'));?>
            </div>  
            <div class="form-group">
                <label>&nbsp;</label>
            <?php echo $this->Form->input('User.confirm_password',array('type'=>'password'));?>
            </div>  
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$id));?>
        </div>
    </fieldset>
    <?php echo $this->Form->end('Submit'); ?>
<script>
$(document).ready(function(){
    $('#changepassword').hide();
$('.ChangePassword').change(function(){
    if($(this).is(':checked')) {
        $('#changepassword').show();
    } else {
        $('#changepassword').hide();
    }
});
});
</script>
</div>
<?php //echo $this->element('Users.Users/admin_sidebar'); ?>