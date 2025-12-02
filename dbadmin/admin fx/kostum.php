<?php
include 'config.php';
$editData = null;

if (isset($_POST['edit_button'])) {
    $editData = [
        'costume_category' => $_POST['costume_category'],
        'costume_name' => $_POST['costume_name'],
        'size' => $_POST['size'],
        'price' => $_POST['price'],
        'availability' => $_POST['availability'],
        'image' => $_POST['image']
    ];
}
if (isset($_POST['update_button'])) {
    $old = $_POST['old_name'];

    mysqli_query($conn, "UPDATE owner SET
        costume_category='{$_POST['new_category']}',
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
                 <li class="active">
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
                    <a class="navbar-brand" href="#">Data Kostum</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind CSS (opsional jika AdminMart belum pakai) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<iframe 
      src="kostum_table.php" 
      style="width: 100%; height: 100vh; border: none;">
</iframe>