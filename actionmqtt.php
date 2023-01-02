<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{

    $txt = isset($_POST['txt'])?$_POST['txt']:'';
    $value = isset($_POST['value'])?$_POST['value']:'';
    $topic = isset($_POST['topic'])?$_POST['topic']:'';
if($txt!='')
{
    switch($txt)
    {
        case 'lampon' : {   $cmd_txt = "B1";  $msgsuccess = "Turn ON Command Sent";
                            $r = insert_cmd_to_db($topic,"B1");}break;
        case 'lampoff' : {$cmd_txt = "B0"; $msgsuccess = "Turn OFF Command Sent";
                            $r = insert_cmd_to_db($topic,"B0");}break;
        case 'timeron' : {  $msgsuccess = "Timer ON Command Sent";
                            $arr_value = explode(";",$value);
                            $arr_value[0] = substr($arr_value[0], 0, 5);
                            $arr_value[1] = substr($arr_value[1], 0, 5);
                            $cmd_txt = "C".$arr_value[0].";".$arr_value[1].";"."1";
                            $r = insert_cmd_to_db($topic,"C".$arr_value[0].";".$arr_value[1].";"."1");
                        }break;
        case 'timeroff' : { $msgsuccess = "Timer OFF Command Sent";
                            $arr_value = explode(";",$value);
                            $arr_value[0] = substr($arr_value[0], 0, 5);
                            $arr_value[1] = substr($arr_value[1], 0, 5);
                            $cmd_txt ="C".$arr_value[0].";".$arr_value[1].";"."0";
                            $r = insert_cmd_to_db($topic,"C".$arr_value[0].";".$arr_value[1].";"."0");
                        }break;
    }
    if($r)
    {
        $status = true;$msgerror = "";
    }
    else
    {
        $status = false;$msgsuccess = "";$msgerror = "Error Sending Command";
    }
echo json_encode( array("status" => $status,"success" => $msgsuccess,"error" => $msgerror ) );

   
    
}


}
catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";

}

function insert_cmd_to_db($topic,$cmd_txt)
{
    require_once ('config/MysqliDb.php');
    include_once ("config/db.php");
    $data = Array ( "cmd_id" => null,
                    "cmd_node_nama" => $topic,
                    "cmd_tx" => "$cmd_txt",
                    "cmd_rx" => null,
                    "cmd_time_tx" => (new \DateTime())->format('Y-m-d H:i:s'),
                    "cmd_time_rx" => null,
                    "cmd_status" => '0'
                );
                // var_dump($data);
    $db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
    $hasil = $db->insert ('cmd', $data);
    $data_node = Array (
        'node_tgl' => (new \DateTime())->format('Y-m-d H:i:s') //`CURRENT_TIMESTAMP`,//
        ,'node_last_modified' => (new \DateTime())->format('Y-m-d H:i:s') //`CURRENT_TIMESTAMP`,//
    );
    if(((strpos($cmd_txt, 'B')) !== false))
    {
        $data_node += array('node_cmd_status' => 0);
    }
    else if (((strpos($cmd_txt, 'C')) !== false))
    {
        $data_node += array('node_cmd_status_timer' => 0);
    }
    $db->where ('node_nama', $topic);
    $db->update ('node', $data_node);
    return $hasil;
    // echo 'berhasil';
}
?>