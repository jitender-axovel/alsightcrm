<?php echo $this->element('datatable'); ?>
<div class="opportunities index">
        <h2><?php echo __('OPPORTUNITIES'); ?></h2>
	<table id="example" class="display">
	<thead>
	<tr>
			<th>Number</th>
			<th>CRM_Company</th>
                        <th>Opportunity</th>
			<th>Amount</th>
                        <th>Detail</th>
			<th>Status</th>
			<th>Keywords</th>
			<th>contact</th>
			<th>Last_Update</th>
			<th>Updated_By</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
       // $allArray=array();
        $tot=0;
        foreach ($opportunities as $opportunity): ?>
          <?php // if(!in_array($opportunity['Opportunity']['OppID'],$allArray)){
           // $allArray[]=$opportunity['Opportunity']['OppID'];
          //  }
          $tot=$tot+$opportunity['Opportunity']['Value'];
          ?>
	<tr>
		<td><?php echo h($opportunity['Opportunity']['id']); ?>&nbsp;</td>
                <td><a href="/<?php echo Configure::read('SITENAME');?>/activities/showCompanyActivityDetail/<?php echo $opportunity['CrmCompany']['id']."/".$opportunity['CrmCompany']['Company_Name']; ?>"><?php echo h($opportunity['CrmCompany']['Company_Name']); ?>&nbsp;</a></td>
                <td><a href="/<?php echo Configure::read('SITENAME');?>/activities/showActivityDetail/<?php echo $opportunity['Opportunity']['id']."/".$opportunity['Opportunity']['Opportunity_Name']; ?>"><?php echo h($opportunity['Opportunity']['Opportunity_Name']); ?>&nbsp;</a></td>
                <td class="valu"><?php echo h($opportunity['Opportunity']['Value']); ?>&nbsp;</td>
		<td><?php echo h($opportunity['Opportunity']['Detail']); ?>&nbsp;</td>
		<td><?php echo h($opportunity['Opportunity']['Status_details']); ?>&nbsp;</td>
		<td><?php echo h($opportunity['Opportunity']['Keywords']); ?>&nbsp;</td>
		<td><a href="/<?php echo Configure::read('SITENAME');?>activities/showContactActivityDetail/<?php echo $opportunity['Contact']['id']."/".$opportunity['Contact']['Contact_Name']; ?>"><?php echo h($opportunity['Contact']['Contact_Email']); ?>&nbsp;</td>
		<td><?php echo h($opportunity['Opportunity']['Last_update']); ?>&nbsp;</td>
		<td><a href="/<?php echo Configure::read('SITENAME');?>/activities/showUpdatedByActivityDetail/<?php echo $opportunity['Opportunity']['id']."/".$opportunity['Opportunity']['Updated_by']; ?>"><?php echo h($opportunity['Opportunity']['Updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $opportunity['Opportunity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $opportunity['Opportunity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $opportunity['Opportunity']['id']), array(), __('Are you sure you want to delete # %s?', $opportunity['Opportunity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>

<div class="add-company">
		<span><?php echo $this->Html->link(__('Add Opportunity'),array('action'=>'add')); ?></span>
</div>

<div class="row">The total of amounts of the opportunity : <span class="toti"></span> </div>
 <script>
     $(document).ready(function(){
         
         function calsi(){
         var allv=0;
        $(".valu").each(function(){
          allv=allv+parseFloat($(this).text());
        }); 
        $(".toti").html(allv);
    }
  
        $('#example_wrapper').on('click',function(){
         
              calsi();
        });
        $("#example_filter").find('input').addClass('searchi');
        
         $("#example_filter").find('input').change(function(){
           calsi();
        });
         $("#example_filter").find('input').click(function(){
           calsi();
        });
          calsi();
     });
     </script>