<?php
include 'config.php';

// Proses form ketika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $costume_category = $_POST['costume_category'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $gambar = "";

    // Upload gambar
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/";
        $gambar = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    // Simpan ke database
    $query = "INSERT INTO costume (costume_category, size, price, availability, gambar)
              VALUES ('$costume_category', '$size', '$price', '$availability', '$gambar')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data costume berhasil ditambahkan!'); window.location='kostum_table.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data costume');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Costume</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    background-color: #fff7f3;
    font-family: "Muli", sans-serif;
}
.container {
    max-width: 650px;
    margin: 60px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
h2 {
    color: #f79c7b;
    font-size: 1.6rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 25px;
}
label {
    font-weight: 600;
    color: #444;
    margin-top: 10px;
    display: block;
}
input, select {
    width: 100%;
    padding: 11px;
    margin-top: 6px;
    border: 1px solid #f5b6a5;
    border-radius: 10px;
    background: #fff7f3;
}
.btn-submit {
  background-color: #f79c7b;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 10px;
  margin-top: 20px;
  width: 100%;
  cursor: pointer;
  font-weight: bold;
}
.btn-submit:hover {
  background-color: #e98663;
}
.btn-back {
    background-color: #fbb097;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
}
.btn-back:hover {
    background-color: #f57c52;
}
</style>
</head>

<body>

<div class="container">
    <h2><i class="fa-solid fa-shirt"></i> Tambah Data Costume</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Kategori Kostum</label>
        <input type="text" name="costume_category" required>

        <label>Ukuran</label>
        <select name="size" required>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>

        <label>Harga (Rp)</label>
        <input type="number" name="price" required>

        <label>Ketersediaan</label>
        <select name="availability" required>
            <option value="yes">Tersedia</option>
            <option value="no">Tidak Tersedia</option>
        </select>

        <label>Upload Gambar</label>
        <input type="file" name="gambar" accept="image/*">

        <div class="d-flex justify-between mt-4 flex gap-3">
            <a href="kostum_table.php" class="btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn-submit"><i class="fa fa-plus-circle"></i> Tambah Costume</button>
        </div>

    </form>
</div>

</body>
</html>
