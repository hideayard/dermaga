

<?php
// $date = DateTime::createFromFormat('Y-m-d', '2012-10-17');
// var_dump($date->format('Y-m-d H:i:s')); //will print 2012-10-17 13:57:34 (the current time)
// echo "mode=".$mode;
if(isset($_POST['submit'])){ 
  //echo "tabel=".$table;
      if(isset($_POST['submit']))
      {
        $user_nama = isset($_POST['user_nama']) ? $_POST['user_nama'] : ""; 
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : ""; 
        $user_pass = isset($_POST['user_pass']) ? $_POST['user_pass'] : ""; 
        $user_hp = isset($_POST['user_hp']) ? $_POST['user_hp'] : ""; 
        $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : ""; 
        $user_tipe = isset($_POST['user_tipe']) ? $_POST['user_tipe'] : ""; 
        $user_foto = isset($_FILES["user_foto"]["name"]) ? $_FILES["user_foto"]["name"] : "avatar5.png"; 
        // $id = isset($_SESSION['i']) ? $_SESSION['i'] : "";
        $info = "Insert Sukses!!";
        $tgl = (new \DateTime())->format('Y-m-d H:i:s');
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

$data = Array ("user_id" => null,
               "user_nama" => $user_nama,
               "user_name" => $user_name,
               "user_pass" => $user_pass,
               "user_hp" => $user_hp,//$sesi_tgl->format('Y-m-d'),
               "user_email" => $user_email,
               "user_tipe" => $user_tipe,
               "user_foto" => $user_foto,
               "user_status" => 1,
               "created_at" => $tgl,
               "modified_at" => $tgl,
               "is_deleted" => 0
);
$hasil = $db->insert ('users', $data);

// $hasil = $db->rawQuery($sql);// or die(mysql_error());
// echo "<script>alert('$hasil');</script>";
// var_dump($hasil);
if($hasil)
{
  $info = "Insert berhasil!";
}
else
{
  $info = "Insert gagal!";
}
$p = "/users";
echo "<script>alert('$info');window.location='http://".$_SERVER['HTTP_HOST'].$prefix.$p."';</script>";
    }
}//echo $sql;

//  var_dump($hasil);
  // echo '<div class="callout callout-info"><h4>Info :</h4><strong></strong> Data berhasil di inputkan.!!</div>';
  





if($mode!="modal")
{
  echo '<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Main content -->
     <section class="content">
      <div class="row">';
}

?>
  
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">

              <div class="card-body">
                <div class="tab-content">
                  
                 

                  <div class="active tab-pane" id="update">
                    <form class="form-horizontal" action="adduser"  enctype="multipart/form-data" method="post">

                    <div class="form-group row">
                        <label for="user_nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="user_nama" name="user_nama" placeholder="Nama">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                        <input type="text" min="1" class="form-control" id="user_name" name="user_name" value="1" placeholder="Username" >
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="user_pass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_hp" class="col-sm-2 col-form-label">HP</label>
                        <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input name="user_hp" id="user_hp" type="number" class="form-control"
                                data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                        </div>                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Email">                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_tipe" class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="user_tipe" name="user_tipe">
                                <option value='PESERTA'>Peserta</option>
                                <option value='JURI'>Juri</option>
                                <option value='PEGAWAI'>Pegawai</option>
                            </select>
                          <!-- <input type="number" min="0" class="form-control" id="sesi_jml_peserta" name="sesi_jml_peserta" placeholder="Username" > -->
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                        <img src="dist/img/<?=$result[0]['user_foto']?>" alt="User Image">
                        <input name="user_foto" type="file" class="form-control" placeholder="Input Foto:"/>
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <label for="user_foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="">
                                <input type="file" class="form-control" id="user_foto" name="user_foto">
                                <label class="custom-file-label" for="user_foto">Choose file</label>
                            </div>                        </div>
                      </div> -->

                      
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
<?php
if($mode!="modal")
{
  echo '</div>
  <!-- Main content -->
</section>
</div>';
}
?>
