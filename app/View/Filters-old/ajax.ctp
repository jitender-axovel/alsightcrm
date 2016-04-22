

<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {

        $(".allDropdown").change(function () {
            var lastId = $(this).attr('id');
            //var lastId = $(this).val();
            var lastHtml = $(this).html();
            if (lastId == "cm" && $(this).val() != "All") {

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
                success: function (result) {
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

<div id="resultContainer" class="companies index">
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;

                    });
                }
            });

        }); 
    </script>

    <div class="companies index">
        <h2><?php echo __('Filter'); ?></h2>
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
            if (!in_array(date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])), $date1)) {
                $date = $date . "<option value='" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "'>" . date('Y-m-d', strtotime($crmData['Opportunity']['Last_update'])) . "</option>";
                $date1[] = date('Y-m-d', strtotime($crmData['Opportunity']['Last_update']));
            }
            if (!in_array($crmData['Contact']['Contact_Name'], $Contact1)) {
                $Contact = $Contact . "<option value='" . $crmData['Contact']['Contact_Name'] . "'>" . $crmData['Contact']['Contact_Name'] . "</option>";
                $Contact1[] = $crmData['Contact']['Contact_Name'];
            }
            if (!in_array($crmData['Company']['Company_Name'], $Company1)) {
                $Company = $Company . "<option value='" . $crmData['Company']['Company_Name'] . "'>" . $crmData['Company']['Company_Name'] . "</option>";
                $Company1[] = $crmData['Company']['Company_Name'];
            }
            if (!in_array($crmData['Opportunity']['Opportunity_Name'], $Opportunity1)) {
                $Opportunity = $Opportunity . "<option value='" . $crmData['Opportunity']['Opportunity_Name'] . "'>" . $crmData['Opportunity']['Opportunity_Name'] . "</option>";
                $Opportunity1[] = $crmData['Opportunity']['Opportunity_Name'];
            }
            if (!in_array($crmData['Opportunity']['Status_details'], $Status1)) {
                $Status = $Status . "<option value='" . $crmData['Opportunity']['Status_details'] . "'>" . $crmData['Opportunity']['Status_details'] . "</option>";
                $Status1[] = $crmData['Opportunity']['Status_details'];
            }
        }
        ?>
        <table id="example" class="display table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Date/Time</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Opportunities</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <th><select name="time" id="dt" class="allDropdown"><?php echo $date; ?></select></th>
                    <th><select name="contact" id="ct" class="allDropdown"><?php echo $Contact; ?></select></th>
                    <th><select name="company" id="cm" class="allDropdown"><?php echo $Company; ?></select></th>
                    <th><select name="Opportunities" id="op" class="allDropdown"><?php echo $Opportunity; ?></select></th>
                    <th><select name="Status" id="st" class="allDropdown"><?php echo $Status ?></select></th>
                </tr>
            </thead>



            <tbody>

                <?php
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
                            echo $crmData['Contact']['Contact_Name'];
                            ?></td>
                        <td>
                            <?php
                            echo $crmData['Company']['Company_Name'];
                            ?></td>
                        <td><?php
                            echo $crmData['Opportunity']['Opportunity_Name'];
                            ?></td>
                        <td><?php
                            echo $crmData['Opportunity']['Status_details'];
                            ?></td>
    <!--                    <td>&nbsp;</td>-->
                    </tr>
                        <?php } ?>


            </tbody>
        </table>
    </div>
</div>
<?php
//echo $this->element('sql_dump'); ?>