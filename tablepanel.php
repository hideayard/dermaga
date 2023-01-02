

<?php
//auto
// $q_column = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='smart' AND `TABLE_NAME`='sesi'";
// $d_columns = $db->rawQuery($q_column);
//end of auto

$table = "panel";
$txt_field= "name,created_at,id,status,id";
$txt_label = "'Nama','Tanggal Pembuatan','Jml Expired Sparepart','Status','Action'";
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
              <div class="row">
                <div class="col-md-2">
                  <button id="redrawbtn" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                      Tambah <?=ucfirst($table)?>
                  </button>
                </div>
                <div class="col-md-4">
                <form class="form-horizontal"  id="panelSortirForm" action="index.php?page=sorted_panel"  enctype="multipart/form-data" method="post">
                  <input type="hidden" class="form-control" id="detail" name="detail" value='{"jumlah":0,"data":[]}'>
                    <table>
                      <tr>
                        <td> <label>Tanggal Acuan : </label> </td>
                        <td> <input type="date" id="tgl" name="tgl" class="form-control"/> </td>
                        <td> | 
                        <!-- <a class="btn btn-success" href="index.php?page=sorted_panel">Sortir <?=ucfirst($table)?></a> -->
                          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                              Sortir <?=ucfirst($table)?>
                          </button> 
                        </td>
                      </tr>
                    </table>
                  </form>

                </div>

                <div class="col-md-4">
                </div>
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="dataTables_wrapper">

              <table id="tablePanel" class="table table-bordered table-hoverstripe row-border order-column nowrap display" style="width:100%">
                <thead>
                <tr>
                  <th>
                    <input class="selectAll" type="checkbox" value="">
                  </th>
                  <?php
                    foreach ($q_label as $key => $value) {
                      echo "<th>".$value."</th>";
                    }
                  ?>
                </tr>
                </thead>
                <tbody> </tbody>
              </table>
              </div>
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
            include_once ("addpanel.php"); ?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


