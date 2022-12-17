   <!-- navbar -->
<nav class="bg-merah navbar-fixed-top">
    <div class="container">
            
        <ul class="nav navbar-nav">
            <li><a class="text-item" href="index.php">TELOR ASIN 68</a></li>
            <li><a class="text-item" href="keranjang.php"> Keranjang</a></li>
            <!-- jika sudah login-->
            <?php if (isset($_SESSION["pelanggan"])): ?>
                <li><a class="text-item" href="riwayat.php">Riwayat Belanja</a></li>
                <li><a class="text-item" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a class="text-item" href="login.php">Login</a></li>
                <li><a class="text-item" href="daftar.php">Daftar</a></li>
            <?php endif ?>
        </ul>

        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword">
            <button class="btn btn-primary">Search</button>
        </form>
    </div>
</nav>