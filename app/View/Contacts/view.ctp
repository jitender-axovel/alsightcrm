<div class="contacts view">
<h2><?php echo __('Contact'); ?></h2>
	<dl>
		<dt><?php echo __('ContactID'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Name'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['Contact_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Email'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['Contact_Email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['Detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company_ID'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['company_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['Last_Update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>