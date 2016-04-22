

<div class="companies view">
<h2><?php echo __('Contact'); ?></h2>
	<dl>
		<dt><?php echo __('ContactID'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Name'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['Contact_Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Email'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['Contact_Email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Detail'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['Detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['Last_Update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($company['Contact']['Updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
