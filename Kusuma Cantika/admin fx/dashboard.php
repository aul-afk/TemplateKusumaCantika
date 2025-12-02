<?php
include 'config.php';
// Total semua kostum
$total_costume = mysqli_fetch_assoc(mysqli_query(
    $conn, "SELECT COUNT(*) AS total FROM costume"
))['total'];

// Kostum tersedia
$available_costume = mysqli_fetch_assoc(mysqli_query(
    $conn, "SELECT COUNT(*) AS total FROM costume WHERE availability = 'yes'"
))['total'];

// Kostum perawatan
$maintenance_costume = mysqli_fetch_assoc(mysqli_query(
    $conn, "SELECT COUNT(*) AS total FROM checks WHERE status = 'maintenance'"
))['total'];

// Pendapatan bulan ini
$income_month = mysqli_fetch_assoc(mysqli_query(
    $conn, "SELECT SUM(total_amount) AS total FROM rental 
            WHERE MONTH(start_date) = MONTH(CURRENT_DATE())
            AND YEAR(start_date) = YEAR(CURRENT_DATE())"
))['total'];
if ($income_month == null) $income_month = 0;

$query = $conn->query("
    SELECT 
        MONTH(start_date) AS bulan,
        COUNT(*) AS total
    FROM rental
    GROUP BY MONTH(start_date)
    ORDER BY bulan ASC
");

$bulan = [];
$total = [];

$namaBulanIndo = [
    1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
    5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
    9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

while ($row = $query->fetch_assoc()) {
    $bulan[] = $namaBulanIndo[$row['bulan']];
    $total[] = $row['total'];
}

?>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        /* KOTAK INFORMASI */
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .stat-card {
            width: 23%;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-title {
            font-size: 18px;
            color: #444;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
            color: #222;
        }

        /* GRAFIK */
        .chart-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        #rentalChart {
    width: 100% !important;
    height: 320px !important; 
    
}
#chartPenyewaan {
    max-width: 650px;
    height: 320px;
    margin: auto;
}
.stats-container {
    display: flex;
    gap: 20px;
    margin: 20px 30px;
}

.stat-card {
    flex: 1;
    background: #fff;
    padding: 22px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    gap: 18px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: #ffe7d1;
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    color: #ff7b00;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-title {
    font-size: 15px;
    color: #666;
    font-weight: 600;
}

.stat-value {
    font-size: 32px;
    font-weight: bold;
    margin-top: 3px;
    color: #333;
}


    </style>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind CSS (opsional jika AdminMart belum pakai) -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <img src="kusuma.jpg" alt="" width="80" />
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="rental.php">
                        <i class="ti-tag"></i>
                        <p>Rental</p>
                    </a>
                </li>
                <li>
                    <a href="check.php">
                        <i class="ti-check"></i>
                        <p>Check</p>
                    </a>
                </li>
                  <li>
                    <a href="kostum.php">
                       <i class="fa-solid fa-shirt"></i>
                        <p>Kostum</p>
                    </a>
                </li>
                <li>
                    <a href="pelanggan.php">
                        <i class="fa-solid fa-users"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>
                <li>
                    <a href="owner.php">
                        <i class="ti-user"></i>
                        <p>Admin</p>
                    </a>
                </li>
                <li>
                    <a href="logout.html">
                       <i class="fas fa-sign-out-alt"></i> 
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                             
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <body>

<!-- 4 KOTAK INFO -->
<div class="stats-container">

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-shirt"></i></div>
        <div class="stat-content">
            <div class="stat-title">Total Costume</div>
            <div class="stat-value"><?= $total_costume ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-box-open"></i></div>
        <div class="stat-content">
            <div class="stat-title">Costume Tersedia</div>
            <div class="stat-value"><?= $available_costume ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <div class="stat-content">
            <div class="stat-title">Costume Perawatan</div>
            <div class="stat-value"><?= $maintenance_costume ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
        <div class="stat-content">
            <div class="stat-title">Pendapatan Bulan Ini</div>
            <div class="stat-value">Rp <?= number_format($income_month, 0, ',', '.') ?></div>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="chart-box">
    <h4 style="text-align:center; margin-bottom:10px;">Grafik Penyewaan Costume per Bulan</h4>
    <canvas id="chartPenyewaan"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('chartPenyewaan').getContext('2d');

var chartPenyewaan = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($bulan); ?>,
        datasets: [{
            label: 'Jumlah Penyewaan',
            data: <?php echo json_encode($total); ?>,
            borderWidth: 2,
            backgroundColor: [
               
                'rgba(255,99,71,0.6)',
             
            ],
            borderColor: 'rgba(0,0,0,0.3)'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        },
        plugins: {
            legend: { display: true },
            tooltip: { enabled: true }
        }
    }
    
});
</script>






</body>
</html>
