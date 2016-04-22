<table border=2><tr>
<th>Subject</th>
<th>Content</th>
<th>Notification Time</th>
<th>Notification Detail</th>
<th>Notification Email</th>
<th>Criteria</th>
</tr>
<?php foreach($response as $request):?>
    <?phpforeach ($request as $responserow):?>
        <tr>
        <?php foreach ($responserow as $responsedata):?>
            <td>
            <?php print_r($responsedata);?>
            </td>
        <?php endforeach;?>
        </tr>
    <?php endforeach;?>
<?php endforeach;?>
</table>
?>