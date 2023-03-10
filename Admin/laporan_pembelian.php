<?php
$semuadata=array();
$tgl_mulai="";
$tgl_selesai="";
$status = "";
if (isset($_POST['kirim']))
{
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $status = $_POST["status"];
    $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON
    pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while($pecah = $ambil->fetch_assoc())
    {
        $semuadata[]=$pecah;
    }
    //echo "<pre>";
    //print_r($semuadata);
    //echo "</pre>";
}
?>


<h2>Laporan Pembelian</h2>
<strong>Dari <?php echo $tgl_mulai ?> Hingga <?php echo $tgl_selesai ?></strong><br>
<hr>

<form method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
            </div>
        </div>  
        <div class="col-md-3">
        <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
            </div>
        </div>  
        <div class="col-md-3">
        <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="">Pilih Status</option>
                    <option value="DIPROSES" <?php echo $status=="DIPROSES"?"selected":""; ?> >BARANG SEDANG DIPROSES</option>
                    <option value="DIKIRIM" <?php echo $status=="DIKIRIM"?"selected":""; ?> >BARANG SEDANG DIKIRIM</option>
                    <option value="SELESAI" <?php echo $status=="SELESAI"?"selected":""; ?> >SELESAI</option>
                    <option value="DIBATALKAN" <?php echo $status=="DIBATALKAN"?"selected":""; ?> >DIBATALKAN</option>
                </select>
            </div>
        </div>  
        <div class="col-md-3">
            <label>&nbsp;</label> <br>
            <button class="btn btn-primary" name="kirim"><i class="fa fa-eye" ></i> Lihat</button>
        </div>  
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach ($semuadata as $key => $value): ?>
        <?php $total+=$value['total_pembelian'] ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value['nama_pelanggan'] ?></td>
            <td><?php echo date("d F Y",strtotime($value["tanggal_pembelian"])); ?></td>
            <td><?php echo $value['status_pembelian'] ?></td>
            <td>Rp. <?php echo number_format($value['total_pembelian']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp. <?php echo number_format($total) ?></th>
        </tr>
    </tfoot>
</table>

<a href="download_laporan.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai?>&status=<?php echo $status?>">Download PDF</a>