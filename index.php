<?php include_once("config/DbConnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments</title>
</head>

<body>
<table border="1">
    <?php
    include_once("functions/queryFunctions.php");

    $groupedData = getGroupedData($dbc);
    $paymentsDetails = getDescriptionData($dbc);
    $footerCount = 0;
    $footerSum = 0;

    foreach ($groupedData as $key => $mainRow) {
        $footerCount += $mainRow['count'];
        $footerSum += $mainRow['total'];
        if (!isset($groupedData[$key - 1]['export_id']) ||
            $groupedData[$key - 1]['export_id'] !== $groupedData[$key]['export_id']) { ?>
            <tr>
                <th> payment_id</th>
                <th> count</th>
                <th> export_id</th>
                <th> total</th>
            </tr>
        <?php } ?>

        <tr style="text-align: right">
            <td> <?php echo $mainRow['payment_id']; ?></td>
            <td> <?php echo $mainRow['count']; ?></td>
            <td> <?php echo $mainRow['export_id']; ?></td>
            <td> <?php echo $mainRow['total']; ?></td>
        </tr>

        <?php if ($mainRow['count'] > 1) { ?>
            <tr>
                <th colspan='2'></th>
                <th> ID</th>
                <th> sum</th>
            </tr>
            <?php foreach ($paymentsDetails[$mainRow['payment_id']] as $description) { ?>
                <tr style="text-align: right">
                    <td colspan="2"></td>
                    <td><?php echo $description['id']; ?></td>
                    <td><?php echo $description['sum']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

        <?php
        if (!isset($groupedData[$key + 1]['export_id']) ||
            $groupedData[$key]['export_id'] !== $groupedData[$key + 1]['export_id']) { ?>
            <tr style="text-align: center">
                <td colspan="4"> Total for export <?php echo $mainRow['export_id']; ?></td>
            </tr>
            <tr style="text-align: center">
                <td colspan="2">count</td>
                <td colspan="2">sum</td>
            </tr>
            <tr style="text-align: center">
                <td colspan="2"><?php echo $footerCount ?></td>
                <td colspan="2"><?php echo $footerSum ?></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

            <?php $footerCount = 0;
            $footerSum = 0;
        } ?>
    <?php } ?>

</table>
</body>
</html>