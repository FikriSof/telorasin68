<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nota Pembelian</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
        <link rel="stylesheet" href="Admin/assets/css/index.css">
    </head>
    <body>

<?php include 'menu.php'; ?> 
<br>
<br>
<br>

<section class="konten">
    <div class="container">
        
    <!-- nota disini copas dari admin-->
    <h2>NOTA PEMBELIAN</h2>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>
        <h3 class="glyphicon glyphicon-barcode"></h3>

<?php
$ambil = $koneksi->query("SELECT * FROM pembelian 
    JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php-->
<?php 
//mendapatkan id_pelanggan yg beli
$idpelangganbeli = $detail["id_pelanggan"];

//mendapatkan id_pelanggan yg login
$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganbeli!==$idpelangganlogin)
{
    echo "<script>alert('Error!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<div class="row">
    <div class="col-md-4">
        <h3>Data Pembelian</h3>
        <strong>No. Order : <?php echo $detail['id_pembelian'] ?></strong><br>
        Tanggal : <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
        Total : Rp. <?php echo number_format($detail['total_pembelian']) ?>
    </div>
    <div class="col-md-4">
        <h3>Data Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            <?php echo $detail['notelp_pelanggan']; ?> <br>
            <?php echo $detail['email_pelanggan']; ?> 
        </p>
    </div>
    <div class="col-md-4">
        <h3>Data Pengiriman</h3>
        <strong><?php echo $detail['tipe']; ?> <?php echo $detail['distrik']; ?> <?php echo $detail['provinsi']; ?></strong> <br>
        Ongkos Kirim : Rp. <?php echo number_format($detail['ongkir']); ?> <br>
        Ekspedisi : <?php echo $detail['ekspedisi']; ?>  <?php echo $detail['paket']; ?> <?php echo $detail['estimasi']; ?><br>
        Alamat : <?php echo $detail['alamat_pengiriman']; ?>
    </div>
</div>

<table  class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Subberat</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>  
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah=$ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo $pecah['berat']; ?> Gr.</td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td><?php echo $pecah['subberat']; ?> Gr.</td>
            <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>    

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>
                Silahkan melakukan pembayaran sebesar Rp. <?php 
                echo number_format($detail['total_pembelian']); ?>
                ke <br> <strong>BANK MANDIRI .........</strong>
            </p>
        </div>
    </div>
</div>

    </div>
</section>

    </body>
</html>