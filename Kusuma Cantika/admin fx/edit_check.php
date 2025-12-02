<?php
include 'config.php';

// ambil ID dari URL
if (!isset($_GET['id'])) {
  die("ID pemeriksaan tidak ditemukan!");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM checks WHERE check_id = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
  die("Data pemeriksaan tidak ditemukan!");
}

// proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
  $costume_id = $_POST['costume_id'];
  $check_date = $_POST['check_date'];
  $status = $_POST['status'];
  $notes = $_POST['notes'];

  $update = mysqli_query($conn, "UPDATE checks 
    SET  costume_id='$costume_id', check_date='$check_date', status='$status', notes='$notes'
    WHERE check_id=$id");

  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='check_table.php?page=check';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pemeriksaan</title>
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
    }

    .header {
      background-color: #ff8c42;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 22px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    form {
      padding: 25px 35px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      font-weight: 600;
      color: #555;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 15px;
      outline: none;
      transition: border 0.2s;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: #ff8c42;
    }

    textarea {
      resize: none;
      height: 90px;
    }

    .btn-group {
      text-align: center;
      margin-top: 25px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 6px;
      font-weight: 500;
      transition: 0.2s;
      border: none;
      cursor: pointer;
      font-size: 15px;
    }

    .btn-save {
      background-color: #ff8c42;
      color: white;
    }

    .btn-save:hover {
      background-color: #e8741e;
    }

    .btn-back {
      background-color: #ccc;
      color: #333;
      margin-left: 10px;
    }

    .btn-back:hover {
      background-color: #b3b3b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <i class="fa-solid fa-pen-to-square"></i> Edit Pemeriksaan
    </div>

    <form method="POST">
      >

      <div class="form-group">
        <label>ID Kostum:</label>
        <input type="text" name="costume_id" value="<?= htmlspecialchars($data['costume_id']) ?>" required>
      </div>

      <div class="form-group">
        <label>Tanggal Pemeriksaan:</label>
        <input type="date" name="check_date" value="<?= htmlspecialchars($data['check_date']) ?>" required>
      </div>

      <div class="form-group">
        <label>Status:</label>
        <select name="status" required>
          <option value="worthy" <?= ($data['status'] == 'worthy') ? 'selected' : '' ?>>Baik</option>
          <option value="unworthy" <?= ($data['status'] == 'unworthy') ? 'selected' : '' ?>>Rusak</option>
          <option value="maintenance"<?= ($data['status'] == 'maintenance') ? 'selected' : '' ?>>Perawatan</option>
        </select>
      </div>

      <div class="form-group">
        <label>Keterangan:</label>
        <textarea name="notes"><?= htmlspecialchars($data['notes']) ?></textarea>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        <a href="check_table.php" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
      </div>
    </form>
  </div>
</body>
</html>
