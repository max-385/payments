<?php
$dbc = new mysqli('localhost', 'maximsa', '12password', 'payments');
$dbc->set_charset('utf8');
if ($dbc->connect_error) {
    die('Could not connect because: ' . $dbc->connect_error);
}