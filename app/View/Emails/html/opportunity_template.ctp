<table border=2>
    <tr>
        <th>Opportunity Name</th>
        <th>Detail</th>
        <th>Status</th>
        <th>Amount</th>
        <th>Keywords</th>
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