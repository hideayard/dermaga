

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
                    <form class="form-horizontal"  id="sparepartform" action="#"  enctype="multipart/form-data" method="post">

                        <div class="form-group row">
                            <label for="code" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Kode">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Sparepart">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="volume" class="col-sm-3 col-form-label">Volume</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="volume" name="volume" placeholder="Volume Sparepart">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Harga Sparepart">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Tanggal Pemasangan</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Tanggal Pemasangan Sparepart">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-sm-3 col-form-label">Umur</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Umur Sparepart">
                            </div>
                        </div>
                        
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="submit" id="btnSubmit" class="btn btn-block btn-primary"><span class="fa fa-paper-plane"></span> Submit</button>
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
<script>

$(document).ready(function () {


    $.validator.setDefaults({
    submitHandler: function () {
        console.log( "Form successful submitted!" );
    }
    });


    $('#sparepartform').validate({
        rules: {
            name: {   required: true,   },
            volume: {   required: true,   },
            price: {   required: true,   },
            age: {   required: true,   }
        },
        messages: {
            name: {  required: "Input Nama Sparepart", },
            volume: {  required: "Input volume Sparepart", },
            price: {  required: "Input Harga Sparepart", },
            age: {  required: "Input Umur Sparepart", }
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
        var form = $('#sparepartform')[0];

        // Create an FormData object
        var data = new FormData(form);

        // disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "actionsparepart.php",
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
                        'Success Input Data!',
                        'success'
                        );
                    console.log("SUCCESS : ", data);
                    // setTimeout(function(){ window.location="node"; }, 1000);
                        // $('#my-awesome-dropzone')[0].dropzone.removeAllFiles(true); 
                    $("#btnSubmit").html('<span class="fa fa-paper-plane"></span> Submit');
                    $("#sparepartform")[0].reset();
                }
                else 
                {
                    Swal.fire(
                        'error!',
                        'Error Input Data, '+data,
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
                    'Error Input Data,<br> '+data,
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