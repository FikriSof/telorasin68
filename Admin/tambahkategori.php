<h2>Tambah Kategori</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save']))
{
    $koneksi->query("INSERT INTO kategori(nama_kategori) VALUES('$_POST[nama]')");
    
    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
}
?>