<?php
session_start();
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
WHERE pembelian.id_pembelian='$id_pembelian'");
$detailbayar = $ambil->fetch_assoc();

//echo "<pre>";
//print_r ($detailbayar);
//echo "</pre>";

//jika blm ada data pembayaran
if (empty($detailbayar))
{
    echo "<script>alert('Tidak Ada Data Pembayaran')</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

//jika ada data pelanggan yg bayar tidak sesuai dengan yg login
//echo "<pre>";
//print_r ($_SESSION);
//echo "</pre>";
if ($_SESSION['pelanggan']['id_pelanggan']!==$detailbayar['id_pelanggan'])
{
    echo "<script>alert('Anda Tidak Punya Hak Untuk Akses')</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/assets/css/index.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <br>
    <br>
    <br>

    <div class="container">
        <h3>Lihat Pembayaran</h3>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $detailbayar['nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?php echo $detailbayar['bank'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo date("d F Y",strtotime($detailbayar['tanggal'])); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?php echo number_format($detailbayar['jumlah']) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti_pembayaran/<?php echo $detailbayar['bukti'] ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</body>
</html>