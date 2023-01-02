<?php
include_once ("config/db.php");
include_once ("config/functions.php");
$table = 'panel';
// Table's primary key
$primaryKey = 'id';
$i=0;
$columns = array(
    array( 'db' => 'id', 'dt' => $i++,
    'formatter' => function( $d, $row ) {
                        return ''; 
                    } ),    
    array( 'db' => 'name', 'dt' => $i++ ),
    array( 'db' => 'created_at', 'dt' => $i++ ),
    // array( 'db' => 'detail', 'dt' => $i++,
    //         'formatter' => function( $d, $row ) {
                                    
    //                             if(isJson($d)) {
    //                                 $data = json_decode($d);

    //                                 if(count($data->data)>0) {
    //                                     $txt = "";
    //                                     $jml = count($data->data);
    //                                     $i=0;
    //                                     foreach($data->data as $value) {
    //                                         if(++$i<=3  ) {
    //                                             $age_left = ($value->age_left > 0)? $value->age_left." hari lagi":"hari ini";
    //                                             $txt .= $value->name." - ".$age_left ."<br>";
    //                                         }
    //                                         else {
    //                                             $txt .= "... and ".($jml - $i +1) ." more";
    //                                             break;
    //                                         }
    //                                     }
    //                                     // $txt = substr( $txt, 0, 8);
    //                                     return $txt;
    //                                 }
    //                                 else {
    //                                     return '-';
    //                                 }
    //                             } else {
    //                                 return $d;
    //                             }
    //                         } ),
    array( 'db' => 'status', 'dt' => $i++,
    'formatter' => function( $d, $row ) {
        switch($d) {
            case 1:return "active";break;
            case 2:return "pending";break;
            default:return "non active";
        }
    } ),

);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);