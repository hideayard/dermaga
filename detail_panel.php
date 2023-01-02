<?php


$id = isset($_GET['id']) ? $_GET['id'] : ""; 

$panel = $db->rawQuery("select * from panel where id='$id'");

$table2 = "sparepart";
$txt_field2= "code,name,volume,price,date,age";
$txt_label2 = "'KODE','SPARE PART','VOLUME','HARGA SATUAN','tanggal','UMUR'";
$q_field2 = explode(",",$txt_field2);
$q_label2 = explode(",",$txt_label2);
$i2=1;$q_sesi2 = "select ".$q_field2[0] ." as " .$q_label2[0];
for($i2;$i2<count($q_field2);$i2++)
{
    $q_sesi2 .= ",".$q_field2[$i2] ." as " .$q_label2[$i2];
}
$q_sesi2 .= " from $table2";
$d_sesi2 = $db->rawQuery($q_sesi2);

// $db->where ("cmd_tx", '%B%', 'like');
// $db->orderBy("cmd_time_tx","Desc");
$sparepart = $db->get("sparepart");
// var_dump($sparepart);die;

if($mode!="modal")
{
  echo '<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Main content -->
     <section class="content">
      <div class="row">';
}

function getStatus($status) {
    switch($status) {
        case 1:{return "Active";}break;
        case 2:{return "Pending";}break;
        default:{return "Non Active";}break;
        
    }
}
?>
  
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">

              <div class="card-body">
                <div class="tab-content">
                  
                 

                  <div class="active tab-pane" id="update">
                    <!-- <form class="form-horizontal"  id="nodeform" action="#"  enctype="multipart/form-data" method="post"> -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=$panel[0]["name"]?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=getStatus($panel[0]["status"])?>" disabled>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <form id="formSparepart" class="add-form" method="POST" action="processSparepart.php?add">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Pilih Sparepart</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="sparepart" name="sparepart" >
                                            <?php

                                                foreach($sparepart as $value) {
                                                    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                                                }

                                            ?>
                                        </select>
                                    <!-- <input type="number" class="form-control" id="status" name="status" placeholder="Status Sparepart"> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-6 col-form-label">Tanggal Pemasangan</label>
                                    <div class="col-sm-6">
                                        <input type="datetime-local" id="tgl" name="tgl" class="form-control" >

                                        <input type="hidden" id="id_panel" name="id_panel" class="form-control" value="<?=$id?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" id="btnSubmit" class="btn btn-block btn-success"><span class="fa fa-paper-plane"></span> Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <!-- <table id="tabelSparepart" class="table table-bordered table-hover"> -->
                        <table id="tableSparepartDetail" class="table table-bordered table-hoverstripe row-border order-column nowrap display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <?php
                                    foreach ($q_label2 as $key => $value) {
                                    echo "<th>".$value."</th>";
                                    }
                
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- <input type="hidden" class="form-control" id="detail" name="detail" value='{"jumlah":0,"data":[]}'> -->

                        </div>
                     
                    <!-- </form> -->

                    <!-- <div class="container">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Salary</th>
                    <th>Date</th>
                    <th style="width:100px;"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Salary</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div> -->

    <!-- <div id="addform">
        <form id="form_edit" class="edit-form hideme" method="POST" action="process.php?edit">
            <b>Edit Form</b>
            <div class="form-item">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname_edit" placeholder="enter firstname">
            </div>
            <div class="form-item">
                <label for="firstname">Lastname</label>
                <input type="text" name="lastname" id="lastname_edit" placeholder="enter lastname">
            </div>
            <div class="form-item">
                <label for="firstname">Salary</label>
                <input type="text" name="salary" id="salary_edit" onkeypress="return isNumberKey(event,this)" placeholder="enter salary">
            </div>
            <div class="form-item">
                <button type="reset">Reset</button>
                <button type="submit">Submit</button>

                <button type="button" id="addbtn">Add new</button>
            </div>
        </form>

        <form id="form_add" class="add-form" method="POST" action="process.php?add">
            <b>Add Form</b>
            <div class="form-item">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" placeholder="enter firstname">
            </div>
            <div class="form-item">
                <label for="firstname">Lastname</label>
                <input type="text" name="lastname" id="lastname" placeholder="enter lastname">
            </div>
            <div class="form-item">
                <label for="firstname">Salary</label>
                <input type="text" name="salary" id="salary" onkeypress="return isNumberKey(event,this)" placeholder="enter salary">
            </div>
            <div class="form-item">
                <button type="reset">Reset</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div> -->

    
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

    var tableSparepartDetail = $("#tableSparepartDetail").DataTable({
        "ajax": {
            url: "getDataSparepart.php?id_panel=<?=$id?>",
            type: "POST"
        },
        // "select": {
        //     "style": 'multi',
        // },

        "dom": 'frtip',
    //     "buttons": [
    //     // 'print', 'pdf', 'csv',
    //       {text: 'Reload',
    //       action: function ( e, dt, node, config ) {
    //           dt.ajax.reload();
    //       }
    //       },
    //   ],
        // "columnDefs": [ 
        //     {
        //         "orderable": false,
        //         "className": 'select-checkbox',
        //         "targets":   0
        //     },
        //     { "className": "dt-head-center", "targets": [ 0 ] },
        // ],

        
    });

    function reloadTable()
    {
        tableSparepartDetail.ajax.reload();
    }


    $.validator.setDefaults({
    submitHandler: function () {
        console.log( "Form successful submitted!" );
    }
    });


    $('#formSparepart').validate({
        rules: {
            sparepart: {   required: true,   }
            ,tgl: {   required: true,   }
                   
        },
        messages: {
            sparepart: {  required: "Pilih Sparepart", }
            ,tgl: {  required: "Pilih Tanggal Pemasangan", }
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
        var form = $('#formSparepart')[0];

        // Create an FormData object
        var data = new FormData(form);

        // disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "processSparepart.php?add",
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
                $("#formSparepart")[0].reset();
                reloadTable();
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

function deleteSparepart(id_sparepart) {
        if(id_sparepart) {
            if(confirm("are you sure?")) {
                var table = $('#example').DataTable();
                // $.ajax({
                //     url: "processSparepart.php?delete",
                //     type: 'POST',
                //     data: { id: id },
                //     dataType: 'json',
                //     success: function (response) {
                //         alert(response);
                //         table.ajax.reload(null, false);
                //     }
                // });
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "processSparepart.php?id="+id_sparepart+"&delete",
                    // data: { id: id_sparepart },
                    // dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                    var rv;
                    try {
                    console.log("RETURN : ", data);

                    rv = JSON.parse(data);
                    console.log("rv : ", rv);

                    if(isEmpty(rv))
                    {
                            Swal.fire(
                            'Info!',
                            'No Data!',
                            'info'
                            );
                        console.log("NO DATA : ", data);
                    }
                    else
                    {
                        if(rv.status==true||rv.status=="true")
                        {
                        Swal.fire(
                            'Success!',
                            'Success Delete Data!',
                            'success'
                            );
                            console.log("SUCCESS : ", data);
                            location.reload();

                        }
                        else 
                        {
                        Swal.fire(
                            'error!',
                            'Error Delete Data, '+data,
                            'error'
                            );
                        console.log("ERROR : ", data);
                        }
                    }
                    } catch (e) {
                    Swal.fire(
                            'error!',
                            'Error Delete Data,<br> '+data,
                            'error'
                            );
                        console.log("catch ERROR : ", data);
                        $("#btnSave").html('<span class="fa fa-save"></span> Save');
                    } 
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                }
                });
            }
            return false;
        }
    }
</script>