<div class="container mt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4>Upload</h4>
                    <?php 
                    // Memastikan koneksi ke database tersedia
                    include 'koneksi.php';

                    // Memastikan form sudah disubmit
                    $submit = @$_POST['submit'];
                    $fotoid = @$_GET['fotoid'];

                    if ($submit == 'Simpan') {
                        // Mengambil data dari form
                        $judulfoto = @$_POST['judulfoto'];
                        $deskripsifoto = @$_POST['deskripsifoto'];
                        $namafile = @$_FILES['namafile']['name'];
                        $tmp_foto = @$_FILES['namafile']['tmp_name'];
                        $tanggal = date('Y-m-d');
                        $albumid = @$_POST['album_id']; // Disesuaikan dengan name di form
                        $userid = @$_SESSION['userid']; // Pastikan $_SESSION['userid'] sudah terisi

                        // Memindahkan file ke folder uploads
                        if (move_uploaded_file($tmp_foto, 'uploads/'.$namafile)) {
                            $insert = mysqli_query($conn, "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, namafile, albumid, userid) VALUES ('$judulfoto', '$deskripsifoto', '$tanggal', '$namafile', '$albumid', '$userid')");
                            if ($insert) {
                                echo 'Gambar berhasil disimpan';
                            } else {
                                echo 'Gambar gagal disimpan: ' . mysqli_error($conn);
                            }
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        } else {
                            echo 'Gagal memindahkan file gambar';
                        }
                    } elseif (isset($_GET['edit'])) {
                        if ($submit == "Ubah") {
                            $judulfoto = @$_POST['judulfoto'];
                            $deskripsifoto = @$_POST['deskripsifoto'];
                            $namafile = isset($_FILES['namafile']['name']) ? $_FILES['namafile']['name'] : null;
                            $tmp_foto = isset($_FILES['namafile']['tmp_name']) ? $_FILES['namafile']['tmp_name'] : null;
                            $tanggal = date('Y-m-d');
                            $albumid = @$_POST['album_id']; 
                            $userid = @$_SESSION['userid'];

                            if (is_null($namafile) || strlen($namafile) == 0) {
                                // Jika tidak ada file baru yang diupload, hanya update judul, deskripsi, dan album
                                $update = mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggal', albumid='$albumid' WHERE fotoid='$fotoid'");
                            } else {
                                // Jika ada file baru yang diupload, update semuanya
                                if (move_uploaded_file($tmp_foto, 'uploads/'.$namafile)) {
                                    $update = mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggal', namafile='$namafile', albumid='$albumid' WHERE fotoid='$fotoid'");
                                } else {
                                    echo 'Gagal memindahkan file gambar';
                                }
                            }

                            if ($update) {
                                echo 'Gambar berhasil diubah';
                            } else {
                                echo 'Gambar gagal diubah: ' . mysqli_error($conn);
                            }
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    } elseif (isset($_GET['hapus'])) {
                        $delete = mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");
                        if ($delete) {
                            echo 'Gambar berhasil dihapus';
                        } else {
                            echo 'Gambar gagal dihapus: ' . mysqli_error($conn);
                        }
                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                    }

                    // Mencari data album
                    $album = mysqli_query($conn, "SELECT * FROM album");
                    $val = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'"));
                    ?>
                    
                    <?php if (!isset($_GET['edit']) && !isset($_GET['hapus'])): ?>
                    <form action="?url=upload" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Foto</label>
                            <input type="text" class="form-control" required name="judulfoto">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Foto</label>
                            <textarea name="deskripsifoto" class="form-control" required cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pilih Gambar</label>
                            <input type="file" name="namafile" class="form-control" required accept=".jpg, .png, .gif">
                            <small class="text-danger">File Harus Berupa: *.jpg *.png *.gif</small>
                        </div>
                        <div class="form-group">
                            <label>Pilih Album</label>
                            <select name="album_id" class="form-select" required>
                                <?php while ($albums = mysqli_fetch_assoc($album)): ?>
                                    <option value="<?= $albums['albumid'] ?>"><?= $albums['namaalbum'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">Upload</button>
                    </form>
                    
                    <?php elseif (isset($_GET['edit'])): ?>
                    <form action="?url=upload&&edit&&fotoid=<?= $val['fotoid'] ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul Foto</label>
                            <input type="text" class="form-control" value="<?= $val['judulfoto'] ?>" required name="judulfoto">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Foto</label>
                            <textarea name="deskripsifoto" class="form-control" required cols="30" rows="5"><?= $val['deskripsifoto'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pilih Gambar</label>
                            <input type="file" name="namafile" class="form-control" accept=".jpg, .png, .gif">
                            <small class="text-danger">File Harus Berupa: *.jpg *.png *.gif</small>
                        </div>
                        <div class="form-group">
                            <label>Pilih Album</label>
                            <select name="album_id" class="form-select">
                                <?php while ($albums = mysqli_fetch_assoc($album)): ?>
                                    <option value="<?= $albums['albumid'] ?>" <?= $albums['albumid'] == $val['albumid'] ? 'selected' : '' ?>>
                                        <?= $albums['namaalbum'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" value="Ubah" name="submit" class="btn btn-danger my-3">Upload</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <?php 
                // Mengambil data foto beserta nama album
                $fotos = mysqli_query($conn, "SELECT f.*, a.namaalbum FROM foto f LEFT JOIN album a ON f.albumid = a.albumid WHERE f.userid='".@$_SESSION['userid']."'");

                foreach ($fotos as $foto):
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card">
                        <img src="uploads/<?= $foto['namafile'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $foto['judulfoto'] ?></h5>
                            <p>Album: <?= $foto['namaalbum'] ?></p> <!-- Menampilkan nama album -->
                            <a href="?url=upload&&edit&&fotoid=<?= $foto['fotoid'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?url=upload&&hapus&&fotoid=<?= $foto['fotoid'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </div>
                    </div>
                </div> 
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
