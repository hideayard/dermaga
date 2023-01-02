<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/knockout/2.0.0/knockout-min.js">
</script>
<?php
  
function get_elapsed_time($then,$now,$format)
{
            $then = strtotime($then);
            //Calculate the difference.
            $difference = $now - $then;
            switch($format)
            {
              case 'jam' : {return floor($difference);}break;
              case 'menit' : {return floor($difference / 60);}break;
              case 'detik' : {return floor($difference / 60 / 60);}break;
            }
            //Convert seconds into minutes.
            
}

function date_getFullTimeDifference( $start, $end )
{
      $uts['start'] = strtotime( $start );
        $uts['end'] = strtotime( $end );
        if( $uts['start']!==-1 && $uts['end']!==-1 )
        {
            if( $uts['end'] >= $uts['start'] )
            {
                $diff    =    $uts['end'] - $uts['start'];
                if( $years=intval((floor($diff/31104000))) )
                    $diff = $diff % 31104000;
                if( $months=intval((floor($diff/2592000))) )
                    $diff = $diff % 2592000;
                if( $days=intval((floor($diff/86400))) )
                    $diff = $diff % 86400;
                if( $hours=intval((floor($diff/3600))) )
                    $diff = $diff % 3600;
                if( $minutes=intval((floor($diff/60))) )
                    $diff = $diff % 60;
                $diff    =    intval( $diff );
                $return_value = ( array('Tahun'=>$years,'Bulan'=>$months,'Hari'=>$days, 'Jam'=>$hours, 'Menit'=>$minutes) );//, 'Detik'=>$diff) );
                // var_dump($return_value);
                  $interval = "";
                  foreach($return_value as $key => $value)
                  {
                    if($value)
                    {
                      $interval .= " ".$value." ".$key;
                    }
                    
                  }
                  return $interval;
            }
            else
            {
                echo "Ending date/time is earlier than the start date/time";
            }
        }
        else
        {
            echo "Invalid date/time data detected";
        }
}
?>
<style>
.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}


