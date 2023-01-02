<?php
error_reporting(E_ALL);

require "vendor/autoload.php";
use karpy47\PhpMqttClient\MQTTClient;

include_once ("config/db.php");
require_once ('config/MysqliDb.php');
try{
// echo 'localhost\n', $dbuser, "\n", $dbpass, "\n", $dbname, "\n";
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
// include_once ("config/functions.php");

// echo "start\n";
$sql = "select * from node";
$hasil = $db->rawQuery($sql);
// var_dump($hasil);
foreach($hasil as $key => $value)
{
    $node_nama[] = $value['node_nama'];
}
var_dump($node_nama);
echo "====================\n";
// $client = new MQTTClient('134.209.110.188', 1883);
// $client->setAuthentication('mqtt-test','mqtt-test');
$client = new MQTTClient('mustang.rmq.cloudamqp.com', 1883);
$client->setAuthentication('zfjxrotg:zfjxrotg','SIB6Ge1_UKs5nIw5rY6OvaT0qCwg_4Ab');

$client->setEncryption('cacerts.pem');
//	public function sendConnect($clientId, $cleanSession=false, $keepAlive=10, $timeout=5000) {
    $time = time();
    // echo "time 07=".(new \DateTime('07:00'))->format('Y-m-d H:i:s');
    echo "id = $time \n";
    echo "connecting to : mustang.rmq.cloudamqp.com:1883 \n";
$success = $client->sendConnect($time,false, 0, $timeout=500);  // set your client ID
if ($success) {
    $topics1 = 'topic-'.(new \DateTime())->format('Y-m-d H:i:s');
    echo "connected\n";
    echo "Subscribe to $topics1\n";
    
        $client->sendPublish($topics1, (new \DateTime())->format('Y-m-d H:i:s') );//'Message to all subscribers of this topic');
        echo "Getting data:\n";
    while(1)
    {
        $client->sendSubscribe('#');
        $messages = $client->getPublishMessages();  // now read and acknowledge all messages waiting
        echo ".";
        foreach ($messages as $message) {
            // var_dump($message);
            if(in_array($message['topic'],$node_nama))
            {   
                echo "===check data type===";
                if ((strpos($message['message'], 'A')) !== false) 
                {
                    echo "===data sensor===\n";
                    $data_txt = substr($message['message'], 2);
                    $data_arr = explode(';',$data_txt); 
                    // var_dump($data_arr);
                    $data = Array (     "sensor_data_id" => null,
                                        "sensor_data_node_id" => null,
                                        "sensor_data_node_nama" => $message['topic'],
                                        "sensor_data_voltase" => $data_arr[0],
                                        "sensor_data_arus" => $data_arr[1],
                                        "sensor_data_daya" => $data_arr[2],//($data_arr[0] * $data_arr[1]),
                                        "sensor_data_kwh" => $data_arr[3],//($data_arr[0] * $data_arr[1]),
                                        "sensor_data_tanggal" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                                        "sensor_data_status" => 1
                                    );
                    $hasil = $db->insert ('sensor_data', $data);
                    echo "===insert data sensor to DB success===\n"; 
                }
                else if ((strpos($message['message'], '>B')) !== false)
                {
                    $data_txt = substr($message['message'], 2); //($message['message']); //
                    $db->where ("cmd_node_nama", $message['topic']);
                    $db->where ("cmd_tx", '%B%', 'like');
                    $db->orderBy("cmd_time_tx","Desc");
                    $cmd = $db->getOne("cmd");
                    // var_dump($cmd);
                    // $data = Array ( "cmd_id" => null,
                    //             "cmd_node_nama" => $message['topic'],
                    //             "cmd_tx" => $data_txt,
                    //             "cmd_rx" => $data_txt,
                    //             "cmd_time_tx" => (new \DateTime())->format('Y-m-d H:i:s'),
                    //             "cmd_time_rx" => (new \DateTime())->format('Y-m-d H:i:s'),
                    //             "cmd_status" => 0
                    //            );
                    // $hasil = $db->insert ('cmd', $data);
                     
                    $data = Array (
                        'cmd_rx' => $data_txt,
                        "cmd_time_rx" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                        "cmd_status" => 1
                    );
                    $db->where ('cmd_id', $cmd["cmd_id"]);
                    if ($db->update ('cmd', $data))
                    {
                        echo $db->count . ' records were updated \n';
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
                            $field_status => (new \DateTime())->format('Y-m-d H:i:s') //`CURRENT_TIMESTAMP`,//
                        );
                        $db->where ('node_nama', $message['topic']);
                        if ($db->update ('node', $data_node))
                        {
                            echo 'update success on node \n';
                        }
                        else
                        {
                            echo 'update failed: ' . $db->getLastError();
                        }
                    }
                    else
                    {
                        echo 'update failed: ' . $db->getLastError();
                    }
                    
                }
                else if ((strpos($message['message'], '<B')) !== false || (strpos($message['message'], '<C')) !== false) 
                {
                    echo "===data cmd timer===\n";
                    $data_txt = substr($message['message'], 1);
                    $data = Array (     "cmd_id" => null,
                                        "cmd_node_nama" => $message['topic'],
                                        "cmd_tx" => $data_txt,
                                        "cmd_rx" => null,
                                        "cmd_time_tx" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                                        "cmd_time_rx" => null,
                                        "cmd_status" => 0
                                    );
                    $hasil = $db->insert ('cmd', $data);
                    echo "===insert cmd to DB success===\n"; 

                }
                else if ((strpos($message['message'], '>C')) !== false)
                {
                    $data_txt = substr($message['message'], 2);
                    $db->where ("cmd_node_nama", $message['topic']);
                    $db->where ("cmd_tx", '%C%', 'like');
                    $db->orderBy("cmd_time_tx","Desc");
                    $cmd = $db->getOne("cmd");
                    // echo "\n cmd="; // var_dump($cmd); //for debug
                    $data = Array (
                        'cmd_rx' => $data_txt,
                        "cmd_time_rx" => (new \DateTime())->format('Y-m-d H:i:s'), //`CURRENT_TIMESTAMP`,//
                        "cmd_status" => 1
                    );
                    $db->where ('cmd_id', $cmd["cmd_id"]);
                    if ($db->update ('cmd', $data))
                    {
                        echo $db->count . ' records were updated \n';
                        ///update node time on/off
                        $data_arr = explode(';',$data_txt); 
                        
                        $data_node = Array (
                            'node_cmd' => 1,
                            'node_timer_on' => (new \DateTime($data_arr[0]))->format('Y-m-d H:i:s'),//`DATE_FORMAT(STR_TO_DATE(node_timer_on, '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d `.$data_arr[0].`:00')`,//$data_arr[0],
                            'node_timer_off' => (new \DateTime($data_arr[1]))->format('Y-m-d H:i:s'),//`DATE_FORMAT(STR_TO_DATE(node_timer_off, '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d `.$data_arr[1].`:00')`,//$data_arr[1],
                            'node_timer_status' => $data_arr[2]
                            // $field_status => (new \DateTime())->format('Y-m-d H:i:s') //`CURRENT_TIMESTAMP`,//
                        );
                        // var_dump($data_node);
                        $db->where ('node_nama', $message['topic']);
                        if ($db->update ('node', $data_node))
                        {
                            echo 'update success on node \n';
                        }
                        else
                        {
                            echo 'update failed: ' . $db->getLastError();
                        }
                    }
                        // echo $db->count . ' records on cmd were updated \n';
                    else
                    {
                       echo 'update failed: ' . $db->getLastError(); 
                    }
                        
                    
                }
                else
                {
                    
                }
                echo "\nDB>>>".$message['topic'] .': '. $message['message'] . PHP_EOL;
                
            }
            else
            {
                echo "\n".$message['topic'] .': '. $message['message'] . PHP_EOL;
            }
            
            // Other keys in $message array: retain (boolean), duplicate (boolean), qos (0-2), packetId (2-byte integer)
        }
        // sleep(0.1);
    }
    $client->sendDisconnect();    
}
$client->close();
}
catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";

}
?>