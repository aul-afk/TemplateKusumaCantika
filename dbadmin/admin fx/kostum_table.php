<?php
include 'config.php';

// PAGINATION
$limit = 5; // jumlah data per halaman
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// hitung total data
$totalData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM costume"))['total'];
$totalPages = ceil($totalData / $limit);

// query utama untuk costume terbaru
$query = mysqli_query($conn, "SELECT * FROM costume ORDER BY costume_id DESC LIMIT $start, $limit");
$no = $start + 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

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
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind CSS (opsional jika AdminMart belum pakai) -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

<style>
/* ===== STYLE TAMBAHAN UNTUK TABEL AGAR SAMA DENGAN KOSTUM ===== */
.table-container {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.08);
  margin: 20px auto;
  overflow: hidden;
}

.table-header {
  background-color: #f79c7bff; /* Tailwind: bg-blue-600 */
  color: #fff;
  padding: 12px 20px;
  font-size: 1.25rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.table-content {
  width: 100%;
  border-collapse: collapse;
}

.table-content th {
  background-color: #fbb097ff; /* Tailwind: bg-blue-500 */
  color: #fff;
  text-align: left;
  padding: 10px 14px;
  font-weight: 600;
  font-size: 26px;
}

.table-content td {
  padding: 10px 14px;
  border-bottom: 1px solid #ffcbbdff; /* Tailwind: border-gray-200 */
  font-size: 22px;
}

.table-content tr:hover {
  background-color: #f1f5f9; /* Tailwind: bg-gray-100 */
}

.gender-male {
  color: #2563eb;
  font-weight: 500;
}
.gender-female {
  color: #db2777;
  font-weight: 500;
}
table {
        width: 100%;
        border-collapse: collapse;
        font-size: 26px; /* ukuran tulisan isi tabel diperbesar */
    }
th, td {
        padding: 16px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }
.card-body {
        padding: 0 20px 20px 20px;
    }
    .action-btns a {
      padding: 5px 8px;
      margin: 0 3px;
      border-radius: 4px;
      font-size: 12px;
      color: white;
      text-decoration: none;
    }
    .costume-img {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
    }
   .btn-add {
    display: inline-block;
    position: relative;
    margin: 35px auto; /* Biar posisinya di tengah */
    padding: 12px 25px;
    background-color: #F39C75; /* Sesuaikan warna */
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15); /* efek melayang */
    transition: 0.3s ease;
}

/* Efek hover */
.btn-add:hover {
    background-color: #e68b63;
    transform: translateY(-3px); /* supay melayang naik sedikit */
}

/* Efek klik */
.btn-add:active {
    transform: translateY(0px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.box-add {
    background-color: #F39C75;
    display: inline-block;
    padding: 15px 25px;
    border-radius: 10px;
    margin: 20px auto;
}

.btn-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 6px 10px;
  font-size: 13px;
  border-radius: 6px;
  margin-right: 5px;
  text-decoration: none;
  color: white;
  transition: 0.2s ease;
}

.btn-view {
  background-color: #5bc0de;
}
.btn-view:hover {
  background-color: #31b0d5;
}

.btn-edit {
  background-color: #f79c7b;
}
.btn-edit:hover {
  background-color: #f57c52;
}

.btn-delete {
  background-color: #dc3545;
}
.btn-delete:hover {
  background-color: #b02a37;
}

.table-actions {
  text-align: center;
  white-space: nowrap;
}

.pagination-btn {
    display: inline-block;
    padding: 6px 12px;
    margin: 0 3px;
    background-color: #F39C75;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    transition: 0.2s ease;
}

.pagination-btn:hover {
    background-color: #e68b63;
}

.pagination-btn.active {
    background-color: #d46a50;
}
</style>

<!-- ===================== -->
<!-- 💠 DATA PELANGGAN -->
<!-- ===================== -->
<a href="add_costum.php" class="btn-add" style="margin-top: 10px; margin-bottom: -10px;"><i class="fa-solid fa-plus"></i> Tambah Costume</a>
<div class="table-container">
  <div class="table-header"></div>
  <div class="card overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-gray-800">
        <thead>
          <tr class="bg-pink-100 text-left">
            <th class="py-3 px-4">No</th>
            <th class="py-3 px-4">Kategori Kostum</th>
            <th class="py-3 px-4">Nama Kostum</th>
            <th class="py-3 px-4">Ukuran</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4">Ketersediaan</th>
            <th class="py-3 px-4">Gambar</th>
            <th class="py-3 px-4 border-b text-center" style="width:150px;">Aksi</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          <?php
          if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
              echo "
              <tr class='hover:bg-gray-50'>
                <td class='py-3 px-4'>{$no}</td>
                <td class='py-3 px-4'>{$row['costume_category']}</td>
                <td class='py-3 px-4'>{$row['costume_name']}</td>
                <td class='py-3 px-4'>{$row['size']}</td>
                <td class='py-3 px-4 text-blue-600 font-medium'>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                <td class='py-3 px-4'>
                  <span class='px-3 py-1 text-xs rounded-full " . 
                    ($row['availability'] == 'yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') . "'>
                    {$row['availability']}
                  </span>
                </td>
                <td class='py-3 px-4'>
                  <img src='assets/img/{$row['image']}' alt='Costume Image' class='costume-img'>
                </td>
                <td class='action-btns'>
                  <a href='edit_costum.php?id={$row['costume_id']}' class='btn-edit'><i class='fa-solid fa-pen-to-square'></i></a>
                  <a href='delete_costum.php?id={$row['costume_id']}' class='btn-delete' onclick='return confirm(\"Yakin hapus data ini?\")'><i class='fa-solid fa-trash'></i></a>
                </td>
              </tr>
              ";
              $no++;
            }
          } else {
            echo "<tr><td colspan='8' class='text-center py-4 text-gray-500 italic'>Tidak ada data costume</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="btn-space" style="text-align:center; margin-top: 20px;">
<?php if($page > 1): ?>
    <a href="?page=<?= $page-1 ?>" class="pagination-btn">&laquo; Previous</a>
<?php endif; ?>

<?php
$max_links = 5;
$start_link = max(1, $page - floor($max_links/2));
$end_link = min($totalPages, $start_link + $max_links - 1);
if ($end_link - $start_link + 1 < $max_links) {
    $start_link = max(1, $end_link - $max_links + 1);
}
for($i = $start_link; $i <= $end_link; $i++):
    $active = ($i==$page) ? 'active' : '';
?>
    <a href="?page=<?= $i ?>" class="pagination-btn <?= $active ?>"><?= $i ?></a>
<?php endfor; ?>

<?php if($page < $totalPages): ?>
    <a href="?page=<?= $page+1 ?>" class="pagination-btn">Next &raquo;</a>
<?php endif; ?>
</div>