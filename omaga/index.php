<?php include 'koneksi.php'; session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Gallery Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
  .navbar-gradient {
    background: linear-gradient(135deg, #6e8efb, #a777e3);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow agar navbar terlihat mengambang */
    border-bottom: 2px solid rgba(255, 255, 255, 0.2); /* Memberikan garis bawah yang halus */
  }
  .navbar-nav .nav-link {
    color: white !important;
    transition: color 0.3s ease, transform 0.3s ease; /* Efek transisi saat hover */
  }
  .navbar-nav .nav-link:hover {
    color: #ffd700 !important; /* Ubah warna teks saat hover menjadi warna emas */
    transform: scale(1.1); /* Membesarkan sedikit ukuran teks saat di-hover */
  }
  .navbar-brand {
    color: white !important;
    font-weight: bold; /* Memberikan efek bold pada brand */
    font-size: 1.5rem; /* Membuat ukuran font lebih besar untuk brand */
  }
  .navbar-toggler {
    border-color: white; /* Mengubah warna border tombol navbar */
  }
  .navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=UTF8,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 viewBox%3D%220 0 30 30%22%3E%3Cpath stroke%3D%22white%22 stroke-width%3D%222%22 stroke-linecap%3D%22round%22 stroke-miterlimit%3D%2210%22 d%3D%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E'); /* Mengubah warna ikon navbar toggle menjadi putih */
  }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-gradient">
  <div class="container">
    <a class="navbar-brand" href="?url=home">Gallery Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="?url=home">Home</a>
        </li>
        <?php if(isset($_SESSION['userid'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="?url=upload">Upload</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?url=album">Album</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?url=profile"><?= ucwords($_SESSION['username']) ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?url=logout">Logout</a>
        </li>
        <?php else:?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daftar.php">Daftar</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php 
$url = @$_GET["url"];
if($url=='home'){
  include 'page/home.php';
}elseif($url=='profile'){
  include 'page/profil.php';
}elseif($url=='upload'){
  include 'page/upload.php';
}elseif($url=='album'){
  include 'page/album.php';
}elseif($url=='lihat_foto'){
  include 'page/lihat_foto.php';
}elseif($url=='like'){
  include 'page/like.php';
}elseif($url=='detail'){
  include 'page/detail.php';
}elseif($url=='logout'){
  session_destroy();
  header("Location: ?url=home");
}else{
  include 'page/home.php';
}
?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
