<?php //pr($allFilteredDatas);?>



<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>


<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date/Time</th>
                <th>Contact</th>
                <th>Company</th>
                <th>Opportunities</th>
                <th>Status</th>
                <th>Classification</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Date/Time</th>
                <th>Contact</th>
                <th>Company</th>
                <th>Opportunities</th>
                <th>Status</th>
                <th>Classification</th>
            </tr>
        </tfoot>
 
        <tbody>
           
                <?php foreach($allFilteredDatas as $crmData){ ?>
             <tr>
                <td><?php echo $crmData['Opportunity']['Last_update']; ?></td>
                <td> <?php echo $crmData['Contact']['Contact_Name']; ?></td>
                <td><?php echo $crmData['Company']['Company_Name']; ?></td>
                <td><?php echo $crmData['Opportunity']['Opportunity_Name']; ?></td>
                <td><?php echo $crmData['Opportunity']['Status_details']; ?></td>
                <td>&nbsp;</td>
                 </tr>
                <?php } ?>
           
        </tbody>
    </table>