<?php
// koneksi database langsung
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "qc";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// ambil semua data costume
$result = $conn->query("SELECT * FROM costume ORDER BY costume_id ASC");

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>

<h2>Data Costume</h2>

<a href="index.php">Tambah Costume</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Kategori</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Tersedia</th>
        <th>Gambar</th>
    </tr>

    <?php if(!empty($data)): ?>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?= $row['costume_id'] ?></td>
                <td><?= $row['costume_category'] ?></td>
                <td><?= $row['costume_name'] ?></td>
                <td><?= $row['size'] ?></td>
                <td><?= number_format($row['price'],0,",",".") ?></td>
                <td><?= $row['availability'] ?></td>
                <td>
                    <?php if($row['image']): ?>
                        <img src="../../../images/<?= $row['image'] ?>" width="70">
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7">Tidak ada data!</td></tr>
    <?php endif; ?>
</table>
