

<?php
// $date = DateTime::createFromFormat('Y-m-d', '2012-10-17');
// var_dump($date->format('Y-m-d H:i:s')); //will print 2012-10-17 13:57:34 (the current time)
// echo "mode=".$mode;
// if(isset($_POST['submit'])){ 
//   //echo "tabel=".$table;
//       if(isset($_POST['submit']))
//       {
//         $node_nama = isset($_POST['node_nama']) ? $_POST['node_nama'] : ""; 
       

// $data = Array ("node_id" => null,
//                "node_nama" => $node_nama
// );
// $hasil = $db->insert ('node', $data);

// // $hasil = $db->rawQuery($sql);// or die(mysql_error());
// // echo "<script>alert('$hasil');</script>";
// // var_dump($hasil);
// if($hasil)
// {
//   $info = "Insert berhasil!";
// }
// else
// {
//   $info = "Insert gagal!";
// }
// // $p = "/tablenode";
// // echo "<script>alert('$info');window.location='http://".$_SERVER['HTTP_HOST'].$prefix.$p."';</script>";
//     }
// }//echo $sql;

// //  var_dump($hasil);
//   // echo '<div class="callout callout-info"><h4>Info :</h4><strong></strong> Data berhasil di inputkan.!!</div>';
  

$id = isset($_GET['id']) ? $_GET['id'] : ""; 
if($id && $id != "") {
    $detail = $db->rawQuery("select * from panel where id = $id");

}
$table2 = "sparepart";
$txt_field2= "code,name,volume,price,age";
$txt_label2 = "'KODE','SPARE PART','VOLUME','HARGA SATUAN','UMUR'";
$q_field2 = explode(",",$txt_field2);
$q_label2 = explode(",",$txt_label2);
$i2=1;$q_sesi2 = "select ".$q_field2[0] ." as " .$q_label2[0];
for($i2;$i2<count($q_field2);$i2++)
{
    $q_sesi2 .= ",".$q_field2[$i2] ." as " .$q_label2[$i2];
}
$q_sesi2 .= " from $table2";
$d_sesi2 = $db->rawQuery($q_sesi2);


if($mode!="modal")
{
  echo '<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Main content -->
     <section class="content">
      <div class="row">';
}

function checkStatus($a,$b) {
    if($a==$b) {
        return "selected";
    }
}

?>
  
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">

              <div class="card-body">
                <div class="tab-content">
                  
                 <h2>Edit Panel</h2>

                  <div class="active tab-pane" id="update">
                    <form class="form-horizontal"  id="panelform" action="#"  enctype="multipart/form-data" method="post">

                        <input type="hidden" id="id" name="id" value="<?=$id?>" />
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Panel" value="<?=$detail[0]["name"]?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status" >
                                <option value="1" <?=checkStatus($detail[0]["status"],"1")?>>Active</option>
                                <option value="2" <?=checkStatus($detail[0]["status"],"2")?>>Pending</option>
                                <option value="0" <?=checkStatus($detail[0]["status"],"3")?>>Non Active</option>
                                </select>
                            <!-- <input type="number" class="form-control" id="status" name="status" placeholder="Status Sparepart"> -->
                            </div>
                        </div>
                      <div class="form-group row">
                      <div class="col-sm-6">
                            <button type="submit" id="btnSubmit" class="btn btn-block btn-primary"><span class="fa fa-paper-plane"></span> Submit</button>
                        </div>
                        <div class="col-sm-6">
                            <a href="tablepanel" class="btn btn-block btn-secondary"><span class="fa fa-arrow-left"></span> Back</a>
                        </div>
                      </div>

    </div>

    
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
<script>

$(document).ready(function () {


    $.validator.setDefaults({
    submitHandler: function () {
        console.log( "Form successful submitted!" );
    }
    });


    $('#panelform').validate({
        rules: {
            name: {   required: true,   }
                   
        },
        messages: {
            name: {  required: "Input Nama Node", }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: submitForm
        });

    function submitForm()
    {

        $("#btnSubmit").html('<span class="fa fa-sync fa-spin"></span> Processing');

        // Get form
        var form = $('#panelform')[0];

        // Create an FormData object
        var data = new FormData(form);

        // disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "actionpanel.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
            var rv;
            try {
            rv = JSON.parse(data);
            if(isEmpty(rv))
            {
                    Swal.fire(
                    'Info!',
                    'No Data!',
                    'info'
                    );
                console.log("NO DATA : ", data);
                $("#btnLoadMore").html('Load More');
            }
            else
            {
                if(rv.status==true||rv.status=="true")
                {
                    Swal.fire(
                        'Success!',
                        'Success Edit Data!',
                        'success'
                        );
                    console.log("SUCCESS : ", data);
                    // setTimeout(function(){ window.location="node"; }, 1000);
                        // $('#my-awesome-dropzone')[0].dropzone.removeAllFiles(true); 
                    $("#btnSubmit").html('<span class="fa fa-paper-plane"></span> Submit');
                    $("#panelform")[0].reset();
                    // window.location="/tablepanel";
                    history.back();
                }
                else 
                {
                Swal.fire(
                    'error!',
                    'Error Edit Data, '+data,
                    'error'
                    );
                
                console.log("ERROR : ", data);
                $("#btnSubmit").html('<span class="fa fa-paper-plane"></span> Submit');

                }

            }
            } catch (e) {
            //error data not json
            Swal.fire(
                    'error!',
                    'Error Edit Data,<br> '+data,
                    'error'
                    );
                
                console.log("ERROR : ", data);
                $("#btnSave").html('<span class="fa fa-save"></span> Save');
            } 

            
            $("#btnSubmit").prop("disabled", false);
            // $("#result").text(data);
            

        },
        error: function (e) {

            // $("#result").text(e.responseText);
            console.log("ERROR : ", e);
            $("#btnSubmit").prop("disabled", false);
            $("#btnSubmit").html('<span class="fa fa-paper-plane"></span> Submit');

        }
        });
    }

});
</script>