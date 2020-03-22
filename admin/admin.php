
<html>
<!-- cek apakah sudah login -->
	<?php 
	session_start();
	if(!isset($_SESSION['status'])){
		header("location: ../index.php?pesan=belum_login");
	}
$start = microtime(true);
$finish = microtime(true);
print 'Page generated in : '. round(($finish - $start) * 10000, 2) .' <small>ms</small>';
 
?>


 <!-- custom styling for all icons -->
  
<head> 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Live Streaming IP Camera</title>
   <style type="text/css">

	a.fas {
	
	 color: blue;
  }
   .tampil {
        margin: 100px auto;
        width: 1000px;
		padding: 500px;
		
        
    }
  
   
</style>
</head>
<body>
 <div class="tampil">
	<div class="card text-center">
  		<div class="card-header">
			Surveillance Camera 
	<a href="logout.php" class="close" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</a>
  		</div>
		<div class="card-body">
			<p class="card-text"><iframe src="http://192.168.0.100:5000/" allow="autoplay" allowfullscreen></iframe></p>
			
		</div>

		<div class="card-footer text-muted">
	
				
				<div class="row justify-content-center">
					<div class="col-1">
					 <a href="record.php">
          				<span class="glyphicon glyphicon-record"></span>
       				 </a>
					</div>
					<div class="col-1">
					<a href="download.php?file=secret.aes">
        			  <span class="glyphicon glyphicon-download-alt"></span>
       				 </a>
					</div>
				
				
			</div>		
			
			
			<!--<a href="logout.php" class="btn btn-primary">Keluar</a> -->
		</div>
	</div>
</div>
</body>
</html>
