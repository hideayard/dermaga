


<?php
if(isset($_POST['submit'])){ 
  //echo "tabel=".$table;
switch ($p) 
{
    case 'profile':
    {
      if(isset($_POST['user_name']))
      {
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : ""; 
        $user_pass = isset($_POST['user_pass']) ? $_POST['user_pass'] : ""; 
        $user_nama = isset($_POST['user_nama']) ? $_POST['user_nama'] : ""; 
        $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : ""; 
        $user_foto = isset($_FILES["user_foto"]["name"]) ? $_FILES["user_foto"]["name"] : ""; 
        $id = isset($_SESSION['i']) ? $_SESSION['i'] : "";
        $info = "Update Sukses!!";
        if($user_foto!="")
        {
          $target_dir = "dist/img/";
          $target_file = $target_dir . basename($_FILES["user_foto"]["name"]);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["user_foto"]["tmp_name"]);
            if($check !== false) {
                $info = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $info = "File is not an image.";
                $uploadOk = 0;
            }
          }
          
            // Check if file already exists
            if (file_exists($target_file)) {
                $info .= "<br>Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["user_foto"]["size"] > 500000) {
                $info .= "<br>Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $info .= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $info .= "<br>Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["user_foto"]["tmp_name"], $target_file)) {
                    $info .= "<br>The file ". basename( $_FILES["user_foto"]["name"]). " has been uploaded.";
                } else {
                    $info .= "<br>Sorry, there was an error uploading your file.";
                }
            }
            $tambahan = ", `user_foto` = '$user_foto'";
        }
            
            
$sql = "UPDATE `users` SET `user_name` = '$user_name',`user_nama` = '$user_nama',`user_pass` = '".md5($user_pass)."' $tambahan WHERE `users`.`user_id` = $id;";
// var_dump($sql);
$hasil = $db->rawQuery($sql);
echo "<script>alert('$info');</script>";
    }break;
}//echo $sql;

//  var_dump($hasil);
  // echo '<div class="callout callout-info"><h4>Info :</h4><strong></strong> Data berhasil di inputkan.!!</div>';
  
      }
     
}






?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/<?=$result[0]['user_foto']?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$result[0]['user_nama']?></h3>

                <p class="text-muted text-center"><?=$result[0]['user_tipe']?></p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Username</b> <a class="float-right"><?=$result[0]['user_name']?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?=$result[0]['user_email']?></a>
                  </li>
                  <li class="list-group-item">
                    <b>No Hp</b> <a class="float-right"><?=$result[0]['user_hp']?></a>
                  </li>
                  
                </ul>
              

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!-- <li class="nav-item"><a class="nav-link active" href="#view" data-toggle="tab">View</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#update" data-toggle="tab">Update</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- <div class="active tab-pane" id="view">
                    <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <label><?=$result[0]['user_name']?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_nama" class="col-sm-2 col-form-label">Nama Asli</label>
                        <div class="col-sm-10">
                        <label><?=$result[0]['user_nama']?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <label><?=$result[0]['user_email']?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                        <img src="dist/img/<?=$result[0]['user_foto']?>" alt="User Image"><br>
                        <label><?=$result[0]['user_foto']?></label>
                        </div>
                      </div>
                      
                    </form>
                  </div> -->

                  <div class="active tab-pane" id="update">
                    <form class="form-horizontal" action="profile"  enctype="multipart/form-data" method="post">
                      <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="user_name" name="user_name" placeholder="username" value="<?=$result[0]['user_name']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_pass" class="col-sm-2 col-form-label">password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_nama" class="col-sm-2 col-form-label">Nama Asli</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="user_nama" name="user_nama" placeholder="Nama" value="<?=$result[0]['user_nama']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" value="<?=$result[0]['user_email']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                        <img src="dist/img/<?=$result[0]['user_foto']?>" alt="User Image">
                        <input name="user_foto" type="file" class="form-control" placeholder="Input Foto:"/>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>