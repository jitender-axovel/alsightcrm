<?php echo $this->element('datatable'); ?>

<div class="flexdirection">
  
</div>
<br />
<div class="companies index">
    <h2><?php echo __('Employees'); ?></h2>

    <table class="display" id="example">
        <thead>
            <tr role="row">
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Last Login</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $company): ?>
                <tr>
                    <td><?php echo h($company['User']['user_company_code']); ?>&nbsp;</td>
                    <td><?php echo h($company['User']['username']); ?>&nbsp;</td>
                    <td><?php echo h($company['User']['email']); ?>&nbsp;</td>
                    <td><?php echo h($company['User']['last_login']); ?>&nbsp;</td>
                    <td><?php echo h($company['User']['active']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php //echo $this->Html->link(__('View'), array('action' => 'view', $company['User']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $company['User']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $company['User']['id']), array(), __('Are you sure you want to delete # %s?', $company['User']['id'])); ?>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>	



<div class="add-company">
    <span><?php if($this->Session->read('Auth.User.role')=="company") { echo $this->Html->link(__('Add Employee'), array('action' => 'add')); } ?></span>
</div>