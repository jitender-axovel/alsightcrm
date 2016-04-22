<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<div id="opdata" style="background-color:rgb(255, 255, 255);color:rgb(244, 80, 89);" class="companies index"></div>
<div style="clear:both;"></div>
<div id="resultContainer" class="companies index">
    
    <script>
       $(document).ready(function(){
           $('#example').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;

                });
            }
        });
        
    });
        </script>
   
<div class="companies index">
	<h2><?php echo __('Filter'); 
        //pr($allFilteredDatas);
        ?></h2>
         <?php
            $date1 = array();
            $Contact1 = array();
            $Company1 = array();
            $Opportunity1 = array();
            $Status1 = array();
            $date = "<option value='All'>All Date</option>";
            $Contact = "<option value='All'>All Contact</option>";
            $Company = "<option value='All'>All Company</option>";
            $Opportunity = "<option value='All'>All Opportunity</option>";
            $Status = "<option value='All'>All Status</option>";
            foreach ($allFilteredDatas as $crmData) {?>
                
                
                        <?php
                        if (!in_array(date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])), $date1)) {
                            $date = $date . "<option value='" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "'>" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "</option>";
                            $date1[] = date('Y-m-d', strtotime($crmData['Opportunity']['Last_update']));
                        }
                       
                        ?>
                   
               
                        <?php
                        if (!in_array($crmData['Contact']['Contact_Name'], $Contact1)) {
                            $Contact = $Contact . "<option value='" . $crmData['Contact']['Contact_Name'] . "'>" . $crmData['Contact']['Contact_Name'] . "</option>";
                            $Contact1[] = $crmData['Contact']['Contact_Name'];
                        }
                       
                        ?>
                      <?php
                         if (!in_array($crmData['CrmCompany']['Company_Name'], $Company1)) {
                            $Company = $Company . "<option value='" . $crmData['CrmCompany']['Company_Name'] . "'>" . $crmData['CrmCompany']['Company_Name'] . "</option>";
                            $Company1[] = $crmData['CrmCompany']['Company_Name'];
                        }
                       
                        ?>
                  
                        <?php
                            if (!in_array($crmData['Opportunity']['Opportunity_Name'], $Opportunity1)) {
                            $Opportunity = $Opportunity . "<option value='" . $crmData['Opportunity']['Opportunity_Name'] . "'>" . $crmData['Opportunity']['Opportunity_Name'] . "</option>";
                            $Opportunity1[] = $crmData['Opportunity']['Opportunity_Name'];
                        }

                       
                        ?>
                  
                        <?php
                       if (!in_array($crmData['Opportunity']['Status_details'], $Status1)) {
                $Status = $Status . "<option value='" . $crmData['Opportunity']['Status_details'] . "'>" . $crmData['Opportunity']['Status_details'] . "</option>";
                $Status1[] = $crmData['Opportunity']['Status_details'];
            }
                       
                        ?>
                   
                
                
            <?php }
                ?>
        
    <table id="example" class="display table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date/Time</th>
                <th>Contact</th>
                <th>CRM_Company</th>
                <th>Opportunities</th>
                <th>Status</th>
<!--                <th>Classification</th>-->
            </tr>
            <tr>
                <th><select name="time" id="dt" class="allDropdown"><?php echo $date; ?></select></th>
                <th><select name="contact" id="ct" class="allDropdown"><?php echo $Contact; ?></select></th>
                <th><select name="company" id="cm" class="allDropdown"><?php echo $Company; ?></select></th>
                <th><select name="Opportunities" id="op" class="allDropdown"><?php echo $Opportunity; ?></select></th>
                <th><select name="Status" id="st" class="allDropdown"><?php echo $Status ?></select></th>
