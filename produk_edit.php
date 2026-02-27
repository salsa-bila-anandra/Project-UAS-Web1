<?php
// Redirect to new produk folder location
$qs = isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
header('Location: produk/produk_edit.php' . $qs);
exit;
?>
