<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan login dulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

//mendapatkan id_pembelian dari url
$idpembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpembelian'");
$detailpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yg beli
$id_pelanggan_beli = $detailpem["id_pelanggan"];
//mendapatkan id_pelanggan yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli)
{
    echo "<script>alert('Error!!!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/assets/css/index.css">
</head>
<body>
<br>
<br>
<br>
    
<?php include 'menu.php'; ?>
<div class="container">
    <h2>Konfirmasi Pembayaran</h2>
    <p>Kirim bukti pembayaran disini</p>
    <div class="alert alert-info">Total Tagihan Pembayaran Anda <strong>Rp. 
        <?php echo number_format($detailpem["total_pembelian"]) ?></strong></div>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label>Bank</label>
            <input type="text" class="form-control" name="bank">
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="1">
        </div>
        <div class="form-group">
            <label>Bukti Foto Pembayaran</label>
            <input type="file" class="form-control" name="bukti">
            <p class="text-danger">Format bukti foto harus .JPG/PNG maksimal 2MB</p>
        </div>
        <button class="btn btn-primary" name="kirim">Kirim</button>
    </form>
</div>

<?php
//kirim button
if (isset($_POST["kirim"]))
{
    //upload foto bukti pembayaran
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafix = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    //menyimpan pembayaran
    $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
    VALUES ('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafix')");

    //update data pembelian dari pending menjadi sudah tf
    $koneksi->query("UPDATE pembelian SET status_pembelian='MENUNGGU KONFIRMASI'
    WHERE id_pembelian='$idpembelian'");

    echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

</body>
</html>