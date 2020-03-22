<!DOCTYPE html>
<html lang="en">
<head><!DOCTYPE html>
<html lang="en">
<head>
   <style type="text/css">

    .login {
        margin: 100px auto;
        width: 600px;
        padding: 10px;
        
    }
   
</style>
	<title>Login IPCAM</title>

	<meta charset="UTF-8">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			//echo "Login gagal! username dan password salah!";
		}else if($_GET['pesan'] == "logout"){
			//echo "Anda telah berhasil logout";
		}else if($_GET['pesan'] == "belum_login"){
			//echo "Anda harus login untuk mengakses halaman admin";
		}
  }
	?>
    <div class="container">
   
    <div class="row">
         <div class="login">
      <div class="col-sm-11 col-md-9 col-lg- mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form method="post" name="login" class="form-signin" action="config/cek_login.php">
              <div class="form-label-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <label for="inputEmail">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
              <hr class="my-4">
            
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
         
</body>
</html>
	