<!--                <th><select name="Classification" id="cl" class="allDropdown"><?php echo $Classification; ?></select></th>-->
            </tr>
        </thead>



        <tbody>

            <?php
            $date1 = array();
            $Contact1 = array();
            $Company1 = array();
            $Opportunity1 = array();
            $Status1 = array();
            $date = "<option value='All'>All Date</option>";
            $Contact = "<option value='All'>All Contact</option>";
            $Company = "<option value='All'>All Company</option>";
            $Opportunity = "<option value='All'>All Opportunity</option>";
            $Status = "<option value='All'>All Status</option>";
            foreach ($allFilteredDatas as $crmData) {
                   ?>
                <tr>
                    <td>
                        <?php
                        
                        echo date('Y-m-d', strtotime($crmData['Opportunity']['Last_update']));
                        ?>
                    </td>
                    <td> 
                        <?php                     
                    $con=$crmData['Contact']['Contact_Name'];//die;
                        
                        ?><a href="javascript:void(0);" class="con emp" data-toggle="modal" data-target="#myModal" id="<?php echo $crmData['Contact']['id'];?>"><?php echo $con;?></a>
                        </td>
                    <td>
                        <?php
                        $com=$crmData['CrmCompany']['Company_Name'];
                        
                        ?><a href="javascript:void(0);" class="com emp" data-toggle="modal" data-target="#myModal" id="<?php echo $crmData['CrmCompany']['id'];?>"><?php echo $com;?></a>
                        </td>
                    <td><?php
                        $opp=$crmData['Opportunity']['Opportunity_Name'];
                        
                        ?>
                    <?php echo $opp;//$this->Html->link(__($opp), array('action' => 'view',$crmData['Opportunity']['id']), array('title' => 'View',)); ?>
                    </td>
                    <td><?php
            
            echo $crmData['Opportunity']['Status_details'];
            ?>
                    
                    </td>
<!--                    <td>&nbsp;</td>-->
                </tr>
<?php } ?>

        <tfoot>
            
        </tfoot>
        </tbody>
    </table>
</div>
</div>
<?php //echo $this->element('sql_dump'); ?>
<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg openmodal" data-toggle="modal" data-target="#myModal" style="display:none;">
  Launch demo modal
</button>-->

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
    
   $(document).ready(function() {

   $("#op").change(function() {
       $("#opdata").html('');
       var opportunity = $("#op").val();
       if(opportunity!="All"){
         $.ajax({
                type: "POST",
                data: {opportunity:opportunity},
                url: "get_opportunity",
                success: function(result) {
                    $("#opdata").html(result);
                    return false;
                }
            });
             }
       
   });
  
 $(".com").click(function() {
            $("#gotresult").html('<img src="http://project.axovel.com/crm/img/ajax-loader.gif">');
       var company = $(this).attr('id');
         $.ajax({
                type: "POST",
                data: {company:company},
                url: "get_company/"+company,
                success: function(result) {
                $("#gotresult").html(result);
                $("openmodal").click();
                    return false;
                }
            });
       
   });
 $(".con").click(function() {
       $("#gotresult").html('<img src="http://project.axovel.com/crm/img/ajax-loader.gif">');
       var contact = $(this).attr('id');
         $.ajax({
                type: "POST",
                data: {contact:contact},
                url: "get_contact/"+contact,
                success: function(result) {
                  
   $("#gotresult").html(result);
                $("openmodal").click();
                    return false;
                }
            });
       
   });
        $(".allDropdown").change(function() {
            var lastId = $(this).attr('id');
            //var lastId = $(this).val();
            var lastHtml = $(this).html();
            if(lastId=="cm" && $(this).val()!="All"){
                
               $("#ct").val('All');
            }
            var datet = $("#dt").val();
            var contactn = $("#ct").val();
            var companyn = $("#cm").val();
            var opportunity = $("#op").val();
            var status = $("#st").val();
            //alert(lastId);
            //alert(lastHtml);
            $.ajax({
                type: "POST",
                data: {datet: datet, contactn: contactn, companyn: companyn, opportunity: opportunity, status: status},
                url: "ajax",
                success: function(result) {
                    //alert(result);
                    $("#resultContainer").html(result);
                    $("#cm").html("<?php echo $this->Session->read('companyName'); ?>");
                    $("#dt").val(datet);
                    $("#ct").val(contactn);
                    $("#cm").val(companyn);
                    $("#op").val(opportunity);
                    $("#st").val(status);

                    return false;
                }
            });
        });
       
    });

 

</script>