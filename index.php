<?php
session_start();
// error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$prefix = "/project/e-dermaga";

require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
include("config/functions.php");

// $user_tipe = $_SESSION['t'];
//set tgl
date_default_timezone_set("Asia/Jakarta");
$tgl=date('Y-m-d');
$page=isset($_GET['page']) ? $_GET['page'] : "home"; 
$mode=isset($_GET['mode']) ? $_GET['mode'] : ""; 
$d=isset($_GET['d']) ? $_GET['d'] : ""; 
// echo "page = ".$page. "<hr>mode = ".$mode;
if(!isset($_SESSION['u']))
{
  header('Location:login.php');
  exit(); //hentikan eksekusi kode di login_proses.php
}
$skrg = date("Y-m-d h:i:sa");

$table = isset($_GET['t']) ? $_GET['t'] : 'inbox';
$selected=array();
$home='';
switch ($page) {
        case 'users' : {
                        $selected[8]=' class="active" ';$judul="Users";
                      }break;
        case 'home' : {
                        $selected[4]=' class="active" ';$judul="Home";$home='active';
                      }break;
        
        default : {
                    
                       $selected[4]=' class="active" ';$judul="Home";  
                      }break;

      }

      $sql = "SELECT * FROM users WHERE user_id = '".$_SESSION['i']."' "; 
      $result = $db->rawQuery($sql);//@mysql_query($sql);


      //////////functions
      function check_https() {
	
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
          
          echo "https://"; 
        }
        else
        {
          echo "http://"; 
      
        }
      }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Dermaga | Dashboard</title>
  <link rel="icon" href="assets/img/cargo1_50.png" type="image/png" sizes="50x50">  <!-- Tell the browser to be responsive to screen width -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style dist/js/bootstrap-datepicker.min.js -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- datepicker -->
    <!-- <link rel="stylesheet" href="dist/css/bootstrap-datepicker.min.css"> -->
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="dist/css/jquery.datetimepicker.css">
  <!-- jquery.datetimepicker.css -->
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- toggle -->
  <link href="plugins/bootstrap-toggle-master/css/bootstrap-toggle.css" rel="stylesheet">
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- datatables -->
<link rel="stylesheet" href="dist/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="dist/css/fixedColumns.dataTables.min.css">
 <link rel="stylesheet" href="dist/css/select.dataTables.min.css">
 <link rel="stylesheet" href="dist/css/rowGroup.dataTables.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>

  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-trophy mr-2"></i> 4 sesi baru
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> 8 user baru
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 laporan baru
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

<?php require_once ("sidebar.php"); ?>

  <?php
            $users = $db->get('users', 10); //contains an Array 10 users
            //print_r($users);
            if (file_exists("".$page.".php")) 
            {
                include("".$page.".php");
            }
            else 
            {
                include("error.php");
            }
          ?>

  
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">Kontri Studio</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
<script src="dist/js/jquery.datetimepicker.js"></script>
<!-- jquery.datetimepicker.css -->
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- datepicker -->
<!-- <script src="dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- date-range-picker -->
<!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/dataTables.select.min.js"></script>
<script src="dist/js/dataTables.fixedColumns.min.js"></script>
<script src="dist/js/dataTables.rowGroup.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/dataTables.buttons.min.js"></script>
<script src="dist/js/buttons.flash.min.js"></script>
<!-- <script src="dist/js/pdfmake.min.js"></script> -->
<!-- <script src="dist/js/vfs_fonts.js"></script> -->
<script src="dist/js/buttons.html5.min.js"></script>
<script src="dist/js/buttons.print.min.js"></script>
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<?php  if(($page=="home") || ($page=="index") ) {   ?>
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot-old/jquery.flot.resize.min.js"></script>
<?php  } ?>
<!-- toggle -->
<script src="plugins/bootstrap-toggle-master/js/bootstrap-toggle.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>

