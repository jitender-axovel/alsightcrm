<div class="companies view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('UserCompanyCode'); ?></dt>
		<dd>
			<?php echo h($employee['User']['user_company_code']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('CrmCompanyId'); ?></dt>
		<dd>
			<?php echo h($employee['User']['crm_company_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($employee['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($employee['User']['last_login']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($employee['User']['created']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
