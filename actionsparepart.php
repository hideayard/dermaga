<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
include("config/functions.php");       
$tgl = (new \DateTime())->format('Y-m-d H:i:s');
$file = basename($_SERVER['PHP_SELF']);
$filename = (explode(".",$file))[0];
{
    $id_user = isset($_SESSION['i']) ? $_SESSION['i'] : "";
    $tipe = isset($_SESSION['t']) ? $_SESSION['t'] : "";
    $mode = isset($_POST['mode']) ? $_POST['mode'] : ""; 
    $type = isset($_POST['type']) ? $_POST['type'] : ""; 
        
    switch($mode)
    {
        case "submit" : {$status = 1;}break;
        case "save" : {$status = 2;}break;
        // case "delete" : {$status = 3;}break;
        default : {$status = 1;}break;
    }

    $id = isset($_POST['id']) ? $_POST['id'] : ""; 
    $code = isset($_POST['code']) ? $_POST['code'] : ""; 
    $name = isset($_POST['name']) ? $_POST['name'] : ""; 
    $volume = isset($_POST['volume']) ? $_POST['volume'] : ""; 
    $price = isset($_POST['price']) ? $_POST['price'] : ""; 
    $age = isset($_POST['age']) ? $_POST['age'] : ""; 

    $message = "Insert Sukses!!";

    $uploadOk =1 ;

    $data = Array (
            "code" => $code,
            "name" => $name,
            "volume" => $volume,
            "price" => $price,
            "age" => $age,
    );
    $hasil_eksekusi = false;

    if(isset($_POST['id']))
    {    
        if($mode == "delete" && $tipe=="ADMIN")
        {
            $db->where('id', $id);
            $hasil_eksekusi = $db->delete('sparepart');
            $message = "Delete Success !!";
        }
        else
        {
            
            $data += array('modified_by' => $id_user);
            $data += array('modified_at' => $tgl);

            $db->where ('id', $id);
            $hasil_eksekusi = $db->update ('sparepart', $data);
            $message = "Update Success !!";
        }
        if ($hasil_eksekusi)
        {   
        echo json_encode( array("status" => true,"info" => $status,"messages" => $message ) );
        }
        else
        {   
        echo json_encode( array("status" => false,"info" => 'update failed: ' . $db->getLastError(),"messages" => $message ) );
        }
    }
    else
    {  
        $data += array("id" => null);
        if($db->insert ('sparepart', $data))
        {
        echo json_encode( array("status" => true,"info" => $status,"messages" => $message ) );
        }
        else
        {
        echo json_encode( array("status" => false,"info" => $db->getLastError(),"messages" => $message ) );
        }
    }

}
?>