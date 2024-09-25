<?php
include 'koneksi.php';

// Ambil album ID dari URL
$albumid = $_GET['albumid'];

// Query untuk mengambil foto dari album yang sesuai dan username dari tabel user
$tampil = mysqli_query($conn, "SELECT foto.*, user.username FROM foto INNER JOIN user ON foto.userid = user.userid WHERE foto.albumid='$albumid'");

// Query untuk mengambil informasi album
$album_info = mysqli_fetch_array(mysqli_query($conn, "SELECT namaalbum FROM album WHERE albumid='$albumid'"));
?>

<style>
/* CSS untuk modal pop-up */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.8);
}

.modal img {
    display: block;
    margin: auto;
    max-width: 80%;
    max-height: 80%;
}

.modal:target {
    display: block;
}

.close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}
</style>

<div class="container mt-5">
    <h4>Album: <?= htmlspecialchars($album_info['namaalbum']) ?></h4>
    <div class="row">
        <?php
        // Periksa apakah ada foto yang ditemukan
        if (mysqli_num_rows($tampil) > 0) {
            // Jika ada foto, tampilkan
            foreach ($tampil as $tampils) {
                // Ambil informasi foto dari kolom database
                $file_path = !empty($tampils['namafile']) ? $tampils['namafile'] : 'default.jpg'; // Path ke file foto
                $judul_foto = !empty($tampils['judulfoto']) ? $tampils['judulfoto'] : 'Tidak ada judul'; // Judul foto
                $username = !empty($tampils['username']) ? $tampils['username'] : 'Tidak ada username'; // Username yang mengunggah
                $foto_id = $tampils['fotoid']; // ID foto untuk unique modal
                ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <!-- Menampilkan gambar dari path 'uploads' -->
                        <a href="#modal<?= $foto_id ?>">
                            <img src="uploads/<?= htmlspecialchars($file_path) ?>" alt="<?= htmlspecialchars($judul_foto) ?>" class="card-img-top">
                        </a>
                        <div class="card-body">
                            <!-- Menampilkan judul foto -->
                            <h5 class="card-title"><?= htmlspecialchars($judul_foto) ?></h5>
                            <!-- Menampilkan username pengunggah -->
                            <p class="card-text text-muted">by: <?= htmlspecialchars($username) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Modal Pop-up -->
                <div id="modal<?= $foto_id ?>" class="modal">
                    <a href="#" class="close">&times;</a>
                    <img src="uploads/<?= htmlspecialchars($file_path) ?>" alt="<?= htmlspecialchars($judul_foto) ?>">
                </div>
                <?php
            }
        } else {
            // Jika tidak ada foto, tampilkan pesan
            echo '<p>Tidak ada foto di dalam album ini.</p>';
        }
        ?>
    </div>
</div>
