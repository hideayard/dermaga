<?php
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);
error_reporting(0);

require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
$dbtimer = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
$node = isset($_GET['node'])? $_GET['node'] :'' ;
$mode = isset($_GET['mode'])? $_GET['mode'] :'lampu' ;
// include("config/functions.php");
// echo "===check data type===";
$cmdtx='';
if($node!= '')
{
    $db->where ("cmd_node_nama", $node);
    $dbtimer->where ("cmd_node_nama", $node);
    $db->where ("cmd_tx", '%B%', 'like');
    $dbtimer->where ("cmd_tx", '%C%', 'like');
    $db->orderBy("cmd_id","Desc");
    $dbtimer->orderBy("cmd_id","Desc");
    $getcmdlampu = $db->getOne("cmd"); 
    $getcmdtimer = $dbtimer->getOne("cmd"); 
        $status = true;
        $cmdtx = substr($getcmdlampu['cmd_tx'], 1); 
        
        if($getcmdlampu == null)
        {
            $statuscmdlampu = 0;
        }
        else
        {
            $statuscmdlampu = $getcmdlampu['cmd_status'];
        }

        $timeron = [intval((new \DateTime($getnode['node_timer_on']))->format('H')),intval((new \DateTime($getnode['node_timer_on']))->format('i'))];
        $timeroff = [intval((new \DateTime($getnode['node_timer_off']))->format('H')),intval((new \DateTime($getnode['node_timer_off']))->format('i'))];
        $timermode = intval($getnode['node_timer_status'] );
        if($getcmdtimer == null || is_null($getcmdtimer['cmd_status']) )
        {
            $statuscmdtimer = 0;
        }
        else
        {
            $cmdtimertx = substr($getcmdtimer['cmd_tx'], 1); 
            $data_arr = explode(';',$cmdtimertx);
            $timeron =  [intval((new \DateTime($data_arr[0]))->format('H')),intval((new \DateTime($data_arr[0]))->format('i'))];
            $timeroff =  [intval((new \DateTime($data_arr[1]))->format('H')),intval((new \DateTime($data_arr[1]))->format('i'))];
            $timermode = intval($data_arr[2]);
            $statuscmdtimer = $getcmdtimer['cmd_status'];//$statuscmdtimer['cmd_status'];
        }
        $lampu = intval(preg_replace('~\D~', '', $node));
        $msgerror = "node ". $node ." tidak ditemukan";
        
        $db->where ("node_nama", $node);
        if($getnode = $db->getOne("node"))
        {
            $msgsuccess = "get data node ". $node ." success";
        }

}
else
{
    $status = false;
    $msgsuccess = "";
    $msgerror = "data kosong";
}
echo json_encode( array("statuscmdlampu" => $statuscmdlampu
,"lampu" => intval($cmdtx)
,"statuscmdtimer" => $statuscmdtimer
,"timerON" => $timeron
,"timerOFF" => $timeroff
,"timermode" => $timermode 
)
);
// ,"status" => $status,"success" => $msgsuccess,"error" => $msgerror ) );
// echo json_encode( array("status" => $status,"success" => $msgsuccess,"error" => $msgerror ,"info" => $getcmd ) );

?>