<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto</title>
    <style>
        .liked svg {
            fill: red;
        }

        a {
            color: black; /* Mengubah warna teks menjadi hitam */
            text-decoration: none; /* Menghilangkan garis bawah */
        }

        a.reply-link {
            color: gray; /* Ubah warna teks menjadi abu-abu */
            font-weight: bold; /* Buat teks menjadi bold */
        }

        .like-count {
            font-size: 0.875rem; /* Mengecilkan ukuran teks */
        }

        .comment {
            margin-bottom: 1rem; /* Memberikan jarak bawah pada setiap komentar */
        }

        .reply {
            margin-left: 1rem; /* Memberikan jarak kiri pada balasan komentar */
            margin-top: 0.5rem; /* Memberikan jarak atas pada balasan komentar */
        }

        .reply-form {
            margin-top: 1rem; /* Memberikan jarak atas pada form balasan */
        }
    </style>
</head>
<body>
<?php 
include 'koneksi.php'; 

// Cek apakah user sudah login
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

// Cek apakah 'id' ada di URL
if (isset($_GET['id'])) {
    $fotoid = $_GET['id'];
    $details = mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid = user.userid WHERE foto.fotoid = '$fotoid'");
    $data = mysqli_fetch_array($details);
    $likes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'"));
    $cek = ($userid) ? mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'")) : 0;

    // Proses mengirim komentar
    if (isset($_POST['submit']) && $userid) {
        $komentar = $_POST['komentar'];
        $tanggal = date('Y-m-d');
        mysqli_query($conn, "INSERT INTO komentar (fotoid, userid, isikomentar, tanggalkomentar) VALUES ('$fotoid', '$userid', '$komentar', '$tanggal')");
        header("Location: ?url=detail&&id=$fotoid");
        exit;
    }
    
    // Proses balasan komentar
    if (isset($_POST['submit_reply']) && $userid) {
        $parentid = $_POST['parentid'];
        $reply = $_POST['reply'];
        $tanggal = date('Y-m-d');
        mysqli_query($conn, "INSERT INTO komentar (fotoid, userid, isikomentar, tanggalkomentar, parentid) VALUES ('$fotoid', '$userid', '$reply', '$tanggal', '$parentid')");
        header("Location: ?url=detail&&id=$fotoid");
        exit;
    }

    // Proses hapus komentar
    if (isset($_POST['delete_comment']) && $userid) {
        $komentarid = $_POST['komentarid'];
        mysqli_query($conn, "DELETE FROM komentar WHERE komentarid='$komentarid' AND userid='$userid' OR parentid='$komentarid'");
        header("Location: ?url=detail&&id=$fotoid");
        exit;
    }

    // Proses hapus balasan komentar
    if (isset($_POST['delete_reply']) && $userid) {
        $komentarid = $_POST['komentarid'];
        mysqli_query($conn, "DELETE FROM komentar WHERE komentarid='$komentarid' AND userid='$userid'");
        header("Location: ?url=detail&&id=$fotoid");
        exit;
    }
} else {
    echo "ID foto tidak ditemukan!";
    exit;
}
?>


    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card mt-5">
                    <img src="uploads/<?= $data['namafile'] ?>" alt="<?= $data['judulfoto'] ?>" class="object-fit-cover">
                    <div class="card-body">
                        <h3 class="card-title mb-0"><?= $data['judulfoto'] ?>
                        <a href="<?php if($userid){echo '?url=like&&id='.$data['fotoid'].'';}else{echo 'login.php';} ?>" 
                           class="<?php if($cek != 0){echo 'liked';} ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>
                            <span class="like-count"><?= $likes ?></span>
                        </a></h3>
                        <small class="text-muted mb-3">by: <?= $data['username'] ?>, <?= $data['tanggalunggah'] ?></small>
                        <p><?= $data['deskripsifoto'] ?></p>
                        
                        <?php if($userid): ?>
                            <form action="?url=detail&&id=<?= $_GET['id'] ?>" method="post">

                            <div class="form-group d-flex flex-row">
                                <input type="hidden" name="fotoid" value="<?= $data['fotoid'] ?>">
                                <a href="?urlhome" class="btn btn-secondary">Back</a>
                                <input type="text" name="komentar" class="form-control" placeholder="Masukan Komentar Anda...">
                                <input type="submit" value="Kirim" name="submit" class="btn btn-secondary">
                            </div>
                        </form>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary">Login untuk berkomentar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-6">
    <?php 
    // Ambil komentar utama (yang bukan balasan)
    $komen = mysqli_query($conn, "SELECT * FROM komentar INNER JOIN user ON komentar.userid=user.userid WHERE komentar.fotoid='$_GET[id]' AND parentid IS NULL");
    foreach ($komen as $komens): 
    ?>
    <div class="comment">
        <p class="mb-0 fw-bold mt-5"><?= htmlspecialchars($komens['username']) ?></p>
        <p class="mb-1"><?= htmlspecialchars($komens['isikomentar']) ?></p>
        <p class="text-muted small mb-0"><?= htmlspecialchars($komens['tanggalkomentar']) ?></p>
        
        <!-- Form untuk menghapus komentar -->
        <?php if($userid && $userid == $komens['userid']): ?>
        <form action="?url=detail&&id=<?= $_GET['id'] ?>" method="post" class="d-inline">
            <input type="hidden" name="komentarid" value="<?= $komens['komentarid'] ?>">
            <button type="submit" name="delete_comment" class="btn btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
        <?php endif; ?>
        
        <!-- Link untuk menampilkan form balasan -->
        <?php if($userid): ?>
        <a href="?url=detail&&id=<?= $_GET['id'] ?>&reply_to=<?= $komens['komentarid'] ?>" class="reply-link">Balas</a>
        
        <!-- Form balasan komentar, hanya tampilkan jika query 'reply_to' cocok dengan komentar ini -->
        <?php if (isset($_GET['reply_to']) && $_GET['reply_to'] == $komens['komentarid']): ?>
        <form action="?url=detail&&id=<?= $_GET['id'] ?>" method="post" class="reply-form mt-2">
            <input type="hidden" name="parentid" value="<?= $komens['komentarid'] ?>">
            <div class="form-group d-flex">
                <input type="text" name="reply" class="form-control" placeholder="Balas komentar...">
                <input type="submit" value="Kirim" name="submit_reply" class="btn btn-secondary ms-1">
            </div>
        </form>
        <?php endif; ?>
        <?php endif; ?>
        
        <!-- Menampilkan balasan komentar -->
        <?php 
        $replies = mysqli_query($conn, "SELECT * FROM komentar INNER JOIN user ON komentar.userid=user.userid WHERE komentar.parentid='{$komens['komentarid']}'");
        foreach ($replies as $reply): ?>
        <div class="reply">
            <p class="mb-0 fw-bold"><?= htmlspecialchars($reply['username']) ?></p>
            <p class="mb-1"><?= htmlspecialchars($reply['isikomentar']) ?></p>
            <p class="text-muted small mb-0"><?= htmlspecialchars($reply['tanggalkomentar']) ?></p>
            
            <!-- Form untuk menghapus balasan -->
            <?php if($userid && $userid == $reply['userid']): ?>
            <form action="?url=detail&&id=<?= $_GET['id'] ?>" method="post" class="d-inline">
                <input type="hidden" name="komentarid" value="<?= $reply['komentarid'] ?>">
                <button type="submit" name="delete_reply" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
