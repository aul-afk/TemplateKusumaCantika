<?php
// owner_view.php
include 'config.php';

if (!isset($_GET['id'])) { header("Location: owner.php"); exit(); }
$id = intval($_GET['id']);
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM owner WHERE owner_id = $id"));
if (!$row) { header("Location: owner.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Detail Owner</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{font-family:"Poppins";background:#fafafa;padding:20px;}
.card{max-width:640px;margin:auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.06);}
h2{color:#f79c7b;margin-bottom:8px;}
.item{margin:10px 0;padding:10px;border-radius:8px;background:#fff8f6;border:1px solid #fee7df;}
.label{font-weight:700;color:#555;}
.value{margin-top:6px;color:#333;}
.btn-back{display:inline-block;margin-top:14px;padding:8px 12px;background:#3b82f6;color:#fff;border-radius:8px;text-decoration:none;}
</style>
</head>
<body>
<div class="card">
  <h2><i class="fa-solid fa-id-badge"></i> Detail Owner</h2>

  <div class="item">
    <div class="label">ID</div>
    <div class="value"><?= htmlspecialchars($row['owner_id']) ?></div>
  </div>

  <div class="item">
    <div class="label">Nama</div>
    <div class="value"><?= htmlspecialchars($row['owner_name']) ?></div>
  </div>

  <div class="item">
    <div class="label">Telepon</div>
    <div class="value"><?= htmlspecialchars($row['phone_number']) ?></div>
  </div>

  <div class="item">
    <div class="label">Email</div>
    <div class="value"><?= htmlspecialchars($row['email']) ?></div>
  </div>

  <div class="item">
    <div class="label">Alamat</div>
    <div class="value"><?= nl2br(htmlspecialchars($row['address'])) ?></div>
  </div>

  <a href="owner.php" class="btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
</body>
</html>
