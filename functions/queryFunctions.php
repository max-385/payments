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