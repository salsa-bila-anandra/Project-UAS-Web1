<?php
$title = "Customer";
include 'layout.php';
include 'koneksi.php';

// CREATE
if (isset($_POST['simpan'])) {
    $name    = $_POST['name'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn, "INSERT INTO customers VALUES (NULL,'$name','$phone','$address')");
}

// READ
$data = mysqli_query($conn, "SELECT * FROM customers");
?>

<h2>Data Customer</h2>

<form method="post">
    <input type="text" name="name" placeholder="Nama Customer" required>
    <input type="text" name="phone" placeholder="No Telepon" required>
    <input type="text" name="address" placeholder="Alamat" required>
    <button name="simpan">Simpan</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>No Telepon</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($c=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $c['name'] ?></td>
    <td><?= $c['phone'] ?></td>
    <td><?= $c['address'] ?></td>
    <td>
        <a href="customer_edit.php?id=<?= $c['id'] ?>">Edit</a> |
        <a href="customer_hapus.php?id=<?= $c['id'] ?>" onclick="return confirm('Hapus customer?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

    </div>
</div>
</body>
</html>
