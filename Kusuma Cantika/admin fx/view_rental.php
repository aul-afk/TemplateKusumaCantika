<?php
include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Rental</title>
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

<h2>Data Rental</h2>
<a href="add_rental.php" class="add">Tambah Rental</a>

<table>
    <tr>
        <th>No</th>
        <th>Rental ID</th>
        <th>Customer ID</th>
        <th>Costume ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Quantity</th>
        <th>Total Amount</th>
        <th>Payment Status</th>
        <th>Status</th>
        <th>Penalty Fee</th>
        <th>Actions</th>
    </tr>

<?php
$query = mysqli_query($conn, "SELECT * FROM rental");
$no = 1;

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>".$no++."</td>";
        echo "<td>".$row["rental_id"]."</td>";
        echo "<td>".$row["customer_id"]."</td>";
        echo "<td>".$row["costume_id"]."</td>";
        echo "<td>".$row["start_date"]."</td>";
        echo "<td>".$row["end_date"]."</td>";
        echo "<td>".$row["quantity"]."</td>";
        echo "<td>Rp ".number_format($row["total_amount"], 2, ',', '.')."</td>";

        $paymentClass = ($row["payment_status"] == 'paid') ? 'payment-paid' : 'payment-unpaid';
        echo "<td class='$paymentClass'>".ucfirst($row["payment_status"])."</td>";

        $statusClass = 'status-' . $row["status"];
        echo "<td class='$statusClass'>".ucfirst($row["status"])."</td>";

        echo "<td>Rp ".number_format($row["penalty_fee"], 2, ',', '.')."</td>";

        echo "<td>
                <a href='edit_rental.php?id=".$row['rental_id']."' class='edit'>Edit</a> 
                <a href='delete_rental.php?id=".$row['rental_id']."' class='delete' onclick='return confirm(\"Yakin mau dihapus?\")'>Delete</a>
              </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>Tidak ada data rental</td></tr>";
}
$conn->close();
?>
</table>

</body>
</html>
