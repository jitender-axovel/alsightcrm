<table border=1>
    <tr>
        <th>Contact Name</th>
        <th>Contact Email</th>
        <th>Detail</th>
    </tr>
<?php foreach($response as $request): ?>
    <?phpforeach ($request as $responserow): ?>
        <tr>
        <?phph foreach ($responserow as $responsedata): ?>
            <td>
                <?php print_r($responsedata); ?>
            </td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>