<?php
include "koneksi.php";

/* ===============================
✅ AMBIL DATA TRANSAKSI
=============================== */
$data = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");

$content = "
<h2>Laporan Penjualan</h2>

<button onclick='window.print()' style='float:right;'>
    Print Laporan
</button>

<div style='clear:both;'></div>
<hr>

<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Total</th>
</tr>
";

$no = 1;
$totalAll = 0;

/* ===============================
✅ LOOP DATA TRANSAKSI
=============================== */
while ($t = mysqli_fetch_assoc($data)) {

    $totalAll += $t['total'];

    $content .= "
    <tr>
        <td>$no</td>
        <td>$t[tanggal]</td>
        <td>Rp. " . number_format($t['total']) . "</td>
    </tr>
    ";

    $no++;
}

/* ===============================
✅ TOTAL KESELURUHAN
=============================== */
$content .= "
<tr style='background:#f2f2f2; font-weight:bold;'>
    <td colspan='2'>TOTAL KESELURUHAN</td>
    <td>Rp. " . number_format($totalAll) . "</td>
</tr>
</table>
";

include "layout.php";
?>
