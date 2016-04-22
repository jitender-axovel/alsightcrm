<div class="companyEmailConfigs form">
<?php echo $this->Form->create('CompanyEmailConfig'); ?>
    <fieldset>
        <legend><?php echo __('Add Company Email Config'); ?></legend>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('EmailID');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('password');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('server',array('rows'=>1));?>
        </div>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>