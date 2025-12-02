<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $costume_id = $_POST['costume_id'];
  $check_date = $_POST['check_date'];
  $status = $_POST['status'];
  $notes = $_POST['notes'];

  $query = "INSERT INTO checks ( costume_id, check_date, status, notes)
            VALUES ('$costume_id', '$check_date', '$status', '$notes')";
  if (mysqli_query($conn, $query)) {
    header("Location: check_table.php");
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
<style>
body {
    background-color: #fff7f3;
    font-family: "Muli", sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
    margin: 40px auto;
    background: #ffffff;
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

h2 {
    color: #f57c52;
    text-align: center;
    font-weight: 700;
    margin-bottom: 30px;
}

label {
    color: #333;
    font-weight: 600;
    display: block;
    margin-bottom: 7px;
    font-size: 15px;
}

.input-box {
    width: 100%;
    border: 1px solid #f5b6a5;
    background: #fff8f6;
    padding: 12px;
    font-size: 15px;
    border-radius: 12px;
    margin-bottom: 18px;
    outline: none;
}

.input-box:focus {
    border-color: #f57c52;
    box-shadow: 0 0 0 2px rgba(245,124,82,0.2);
}

.btn-submit {
    width: 100%;
    padding: 12px;
    background-color: #f57c52;
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: 0.3s;
}

.btn-submit:hover {
    background-color: #e0643f;
}

.btn-back {
    display: inline-block;
    background-color: #ef6b57;
    padding: 10px 20px;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-size: 15px;
    margin-bottom: 20px;
}

.btn-back:hover {
    background-color: #d9543e;
}

</style>
<div class="container">

    <a href="check_table.php" class="btn-back">Kembali</a>
    <h2>Tambah Data Pemeriksaan</h2>

    <form method="POST">

        

        <label>ID Kostum:</label>
        <input type="text" name="costume_id" class="input-box" required>

        <label>Tanggal:</label>
        <input type="date" name="check_date" class="input-box" required>

        <label>Status:</label>
        <select name="status" class="input-box">
            
            <option value="unworthy">Rusak</option>
        </select>

        <label>Keterangan:</label>
        <textarea name="notes" class="input-box" style="height: 100px;"></textarea>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
</div>

