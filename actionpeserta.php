<?php

require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
include("config/functions.php");

$sql = "select ifnull(max(p_id),1) as max from participant;";// where p_tgl=NOW();";
$hasil = $db->rawQuery($sql);

if(isset($_POST['sesi_id'])){ 
        $sesi_id = isset($_POST['sesi_id']) ? $_POST['sesi_id'] : ""; 
        $user_nama = isset($_POST['user_nama']) ? $_POST['user_nama'] : ""; 
        $user_hp = isset($_POST['user_hp']) ? $_POST['user_hp'] : ""; 
        // $id = isset($_SESSION['i']) ? $_SESSION['i'] : "";
        $info = "Insert Sukses!!";
      $ticket = formatNumber($hasil[0]['max']);
      // $tgl = (new \DateTime())->format('Y-m-d H:i:s');
$data = Array ("p_id" => null,
               "p_user_id" => null,
               "p_ticket" => $ticket,//crc32($hasil[0]['max'].$_POST['user_hp']),
               "p_sesi_id" => $sesi_id,
               "p_tipe" => 'peserta',//$ds_tgl->format('Y-m-d'),
               "p_tgl" =>(new \DateTime())->format('Y-m-d H:i:s'),
               "p_nama" => $user_nama,
               "p_hp" => $user_hp,
               "p_status" => '1'
);
// var_dump($data);//die;
$hasil = $db->insert ('participant', $data);

if($hasil)
{
  $status = true;
  $info = "Insert berhasil!";
}
else
{
  $status = false;
  $info = "Insert gagal!";
}
// echo "<script>alert('$info');</script>";
    // echo $info;
    echo json_encode( array('status'=> $status, 'sesi_status' => 1 ,'msg' => $info,'ticket' => $ticket , 'tgl' => (new \DateTime())->format('d / m / Y') ) );

}//echo $sql;

?>