<!-- delete_rental.php -->
<?php
include "config.php";

$id = $_GET['id'];
$query = "DELETE FROM rental WHERE rental_id='$id'";

if(mysqli_query($conn, $query)){
    echo "Data berhasil dihapus!";
} else {
    echo "Error: " . mysqli_error($conn);
}

header("Location: index.php");
?>
