<?php
// Koneksi ke database
include 'koneksi.php';

// Memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil ID pengguna yang sedang login dari sesi
$userid = $_SESSION['userid'];

// Ambil informasi pengguna dari database
$user_query = mysqli_query($conn, "SELECT * FROM user WHERE userid='$userid'");
$user_info = mysqli_fetch_assoc($user_query);

// Variabel untuk menampung pesan
$upload_status = "";

// Menangani update profil
if (isset($_POST['update_profile'])) {
    $new_username = $_POST['username'];
    $new_namalengkap = $_POST['namalengkap'];
    $profile_picture = $user_info['profile_picture']; // Ambil dari database

    // Update nama lengkap dan username
    mysqli_query($conn, "UPDATE user SET username='$new_username', namalengkap='$new_namalengkap' WHERE userid='$userid'");

    // Jika ada upload file
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $upload_dir = 'uploads/profile_pictures/';
        $file_path = $upload_dir . $file_name;

        // Cek apakah folder tujuan ada dan bisa ditulis
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Buat folder jika belum ada
        }

        // Pindahkan file yang diupload ke folder
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Hapus foto profil lama jika ada (dan bukan default)
            if ($profile_picture && $profile_picture !== 'uploads/profile_pictures/default_profile_picture.jpg' && file_exists($profile_picture)) {
                unlink($profile_picture); // Hapus file lama
            }

            // Update path foto profil di database
            $profile_picture = $file_path;
            $update_picture_query = "UPDATE user SET profile_picture='$profile_picture' WHERE userid='$userid'";
            if (!mysqli_query($conn, $update_picture_query)) {
                $upload_status = "Gagal memperbarui foto profil di database: " . mysqli_error($conn);
            }
        } else {
            $upload_status = "Gagal mengunggah foto profil.";
        }
    } else if ($_FILES['profile_picture']['error'] != UPLOAD_ERR_NO_FILE) {
        $upload_status = "Error dalam upload file: " . $_FILES['profile_picture']['error'];
    }

    // Update pesan sukses jika tidak ada error
    if (empty($upload_status)) {
        $upload_status = "Profil berhasil diperbarui.";
    }

    // Jangan menggunakan header redirect untuk menghindari perubahan halaman
    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit();
}

// Ambil foto profil dari database atau gunakan gambar default
$profile_picture = $user_info['profile_picture'] ? $user_info['profile_picture'] : 'uploads/profile_pictures/default_profile_picture.jpg';

// Ambil foto yang telah diupload oleh pengguna
$foto_query = mysqli_query($conn, "SELECT * FROM foto WHERE userid='$userid'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
        }
        .profile-header .profile-info {
            flex: 1;
        }
        .profile-header .profile-info p {
            margin: 0;
        }
        .card {
    height: 100%; /* Membuat kartu memiliki tinggi yang sama */
    display: flex;
    flex-direction: column;
        }

        .card img {
            max-width: 100%;
            height: 200px; /* Atur tinggi gambar */
            object-fit: cover; /* Membuat gambar tetap proporsional */
        }

        .card-body {
            flex-grow: 1;
        }

        .card-text {
            max-height: 60px; /* Batasi tinggi deskripsi */
            overflow: hidden; /* Sembunyikan teks yang berlebihan */
            text-overflow: ellipsis; /* Tambahkan ellipsis (titik-titik) */
            white-space: nowrap; /* Membuat teks satu baris */
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Profil</h1>
            <hr>
            <div class="profile-header mt-5">
                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Foto Profil">
                <div class="profile-info">
                    <p><strong>Username:</strong> <?= htmlspecialchars($user_info['username']) ?></p>
                    <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($user_info['namalengkap']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user_info['email']) ?></p>
                    <br>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit Profil</button>
                    <?php if ($upload_status): ?>
                        <div class="alert alert-info mt-3"><?= $upload_status ?></div>
                    <?php endif; ?>
                </div>
            </div>

           <h3>Foto yang Telah Diupload</h3>
<div class="row">
    <?php while ($foto = mysqli_fetch_assoc($foto_query)): ?>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card mb-4">
            <!-- Tambahkan tautan ke halaman detail foto -->
            <a href="?url=detail&&id=<?= htmlspecialchars($foto['fotoid']) ?>">
                <img src="uploads/<?= htmlspecialchars($foto['namafile']) ?>" class="card-img-top" alt="<?= htmlspecialchars($foto['judulfoto']) ?>">
            </a>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($foto['judulfoto']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($foto['deskripsifoto']) ?></p>
                <p class="card-date text-muted"><?= date('d M Y', strtotime($foto['tanggalunggah'])) ?></p>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

        </div>
    </div>
</div>

<!-- Modal untuk Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#D7BFDC;">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body" style="background-color:#D7BFDC;">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user_info['username']) ?>">
          </div>
          <div class="form-group">
            <label for="namalengkap">Nama Lengkap</label>
            <input type="text" name="namalengkap" class="form-control" value="<?= htmlspecialchars($user_info['namalengkap']) ?>">
          </div>
          <div class="form-group">
            <label for="profile_picture">Foto Profil</label>
            <input type="file" name="profile_picture" class="form-control-file" accept="image/*">
          </div>
        </div>
        <div class="modal-footer" style="background-color:#D7BFDC;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="update_profile" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>