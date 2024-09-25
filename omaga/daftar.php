<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Gallery Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body, html {
            height: 100%;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            justify-content: center;
            align-items: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            max-width: 500px;
            width: 100%; /* Gunakan lebar 100% untuk responsif */
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05); /* Animasi saat hover */
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
        }
        .card-body {
            text-align: center;
        }
        h4 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #fff;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            outline: none;
            transition: background 0.3s;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.4);
        }
        .btn {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #fff;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }
        .btn:hover {
            background: linear-gradient(135deg, #5b79e4, #9b68d9);
            transform: translateY(-5px);
        }

        /* Pesan Kesalahan */
        .error-message {
            color: #fff;
            background-color: rgba(255, 0, 0, 0.2); /* Warna background untuk error */
            border: 1px solid red;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        /* Pesan Sukses */
        .success-message {
            color: #fff;
            background-color: rgba(0, 255, 0, 0.2); /* Warna background untuk sukses */
            border: 1px solid green;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        /* Media query untuk responsif */
        @media (max-width: 500px) {
            .card {
                padding: 1rem;
            }

            h4 {
                font-size: 24px;
            }

            .form-control, .btn {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Halaman Daftar</h4>
                        <p class="card-title">Daftar Akun</p>

                        <?php 
                        $submit = @$_POST['submit'];
                        if($submit == 'Daftar'){
                            $username = mysqli_real_escape_string($conn, @$_POST['username']);
                            $password = md5(mysqli_real_escape_string($conn, @$_POST['password']));
                            $email = mysqli_real_escape_string($conn, @$_POST['email']);
                            $namalengkap = mysqli_real_escape_string($conn, @$_POST['namalengkap']);
                            $alamat = mysqli_real_escape_string($conn, @$_POST['alamat']);

                            // Cek apakah ada field yang kosong
                            if(empty($username) || empty($password) || empty($email) || empty($namalengkap) || empty($alamat)){
                                echo '<p id="error-message" class="error-message">Silahkan Isi Form Terlebih Dahulu!</p>';
                                echo '<script>
                                        setTimeout(function() {
                                            document.getElementById("error-message").style.display = "none";
                                        }, 2000); // Hapus pesan setelah 2 detik
                                      </script>';
                            } else {
                                // Cek apakah username atau email sudah ada
                                $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$email'");
                                if(mysqli_num_rows($cek) == 0){
                                    // Insert data ke database
                                    mysqli_query($conn, "INSERT INTO user (username, password, email, namalengkap, alamat) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')");
                                    echo '<p class="success-message">Daftar Berhasil, Silahkan Login!</p>';
                                    echo '<meta http-equiv="refresh" content="2; url=login.php">';
                                } else {
                                    echo '<p class="error-message">Maaf, Akun Sudah Ada</p>';
                                    echo '<meta http-equiv="refresh" content="2; url=daftar.php">';
                                }
                            }
                        }
                        ?>

                        <form action="daftar.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="namalengkap">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <input type="submit" value="Daftar" class="btn btn-danger my-3" name="submit">
                            <p>Sudah Punya Akun? <a href="login.php" class="link-danger">Login Sekarang</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
