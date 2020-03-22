<?php 
$koneksi = mysqli_connect("localhost","rauf","tes123","ipcam");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
