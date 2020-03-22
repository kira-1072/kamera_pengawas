<?php
session_start();
require_once "../../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['save'])) {
            // ambil data hasil submit dari form
            $firstname      = mysqli_real_escape_string($mysqli, trim($_POST['firstname']));
            $lastname       = mysqli_real_escape_string($mysqli, trim($_POST['lastname']));
            $email          = mysqli_real_escape_string($mysqli, trim($_POST['email']));
            $phonenumber   = mysqli_real_escape_string($mysqli, trim($_POST['phonenumber']));
            $password = hash('sha256', $_POST['password']);

                        $query = mysqli_query($mysqli, "INSERT INTO users(firstname,lastname,email,phonenumber,password)
                                                        VALUES('$firstname','$lastname','$email','$phonenumber','$password')")
                                                        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                        // cek query
                        if ($query) {
                            // jika berhasil tampilkan pesan berhasil simpan data
                            header("location: ../../main.php?module=patient&alert=1");
                        }   
                    }
             }  
           
      
    elseif ($_GET['act']=='update') {
        if (isset($_POST['save'])) {
            if (isset($_POST['id_user'])) {
                // ambil data hasil submit dari 
            $id_user        = mysqli_real_escape_string($mysqli, trim($_POST['id_user']));
            $firstname      = mysqli_real_escape_string($mysqli, trim($_POST['firstname']));
            $lastname       = mysqli_real_escape_string($mysqli, trim($_POST['lastname']));
            $email          = mysqli_real_escape_string($mysqli, trim($_POST['email']));
            $phonenumber   = mysqli_real_escape_string($mysqli, trim($_POST['phonenumber']));
            $password = hash('sha256', $_POST['password']);
                
                    $query = mysqli_query($mysqli, "UPDATE users SET firstname= '$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber'
                                                                      WHERE id_user = '$id_user'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                    
                                  // cek query
                                if ($query) {
                                    // jika berhasil tampilkan pesan berhasil update data
                                    header("location: ../../main.php?module=patient&alert=2");
                                }
                         }
                    } 
                }      

       elseif ($_GET['act']=='detail') {
            if (isset($_POST['id_user'])) {
                // ambil data hasil submit dari form
            $firstname      = mysqli_real_escape_string($mysqli, trim($_POST['firstname']));
            $lastname       = mysqli_real_escape_string($mysqli, trim($_POST['lastname']));
            $email          = mysqli_real_escape_string($mysqli, trim($_POST['email']));
            $phonenumber   = mysqli_real_escape_string($mysqli, trim($_POST['phonenumber']));
            $password       = hash('sha256', $_POST['password']);
            $log            = mysqli_real_escape_string($mysqli, trim($_POST['log']));
            $lat            = mysqli_real_escape_string($mysqli, trim($_POST['lat']));
            $position       = mysqli_real_escape_string($mysqli, trim($_POST['position']));
            }      
        }
    

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $gambar_id = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel users
            $query = mysqli_query($mysqli, "DELETE FROM gambars WHERE gambar_id='$gambar_id'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

           
            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=pictures&alert=3");
            }
        }
    }       
}       
?>