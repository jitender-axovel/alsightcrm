<div class="activities form">
<?php echo $this->Form->create('Activity',array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Activity'); ?></legend>
                
                <div class="form-group">
                    <label>Subject</label>
                    <?php echo $this->Form->input('Subject',array('rows'=>1,'label'=>FALSE));?>
                </div>
                <div class="form-group">
                    <label>Email Body</label>
                    <?php echo $this->Form->input('Email_Body',array('rows'=>2,'label'=>FALSE));?>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <?php echo $this->Form->input('Content',array('rows'=>2,'label'=>FALSE));?>
                </div>

                <div class="form-group">
                    <label>Opportunity</label>
                    <?php echo $this->Form->select('opportunity_id',$opportunities,array(
                        'label'=>FALSE,'empty'=>'(Choose One)'));?>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <?php echo $this->Form->select('contact_id',$contacts,array(
                        'label'=>FALSE,'empty'=>'(Choose One)'));?>
                </div>
                <div class="form-group">
                    <label>Notification Time</label>
                    <?php echo $this->Form->input('Notification_Time',array('label'=>FALSE));?>
                </div>
                <div class="form-group">
                    <label>Notification Detail</label>
                    <?php echo $this->Form->input('Notification_Detail',array('rows'=>2,'label'=>FALSE));?>
                </div>
                <div class="form-group">
                    <label>Notification Email</label>
                    <?php echo $this->Form->input('Notification_Email',array('rows'=>1,'label'=>FALSE));?>
                </div>
                <div class="form-group">
                    <label>Criteria</label>
                    <?php echo $this->Form->input('Criteria',array('rows'=>2,'label'=>FALSE));?>
                </div>
                <div class="form-group">
                    <label>File</label>
                    <?php //echo $this->Form->create('Media',array("type" => "file"));
                    echo $this->Form->file('File');
                    //echo $this->Form->submit(__('Upload',TRUE))?>
                </div>
        <?php /*echo $this->Form->input('Last_updated');*/?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?></li>
	</ul>
</div>-->
