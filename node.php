<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
$dbdetail = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
$node = isset($_GET['node'])? $_GET['node'] :'' ;
$cmd = isset($_GET['cmd'])? $_GET['cmd'] :'' ;
// echo "===check data type===";
if($node!= '')
{

    $data_log = Array (     
    "log_id" => null,
    "log_node" => $node,
    "log_txt" => $cmd,
    "log_created_at" => (new \DateTime())->format('Y-m-d H:i:s'),
    );
    $hasil_log = $db->insert ('node_log', $data_log);

    if ((strpos($cmd, 'A')) !== false) 
    {
        // echo "===data sensor===\n";
        $data_txt = substr($cmd, 1);
        $data_arr = explode(';',$data_txt); 
        // var_dump($data_arr);
        $data = Array (     "sensor_data_id" => null,
                            "sensor_data_node_id" => null,
                            "sensor_data_node_nama" => $node,
                            "sensor_data_voltase" => $data_arr[0],
                            "sensor_data_arus" => $data_arr[1],
                            "sensor_data_daya" => $data_arr[2],//($data_arr[0] * $data_arr[1]),
                            "sensor_data_kwh" => $data_arr[3],//($data_arr[0] * $data_arr[1]),
                            "sensor_data_tanggal" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                            "sensor_data_status" => 1
                        );
        $hasil = $db->insert ('sensor_data', $data);
        $status = true; 
        $msgsuccess =  'insert data sensor to DB success';
        $msgerror = '';
    }
    else if ((strpos($cmd, 'B')) !== false)
    {
        $data_txt = substr($cmd, 1); 
        $db->where ("cmd_node_nama", $node);
        $db->where ("cmd_tx", '%B%', 'like');
        $db->orderBy("cmd_time_tx","Desc");
        $getcmd = $db->getOne("cmd");
        
        $data = Array (
            'cmd_rx' => $data_txt,
            "cmd_time_rx" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
            "cmd_status" => 1
        );
        $db->where ('cmd_id', $getcmd["cmd_id"]);
        if ($db->update ('cmd', $data))
        {
            ///update node time on/off
            if($data_txt == 1)
            {
                $field_status = 'node_time_on';
            }
            else
            {
                $field_status = 'node_time_off';
            }
            $data_node = Array (
                'node_cmd' => $data_txt,
                $field_status => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                'node_cmd_status' => 1,
                'node_tgl' => (new \DateTime())->format('Y-m-d H:i:s')
            );
            $db->where ('node_nama', $node);
            if ($db->update ('node', $data_node))
            {
                $status = true; 
                $msgsuccess =  'update success on node';
                $msgerror = '';
            }
            else
            {
                $status = false;
                $msgsuccess = "";
                $msgerror = $db->getLastError();
            }
        }
        else
        {
            $status = false;
            $msgsuccess = "";
            $msgerror = $db->getLastError();
        }
        
    }
    else if ((strpos($cmd, 'C')) !== false)
    { //echo "cmd C = ".$cmd;
        $data_txt = substr($cmd, 1);
        // var_dump($data_txt);
        $db->where ("cmd_node_nama", $node);
        $db->where ("cmd_tx", '%C%', 'like');
        $db->orderBy("cmd_time_tx","Desc");
        $getcmd = $db->getOne("cmd");
        // echo "\n cmd="; // var_dump($cmd); //for debug
        $data = Array (
            'cmd_rx' => $data_txt,
            "cmd_time_rx" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
            "cmd_status" => 1
        );
        $db->where ('cmd_id', $getcmd["cmd_id"]);
        if ($db->update ('cmd', $data))
        {
            ///update node time on/off
            $data_arr = explode(';',$data_txt); 
            
            $data_node = Array (
                'node_cmd' => 1,
                'node_timer_on' => (new \DateTime($data_arr[0]))->format('Y-m-d H:i:s'),//`DATE_FORMAT(STR_TO_DATE(node_timer_on, '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d `.$data_arr[0].`:00')`,//$data_arr[0],
                'node_timer_off' => (new \DateTime($data_arr[1]))->format('Y-m-d H:i:s'),//`DATE_FORMAT(STR_TO_DATE(node_timer_off, '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d `.$data_arr[1].`:00')`,//$data_arr[1],
                'node_timer_status' => $data_arr[2],
                'node_cmd_status_timer' => 1,
                'node_tgl' => (new \DateTime())->format('Y-m-d H:i:s')
                // $field_status => (new \DateTime())->format('Y-m-d H:i:s') //`CURRENT_TIMESTAMP`,//
            );
            // var_dump($data_node);
            $db->where ('node_nama', $node);
            if ($db->update ('node', $data_node))
            {
                $status = true;
                $msgsuccess = "update success on node";
                $msgerror = "";
            }
            else
            {
                $status = false;
                $msgsuccess = "";
                $msgerror = 'update failed: ' . $db->getLastError();
            }
        }
        else
        {
            $status = false;
            $msgsuccess = "";
            $msgerror = 'update failed: ' . $db->getLastError();
        }
            
        
    }

}
else
{
    $status = false;
    $msgsuccess = "";
    $msgerror = "data kosong";
}
echo json_encode( array("status" => $status,"success" => $msgsuccess,"error" => $msgerror ) );
// echo json_encode( array("status" => $status,"success" => $msgsuccess,"error" => $msgerror,"info" => $data ) );
?>