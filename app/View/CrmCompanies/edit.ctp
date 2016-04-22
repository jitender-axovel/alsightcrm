<div class="companies form">
<?php echo $this->Form->create('CrmCompany'); ?>
    <fieldset>
        <legend><?php echo __('Edit CRM Company'); ?></legend>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('CrmCompany.Company_Name');?>
        </div>  
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('CrmCompany.Company_Domain');?>
        </div> 
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('CrmCompany.Company_Group');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->checkbox('ChangePassword', array('hiddenField' => false,'class'=>'ChangePassword'));?>&nbsp;Click To Change Password
        </div>
        <?php $email=$_SESSION['Auth']['User']['email']; echo $this->Form->input('Updated_by',array('type'=>'hidden','value'=>$email));?>
<!--    </fieldset>-->
<?php //echo $this->Form->end(__('Submit')); ?>
    <label>&nbsp;</label>
<?php //echo $this->Form->create('Crm_Company',array('action'=>'change_password')); ?>
<!--    <fieldset>
        <legend><?php echo __('Change Password'); ?></legend>-->
        <?php echo $this->Form->input('id',array('type'=>'hidden'));?>
        <?php echo $this->Form->input('User.crm_company_id',array('type'=>'hidden'));?>
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
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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
