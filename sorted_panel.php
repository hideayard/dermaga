<?php


$detail = isset($_POST['detail']) ? $_POST['detail'] : '{"jumlah":0,"data":[]}'; 
$now = (new \DateTime())->format('Y-m-d H:i:s');
$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : $now; 
$jsonDetail = json_decode($detail);
// var_dump( $jsonDetail );die;

if(!$jsonDetail->data) {
    echo '<script>
    alert("panel tidak boleh kosong");
    history.back();
    </script>';
}
$ids = implode(",",$jsonDetail->data);
$panel = $db->rawQuery("select * from panel where id in ('$ids')");

$table2 = "sparepart";
$txt_field2= "id,code,name,volume,price,date,age,id,id,id";
$txt_label2 = "'PANEL','KODE','SPARE PART','VOLUME','HARGA SATUAN','TANGGAL','UMUR','TANGGAL HABIS SPAREPART','SISA UMUR','EXPIRED'";
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
<style>
table.dataTable tr.group-end td {
    text-align: right;
    font-weight: normal;
}
</style>
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
                                    <label for="name" class="col-sm-3 col-form-label">Tgl Sorting</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=$tgl?>" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>

                        
                        <!-- /.card-header -->
                        <div class="card-body">
                        <!-- <table id="tabelSparepart" class="table table-bordered table-hover"> -->
                        <table id="tableSparepartDetail" class="table table-bordered table-hoverstripe row-border order-column nowrap display" style="width:100%">
                            <thead>
                            <tr>
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

    document.title = "Data Panel Per Tanggal <?=tgl_indo($tgl)?>";
    var tableSparepartDetail = $("#tableSparepartDetail").DataTable({
        "ajax": {
            url: "getDataSparepartSorted.php?id_panel=<?=$ids?>&tgl=<?=$tgl?>",
            type: "POST"
        },
        // "select": {
        //     "style": 'multi',
        // },

        "scrollX": true,
        "dom": 'Bfrtip',
        "buttons": [
            // 'print',
            {
                    "extend": "print",
                    "customize": function(win)
                    {
        
                        var last = null;
                        var current = null;
                        var bod = [];
        
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');
        
                        style.type = 'text/css';
                        style.media = 'print';
        
                        if (style.styleSheet)
                        {
                        style.styleSheet.cssText = css;
                        }
                        else
                        {
                        style.appendChild(win.document.createTextNode(css));
                        }
        
                        head.appendChild(style);
                }
            },
        ],
        "rowGroup": {
            "endRender": function ( rows, group ) {
                console.log("group=",group);
                console.log("rows=",rows);
                var total = rows
                    .data()
                    .pluck(4)
                    .reduce( function (a, b) {
                        return a + b.replace(/[^\d]/g, '')*1;
                    }, 0) ;
                    // rows.count();
 
                    var expired = rows
                    .data()
                    .filter( function ( data, index ) {
                        console.log("data=",data);

                        return data[9] == "true" ? true : false;
                    } )
                    .pluck(4)
                    .reduce( function (a, b) {
                        return a + b.replace(/[^\d]/g, '')*1;
                    }, 0) ;
                return 'Total Biaya Expired Sparepart '+group+' = '+
                $.fn.dataTable.render.number(',', '.', 0, 'Rp.').display( total );
                // +' dan Expired = '+
                // $.fn.dataTable.render.number(',', '.', 0, 'Rp.').display( expired );

            },
            "dataSrc": 0
        }
    //     "buttons": [
    //     'print', 'pdf', 'csv',
    //     // {
    //     //     "extend": 'print',
    //     //     "text": '<img src="images/printer24x24.png" alt="">',
    //     //     "titleAttr": 'Imprimir',
    //     //     "columns": ':not(.select-checkbox)',
    //     //     "orientation": 'landscape'
    //     // }
    //     //   {text: 'Reload',
    //     //   action: function ( e, dt, node, config ) {
    //     //       dt.ajax.reload();
    //     //   }
    //     //   },
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



    

});

</script>