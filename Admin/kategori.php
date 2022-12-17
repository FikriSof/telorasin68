<h2>Data Kategori</h2>
<hr>

<table class="table table-bordered">
    <thead>
        <th>No</th>
        <td>Kategori</td>
        <td>Aksi</td>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM kategori"); ?>
        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_kategori']; ?></td>
            <td>
                <a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" ></i> Hapus</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>