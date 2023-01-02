<?php
include_once ("config/db.php");
$table = 'sensor_data';
// Table's primary key
$primaryKey = 'sensor_data_id';
$i=0;
$columns = array(
    array( 'db' => 'sensor_data_node_nama', 'dt' => $i++ ),
    array( 'db' => 'sensor_data_voltase',  'dt' => $i++),
    array( 'db' => 'sensor_data_arus',   'dt' => $i++ ),
    array( 'db' => 'sensor_data_daya',   'dt' => $i++ ),
    array( 'db' => 'sensor_data_kwh',   'dt' => $i++ ),
    array( 'db' => 'sensor_data_tanggal',   'dt' => $i++ )
    // ,'formatter' => function( $d, $row ) {
    //         if($d==0){ return '<span class="text-danger">OFF</span>'; }
    //         else if($d==1)
    //         {   return '<span class="text-success">ON</span>';   }
    //         else
    //         {   return $d;  }
    //     } )
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);