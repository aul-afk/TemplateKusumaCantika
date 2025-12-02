<?php
include 'config.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
  
  $customer_name = $_POST['customer_name'];
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  
  $address = $_POST['address'];

  $update = "UPDATE customer SET 
             
              customer_name='$customer_name', 
              gender='$gender',
              phone_number='$phone_number',
              
              address='$address'
            WHERE customer_id='$id'";
  mysqli_query($conn, $update);
  header("Location: pelanggan_table.php");
}
?>

<head>
  <meta charset="utf-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Pelanggan</title>
</head>

<style>
.container {
  max-width: 500px;
  background: #fff;
  margin: 60px auto;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h2 {
  color: #f79c7b;
  font-size: 1.5rem;
  font-weight: 600;
  text-align: center;
  margin-bottom: 20px;
}

label {
  font-weight: 500;
  color: #444;
  margin-top: 8px;
  display: block;
}

input, select, textarea {
  width: 100%;
  padding: 10px;
  margin-top: 6px;
  border: 1px solid #ddd;
  border-radius: 8px;
}

button {
  background-color: #f79c7b;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 8px;
  margin-top: 15px;
  width: 100%;
  cursor: pointer;
}

button:hover {
  background-color: #e98663;
}
</style>

<body>
  <div class="container">
    <h2>Edit Pelanggan</h2>
    <form method="POST">
      

      <label>Nama Pelanggan</label>
      <input type="text" name="customer_name" value="<?= $data['customer_name'] ?>" required>

      <label>Jenis Kelamin</label>
      <select name="gender" required>
        <option value="male" <?= $data['gender']=='male'?'selected':'' ?>>Laki-laki</option>
        <option value="female" <?= $data['gender']=='female'?'selected':'' ?>>Perempuan</option>
      </select>

      <label>No. Telepon</label>
      <input type="text" name="phone_number" value="<?= $data['phone_number'] ?>" required>

      

      <label>Alamat</label>
      <textarea name="address" required><?= $data['address'] ?></textarea>

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
