<?php
// owner_add.php
include 'config.php';

$errors = [];
if (isset($_POST['submit'])) {
    $name  = trim($_POST['owner_name']);
    $phone = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $addr  = trim($_POST['address']);

    if ($name === '') $errors[] = "Nama Owner wajib diisi.";
    if ($email === '') $errors[] = "Email wajib diisi.";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO owner (owner_name, phone_number, email, address) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $phone, $email, $addr);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: owner.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Tambah Owner</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{font-family:"Poppins";background:#fafafa;padding:20px;}
.card{max-width:720px;margin:auto;background:#fff;padding:18px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.06);}
h2{color:#f79c7b;margin:0 0 12px 0;}
.form-row{display:flex;gap:12px;margin-bottom:10px;}
.form-row input{flex:1;padding:10px;border:1px solid #ddd;border-radius:8px;}
textarea{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;min-height:100px;}
.btn {background:#f79c7b;color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;font-weight:600;}
.link {margin-left:10px;color:#555;text-decoration:none;}
.error {background:#ffe6e6;color:#b00020;padding:8px;border-radius:6px;margin-bottom:10px;}
</style>
</head>
<body>
<div class="card">
  <h2><i class="fa-solid fa-plus"></i> Tambah Owner</h2>

  <?php if (!empty($errors)): ?>
    <div class="error"><?= implode("<br>", array_map('htmlspecialchars', $errors)) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="form-row">
      <input type="text" name="owner_name" placeholder="Nama Owner" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" required>
      <input type="text" name="phone_number" placeholder="No. Telepon" value="<?= isset($phone) ? htmlspecialchars($phone) : '' ?>">
    </div>
    <div class="form-row">
      <input type="email" name="email" placeholder="Email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
    </div>
    <div>
      <textarea name="address" placeholder="Alamat"><?= isset($addr) ? htmlspecialchars($addr) : '' ?></textarea>
    </div>
    <div style="margin-top:12px;">
      <button type="submit" name="submit" class="btn"><i class="fa fa-save"></i> Simpan</button>
      <a href="owner.php" class="link">Batal</a>
    </div>
  </form>
</div>
</body>
</html>
