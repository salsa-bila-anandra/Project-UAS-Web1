<?php
// Redirect stub to customer folder
$qs = isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
header('Location: customer.php' . $qs);
exit;