<script>
  // (function ($) {
  // })(jQuery);
  $(function () {
    
$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
     
 // Filter from database
	$('.FilterDB').select2({
    minimumInputLength: 2,
        placeholder: 'Select an item',
        // theme: "material",
        theme: 'bootstrap4',
        // allowClear: true,
        ajax: {
          url: 'select2ticket.php?filter=yes&d=<?=$d?>',//'filterDB.php',
          dataType: 'json',
          // delay: 50,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      }); 

      $('.FilterDBsesi').select2({
    minimumInputLength: 2,
        placeholder: 'Select an item',
        // theme: "material",
        theme: 'bootstrap4',
        // allowClear: true,
        ajax: {
          url: 'select2sesi.php?filter=yes',//'filterDB.php',
          dataType: 'json',
          // delay: 50,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      }); 
      //kolam
      $('.FilterDBkolam').select2({
    minimumInputLength: 2,
        placeholder: 'Select an item',
        // theme: "material",
        theme: 'bootstrap4',
        // allowClear: true,
        ajax: {
          url: 'select2kolam.php?filter=yes',//'filterDB.php',
          dataType: 'json',
          // delay: 50,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      }); 
 //Date picker
    $('#tanggal').datetimepicker({
      timepicker:false,
	format:'d-m-Y',
	formatDate:'Y/m/d',
	minDate:'-1970/01/02', // yesterday is minimum date
    });

  $('#duration').datetimepicker({
      datepicker:false,
	    format:'H:i',
	    step:5
    });
    //Timepicker
    $('#start').datetimepicker({
      datepicker:false,
	    format:'H:i',
	    step:5
    });
    //Timepicker
    $('#stop').datetimepicker({
      datepicker:false,
	    format:'H:i',
	    step:5
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',
      "buttons": [
        'print', 'pdf', 'csv',
          {text: 'Reload',
          action: function ( e, dt, node, config ) {
              dt.ajax.reload();
          }
          },
      ],
        <?php
        switch($page)
        {
          case "users" : {echo '"ajax": "get_data_users.php"';}break;
          case "tablenode" : {echo '"ajax": "get_data_node.php"';}break;
          case "tablesparepart" : {echo '"ajax": "get_data_sparepart.php"';}break;
          case "tablepanel" : {echo '"ajax": "get_data_panel.php"';}break;
          case "tabledatasensor" : {echo '"ajax": "get_data_sensor.php"';}break;
          case "sesi" : {echo '"ajax": "get_data_sesi.php","order": [[ 4, "desc" ]]';}break;
          // case "pilihsesi" : {echo '"ajax": "get_data_participant.php?d='.$d.'","order": [[ 2, "desc" ]]';}break;

        }
        ?>
    });

    var table = $('#tabelSparepart').DataTable({
      "paging": false,
      // "lengthChange": false,
      "searching": true,
      "ordering": true,
      // "info": true,
      // "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": "get_data_sparepart_select.php",
      "select": {
            "style": 'multi',
            "selector": 'td:first-child'
        },
      "fixedColumns":   {
          "left": 1 
      },
        "columnDefs": [ 
          // {"targets":[0], "class":"nowrap"},
          { "width": "20%", "targets": 2 },
          {
            "orderable": false,
            "className": 'select-checkbox',
            "targets":   0
        } ],
        "order": [[ 2, 'asc' ]],
        // "height":500,
        // "scrollY":500,
        "scrollCollapse": true,
        "dom": 'Bfrtip',
      "buttons": [
          {text: 'Refresh',
          action: function ( e, dt, node, config ) {
              dt.ajax.reload();
          }
          }
      ],
      // "fixedHeader": true
      // "initComplete": function ( e, dt, node, config ) {
      //         dt.ajax.reload();
      //     }
    });
    

    var tablePanel = $('#tabelPanel').DataTable({
      "paging": false,
      // "lengthChange": false,
      "searching": true,
      "ordering": true,
      // "info": true,
      // "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": "get_data_panel.php",
      "select": {
            "style": 'multi',
            "selector": 'td:first-child'
        },
      "fixedColumns":   {
          "left": 1 
      },
        "columnDefs": [ {
            "orderable": false,
            "className": 'select-checkbox',
            "targets":   0
        },
        { "className": "dt-head-center", "targets": [ 0 ] },
 
      ],
        "order": [[1, 'asc' ]],
        // "height":500,
        // "scrollY":500,
        "scrollCollapse": true,
        "dom": 'Bfrtip',
      "buttons": [
          {text: 'Refresh',
          action: function ( e, dt, node, config ) {
              dt.ajax.reload();
          }
          }
      ],
    });

    // $(".selectAll").on( "click", function(e) {
    // if ($(this).is( ":checked" )) {
    //   tablePanel.rows(  ).select();        
    // } else {
    //   tablePanel.rows(  ).deselect(); 
    // }
// });
    
table.on( 'select', function ( e, dt, type, indexes ) {
  if ( type === 'row' ) {
    let allselected=table.rows( {selected:true} ).data();
    let selected = table.rows( indexes ).data();
    let countselected=table.rows( {selected:true} ).data().length;
    // console.log("allselected=",allselected,allselected[0]);
    let detailtext = document.getElementById("detail").value;
    let detailjson = JSON.parse(detailtext);
    detailjson["jumlah"] = countselected;
    let detailDataArray = [];
    let i=0;
    for (i;i<countselected;i++) {
      detailDataArray.push(allselected[i]);
      }
      console.log("detailDataArray=",detailDataArray);
    detailjson["data"] = detailDataArray;
    detailtext = JSON.stringify(detailjson);
    document.getElementById("detail").value = detailtext;
  }
});

table.on( 'deselect', function ( e, dt, type, indexes ) {
  // if ( type === 'row' ) {
  //   let deselected = table.rows( indexes ).data();
  //       console.log("deselected=",deselected[0][1]);
  //       let detailtext = document.getElementById("detail").value;
  //       let detailjson = JSON.parse(detailtext);
  //       let detailDataArray = detailjson["data"];
  //       let newDetailDataArray = [];
  //       for (let a of detailDataArray) {
  //           if(a[1] != deselected[0][1]) {
  //             newDetailDataArray.push(a);
  //           }
  //        }

  //       console.log("newDetailDataArray=",newDetailDataArray);
  //       detailjson["data"] = newDetailDataArray;
  //       detailtext = JSON.stringify(detailjson);
  //       document.getElementById("detail").value = detailtext;
 
  //     }
  if ( type === 'row' ) {
    let allselected=table.rows( {selected:true} ).data();
    let countselected=table.rows( {selected:true} ).data().length;
    let detailtext = document.getElementById("detail").value;
    let detailjson = JSON.parse(detailtext);
    detailjson["jumlah"] = countselected;
    let detailDataArray = [];
    let i=0;
    for (i;i<countselected;i++) {
      detailDataArray.push(allselected[i]);
      }
      console.log("detailDataArray=",detailDataArray);
    detailjson["data"] = detailDataArray;
    detailtext = JSON.stringify(detailjson);
    document.getElementById("detail").value = detailtext;
  }
});

    // document.getElementById("redrawbtn").onclick = function() {  
    //   redrawTable();
    // };  


    // function redrawTable() {
    //   console.log("redrawTable");
    //   // table.clear().draw();
    //   table.columns.adjust().draw();
    //   table.ajax.reload();  
    // }

    function reloadSparepart() {
      console.log("reloadSparepart");
      table.ajax.reload();  
    }
  });

</script>

<script src="dist/js/tes.js"></script>

<script type="text/javascript" src="dist/js/jquery-barcode.js"></script>
    <script type="text/javascript">
    
      function generateBarcode(){
        var value = no_ticket;//document.getElementById('ticket').value;//'0033';//$("#barcodeValue").val();
        var btype = 'code128';//$("input[name=btype]:checked").val();
        var renderer = 'css';//$("input[name=renderer]:checked").val();

        var settings = {
          output:renderer,
          bgColor: '#FFFFFF',//$("#bgColor").val(),
          color: '#000000',//$("#color").val(),
          barWidth: '5',//$("#barWidth").val(),
          barHeight: '100',//$("#barHeight").val(),
          moduleSize: '5',//$("#moduleSize").val(),
          posX: '10',//$("#posX").val(),
          posY: '20',//$("#posY").val(),
          addQuietZone: '1'//$("#quietZoneSize").val()
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
        } else {
          $("#canvasTarget").hide();
          $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
      }
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      <?php  if(($page=="home") || ($page=="index") ) {   ?>

      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        // generateBarcode();
        //Timepicker
        // $('#timepicker').datetimepicker({
        //   format: 'LT'
        // })
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data        = [],
        totalPoints = 100

    function getRandomData() {

      if (data.length > 0) {
        data = data.slice(1)
      }

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_plot_voltase = $.plot('#grafik_voltase', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )
    var interactive_plot_arus = $.plot('#grafik_arus', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )

    var interactive_plot_daya = $.plot('#grafik_daya', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    
    function update() {

      interactive_plot_voltase.setData([getRandomData()])
      interactive_plot_arus.setData([getRandomData()])
      interactive_plot_daya.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot_voltase.draw()
      interactive_plot_arus.draw()
      interactive_plot_daya.draw()
      if (realtime === 'on') {
        setTimeout(update, updateInterval)
      }
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
      update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtime = 'on'
      }
      else {
        realtime = 'off'
      }
      update()
    })
    /*
     * END INTERACTIVE CHART
     */


      });
    <?php } ?>
    function isEmpty(obj) {
        for(var prop in obj) {
            if(obj.hasOwnProperty(prop))
                return false;
        }
          return true;
      }
    </script>
</body>
</html>
