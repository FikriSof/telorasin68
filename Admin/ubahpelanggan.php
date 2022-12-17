<h2>Ubah Pelanggan</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $pecah[
            'email_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Pelanggan</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah[
            'nama_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="pass" value="<?php echo $pecah[
            'password_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Telepon</label>
        <input type="number" class="form-control" name="notelp" value="<?php echo $pecah[
            'notelp_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" value="<?php echo $pecah[
            'alamat_pelanggan']; ?>">
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah']))
{
        $koneksi->query("UPDATE pelanggan SET email_pelanggan='$_POST[email]',
        nama_pelanggan='$_POST[nama]',password_pelanggan='$_POST[pass]',
        notelp_pelanggan='$_POST[notelp]', alamat_pelanggan='$_POST[alamat]' WHERE id_pelanggan='$_GET[id]'");

    echo "<script>alert('Data Pelanggan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}
?>