<?php
session_start();
include 'koneksi.php';
?>
<?php
//mendapatkan id_produk dari url
$id_produk = $_GET["id"];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detail);
//echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="Admin/assets/css/index.css">
</head>
<body>

<?php include 'menu.php'; ?>
<br>
<br>
<br>
<br>
<br>

<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img_produk/<?php echo $detail["foto_produk"]; ?>" width="500" height="450" alt="" 
                class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2><?php echo $detail["nama_produk"] ?></h2>
                <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

                <h5>Stok: <?php echo $detail['stok_produk'] ?></h5>

                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" value="<?php echo $detail['stok_produk'] ?>" min="1" class="form-control" name="jumlah" 
                            max="<?php echo $detail['stok_produk'] ?>">
                            <div class="input-group-btn">
                                <button class="btn btn-success" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                //jika ada tombol beli
                if (isset($_POST["beli"]))
                {
                    //mendapatkan jumlah yang diinput
                    $jumlah = $_POST["jumlah"];
                    //masukan ke keranjang belanja
                    $_SESSION["keranjang"]["$id_produk"] = $jumlah;
                    echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
                ?><br>
                <h4>Deskripsi : </h4>
                <p><?php echo $detail["desc_produk"]; ?></p>
            </div>
        </div>
    </div>
</section>

</body>
</html>