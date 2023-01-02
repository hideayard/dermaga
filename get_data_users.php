<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
include_once ("config/db.php");

// DB table to use
$table = 'users';
 
// Table's primary key
$primaryKey = 'user_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'user_name', 'dt' => 0 ),
    array( 'db' => 'user_nama',  'dt' => 1 ),
    array( 'db' => 'user_hp',   'dt' => 2 ),
    array( 'db' => 'user_email',   'dt' => 3 ),
    array( 'db' => 'user_tipe',   'dt' => 4 )
    ,array(
        'db'        => 'user_foto',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            if($d)
            {//<img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                return '<img src="dist/img/'.$d.'"  class="direct-chat-img" alt="User Image">';
            }
            else
            {
                return '<img src="dist/img/avatar5.png" class="direct-chat-img" alt="User Image">';
            }
        }
    )
    // ,array(
    //     'db'        => 'salary',
    //     'dt'        => 5,
    //     'formatter' => function( $d, $row ) {
    //         return '$'.number_format($d);
    //     }
    // )
);
 

 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);