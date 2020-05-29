<?php include_once("config/DbConnection.php");
error_reporting(E_ALL & ~E_NOTICE);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments</title>
</head>


<body>
<table border="1">
    <?php
    function executeQuery(string $query, mysqli $dbc): array
    {
        $execute = mysqli_query($dbc, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    function getGroupedData(mysqli $dbc): array
    {
        $query = "SELECT payment_id, export_id, count(id) as count, sum(sum) as total FROM data GROUP BY export_id, payment_id";

        return executeQuery($query, $dbc);
    }

    function getDescriptionData(mysqli $dbc): array
    {
        $query = "SELECT id, payment_id, sum FROM data";
        $rawData = executeQuery($query, $dbc);

        $data = [];
        foreach ($rawData as $row) {
            $paymentId = $row['payment_id'];
            unset($row['payment_id']);

            $data[$paymentId][] = $row;
        }

        return $data;
    }

    $groupedData = getGroupedData($dbc);
    $descriptionData = getDescriptionData($dbc);
    $footerCount = 0;
    $footerSum = 0;

    foreach ($groupedData as $key => $mainRow) {
        $footerCount += $mainRow['count'];
        $footerSum += $mainRow['total'];
        if ($groupedData[$key - 1]['export_id'] != $groupedData[$key]['export_id']) { ?>
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
            <?php foreach ($descriptionData[$mainRow['payment_id']] as $description) { ?>
                <tr style="text-align: right">
                    <td colspan="2"></td>
                    <td><?php echo $description['id']; ?></td>
                    <td><?php echo $description['sum']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

        <?php if ($groupedData[$key]['export_id'] != $groupedData[$key + 1]['export_id']) { ?>
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

        <?php   $footerCount = 0;
                $footerSum = 0;
        } ?>
    <?php } ?>

</table>
</body>
</html>