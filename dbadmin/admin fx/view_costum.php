<?php
include 'config.php';

$cid = $_GET['id'];

// Ambil nama costume
$costume = mysqli_query($conn, "SELECT costume_name FROM costume WHERE costume_id = '$cid'");
$c = mysqli_fetch_assoc($costume);

// Ambil log costume
$logs = mysqli_query($conn, "
    SELECT lc.*, c.costume_name
    FROM log_costume lc
    JOIN costume c ON lc.costume_id = c.costume_id
    WHERE lc.costume_id = '$cid'
    ORDER BY lc.log_id DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Costume - <?= $c['costume_name'] ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
body {
    background-color: #fff7f5;
    font-family: 'Segoe UI', sans-serif;
}

/* Wrapper card */
.log-container {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    padding: 20px;
    margin-top: 20px;
}

/* Title */
.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #f57c52; 
}

/* Tombol kembali */
.btn-back {
    background-color: #f79c7bff;
    color: white;
    border-radius: 6px;
    font-weight: 600;
    padding: 8px 16px;
    border: none;
}
.btn-back:hover {
    background-color: #f57c52;
}

/* Tabel */
.table {
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    font-size: 16px;
}

.table thead {
    background-color: #fbb097ff;
    color: white;
    font-weight: 600;
}

.table tbody tr:hover {
    background-color: #fff0eb;
    transition: 0.2s ease;
}

.table td, .table th {
    padding: 14px;
    border-bottom: 1px solid #ffcbbdff;
    vertical-align: middle;
    text-align: center;
}

/* Status badge (optional kalau mau) */
.status-badge {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    color: white;
    font-weight: 600;
}
.status-ok { background-color: #4ade80; }
.status-problem { background-color: #f87171; }
</style>

</head>
<body class="p-4">

<div class="container">

    <h3 class="page-title mb-3">Log Costume: <b><?= $c['costume_name'] ?></b></h3>

    <a href="kostum_table.php" class="btn btn-back mb-4">Kembali</a>

    <div class="log-container">

        <table class="table">
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Kostum</th>
                    <th>Check ID</th>
                    <th>Tanggal Cek</th>
                    <th>Status</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($logs)): ?>
                <tr>
                    <td><?= $row['log_id'] ?></td>
                    <td><?= $row['costume_name'] ?></td>
                    <td><?= $row['check_id'] ?></td>
                    <td><?= $row['check_date'] ?></td>
                    <td>
                        <span class="status-badge 
                            <?= ($row['status'] == 'OK') ? 'status-ok' : 'status-problem' ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                    <td><?= $row['notes'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

</div>

</body>



</html>
