<div class="activities form">
<?php echo $this->Form->create('Activity'); ?>
    <fieldset>
        <legend><?php echo __('Edit Activity'); ?></legend>

        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Subject',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Email_Body',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Content',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('opportunity_id',$opportunities,array('label'=>'Opportunity','empty'=>'(Choose One)'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('contact_id',$contacts,array('label'=>'Contact','empty'=>'(Choose One)'));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Notification_Time');?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Notification_Detail',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Notification_Email',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('Criteria',array('rows'=>1));?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <label>File</label>
            <?php echo $this->Form->file('File'); ?>
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <?php echo $this->Form->input('id');?>
        </div>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>