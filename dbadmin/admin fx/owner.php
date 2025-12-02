<?php
include 'config.php';
$editData = null;

if (isset($_POST['edit_button'])) {
    $editData = [
        'owner_name' => $_POST['owner_name'],
        'phone_number' => $_POST['phone_number'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];
}
if (isset($_POST['update_button'])) {
    $old = $_POST['old_name'];

    mysqli_query($conn, "UPDATE owner SET
        owner_name='{$_POST['new_name']}',
        phone_number='{$_POST['new_phone']}',
        email='{$_POST['new_email']}',
        address='{$_POST['new_address']}'
    WHERE owner_name='$old'");

   echo "<script>
    setTimeout(function(){
        alert('Data berhasil diupdate');
    }, 200);
    window.location='owner.php';
</script>";


}
if (isset($_POST['cancel_edit'])) {
    $editData = null; // tutup form edit
}



?>

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
                <li>
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Data Admin</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                    </ul>

                </div>
            </div>
        </nav>
       <?php if ($editData) { ?>
<div class="edit-card">
    <h3 class="edit-title">Edit Data Owner</h3>

    <!-- 🔙 Tombol Kembali -->
    <form method="POST" style="margin-bottom: 10px;">
        <button type="submit" name="cancel_edit" 
            style="
                background:#ef4444;
                color:white;
                padding:8px 14px;
                border:none;
                border-radius:8px;
                cursor:pointer;
                margin-bottom:15px;
            ">
            Kembali
        </button>
    </form>

    <form method="POST" class="edit-form">

        <input type="hidden" name="old_name" value="<?= $editData['owner_name'] ?>">

        <label>Nama Owner</label>
        <input type="text" name="new_name" value="<?= $editData['owner_name'] ?>">

        <label>No Telepon</label>
        <input type="text" name="new_phone" value="<?= $editData['phone_number'] ?>">

        <label>Email</label>
        <input type="text" name="new_email" value="<?= $editData['email'] ?>">

        <label>Alamat</label>
        <input type="text" name="new_address" value="<?= $editData['address'] ?>">

        <button type="submit" name="update_button" class="btn-save">Simpan Perubahan</button>
    </form>
</div>
<?php } ?>



        <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind CSS (opsional jika AdminMart belum pakai) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    /* === FORM EDIT STYLING (BIAR SERAGAM) === */
.edit-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 20px 25px;
  margin: 25px;
  border-left: 6px solid #f79c7bff; /* warna oranye sama header */
}

.edit-title {
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #f07954;
}

.edit-form label {
  font-weight: 600;
  color: #444;
}

.edit-form input {
  width: 100%;
  padding: 10px 12px;
  margin-bottom: 15px;
  font-size: 15px;
  border: 1px solid #ffcbbdff;
  border-radius: 8px;
  background: #fff8f6;
  transition: 0.2s;
}

.edit-form input:focus {
  border-color: #f79c7bff;
  background: #fff;
  outline: none;
  box-shadow: 0 0 4px rgba(247, 156, 123, 0.5);
}

.btn-save {
  background: #f79c7bff;
  color: white;
  padding: 10px 14px;
  font-size: 14px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: 0.2s;
}

.btn-save:hover {
  background: #f06f3fff;
  transform: translateY(-2px);
}

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
  font-size: 0.95rem;
}

.table-content td {
  padding: 10px 14px;
  border-bottom: 1px solid #ffcbbdff; /* Tailwind: border-gray-200 */
  font-size: 0.9rem;
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
.action { text-align:center; }
.btn-action { display:inline-block; padding:6px 9px; border-radius:6px; color:#fff; text-decoration:none; margin:2px; font-size:0.9rem; }
.view { background:#3b82f6; } .edit { background:#10b981; } .del { background:#ef4444; }
.btn-action:hover { opacity:0.9; transform:translateY(-1px); }
.empty { text-align:center; padding:20px; color:#777; }
.page-title {
  background-color: #f7f5f0;
  padding: 20px;
}
.page-title {
  background-color: #f7f5f0;
  padding: 20px;
}

.table-header {
  background-color: #f59573;
  color: white;
  font-weight: bold;
  padding: 15px 20px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

/* tombol di kiri antara judul & header oranye */
.btn-action { display:inline-block; padding:6px 9px; border-radius:6px; color:#fff; text-decoration:none; margin:0 2px; font-size:0.85rem; }
.view { background:#3b82f6; } 
.edit { background:#10b981; } 
.del { background:#ef4444; }
.btn-action:hover { opacity:0.9; transform:translateY(-1px); transition:0.2s; }
.empty { text-align:center; padding:20px; color:#777; }
</style>
<div class="table-container">
  <div class="table-header">
  </div>
 


        <!-- Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="bg-pink-100 text-black-800 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 border-b">Nama Owner</th>
                        <th class="py-3 px-4 border-b">No. Telepon</th>
                        <th class="py-3 px-4 border-b">Email</th>
                        <th class="py-3 px-4 border-b">Alamat</th>
                        <th class="py-3 px-4 border-b text-center" style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
              $query = "SELECT * FROM owner";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "
                      <tr class='hover:bg-gray-50'>
                          <td class='py-3 px-4 border-b text-center font-medium text-gray-700'>{$row['owner_name']}</td>
                          <td class='py-3 px-4 border-b text-center'>{$row['phone_number']}</td>
                          <td class='py-3 px-4 border-b text-center'>{$row['email']}</td>
                          <td class='py-3 px-4 border-b text-center'>{$row['address']}</td>
                            <td class='py-3 px-4 border-b text-center'>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='owner_name' value='{$row['owner_name']}'>
                                    <input type='hidden' name='phone_number' value='{$row['phone_number']}'>
                                    <input type='hidden' name='email' value='{$row['email']}'>
                                    <input type='hidden' name='address' value='{$row['address']}'>
                                    <button type='submit' name='edit_button' class='btn-action edit'><i class='fa-solid fa-pen-to-square'></i></button>
                                </form>
                            </td>
                      </tr>
                      ";
                  }
              } else {
                  echo "<tr><td colspan='6' class='py-4 text-center text-gray-500'>Tidak ada data owner</td></tr>";
              }
              ?>
                </tbody>
            </table>
        </div>
    </div>