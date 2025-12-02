<?php
// owner_delete.php
include 'config.php';
if (!isset($_GET['id'])) { header("Location: owner.php"); exit(); }
$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "DELETE FROM owner WHERE owner_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: owner.php");
exit();