</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <!-- ./col -->
          <?php
          $sql = "SELECT a.*,b.*,ifnull(b.sensor_data_kwh,'-') as 'sensor_data_kwh' FROM `node` as a LEFT JOIN (SELECT * FROM sensor_data t1 WHERE t1.sensor_data_tanggal = (SELECT max(t2.sensor_data_tanggal) FROM sensor_data t2 WHERE t1.sensor_data_node_nama = t2.sensor_data_node_nama)  ) b ON b.sensor_data_node_nama = a.node_nama  where node_status = 1 ORDER BY node_id";
          $hasil = $db->rawQuery($sql);

          $i=1;
          $j=1;
          //Get the current timestamp.
          $now = time();
          foreach ($hasil as $key => $value)
          { 
            // var_dump($value);
            switch($i)
            {
              case 1 :{$box_color = 'info';$btn_color = 'btn-info';$warna = 'blue';}break;
              case 2 :{$box_color = 'success';$btn_color = 'btn-success';$warna = 'green';}break;
              case 3 :{$box_color = 'warning';$btn_color = 'btn-warning';$warna = 'yellow';}break;
              case 4 :{$box_color = 'danger';$btn_color = 'btn-danger';$warna = 'red';}break;
            }
            

            //  $first  = new DateTime($value['sensor_data_tanggal']);
            // $second = (new \DateTime())->format('Y-m-d H:i:s');
            $then = $value['sensor_data_tanggal'];
            //Convert it into a timestamp.
            // get_elapsed_time( $then, $now, 'jam');
            // echo $minutes;
            // echo "<script>console.log('".$minutes."');</script>";
            $minutes = get_elapsed_time($then,$now,'menit');
            if($minutes<=5)
            {
                $status_koneksi = "Connected";
            }
            else
            {
              $status_koneksi = "Disconnected";
            }
            $date_b = new DateTime();
            if($value['node_cmd']==1)
            {
              if($value['node_time_on'])
              {
                $times = $value['node_time_on'];
                  $skrg = (new DateTime())->format('Y-m-d H:i:s');
                  $return_value =  date_getFullTimeDifference( $times , $skrg );
                $txt_elapsed = "On at ".(new \DateTime($value['node_time_on']))->format('H:i:s d-m-Y')." (".$return_value.")";
              }
              else
              {
                $txt_elapsed = " - ";
              }
            }
            else
            {
              if($value['node_time_off'])
              {
                $times = $value['node_time_off'];
                  $skrg = (new DateTime())->format('Y-m-d H:i:s');
                  $return_value =  date_getFullTimeDifference( $times , $skrg );
                $txt_elapsed = "Off at ".(new \DateTime($value['node_time_off']))->format('H:i:s d-m-Y')." (".$return_value.")";
              }
              else
              {
                $txt_elapsed = " - ";
              }
              
            }
            // var_dump($value);
            // echo "<input type='hidden' id='txt_id_".$value['node_id']."' value='".$value['node_id']."' />";
            echo "<input type='hidden' id='txt_nama_".$value["node_id"]."' value='".$value['node_nama']."' />";
            echo "<input type='hidden' id='txt_status_".$value["node_id"]."' value='".$status_koneksi."' />";
            echo "<input type='hidden' id='txt_onoffat_".$value["node_id"]."' value='".$txt_elapsed."' />";
            echo "<input type='hidden' id='txt_daya_".$value["node_id"]."' value='".$value['sensor_data_daya']."' />";
            echo "<input type='hidden' id='txt_tegangan_".$value["node_id"]."' value='".$value['sensor_data_voltase']."' />";
            echo "<input type='hidden' id='txt_arus_".$value["node_id"]."' value='".$value['sensor_data_arus']."' />";
            echo "<input type='hidden' id='txt_last_maintenance_".$value["node_id"]."' value='".$value['node_last_maintenance']."' />";
            echo "<input type='hidden' id='txt_timer_status_".$value["node_id"]."' value='".$value['node_timer_status']."' />";
            echo "<input type='hidden' id='txt_color_".$value["node_id"]."' value='".$box_color."' />";
            $timeron = (new DateTime($value['node_timer_on']))->format('H:i:s');
            $timeroff = (new DateTime($value['node_timer_off']))->format('H:i:s');
           ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-<?=$box_color?>">
              <div class="inner">
                <h3 id="node_nama_<?=$value["node_id"]?>"><?=$value['node_nama']?>
                </h3>
                <p>
                <br>Status : <span id="node_status_<?=$value["node_id"]?>"><?=$status_koneksi?></span>
                <br><span id="node_elapsed_<?=$value["node_id"]?>"><?=$txt_elapsed?></span>
                <br>Daya Terpakai : <span id="node_sensor_data_kwh_<?=$value["node_id"]?>"><?=$value["sensor_data_kwh"]?> KwH</span> 
                <br>Timer ON : <span id="node_timeron_<?=$value["node_id"]?>"><?=$timeron?></span> 
                <br>Timer OFF : <span id="node_timeroff_<?=$value["node_id"]?>"><?=$timeroff?></span> 
                </p>
              </div>
              <div class="icon">
              <?php
              if($value['node_cmd'] == '1')
              {
                $class = "iconify"; 
                $data_icon = "ion-md-sunny";
                $check = "checked";
               
              }
              else{
                $class = "fa fa-lightbulb";
                $data_icon = "";
                $check = "";
              }
              //check timer
              if($value['node_timer_status'] == 0)
              {
                $btn_color_timer = "btn-secondary";
              }
              else
              {
                $btn_color_timer = $btn_color;
              }
              ?>
                  <i id="span_icon_<?=$value["node_id"]?>" ><span class="<?=$class?>" data-icon="<?=$data_icon?>"></span></i>
              </div>
              <div class="btn-group small-box-footer">
                          
              <div class="panel-body">
              <input name="my-checkbox" id="my-checkbox-<?=$value["node_id"]?>" onchange="action_on_off('<?=$value['node_id']?>');"  type="checkbox" <?=$check?> data-toggle="toggle" data-onstyle="<?=$box_color?>">

              <button id="btn_timer_<?=$value['node_id']?>" onclick="settimer('<?=$value['node_nama']?>','<?=$value['node_id']?>','<?=$timeron?>','<?=$timeroff?>');" type="button" class=" btn <?=$btn_color_timer?> btn-circle btn-lg"><i class="fa fa-clock"></i></button>

              <button onclick="showdetail('<?=$value['node_nama']?>','<?=$value['node_id']?>');" type="button" class="btn <?=$btn_color?>"><span class="fa fa-ellipsis-v"></span></button>
            

            </div>      

                </div>            
              </div>
          </div>
          <!-- ./col -->
          <?php 
             if(++$i>4){$i=1;} 
             $j++;
          } 
        ?>
        <input id="increment" type="hidden" value="0" />
        <input id="selected_j" type="hidden" value="1" />
          <div class="col-lg-3 col-6">
         
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Launch Default Modal
                </button> -->
  <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal_title">Setting Timer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
              <p > 
                <table style="text-align: left">
                <tr>
                    <td>ON </td>
                    <td>: <input id="timer_start" name="timer_start" data-bind="value: startTime" type="Time" ></input></td>
                </tr>
                <tr>
                    <td>OFF </td>
                    <td>: <input id="timer_end" name="timer_end" data-bind="value: endTime" type="Time"></input></td>
                </tr>
                <tr>
                    <td>Activate Timer</td>
                    <td>: 
                    <input type="checkbox" data-toggle="toggle" name="timer_checkbox" id="timer_checkbox" /></td>
                </tr>  
              </table>
              </p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button onclick="resettimer();" type="button" class="btn btn-secondary">Reset</button>
              <button id="btn-save-timer" type="button" onclick="action_savetimer();" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal_detail_title">Detail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
              <p > 
                <table >
                  <tr><td style="text-align: right;">Nama : </td>
                      <td> <div id="detail_nama" >Lampu 1</div>
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">Status : </td>
                      <td><div id="detail_status" >Lampu 1</div> 
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">On at : </td>
                      <td><div id="detail_onoff_at" >Lampu 1</div> 
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">Daya : </td>
                      <td><div id="detail_daya" >Lampu 1</div> 
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">Tegangan : </td>
                      <td><div id="detail_tegangan" >Lampu 1</div> 
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">Arus : </td>
                      <td><div id="detail_arus" >Lampu 1</div> 
                      </td>
                  </tr>
                  <tr>
                  <td style="text-align: right;">Grafik : </td>
                      <td><button onclick="showgrafik();" class="btn btn-primary" >   <i class="fa fa-chart-bar"></i></button>
                      </td>
                  </tr>
                  <tr><td style="text-align: right;">Last Maintenance : </td>
                      <td><div id="detail_last_maintenance" >Lampu 1</div> 
                      </td>
                  </tr>
                        
              </table>
              </p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-grafik">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal_grafik_title">Grafik</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
              <p > 
                <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Data Voltase
                  </h3>

                  <div class="card-tools">
                    Real time
                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                      <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                      <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="grafik_voltase" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><canvas class="flot-overlay" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;"><svg style="width: 100%; height: 100%;"><g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="28" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">0</text><text x="93.01333648989899" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">10</text><text x="162.00323547979798" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">20</text><text x="230.99313446969697" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">30</text><text x="299.98303345959596" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">40</text><text x="368.9729324494949" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">50</text><text x="437.96283143939394" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">60</text><text x="506.95273042929284" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">70</text><text x="575.9426294191919" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">80</text><text x="644.9325284090909" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">90</text></g><g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="8.953125" y="269" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">0</text><text x="1" y="218.2" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">20</text><text x="1" y="167.4" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">40</text><text x="1" y="116.6" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">60</text><text x="1" y="65.8" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">80</text><text x="-6.953125" y="15" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">100</text></g></svg></div></div>
                </div>
                <!-- /.card-body-->
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Data Arus
                  </h3>

                  <div class="card-tools">
                    Real time
                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                      <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                      <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="grafik_arus" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><canvas class="flot-overlay" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;"><svg style="width: 100%; height: 100%;"><g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="28" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">0</text><text x="93.01333648989899" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">10</text><text x="162.00323547979798" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">20</text><text x="230.99313446969697" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">30</text><text x="299.98303345959596" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">40</text><text x="368.9729324494949" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">50</text><text x="437.96283143939394" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">60</text><text x="506.95273042929284" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">70</text><text x="575.9426294191919" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">80</text><text x="644.9325284090909" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">90</text></g><g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="8.953125" y="269" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">0</text><text x="1" y="218.2" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">20</text><text x="1" y="167.4" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">40</text><text x="1" y="116.6" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">60</text><text x="1" y="65.8" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">80</text><text x="-6.953125" y="15" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">100</text></g></svg></div></div>
                </div>
                <!-- /.card-body-->
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Data Daya
                  </h3>

                  <div class="card-tools">
                    Real time
                    <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                      <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                      <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="grafik_daya" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><canvas class="flot-overlay" width="723" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 723px; height: 300px;"></canvas><div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;"><svg style="width: 100%; height: 100%;"><g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="28" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">0</text><text x="93.01333648989899" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">10</text><text x="162.00323547979798" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">20</text><text x="230.99313446969697" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">30</text><text x="299.98303345959596" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">40</text><text x="368.9729324494949" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">50</text><text x="437.96283143939394" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">60</text><text x="506.95273042929284" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">70</text><text x="575.9426294191919" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">80</text><text x="644.9325284090909" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">90</text></g><g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><text x="8.953125" y="269" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">0</text><text x="1" y="218.2" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">20</text><text x="1" y="167.4" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">40</text><text x="1" y="116.6" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">60</text><text x="1" y="65.8" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">80</text><text x="-6.953125" y="15" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">100</text></g></svg></div></div>
                </div>
                <!-- /.card-body-->
              </div>

              </p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- <input type="hidden" id="unlockonoff" value="1" /> -->
