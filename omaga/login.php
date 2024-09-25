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
        .container {
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .link-primary {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }

        .link-primary:hover {
            color: #a777e3;
        }
        p {
            color: #fff;
            margin-top: 1rem;
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
                        <h4 class="card-title">Halaman Login</h4>
                        <p class="card-title">Login Akun</p>
                        <?php 
                         $submit = @$_POST['submit'];
                         if($submit == 'Login'){
                            $username = mysqli_real_escape_string($conn, @$_POST['username']);
                            $password = md5(mysqli_real_escape_string($conn, @$_POST['password']));
                            $sql=mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$password'");
                            
                            $cek=mysqli_num_rows($sql);
                            if($cek!=0){
                                $sesi=mysqli_fetch_array($sql);
                                echo 'Login Berhasil !!';
                                $_SESSION['username']=$sesi['username'];
                                $_SESSION['userid']=$sesi['userid'];
                                $_SESSION['email']=$sesi['email'];
                                $_SESSION['namalengkap']=$sesi['namalengkap'];
                                echo '<meta http-equiv="refresh" content="0.8; url=./">';
                            }else{
                                echo 'Login Gagal :(';
                                echo '<meta http-equiv="refresh" content="2; url=login.php">';
                            }
                         }
                        ?>
                        
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <input type="submit" value="Login" class="btn btn-danger my-3" name="submit">
                            <p>Belum Punya Akun? <a href="daftar.php" class="link-danger">Daftar Sekarang</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>