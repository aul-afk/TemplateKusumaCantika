<h2>Tambah Costume</h2>

<form action="/qc-final/public/costume/store" method="POST" enctype="multipart/form-data">

    <label>Kategori</label><br>
    <select name="category" required>
        <option value="">-- pilih kategori --</option>
        <option value="Tari Daerah">Tari Daerah</option>
        <option value="Tokoh wayang">Tokoh wayang</option>
    </select>
    <br><br>

    <label>Nama Costume</label><br>
    <input type="text" name="name" required><br><br>

    <label>Size</label><br>
    <select name="size">
        <option value="">-- pilih size --</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select>
    <br><br>

    <label>Harga</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Availability</label><br>
    <select name="availability">
        <option value="yes" selected>Yes</option>
        <option value="no">No</option>
    </select>
    <br><br>

    <label>Gambar</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Simpan</button>
</form>
