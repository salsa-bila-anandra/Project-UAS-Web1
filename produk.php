<?php
$title = "Data Produk";
include 'layout.php';
include 'koneksi.php';

// CREATE
if (isset($_POST['simpan'])) {
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    mysqli_query($conn, "INSERT INTO products VALUES (NULL,'$name','$price','$stock')");
}

// READ
$data = mysqli_query($conn, "SELECT * FROM products");
?>

<h2>Data Produk</h2>

<form method="post">
    <input type="text" name="name" placeholder="Nama Produk" required>
    <input type="number" name="price" placeholder="Harga" required>
    <input type="number" name="stock" placeholder="Stok" required>
    <button name="simpan">Simpan</button>
</form>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

<?php $no=1; while($p = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $p['name'] ?></td>
        <td><?= $p['price'] ?></td>
        <td><?= $p['stock'] ?></td>
        <td>
            <a href="produk_edit.php?id=<?= $p['id'] ?>">Edit</a> |
            <a href="produk_hapus.php?id=<?= $p['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>

    </div>
</div>
</body>
</html>
