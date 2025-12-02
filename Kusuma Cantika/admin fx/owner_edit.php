<?php
// owner_edit.php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: owner.php");
    exit();
}
$id = intval($_GET['id']);
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM owner WHERE owner_id = $id"));
if (!$row) {
    header("Location: owner.php");
    exit();
}

$errors = [];
if (isset($_POST['update'])) {
    $name  = trim($_POST['owner_name']);
    $phone = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $addr  = trim($_POST['address']);

    if ($name === '') $errors[] = "Nama Owner wajib diisi.";
    if ($email === '') $errors[] = "Email wajib diisi.";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "UPDATE owner SET owner_name=?, phone_number=?, email=?, address=? WHERE owner_id=?");
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $phone, $email, $addr, $id);
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
<title>Edit Owner</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{font-family:"Poppins";background:#fafafa;padding:20px;}
.card{max-width:720px;margin:auto;background:#fff;padding:18px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.06);}
h2{color:#f79c7b;margin:0 0 12px 0;}
.form-row{display:flex;gap:12px;margin-bottom:10px;}
.form-row input{flex:1;padding:10px;border:1px solid #ddd;border-radius:8px;}
textarea{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;min-height:100px;}
.btn {background:#10b981;color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;font-weight:600;}
.link {margin-left:10px;color:#555;text-decoration:none;}
.error {background:#ffe6e6;color:#b00020;padding:8px;border-radius:6px;margin-bottom:10px;}
</style>
</head>
<body>
<div class="card">
  <h2><i class="fa-solid fa-pen-to-square"></i> Edit Owner</h2>

  <?php if (!empty($errors)): ?>
    <div class="error"><?= implode("<br>", array_map('htmlspecialchars', $errors)) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="form-row">
      <input type="text" name="owner_name" placeholder="Nama Owner" value="<?= htmlspecialchars(isset($name) ? $name : $row['owner_name']) ?>" required>
      <input type="text" name="phone_number" placeholder="No. Telepon" value="<?= htmlspecialchars(isset($phone) ? $phone : $row['phone_number']) ?>">
    </div>
    <div class="form-row">
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars(isset($email) ? $email : $row['email']) ?>" required>
    </div>
    <div>
      <textarea name="address" placeholder="Alamat"><?= htmlspecialchars(isset($addr) ? $addr : $row['address']) ?></textarea>
    </div>
    <div style="margin-top:12px;">
      <button type="submit" name="update" class="btn"><i class="fa fa-save"></i> Update</button>
      <a href="owner.php" class="link">Batal</a>
    </div>
  </form>
</div>
</body>
</html>
