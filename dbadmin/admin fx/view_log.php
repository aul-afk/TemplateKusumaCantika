<?php
include 'config.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT log_costume.*, costume.costume_name
    FROM log_costume
    JOIN costume ON costume.costume_id = log_costume.costume_id
    WHERE log_costume.costume_id = '$id'
");

if (mysqli_num_rows($query) == 0) {
    echo "<p class='text-center text-gray-500 py-4'>Tidak ada log untuk costume ini.</p>";
    exit;
}

echo "<table class='table table-bordered'>
        <tr>
            <th>Log ID</th>
            <th>Nama Costume</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Tanggal Check</th>
        </tr>";

while ($row = mysqli_fetch_assoc($query)) {
    echo "
        <tr>
            <td>{$row['log_id']}</td>
            <td>{$row['costume_name']}</td>
            <td>{$row['status']}</td>
            <td>{$row['notes']}</td>
            <td>{$row['check_date']}</td>
        </tr>
    ";
}

echo "</table>";
?>