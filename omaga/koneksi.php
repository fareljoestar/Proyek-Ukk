<?php 
$conn = mysqli_connect("localhost", "root", "", "galeryfoto2");

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
