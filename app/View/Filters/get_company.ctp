

<div class="companies view">
<h2><?php echo __('CRM_Company'); ?></h2>
	<dl>
		<dt><?php echo __('CRM_CompanyID'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Domain'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Domain']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Group'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Company_Group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Last_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($company['CrmCompany']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
