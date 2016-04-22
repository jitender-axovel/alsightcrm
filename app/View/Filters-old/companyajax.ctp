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
        <h2><?php if(!empty($allFilteredDatas)){ echo __($allFilteredDatas[0]['Company']['Company_Name']); } ?></h2>
 
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date/Time</th>
                <th>Contact</th>
               
                <th>Opportunities</th>
                <th>Status</th>
                <th>Classification</th>
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
                        if (!in_array(date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])), $date1)) {
                            $date = $date . "<option value='" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "'>" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "</option>";
                            $date1[] = date('Y-m-d', strtotime($crmData['Opportunity']['Last_update']));
                        }
                        echo date('Y-m-d', strtotime($crmData['Opportunity']['Last_update']));
                        ?>
                    </td>
                    <td> 
                        <?php
                        if (!in_array($crmData['Contact']['Contact_Name'], $Contact1)) {
                            $Contact = $Contact . "<option value='" . $crmData['Contact']['Contact_Name'] . "'>" . $crmData['Contact']['Contact_Name'] . "</option>";
                            $Contact1[] = $crmData['Contact']['Contact_Name'];
                        }
                        echo $crmData['Contact']['Contact_Name'];
                        ?></td>
                   
                    <td><?php
                        if (!in_array($crmData['Opportunity']['Opportunity_Name'], $Opportunity1)) {
                            $Opportunity = $Opportunity . "<option value='" . $crmData['Opportunity']['Opportunity_Name'] . "'>" . $crmData['Opportunity']['Opportunity_Name'] . "</option>";
                            $Opportunity1[] = $crmData['Opportunity']['Opportunity_Name'];
                        }
                        echo $crmData['Opportunity']['Opportunity_Name'];
                        ?></td>
                    <td><?php
            if (!in_array($crmData['Opportunity']['Status_details'], $Status1)) {
                $Status = $Status . "<option value='" . $crmData['Opportunity']['Status_details'] . "'>" . $crmData['Opportunity']['Status_details'] . "</option>";
                $Status1[] = $crmData['Opportunity']['Status_details'];
            }
            echo $crmData['Opportunity']['Status_details'];
            ?></td>
                    <td>&nbsp;</td>
                </tr>
<?php } ?>

        <tfoot>
            <tr>
                <th><select name="time" id="dt" class="allDropdown"><?php echo $date; ?></select></th>
                <th><select name="contact" id="ct" class="allDropdown"><?php echo $Contact; ?></select></th>
              
                <th><select name="Opportunities" id="op" class="allDropdown"><?php echo $Opportunity; ?></select></th>
                <th><select name="Status" id="st" class="allDropdown"><?php echo $Status ?></select></th>
                <th><select name="Classification" id="cl" class="allDropdown"><?php echo $Classification; ?></select></th>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>