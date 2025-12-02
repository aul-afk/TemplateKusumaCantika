<?php
include 'config.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM costume WHERE costume_id = '$id'");
  $data = mysqli_fetch_assoc($query);
}

if (isset($_POST['update'])) {
  
  $category = $_POST['costume_category'];

  $size = $_POST['size'];
  $price = $_POST['price'];
  $availability = $_POST['availability'];

  // Upload gambar baru (opsional)
  if ($_FILES['gambar']['name'] != '') {
    $gambar = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $gambar);
  } else {
    $gambar = $data['image'];
  }

  $update = mysqli_query($conn, "UPDATE costume SET 
    
    costume_category='$category',
    
    size='$size',
    price='$price',
    availability='$availability',
    image='$gambar'
    WHERE costume_id='$id'
  ");

  if ($update) {
    echo "<script>alert('Data costume berhasil diperbarui!'); window.location='kostum_table.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Costume</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 40px;
    }

    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      border-top: 5px solid #ff8c42;
    }

    .header {
      background-color: #ff8c42;
      color: white;
      text-align: center;
      padding: 15px 0;
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    form {
      padding: 25px 35px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #555;
    }

    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 14px;
      transition: all 0.2s;
    }

    input:focus, select:focus {
      border-color: #ff8c42;
      box-shadow: 0 0 4px rgba(255, 140, 66, 0.4);
      outline: none;
    }

    .preview-img {
      display: block;
      width: 160px;
      margin: 15px auto;
      border-radius: 6px;
      border: 2px solid #ff8c42;
    }

    .btn-submit {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: #ff8c42;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.2s;
      font-weight: 600;
    }

    .btn-submit:hover {
      background-color: #e8741e;
    }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: #999;
      color: white;
      text-decoration: none;
      padding: 9px 18px;
      border-radius: 6px;
      margin-left: 10px;
      transition: 0.2s;
    }

    .btn-back:hover {
      background-color: #777;
    }

    .footer {
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="header">
    <i class="fa-solid fa-pen-to-square"></i> Edit Costume
  </div>

  <form method="POST" enctype="multipart/form-data">
    

    <label>Kategori Costume</label>
    <input type="text" name="costume_category" value="<?= $data['costume_category']; ?>" required>


    <label>Ukuran</label>
    <input type="text" name="size" value="<?= $data['size']; ?>" required>

    <label>Harga</label>
    <input type="number" name="price" value="<?= $data['price']; ?>" required>

    <label>Ketersediaan</label>
    <select name="availability" required>
      <option value="yes" <?= $data['availability'] == 'yes' ? 'selected' : ''; ?>>Tersedia</option>
      <option value="no" <?= $data['availability'] == 'no' ? 'selected' : ''; ?>>Tidak Tersedia</option>
    </select>

    <label>Gambar Costume</label>
    <input type="file" name="gambar">
    <?php if (!empty($data['gambar'])): ?>
      <img src="uploads/<?= $data['gambar']; ?>" class="preview-img" alt="Costume Image">
    <?php endif; ?>

    <div class="footer">
      <button type="submit" name="update" class="btn-submit">
        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
      </button>
      <a href="kostum_table.php" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali
      </a>
    </div>
  </form>
</div>

</body>
</html>
