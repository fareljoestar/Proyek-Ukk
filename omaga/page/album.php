<div class="container mt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h4>Album</h4>
                    <?php 
                    // Memastikan form sudah disubmit
                    $submit = @$_POST['submit'];
                    $albumid = @$_GET['albumid'];
                    if ($submit == 'Simpan') {
                        // Mengambil data dari form
                        $namaalbum = @$_POST['namaalbum'];
                        $deskripsi = @$_POST['deskripsi'];
                        $tanggal = date('Y-m-d');
                        $userid = @$_SESSION['userid']; // Pastikan $_SESSION['userid'] sudah terisi

                        // Memastikan koneksi database tersedia
                        include 'koneksi.php'; 

                        // Query untuk menyimpan data ke dalam tabel album
                        $insert = mysqli_query($conn, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid) VALUES ('$namaalbum', '$deskripsi', '$tanggal', '$userid')");

                        // Mengecek apakah query berhasil dijalankan
                        if ($insert) {
                            echo 'Berhasil membuat album';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                        } else {
                            echo 'Gagal membuat album: ' . mysqli_error($conn);
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                        }
                    } elseif (isset($_GET['edit'])) {
                        if ($submit == 'Ubah') {
                            $namaalbum = @$_POST['namaalbum'];
                            $deskripsi = @$_POST['deskripsi'];
                            $userid = @$_SESSION['userid'];
                            $update = mysqli_query($conn, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi' WHERE albumid='$albumid'");
                            if ($update) {
                                echo 'Berhasil mengubah album';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                            } else {
                                echo 'Gagal mengubah album: ' . mysqli_error($conn);
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                            }
                        }
                    } elseif (isset($_GET['hapus'])) {
                        $hapus = mysqli_query($conn, "DELETE FROM album WHERE albumid='$albumid'");
                        if ($hapus) {
                            echo 'Berhasil hapus album';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                        } else {
                            echo 'Gagal hapus album: ' . mysqli_error($conn);
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                        }
                    }
                    $val = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM album WHERE albumid='$albumid' "));
                    ?>
                    <?php if (!isset($_GET['edit'])): ?>
                    <form action="?url=album" method="post">
                        <div class="form-group">
                            <label>Nama Album</label>
                            <input type="text" class="form-control" required name="namaalbum">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Album</label>
                            <textarea name="deskripsi" class="form-control" required cols="30" rows="5"></textarea>
                        </div>
                        <button type="submit" value="Simpan" name="submit" class="btn btn-danger my-3">Upload</button>
                    </form>
                    <?php elseif (isset($_GET['edit'])): ?>
                    <form action="?url=album&&edit&&albumid=<?= $val['albumid'] ?>" method="post">
                        <div class="form-group">
                            <label>Nama Album</label>
                            <input type="text" class="form-control" value="<?= $val['namaalbum'] ?>" required name="namaalbum">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Album</label>
                            <textarea name="deskripsi" class="form-control" required cols="30" rows="5"><?= $val['deskripsi'] ?></textarea>
                        </div>
                        <button type="submit" value="Ubah" name="submit" class="btn btn-danger my-3">Ubah</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $userid = @$_SESSION['userid'];
                            $albums = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
                            foreach ($albums as $album):
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $album['namaalbum'] ?></td>
                                <td><?= $album['deskripsi'] ?></td>
                                <td><?= $album['tanggaldibuat'] ?></td>
                                <td>
                                    <a href="?url=lihat_foto&&albumid=<?= $album['albumid'] ?>" class="btn btn-sm btn-success">Lihat Foto</a>
                                    <a href="?url=album&&edit&&albumid=<?= $album['albumid'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="?url=album&&hapus&&albumid=<?= $album['albumid'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
