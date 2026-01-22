<?php
$title = "Laporan Penjualan";
include 'layout.php';
include 'koneksi.php';

// filter
$tanggal = $_GET['tanggal'] ?? '';
$bulan   = $_GET['bulan'] ?? '';

$where = "1";

if ($tanggal) {
    $where .= " AND DATE(t.created_at) = '$tanggal'";
}

if ($bulan) {
    $where .= " AND DATE_FORMAT(t.created_at,'%Y-%m') = '$bulan'";
}

$query = "
    SELECT t.*, c.name AS customer 
    FROM transactions t
    JOIN customers c ON t.customer_id = c.id
    WHERE $where
    ORDER BY t.created_at DESC
";

$data = mysqli_query($conn, $query);
?>
<h2>Laporan Penjualan</h2>

<form method="get">
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="<?= $tanggal ?>">

    <label>Bulan:</label>
    <input type="month" name="bulan" value="<?= $bulan ?>">

    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Customer</th>
    <th>Total</th>
</tr>

<?php
$no = 1;
$grandTotal = 0;
while ($r = mysqli_fetch_assoc($data)):
    $grandTotal += $r['total'];
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= date('d-m-Y H:i', strtotime($r['created_at'])) ?></td>
    <td><?= $r['customer'] ?></td>
    <td>Rp <?= number_format($r['total']) ?></td>
</tr>
<?php endwhile; ?>

<tr>
    <th colspan="3">TOTAL</th>
    <th>Rp <?= number_format($grandTotal) ?></th>
</tr>
</table>

    </div>
</div>
</body>
</html>
