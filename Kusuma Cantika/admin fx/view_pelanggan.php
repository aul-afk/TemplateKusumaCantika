<?php
include 'config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Costume</title>
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

    .image-box {
      text-align: center;
      margin: 25px 0;
    }

    .image-box img {
      width: 200px;
      border-radius: 8px;
      border: 2px solid #ff8c42;
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
    <i class="fa-solid fa-shirt"></i> Detail Pelanggan
  </div>

  <div class="content">
    <div class="row">
      <label>Costume ID:</label>
      <span><?= $data['costume_id']; ?></span>
    </div>
    <div class="row">
      <label>Nama:</label>
      <span><?= $data['customer_name']; ?></span>
    </div>
    <div class="row">
      <label>Gender:</label>
      <span><?= $data['gender']; ?></span>
    </div>
    <div class="row">
      <label>No Telepon:</label>
      <span><?= $data['phone_number']; ?></span>
    </div>
    <div class="row">
      <label>Email:</label>
      <span><?= $data['email']; ?></span>
    </div>
    <div class="row">
      <label>Alamat:</label>
      <span><?= $data['address']; ?></span>
  <div class="footer">
    <a href="pelanggan_table.php" class="btn-back">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

</body>
</html>