<script>
  var unlockonoff = true;// document.getElementById("unlockonoff").value;
  function comingsoon()
  {
    $(document).Toasts('create', {
    class: 'bg-info', 
    title: 'Coming Soon.!!!',
    // subtitle: '!!!',
    body: 'Content Not Available for now<br>Please contact us for more info.'
  });
  }
  function settimer(a,i,timer_start,timer_end)
  { 
    console.log(a,"-",i);
    document.getElementById('modal_title').innerHTML = "Setting Timer "+a;
    document.getElementById('selected_j').value = i;
    document.getElementById('timer_start').value = timer_start;
    document.getElementById('timer_end').value = timer_end;
    console.log(document.getElementById('txt_timer_status_'+i).value);
    if(document.getElementById('txt_timer_status_'+i).value == 1)
    {
      console.log('masuk true');
      unlockonoff = false;
      $('#timer_checkbox').bootstrapToggle('on');
    }
    else
    {
      console.log('masuk else false');
      unlockonoff = false;
      $('#timer_checkbox').bootstrapToggle('off');
      
    }

    $("#modal-sm").modal();
  }

  function showdetail(a,i)
  {
    console.log(a);
    document.getElementById('modal_detail_title').innerHTML = "Detail of "+a;
    document.getElementById('detail_nama').innerHTML = a;
    
    document.getElementById('detail_status').innerHTML = document.getElementById('txt_status_'+i).value;
    document.getElementById('detail_onoff_at').innerHTML = document.getElementById('txt_onoffat_'+i).value;
    document.getElementById('detail_daya').innerHTML = document.getElementById('txt_daya_'+i).value;
    document.getElementById('detail_tegangan').innerHTML = document.getElementById('txt_tegangan_'+i).value;
    document.getElementById('detail_arus').innerHTML = document.getElementById('txt_arus_'+i).value;
    document.getElementById('detail_last_maintenance').innerHTML = document.getElementById('txt_last_maintenance_'+i).value;
    
    $("#modal-detail").modal();
  }

  function resettimer()
  {
    // console.log(a);
    document.getElementById('on_jam').value = 0;
    document.getElementById('on_menit').value = 0;
    document.getElementById('off_jam').value = 0;
    document.getElementById('off_menit').value = 0;
    // $("#modal-default").modal();
  }

  function showgrafik()
  {
    //modal_detail_title
    let a = document.getElementById('modal_detail_title').innerHTML;
    console.log('showgrafik',a);
    document.getElementById('modal_grafik_title').innerHTML = "Grafik "+a;
    
    $("#modal-grafik").modal();
  }

  function action_on_off(a)
  { console.log("unlockonoff before",unlockonoff);
    if(unlockonoff)
    {
        console.log('action_on_off - increment',document.getElementById("increment").value);
        //i dont know why this action is always called upon load.
        //increment >7 indicate not default/starting value
        if(++document.getElementById("increment").value>0)//<?=($j-1)?>)
        {
          let topic = document.getElementById('txt_nama_'+a).value;
          if (document.getElementById('my-checkbox-'+a).checked) 
          {
            document.getElementById("span_icon_"+a).innerHTML = "<span class='iconify' data-icon='ion-md-sunny'></span>";
            console.log(a,'checked');
            // cmd_txt,cmd<type,cmd_topic
            // sendCommand('lampon',null,topic);
            sendCommand('lampon',null,topic,"btn-save-timer","Save Changes");
          } else {
              // calculate();
              document.getElementById("span_icon_"+a).innerHTML = "<span class='fa fa-lightbulb' '></span>";
              console.log(a,'not checked');
              // sendCommand('lampoff',null,topic);
              sendCommand('lampoff',null,topic,"btn-save-timer","Save Changes");

          }
        }
    }
    else
    {unlockonoff = true;}
    console.log("unlockonoffafter",unlockonoff);
    
    
  }

  function action_savetimer()
  {
    let i = document.getElementById('selected_j').value;
    console.log("actionsavetimer",i);
    if(document.getElementById("txt_timer_status_"+i).value == "0")
    { //currently off, so it will turn on
      document.getElementById("txt_timer_status_"+i).value = "1";
      document.getElementById("btn_timer_"+i).className = ("btn btn-"+document.getElementById("txt_color_"+i).value+" btn-circle btn-lg");
      console.log(i,"off to on");
    }
    else
    {
      document.getElementById("txt_timer_status_"+i).value = "0";
      document.getElementById("btn_timer_"+i).className = ('btn btn-secondary btn-circle btn-lg');
      console.log(i,"on to off");
    }
    let tsa = document.getElementById("timer_start").value;
    let te = document.getElementById("timer_end").value;
    let valuet = tsa+";"+te+";";
    let topic = document.getElementById('txt_nama_'+i).value;
    console.log(i,tsa,te,topic);
    if(document.getElementById("timer_checkbox").checked==true)
    {
      sendCommand('timeron',valuet,topic,"btn-save-timer","Save Changes");
    }
    else
    {
      sendCommand('timeroff',valuet,topic,"btn-save-timer","Save Changes");
    }
    
  }


  function sendCommand(cmd_txt,txt_value,cmd_topic,id_btn,txt)
  { 
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2500
    });
  console.log("sendCommand",cmd_txt,txt_value,cmd_topic);
    $.ajax({
      url:"<?=check_https().$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])?>/actionmqtt.php",
        method:"POST", //First change type to method here
        data:{
          txt : cmd_txt,
          value : txt_value,
          topic: cmd_topic
        },
        beforeSend: function()
            {   
                $("#"+id_btn).html('<i class="fa fa-sync fa-spin"></i> &nbsp; Sending');
            },
        success:function(response) {
          try {
            rv = JSON.parse(response);
            if(rv.status==true)
              { Toast.fire({type: 'success', title: rv.success});}
              else
              { Toast.fire({type: 'error', title: rv.error});}
          } catch (e) {
             Toast.fire({type: 'error', title: rv.error});
          }
         console.log(response);
         $("#"+id_btn).html(txt);
         
       },
       error:function(e){
        console.log("error = "+e);
        $("#"+id_btn).html(txt);
       }

      });
  }

  function get_update()
{
  $.ajax({
        url:"<?=check_https().$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])?>/actionrefresh.php",
        method:"POST", 
        success:function(response) {
        let myObj = JSON.parse(response);
        myObj.forEach(peritem);
        console.log("myObj",myObj);
       },
       error:function(e){
        console.log("error = ",e);
       }

      });
}
let intervalId= setInterval(() =>get_update(), 1000);

