

<?php
//auto
// $q_column = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='smart' AND `TABLE_NAME`='sesi'";
// $d_columns = $db->rawQuery($q_column);
//end of auto

$table = "sparepart";
$txt_field= "code,name,volume,price,age,status,id";
$txt_label = "'KODE','SPARE PART','VOLUME','HARGA SATUAN','UMUR','STATUS','ACTION'";
$q_field = explode(",",$txt_field);
$q_label = explode(",",$txt_label);
$i=1;$q_sesi = "select ".$q_field[0] ." as " .$q_label[0];
for($i;$i<count($q_field);$i++)
{
    $q_sesi .= ",".$q_field[$i] ." as " .$q_label[$i];
}
$q_sesi .= " from $table";
$d_sesi = $db->rawQuery($q_sesi);
?>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->

<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data <?=ucfirst($table)?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active"><?=ucfirst($table)?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">List Data Sesi</h3> -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                  Tambah <?=ucfirst($table)?>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tableSparepart" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <?php
                    foreach ($q_label as $key => $value) {
                      echo "<th>".$value."</th>";
                      // var_dump($value);
                    }
  
                  ?>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <!-- <tfoot>
                <tr> -->
                <?php
                    // foreach ($q_label as $key => $value) {
                    //   echo "<th>".$value."</th>";
                    // }
                  ?>
                <!-- </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah <?=ucfirst($table)?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php $mode = "modal";
              // echo "mode sblm include=".$mode;
              //  include_get_params('addsesi.php?mode=modal');
               include_once ("addsparepart.php"); ?>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


<script>

$(document).ready(function () {
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
                    url: "processSparepartAll.php?id="+id_sparepart+"&delete",
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