<?php
$conn = new mysqli("localhost", "root", "", "qc"); 
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// CSS untuk tampilan rapi
echo '<style>
h2.section-title { text-align:center; margin-bottom:30px; font-size:28px; }
ul.costume-list { list-style:none; padding:0; max-width:800px; margin:0 auto; }
ul.costume-list li { display:flex; align-items:center; padding:15px; border:1px solid #ddd; border-radius:10px; margin-bottom:15px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
ul.costume-list li img { width:150px; height:150px; object-fit:cover; border-radius:10px; margin-right:20px; }
.item-content { flex:1; }
.item-content h3 { margin:0 0 5px 0; font-size:18px; }
.item-content span.price { color:#e74c3c; font-weight:bold; display:block; margin-bottom:5px; }
.item-content span.info { display:block; margin-bottom:3px; font-size:14px; color:#555; }
.item-content span.counter { font-weight:bold; display:block; margin-bottom:5px; }
</style>';

// Ambil data costume
$sql = "SELECT * FROM costume ORDER BY costume_id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<ul class="costume-list">';

    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<li>';
        // gambar costume
        $imgSrc = '/TemplateKusumaCantika-main/qc-final/images/' . $row['image'];
        echo '<img src="'.$imgSrc.'" alt="'.htmlspecialchars($row['costume_name']).'">';
        
        // konten info
        echo '<div class="item-content">';
        echo '<span class="counter">'.$counter.'.</span>';
        echo '<h3>'.htmlspecialchars($row['costume_category']).'<h3>';
        echo '<h3>'.htmlspecialchars($row['costume_name']).'</h3>';
        echo '<span class="price">Rp '.number_format($row['price'],0,",",".").'</span>';
        echo '<span class="info">Ukuran: '.htmlspecialchars($row['size']).'</span>';
        echo '<span class="info">Ketersediaan: '.htmlspecialchars($row['availability']).'</span>';
        echo '</div>';

        echo '</li>';
        $counter++;
    }

    echo '</ul>';
} else {
    echo "<p>Tidak ada data costume untuk ditampilkan.</p>";
}

$conn->close();
?>
