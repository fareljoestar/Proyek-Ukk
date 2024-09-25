<?php 
include 'koneksi.php';

$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$_GET[id]' AND userid='$_SESSION[userid]'"));
if($cek==0){    
   $fotoid = @$_GET['id'];
   $userid = @$_SESSION['userid'];
   $tanggal = date('Y-m-d');
   $like = mysqli_query($conn, "INSERT INTO likefoto VALUES('','$fotoid','$userid','$tanggal')");
   header("Location: ?url=detail&&id=$fotoid");
}else {
    $fotoid = @$_GET['id'];
    $userid = @$_SESSION['userid'];
    $dislike = mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
    header("Location: ?url=detail&&id=$fotoid");
}
?>