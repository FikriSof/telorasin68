<h2>Data Produk</h2>
<br>
<div class="pull-right" style="margin-bottom: 10px;">
<a href="index.php?halaman=tambahproduk" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>KATEGORI</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>BERAT</th>
            <th>FOTO</th>
            <th>DESKRIPSI</th>
            <th>STOK</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_kategori']; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td><?php echo $pecah['harga_produk']; ?></td>
            <td><?php echo $pecah['berat_produk']; ?></td>
            <td>
                <img src="../img_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
            </td>
            <td><?php echo $pecah['desc_produk']; ?></td>
            <td><?php echo $pecah['stok_produk']; ?></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" 
                class="btn btn-danger" onclick="return confirm('Yakin Menghapus Produk Ini?')"><i class="glyphicon glyphicon-trash" ></i> Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" 
                class="btn btn-warning"><i class="glyphicon glyphicon-edit" ></i> Ubah</a>
                <a href="index.php?halaman=detailproduk&id=<?php echo $pecah['id_produk']; ?>" 
                class="btn btn-info"><i class="fa fa-eye" ></i> Detail</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>

    </tbody>
</table>
