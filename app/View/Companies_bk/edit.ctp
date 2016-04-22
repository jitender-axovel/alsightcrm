<div class="companies form">
<?php echo $this->Form->create('Company'); ?>
	<fieldset>
		<legend><?php echo __('Edit Company'); ?></legend>
	<?php
		echo $this->Form->input('companyID'); ?>
		 <div class="form-group">
             <label>&nbsp;</label>
    <?php echo $this->Form->input('Company_Name');?>
     </div>  
        <div class="form-group">
             <label>&nbsp;</label>
    <?php echo $this->Form->input('Company_Domain');?>
     </div> 
                 <div class="form-group">
             <label>&nbsp;</label>
    <?php echo $this->Form->input('Company_Group');?>
     </div> 
<!--                 <div class="form-group">
             <label>&nbsp;</label>
    <?php echo $this->Form->input('Last_updated');?>
     </div> 
                 <div class="form-group">
             <label>&nbsp;</label>
    </div> 
                -->
                  <?php $email=$_SESSION['Auth']['User']['email']; echo $this->Form->input('Updated_by',array('type'=>'hidden','value'=>$email));?>
   
		<?php //pr($_SESSION['Auth']['User']['email']); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Company.companyID')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Company.companyID'))); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?></li>
	</ul>
</div>-->
