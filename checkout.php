<?php
session_start();
include 'koneksi.php';

//jika blm login, dilarikan ke login.php
if(!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}

//jika blm memasukan barang ke keranjang, maka dilarikan ke index.php
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Anda Belum Memilih Produk Apapun, Silahkan Belanja Dulu');</script>";
    echo "<script>location='index.php';</script>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
        <link rel="stylesheet" href="Admin/assets/css/index.css">
        <script src="admin/assets/js/jquery.min.js"></script>
    </head>
    <body>

    <?php include 'menu.php'; ?>
    <br>
    <br>
    <br>

<section class="konten">
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalberat=0; ?>
                <?php $totalbelanja = 0; ?>
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                <!-- menampilkan produk berdasarkan id_produk -->
                <?php
                $ambil = $koneksi->query("SELECT * FROM produk 
                    WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah['harga_produk']*$jumlah;
                $subberat = $pecah["berat_produk"]*$jumlah;
                $totalberat+=$subberat;
                ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nama_produk'] ?></td>
                    <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp. <?php echo number_format($subharga); ?></td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]
                    ['nama_pelanggan']?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]
                    ['notelp_pelanggan']?>" class="form-control">
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label>Alamat Lengkap Pengiriman</label>
                <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan alamat lengkap anda disini..."></textarea>
            </div>
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control" name="nama_provinsi"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Distrik</label>
                    <select class="form-control" name="nama_distrik"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ekspedisi</label>
                    <select class="form-control" name="nama_ekspedisi"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Paket</label>
                    <select name="nama_paket" class="form-control"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                 <label>Total Berat :</label>
                <input type="text" name="total_berat" readonly value="<?php echo $totalberat; ?>" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Provinsi :</label>
                <input type="text" name="provinsi" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Kabupaten/Kota :</label>
                <input type="text" name="distrik" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Wilayah :</label>&nbsp;
                <input type="text" name="tipe" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Kodepos :</label>
                <input type="text" name="kodepos" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Jenis Ekspedisi :</label>
                <input type="text" name="ekspedisi" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Jenis Paket :</label>
                <input type="text" name="paket" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Ongkir :</label>
                <input type="text" name="ongkir" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Estimasi Sampai :</label>
                <input type="text" name="estimasi" class="form-control" readonly>
                </div>
            </div>
        </div>
            <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>
        <br>
        <br>
        <br>
        <?php
        if (isset($_POST["checkout"]))
        {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];
            $totalberat = $_POST["total_berat"];
            $provinsi = $_POST["provinsi"];
            $distrik = $_POST["distrik"];
            $tipe = $_POST["tipe"];
            $kodepos = $_POST["kodepos"];
            $ekspedisi = $_POST["ekspedisi"];
            $paket = $_POST["paket"];
            $ongkir = $_POST["ongkir"];
            $estimasi = $_POST["estimasi"];

            $total_pembelian = $totalbelanja + $ongkir;

            // 1. simpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (
                id_pelanggan,tanggal_pembelian,total_pembelian,alamat_pengiriman,totalberat,provinsi,
                distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi)
                VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian',
                '$alamat_pengiriman','$totalberat','$provinsi','$distrik','$tipe','$kodepos',
                '$ekspedisi','$paket','$ongkir','$estimasi') ");
            
            //2. mendapatkan id_pembelian
            $id_pembelian_barusan = $koneksi->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
            {
                // mendapatkan data produk berdasarkan id_produk
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil->fetch_assoc();

                $nama = $perproduk['nama_produk'];
                $harga = $perproduk['harga_produk'];
                $berat = $perproduk['berat_produk'];

                $subberat = $perproduk['berat_produk']*$jumlah;
                $subharga = $perproduk['harga_produk']*$jumlah;
                $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,
                berat,subberat,subharga,jumlah)
                VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");

                //script update stok
                $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah
                WHERE id_produk='$id_produk'");
            }

            // mengkosongkan keranjang belanja
            unset($_SESSION["keranjang"]);

            // 3. tampilan dialihkan ke halaman nota pembelian barusan
            echo "<script>alert('Pembelian Sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
        ?>

    </div>
</section>


    </body>
</html>

<script>
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'dataprovinsi.php',
                success:function(hasil_provinsi)
                {
                    $("select[name=nama_provinsi]").html(hasil_provinsi);
                }
            });

            $("select[name=nama_provinsi]").on("change",function(){
                //mengambil id_provinsi yg dipilih
                var id_provinsi_dipilih = $("option:selected",this).attr("id_provinsi");
                $.ajax({
                    type:'post',
                    url:'datadistrik.php',
                    data:'id_provinsi='+id_provinsi_dipilih,
                    success:function(hasil_distrik)
                    {
                        $("select[name=nama_distrik]").html(hasil_distrik);
                    }
                });
            });

            $.ajax({
                type:'post',
                url:'dataekspedisi.php',
                success:function(hasil_ekspedisi)
                {
                    $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
                }
            });

            $("select[name=nama_ekspedisi]").on("change",function(){

                //mendaatkan ekspedisi yang dipilih.
                var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
                //mendapatkan id_distrik yang dipilih.
                var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
                //mendapatkan total berat
                var total_berat = $("input[name=total_berat]").val();
                $.ajax({
                    type:'post',
                    url:'datapaket.php',
                    data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
                    success:function(hasil_paket)
                    {
                        $("select[name=nama_paket]").html(hasil_paket);

                        $("input[name=ekspedisi]").val(ekspedisi_terpilih);
                    }
                })
            });

            $("select[name=nama_distrik]").on("change",function(){
                var prov = $("option:selected",this).attr("nama_provinsi");
                var dist = $("option:selected",this).attr("nama_distrik");
                var tipe = $("option:selected",this).attr("tipe_distrik");
                var kodepos = $("option:selected",this).attr("kodepos");

                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);
            });

            $("select[name=nama_paket]").on("change",function(){
                var paket = $("option:selected",this).attr("paket");
                var ongkir = $("option:selected",this).attr("ongkir");
                var etd = $("option:selected",this).attr("etd");

                $("input[name=paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd); 
            })
        });
    </script>