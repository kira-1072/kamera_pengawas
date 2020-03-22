<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
require_once "../config/koneksi.php";
include 'ip2.php';
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from admin where username='$username' and password=sha2('$password', 512)");
//$data = mysqli_query($koneksi,"select * from admin where username='$username' and password=md5('$password')");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("Location: admin/admin.php");
}else{
	header("location:index.php?pesan=gagal");
}
?>
