<?php
include_once ("config/db.php");
$table = 'node';
// Table's primary key
$primaryKey = 'node_id';
$i=0;
$columns = array(
    array( 'db' => 'node_nama', 'dt' => $i++ ),
    array( 'db' => 'node_cmd',  'dt' => $i++,
            'formatter' => function( $d, $row ) {
                        if($d==0){ return 'Turning OFF'; }
                        else if($d==1)
                        {   return 'Turning ON';   }
                        else
                        {   return $d;  }
                    } ),
    array( 'db' => 'node_cmd_status',   'dt' => $i++,
            'formatter' => function( $d, $row ) {
                    if($d==0){ return '<span class="text-info">Command Sent</span>'; }
                    else if($d==1)
                    {   return '<span class="text-success">Executed</span>';   }
                    else
                    {   return $d;  }
                } ),
    array( 'db' => 'node_timer_on',   'dt' => $i++ ),
    array( 'db' => 'node_timer_off',   'dt' => $i++ ),
    array( 'db' => 'node_timer_status',   'dt' => $i++ ,
    'formatter' => function( $d, $row ) {
            if($d==0){ return '<span class="text-danger">OFF</span>'; }
            else if($d==1)
            {   return '<span class="text-success">ON</span>';   }
            else
            {   return $d;  }
        } )
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);