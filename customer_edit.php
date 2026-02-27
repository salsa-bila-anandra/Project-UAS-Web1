<?php
// Redirect to new customer folder location
$qs = isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
header('Location: customer/customer_edit.php' . $qs);
exit;
