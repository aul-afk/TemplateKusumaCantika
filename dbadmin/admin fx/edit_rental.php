<?php
// edit_rental.php — FULL FORM RENTAL EDIT WITH CSS
include "config.php";

// --- VALIDASI ID AMAN ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id < 1) {
    die("Invalid rental ID.");
}

// --- AMBIL DATA RENTAL ---
$stmt = mysqli_prepare($conn, "SELECT * FROM rental WHERE rental_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if(!$row){ die("Data rental tidak ditemukan."); }

// --- UPDATE DATA ---
if(isset($_POST['update'])){
    $customer_id   = $_POST['customer_id'];
    $costume_id    = $_POST['costume_id'];
    $start_date    = $_POST['start_date'];
    $end_date      = $_POST['end_date'];
    $quantity      = $_POST['quantity'];
    $total_amount  = $_POST['total_amount'];
    $payment_status= $_POST['payment_status'];
    $status        = $_POST['status'];
    $penalty_fee   = $_POST['penalty_fee'];

    $update = mysqli_prepare($conn, "UPDATE rental SET customer_id=?, costume_id=?, start_date=?, end_date=?, quantity=?, total_amount=?, payment_status=?, status=?, penalty_fee=? WHERE rental_id=?");
    mysqli_stmt_bind_param($update, "iissidsssi", $customer_id, $costume_id, $start_date, $end_date, $quantity, $total_amount, $payment_status, $status, $penalty_fee, $id);

    if(mysqli_stmt_execute($update)){
        header("Location: index.php?updated=1");
        exit;
    } else {
        echo "<div class='alert-error'>❌ Error: ".mysqli_error($conn)."</div>";
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Edit Rental</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        background: #fff4ef;
        font-family: "Inter", sans-serif;
        padding: 20px;
    }
    .card {
        max-width: 600px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        animation: fadein .4s ease;
    }
    @keyframes fadein { from {opacity:0;} to {opacity:1;} }

    h2 {
        color: #f47c52;
        font-size: 1.9rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #333;
    }

    input, select {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #f5b8a5;
        background: #fff;
        margin-bottom: 16px;
        font-size: 15px;
        transition: .2s;
    }

    input:focus, select:focus {
        border-color: #f47c52;
        box-shadow: 0 0 0 3px rgba(244,124,82,0.25);
        outline: none;
    }

    .btn-submit {
        background: #f47c52;
        color: white;
        padding: 14px;
        width: 100%;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 700;
        cursor: pointer;
        transition: .25s;
        margin-top: 10px;
    }
    .btn-submit:hover {
        background: #e86435;
    }

    .btn-back {
        display: inline-block;
        background: #f5b8a5;
        padding: 9px 16px;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
        transition: .2s;
    }

    .btn-back:hover {
        background: #e86435;
    }

    .alert {
        background: #d1fae5;
        color: #065f46;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 8px;
        font-weight: 600;
        text-align:center;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 8px;
        font-weight: 600;
        text-align:center;
    }
</style>
</head>
<body>

<div class="card">
    <a href="index.php" class="btn-back">← Kembali</a>

    <h2>Edit Data Rental</h2>

    <form method="POST">
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

        <label>Total Amount</label>
        <input type="number" name="total_amount" value="<?php echo $row['total_amount']; ?>" required>

        <label>Payment Status</label>
        <select name="payment_status">
            <option value="paid"   <?php if($row['payment_status']=='paid') echo 'selected';?>>Paid</option>
            <option value="unpaid" <?php if($row['payment_status']=='unpaid') echo 'selected';?>>Unpaid</option>
        </select>

        <label>Status</label>
        <select name="status">
            <option value="booked"   <?php if($row['status']=='booked') echo 'selected';?>>Booked</option>
            <option value="borrowed" <?php if($row['status']=='borrowed') echo 'selected';?>>Borrowed</option>
            <option value="returned" <?php if($row['status']=='returned') echo 'selected';?>>Returned</option>
        </select>

        <label>Penalty Fee</label>
        <input type="number" name="penalty_fee" value="<?php echo $row['penalty_fee']; ?>">

        <button type="submit" name="update" class="btn-submit">Update Data</button>

   <script>
    const qty = document.querySelector('input[name="quantity"]');
    const total = document.querySelector('input[name="total_amount"]');

    const originalUnit = <?php echo ($row['total_amount'] / max($row['quantity'],1)); ?>;

qty.addEventListener('input', () => {
        let q = parseFloat(qty.value) || 0;
        total.value = (originalUnit * q).toFixed(0);
    });('input', () => {
        let q = parseFloat(qty.value) || 0;
        let t = parseFloat(total.value) || 0;
        let unit = t / (<?php echo $row['quantity']; ?> || 1);
        total.value = (unit * q).toFixed(0);
    });
</script>
    </form>
</div>


</body>
</html>
