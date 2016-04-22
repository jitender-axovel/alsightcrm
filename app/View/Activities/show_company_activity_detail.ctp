<?php echo $this->element('datatable'); ?>

<div class="activities index">
	<h2><?php echo "Activity of ".$this->params['pass'][1]; ?></h2>
	<table id="example" class="display">
	<thead>
	<tr>
			<th>Number</th>
			<th>Subject</th>
			<th>Date</th>
                        <th>CRM_Company</th>
                        <th>Contact</th>
                        <th>Note</th>
                        <th>Opportunity</th>
                        <th>Opp_Status</th>
                        <th>Notification_Date</th>
                        <th>Notification</th>
                        <th>Owner</th>
                        <th>Body</th>
			<th>File</th>
                        
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($activities as $key=>$activity): ?>
	<tr>
		<td><?php echo h($key+1); ?>&nbsp;</td>
		<td><?php echo h($activity['Activity']['Subject']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['Last_updated']); ?>&nbsp;</td>
                <td><?php echo h($activity['Contact']['CrmCompany']['Company_Name']); ?>&nbsp;</td>
                <td><?php echo h($activity['Contact']['Contact_Email']); ?>&nbsp;</td>
                <td>
                    <?php $content = h($activity['Activity']['Content']);
                    $substr = substr($content,0,40);
                    $length = strlen($content);
                    if($length>40){
                    echo $substr?><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="content" id="<?php echo h($activity['Activity']['id']); ?>"><?php echo ' "Read more....."';?></a>
                    <?php } else{
                        echo ucwords($content);
                    }?>
                </td>
                <td><a href="activities/showActivityDetail/<?php echo $activity['Activity']['opportunity_id']; ?>"><?php echo h($activity['Opportunity']['Opportunity_Name']); ?>&nbsp;</a></td>
                <td><?php echo h($activity['Opportunity']['Status_details']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['Notification_Time']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['Notification_Detail']); ?>&nbsp;</td>
                <td><?php echo h($activity['Activity']['Updated_By']); ?>&nbsp;</td>
		<td>
                    <?php ?>&nbsp;
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="download" id="<?php echo h($activity['Activity']['id']); ?>"><?php echo 'Click Here...';?></a>
                </td>
		<td><?php echo h($activity['Activity']['File']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $activity['Activity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activity['Activity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activity['Activity']['id']), array(), __('Are you sure you want to delete # %s?', $activity['Activity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	</div>

<div class="row">Sum (total) of the Opportunities amount : <?php echo count($activities);?> </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="gotresult">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<script>
    $('document').ready(function(){
        $('.download').click(function(){
            var filename = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "/crm/activities/get_body/"+filename,
                
                success:function(result){
                    $("#gotresult").html(result);
                    $("openmodal").click();
                    return false;
                }
            });
        });

        $('.content').click(function(){
            var actid = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "/crm/activities/get_content/"+actid,
                
                success:function(result){
                    $("#gotresult").html(result);
                    $("openmodal").click();
                    return false;
                }
            });
        });
    });
</script>