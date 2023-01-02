<?php
include_once ("config/db.php");
$table = 'sparepart';
// Table's primary key
$primaryKey = 'id';
$i=0;
$columns = array(
    array( 'db' => 'id', 'dt' => $i++,
            'formatter' => function( $d, $row ) {
                                return ''; 
                            } ),    
    array( 'db' => 'code', 'dt' => $i++ ),
    array( 'db' => 'name', 'dt' => $i++ ),
    array( 'db' => 'volume', 'dt' => $i++ ),
    array( 'db' => 'price', 'dt' => $i++,
            'formatter' => function( $d, $row ) {
                                return 'Rp. '.number_format($d); 
                            } ),
    // array( 'db' => 'date', 'dt' => $i++ ),
    array( 'db' => 'age', 'dt' => $i++ ),
    // array( 'db' => 'date_age_end', 'dt' => $i++ ),
    // array( 'db' => 'age_left', 'dt' => $i++ ),
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);