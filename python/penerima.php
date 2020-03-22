<?php
require_once "../koneksi.php";
           // ambil data hasil submit dari form
            $kamera       = mysqli_real_escape_string($mysqli, trim($_POST['kamera']));
            $tanggal      = mysqli_real_escape_string($mysqli, trim($_POST['tanggal']));
            $gambar       = mysqli_real_escape_string($mysqli, trim($_POST['gambar']));

            echo ',   Kamera : ';
            echo ($kamera);

            echo "Tanggal : ";
            echo ($tanggal);

            echo ',   gambar :';
            echo ($gambar);

                  $query = mysqli_query($mysqli, "INSERT INTO gambars(kamera,tanggal,gambar)
                                                  VALUES('$kamera','$tanggal','$gambar')")
                                                  or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
    ?>
