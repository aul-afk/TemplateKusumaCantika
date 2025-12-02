<?php
include 'config.php';

if (!isset($_GET['id'])) {
  die("ID pemeriksaan tidak ditemukan!");
}

$id = $_GET['id'];
$query = "SELECT * FROM checks WHERE check_id = '$id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
  die("Data tidak ditemukan!");
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pemeriksaan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 600px;
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
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .content {
      padding: 25px 35px;
      color: #333;
    }

    .row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 8px;
    }

    .row label {
      font-weight: 600;
      color: #555;
      flex-basis: 40%;
    }

    .row span {
      flex-basis: 55%;
      text-align: right;
      color: #333;
    }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: #ff8c42;
      color: white;
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      transition: 0.2s;
      margin-top: 10px;
    }

    .btn-back:hover {
      background-color: #e8741e;
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
      <i class="fa-solid fa-clipboard-check"></i> Detail Pemeriksaan
    </div>

    <div class="content">
      <div class="row">
        <label>ID Pemeriksaan:</label>
        <span><?= htmlspecialchars($data['check_id']); ?></span>
      </div>

      <div class="row">
        <label>ID Owner:</label>
        <span><?= htmlspecialchars($data['owner_id']); ?></span>
      </div>

      <div class="row">
        <label>ID Kostum:</label>
        <span><?= htmlspecialchars($data['costume_id']); ?></span>
      </div>

      <div class="row">
        <label>Tanggal Pemeriksaan:</label>
        <span><?= htmlspecialchars($data['check_date']); ?></span>
      </div>

      <div class="row">
        <label>Status:</label>
        <span><?= htmlspecialchars($data['status']); ?></span>
      </div>

      <div class="row">
        <label>Keterangan:</label>
        <span><?= htmlspecialchars($data['notes']); ?></span>
      </div>

      <div class="footer">
        <a href="check_table.php" class="btn-back">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>
  </div>
</body>
</html>
