<?php
include 'config.php';

if (isset($_POST['submit'])) {
  $costume_id = $_POST['costume_id'];
  $customer_name = $_POST['customer_name'];
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  $query = "INSERT INTO customer (costume_id, customer_name, gender, phone_number, email, address)
            VALUES ('$costume_id', '$customer_name', '$gender', '$phone_number', '$email', '$address')";
  mysqli_query($conn, $query);
  header("Location: pelanggan.php");
}
?>

<head>
  <meta charset="utf-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Tambah Pelanggan</title>
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
    <h2>Tambah Pelanggan</h2>
    <form method="POST">
      <label>ID Kostum</label>
      <input type="text" name="costume_id" required>

      <label>Nama Pelanggan</label>
      <input type="text" name="customer_name" required>

      <label>Jenis Kelamin</label>
      <select name="gender" required>
        <option value="male">Laki-laki</option>
        <option value="female">Perempuan</option>
      </select>

      <label>No. Telepon</label>
      <input type="text" name="phone_number" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Alamat</label>
      <textarea name="address" required></textarea>

      <div class="d-flex justify-content-between">
            <a href="pelanggan.php" class="btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn-submit"><i class="fa fa-plus-circle"></i> Tambah Costume</button>
        </div>
    </form>
  </div>
</body>
