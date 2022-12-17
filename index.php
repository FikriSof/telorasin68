<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Toko TelorAsin68</title>
    <link rel="stylesheet" href="Admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/assets/css/index.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="jumbotron banner">
    <div class="container">
      <hgroup>
        <h1 class="text-merah">
          TELORASIN68
        </h1>
        <h2 class="text-abu">
          Menyediakan Jajanan Daerah Dan Kerajinan Tangan
        </h2>
      </hgroup>
    </div>
</div>
<br>
<br>

<!-- konten -->
<section class="konten">
    <div class="container">
        <h1 class="text-center">DAFTAR PRODUK</h1><br>

        <div class="row">
            
            <?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
            <?php while($perproduk = $ambil->fetch_assoc()){ ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="img_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" class="img-responsive">
                    <div class="caption">
                        <h3><?php echo $perproduk['nama_produk']; ?></h3>
                        <h4>Stok: <?php echo $perproduk['stok_produk']; ?></h4>
                        <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                        <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="
                        btn btn-primary">Beli</a>
                        <a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" 
                        class="btn btn-default">Detail</a>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
</section>



</body>
</html>