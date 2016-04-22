<table border=1><tr>
    <th>Company ID</th>
    <th>Company Name</th>
    <th>Company Domain</th>
    <th>Company Group</th>
</tr>
<?php foreach($response as $request): ?>
    <?php foreach ($request as $responserow): ?>
        <tr>
        <?php foreach ($responserow as $responsedata): ?>
            <td>
            <?php print_r($responsedata); ?>
            </td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>