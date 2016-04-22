<div class="companies form">
<?php echo $this->Form->create('CRM_Company'); ?>
    <fieldset>
        <legend><?php echo __('Add CRM Company'); ?></legend>
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
            <?php echo $this->Form->input('User.user_name');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('User.email');?>
        </div>  
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('User.password',array('type'=>'password'));?>
        </div>  
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('User.confirm_password',array('type'=>'password'));?>
        </div>  

        <div class="form-group">
            <label>&nbsp;</label>
            <?php $email=$_SESSION['Auth']['User']['email']; echo $this->Form->input('CrmCompany.Updated_by',array('type'=>'hidden','value'=>$email));?>
        </div>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>