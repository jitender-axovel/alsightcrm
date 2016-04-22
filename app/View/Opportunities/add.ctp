<div class="opportunities form">
<?php echo $this->Form->create('Opportunity'); ?>
    <fieldset>
        <legend><?php echo __('Add Opportunity'); ?></legend>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Opportunity_Name');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Detail',array('class'=>'col-md-2'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Status_details',array('class'=>'col-md-2'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Value');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Keywords',array('class'=>'col-md-2'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>CRM Company</label>
            <?php echo $this->Form->select('crm_company_id',$companies,array('label'=>'CRM_Company','empty'=>'(Choose One)'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>Contact</label>
            <?php echo $this->Form->select('contact_id',$contacts,array('label'=>'Contact','empty'=>'(Choose One)'));?>
        </div>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
