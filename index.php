<?php include_once("config/DbConnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments</title>
</head>


<body>
<table border="1">
    <?php $query = "SELECT payment_id, export_id, count(id) as count, sum(sum) as sum FROM data GROUP BY export_id";
    $data = mysqli_query($dbc, $query);
    while ($res = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <th> payment_id</th>
            <th> count</th>
            <th> export_id</th>
            <th> total</th>
        </tr>
        <?php
        $q = "SELECT payment_id, export_id, count(id) as count, sum(sum) as total FROM data WHERE export_id = '$res[export_id]' GROUP BY payment_id";
        $d = mysqli_query($dbc, $q);

        while ($r = mysqli_fetch_assoc($d)) { ?>
            <tr style="text-align: right">
                <td><?php echo $r['payment_id']; ?></td>
                <td><?php echo $r['count']; ?></td>
                <td><?php echo $r['export_id']; ?></td>
                <td><?php echo $r['total']; ?></td>
            </tr>
            <?php if ($r['count'] > 1) { ?>
                <tr>
                    <th colspan='2'></th>
                    <th> ID</th>
                    <th> sum</th>
                </tr>
                <?php $q2 = "SELECT id, sum FROM data WHERE payment_id = '$r[payment_id]'";
                $d2 = mysqli_query($dbc, $q2);
                while ($res2 = mysqli_fetch_assoc($d2)) { ?>
                    <tr style="text-align: right">
                        <td colspan="2"></td>
                        <td><?php echo $res2['id']; ?></td>
                        <td><?php echo $res2['sum']; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <tr style="text-align: center">
            <td colspan="4"> Total for export <?php echo $res['export_id']; ?></td>
        </tr>
        <tr style="text-align: center">
            <td colspan="2">count</td>
            <td colspan="2">sum</td>
        </tr>
        <tr style="text-align: center">
            <td colspan="2"><?php echo $res['count'] ?></td>
            <td colspan="2"><?php echo $res['sum'] ?></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>

    <?php } ?>
</table>
</body>
</html>