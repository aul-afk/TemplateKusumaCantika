<h2>Edit Costume</h2>

<form action="/qc-final/public/costume/update/<?= $item['costume_id'] ?>" method="POST" enctype="multipart/form-data">

    <label>Kategori</label><br>
    <select name="category" required>
        <option value="Tari Daerah" <?= $item['costume_category']=='Tari Daerah'?'selected':'' ?>>Tari Daerah</option>
        <option value="Tokoh wayang" <?= $item['costume_category']=='Tokoh wayang'?'selected':'' ?>>Tokoh wayang</option>
    </select>
    <br><br>

    <label>Nama Costume</label><br>
    <input type="text" name="name" value="<?= $item['costume_name'] ?>" required><br><br>

    <label>Size</label><br>
    <select name="size">
        <option value="">-- pilih size --</option>
        <option value="S" <?= $item['size']=='S'?'selected':'' ?>>S</option>
        <option value="M" <?= $item['size']=='M'?'selected':'' ?>>M</option>
        <option value="L" <?= $item['size']=='L'?'selected':'' ?>>L</option>
        <option value="XL" <?= $item['size']=='XL'?'selected':'' ?>>XL</option>
    </select>
    <br><br>

    <label>Harga</label><br>
    <input type="number" step="0.01" name="price" value="<?= $item['price'] ?>"><br><br>

    <label>Availability</label><br>
    <select name="availability">
        <option value="yes" <?= $item['availability']=='yes'?'selected':'' ?>>Yes</option>
        <option value="no" <?= $item['availability']=='no'?'selected':'' ?>>No</option>
    </select>
    <br><br>

    <label>Gambar Saat Ini</label><br>
    <?php if ($item['image']) : ?>
        <img src="/qc-final/uploads/<?= $item['image'] ?>" width="70"><br>
    <?php endif; ?>

    <br>
    <label>Ganti Gambar (opsional)</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>
</form>
