<?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i style="margin-right:7px" class="fa fa-edit"></i> Tambah User
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Home </a></li>
      <li><a href="?module=patient"> Users </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/patient/proses.php?act=insert" method="POST" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="firstname" placeholder="first name" autocomplete="off" required>
                </div>
              </div>

              <br>
              <div class="form-group">
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="lastname" placeholder="last name" autocomplete="off" required>
                </div>
              </div>
              <br>

                <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" placeholder="email must @" autocomplete="off" required>
                </div>
              </div>
              <br>

                <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="phonenumber" placeholder="phone number" autocomplete="off" required>
                </div>
              </div>
              <br>

                <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password" placeholder="password" autocomplete="off" required>
                </div>
              </div>
              <br>
         
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-1 col-sm-11">
                  <input type="submit" class="btn btn-primary btn-submit" name="save" value="Save">
                  <a href="?module=ambulance" class="btn btn-default btn-reset">Cancel</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['id'])) {
     
      $query = mysqli_query($mysqli, "SELECT * FROM users WHERE id_user='$_GET[id]'") 
                                      or die('Ada kesalahan pada query tampil data user : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i style="margin-right:7px" class="fa fa-edit"></i> Change user information
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Home </a></li>
      <li><a href="?module=patient"> user </a></li>
      <li class="active"> Change </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/patient/proses.php?act=update" method="POST" enctype="multipart/form-data">
            <div class="box-body">
              
              <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

              <div class="form-group">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="firstname" placeholder="first name" autocomplete="off" value="<?php echo $data['firstname']; ?>" required>
                </div>
              </div>

              <br>
              <div class="form-group">
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="lastname" placeholder="last name" autocomplete="off" value="<?php echo $data['lastname']; ?>" required> 
                </div>
              </div>
              <br>

              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" placeholder="email" autocomplete="off" value="<?php echo $data['email']; ?>" required>
                </div>
              </div>
              <br>

              <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="phonenumber" placeholder="phone number" autocomplete="off" value="<?php echo $data['phonenumber']; ?>" required>
                </div>
              </div>
              <br>

              <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password" placeholder="password" autocomplete="off" value="<?php echo $data['password']; ?>" required>
                </div>
              </div>
              <br>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-1 col-sm-11">
                  <input type="submit" class="btn btn-primary btn-submit" name="save" value="Save">
                  <a href="?module=patient" class="btn btn-default btn-reset">Cancel</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

elseif ($_GET['form']=='detail') { 
  if (isset($_GET['id'])) {
     
      $query = mysqli_query($mysqli, "SELECT * FROM gambars WHERE gambar_id='$_GET[id]'") 
                                      or die('Ada kesalahan pada query tampil data picture : '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>

  <section class="content-header">
    <h1>
      <i style="margin-right:7px" class="fa fa-picture-o"></i> Detail Picture
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=home"><i class="fa fa-home"></i> Home </a></li>
      <li><a href="?module=pictures"> Pictures </a></li>
      <li class="active"> Detail </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

          <!-- form start -->
          <br>
          <ul class="timeline">
            <li>
              <div class="timeline-item">
                <span class="time">
                  <i class="fa fa-clock-o icon-title"></i> <?php echo $data['tanggal']; ?>
                </span>
                <h3 class="timeline-header">
                  <a href="javascript:void(0);"> <i class="fa fa-picture-o icon-title"></i> <?php echo $data['kamera']; ?></a> (<?php echo $data['gambar']; ?>)
                </h3>
                <div class="timeline-body center"><?php echo "<img width=440 src='../pictures/$data[gambar]'"; ?></div><br><br>
              </div>
            </li>
          </ul>
        <a href="?module=pictures" class="btn btn-default btn-reset">Back</a>&nbsp&nbsp 
        <a class="btn btn-primary btn-reset" download="<?=$data[gambar]?>" href="../pictures/<?=$data[gambar]?>" title="<?=$data[gambar]?>">Download</a>
        <!-- <a download="<?=$data[gambar]?>" href="../pictures/<?=$data[gambar]?>" title="<?=$data[gambar]?>">
        <img alt="<?=$data[gambar]?>" src="../pictures/<?=$data[gambar]?>"></a> -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
  <?php
}
?>