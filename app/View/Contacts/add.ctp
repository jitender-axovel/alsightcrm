<div class="contacts form">
<?php echo $this->Form->create('Contact'); ?>
    <fieldset>
        <legend><?php echo __('Add Contact'); ?></legend>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Contact_Name',array('class'=>''));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Contact_Email'); ?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Detail',array('rows'=>1)); ?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>CRM Company</label>
            <?php echo $this->Form->select('crm_company_id',$crmCompanies,array('label'=>'CRM_Company','empty'=>'(Choose One)')); ?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>Company</label>
            <?php echo $this->Form->select('company_id',$companies,array('label'=>'Company','empty'=>'(Choose One)'));?>
        </div>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>