// get_update();
var unlockonoff = true;

function peritem(item, index) {
          document.getElementById("txt_nama_"+(item['txt_id'])).value = item['txt_nama'];
          document.getElementById("txt_status_"+(item['txt_id'])).value = item['txt_status'];
          document.getElementById("txt_onoffat_"+(item['txt_id'])).value = item['txt_onoffat'];
          document.getElementById("txt_daya_"+(item['txt_id'])).value = item['txt_daya'];
          document.getElementById("txt_tegangan_"+(item['txt_id'])).value = item['txt_tegangan'];
          document.getElementById("txt_arus_"+(item['txt_id'])).value = item['txt_arus'];
          document.getElementById("txt_last_maintenance_"+(item['txt_id'])).value = item['txt_last_maintenance'];
          document.getElementById("txt_timer_status_"+(item['txt_id'])).value = item['txt_timer_status'];
          document.getElementById("txt_color_"+(item['txt_id'])).value = item['txt_color'];
          document.getElementById("node_nama_"+(item['txt_id'])).innerHTML = item['txt_cmd_status']+item['txt_nama'];
          document.getElementById("node_status_"+(item['txt_id'])).innerHTML = item['txt_status'];
          document.getElementById("node_elapsed_"+(item['txt_id'])).innerHTML = item['txt_onoffat'];
          document.getElementById("node_sensor_data_kwh_"+(item['txt_id'])).innerHTML = item['txt_daya']+" KwH";
          document.getElementById("node_timeron_"+(item['txt_id'])).innerHTML = item['txt_timeron'];
          document.getElementById("node_timeroff_"+(item['txt_id'])).innerHTML = item['txt_timeroff'];
          //node_timeron_
          let checkeds = true;
          if(item["action_on_off"] == "checked")//action_on_off
          {
            checkeds = true;
            if(!document.getElementById('my-checkbox-'+item['txt_id']).checked == true)
            {
                // icon on
                document.getElementById("span_icon_"+item['txt_id']).innerHTML = "<span class='iconify' data-icon='ion-md-sunny'></span>";
                // document.getElementById('my-checkbox-'+item['txt_id']).checked = true;
                unlockonoff = false;
                $('#my-checkbox-'+item['txt_id']).bootstrapToggle('on');
                console.log('checked = ',document.getElementById('my-checkbox-'+item['txt_id']).checked,'my-checkbox-'+item['txt_id'], true, document.getElementById('my-checkbox-'+item['txt_id']).checked);
             }

          }
          else
          { 
            checkeds = false;
            if(!document.getElementById('my-checkbox-'+item['txt_id']).checked == false)
            {
              //icon off
              document.getElementById("span_icon_"+item['txt_id']).innerHTML = "<span class='fa fa-lightbulb' '></span>";
              // document.getElementById('my-checkbox-'+item['txt_id']).checked = false;
              unlockonoff = false;
              $('#my-checkbox-'+item['txt_id']).bootstrapToggle('off');
              console.log('not checked','my-checkbox-'+item['txt_id'], false, document.getElementById('my-checkbox-'+item['txt_id']).checked);
            }
          }
        }
        
//<![CDATA[
window.onload=function(){

viewModel = {
//reset startTime and EndTime
startTime: ko.observable(moment().format('HH:mm')),
endTime: ko.observable(moment().format('HH:mm'))
// timeDiff : ko.computed(function () {
//   console.log(this.startTime);
//   console.log(this.endTime);
//   return  moment.duration(this.endTime - this.startTime).humanize();

// })
};
ko.applyBindings(viewModel);
}
//]]>
</script>
