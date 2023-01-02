<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once ('config/MysqliDb.php');
include_once ("config/db.php");
$db = new MysqliDb ('localhost', $dbuser, $dbpass, $dbname);
include("config/functions.php");       


$file = basename($_SERVER['PHP_SELF']);
$filename = (explode(".",$file))[0];
// if(!check_role($filename,''))
// {
//   echo json_encode( array("status" => false,"info" => "You are not authorized.!!!","messages" => "You are not authorized.!!!" ) );
// }
// else
{
    $id_user = isset($_SESSION['i']) ? $_SESSION['i'] : "";
    $tipe = isset($_SESSION['t']) ? $_SESSION['t'] : "";
    // $target_dir = "uploads/node/";
    $mode = isset($_POST['mode']) ? $_POST['mode'] : ""; 
    $type = isset($_POST['type']) ? $_POST['type'] : ""; 
        
      switch($mode)
      {
        case "submit" : {$node_status = 1;}break;
        case "save" : {$node_status = 2;}break;
        // case "delete" : {$node_status = 3;}break;
        default : {$node_status = 1;}break;
      }
      // var_dump($_POST);die;
          $node_id = isset($_POST['node_id']) ? $_POST['node_id'] : ""; 
          $node_nama = isset($_POST['node_nama']) ? $_POST['node_nama'] : ""; 
        //   $node_email = isset($_POST['node_email']) ? $_POST['node_email'] : ""; 
        //   $node_tarikh = isset($_POST['node_tarikh']) ? (new \DateTime($_POST['node_tarikh']))->format('Y-m-d') ." " . (new \DateTime())->format('H:i:s') : (new \DateTime())->format('Y-m-d H:i:s'); 

        //   $node_tempat = isset($_POST['node_tempat']) ? $_POST['node_tempat'] : ""; 
        //   $node_daerah_id = isset($_POST['node_daerah_id']) ? $_POST['node_daerah_id'] : ""; 
        //   $node_daerah_name = isset($_POST['node_daerah_name']) ? $_POST['node_daerah_name'] : ""; 
        //   $node_negeri = isset($_POST['node_negeri']) ? $_POST['node_negeri'] : ""; 
        //   $node_agency = isset($_POST['node_agency']) ? $_POST['node_agency'] : ""; 
        //   $node_agency_name = isset($_POST['node_agency_name']) ? $_POST['node_agency_name'] : ""; 
        //   $node_agency_others = isset($_POST['node_agency_others']) ? $_POST['node_agency_others'] : ""; 
        //   $node_jenis_program = isset($_POST['node_jenis_program']) ? $_POST['node_jenis_program'] : ""; 
        //   $node_jenis_program_name = isset($_POST['node_jenis_program_name']) ? $_POST['node_jenis_program_name'] : ""; 
        //   $node_program_name = isset($_POST['node_program_name']) ? $_POST['node_program_name'] : ""; 
        //   $node_program = isset($_POST['node_program']) ? $_POST['node_program'] : ""; 
        //   $node_bil_peserta = isset($_POST['node_bil_peserta']) ? $_POST['node_bil_peserta'] : ""; 
        //   //checkbox
        //   $node_checkbox1 = isset($_POST['node_checkbox1']) ? $_POST['node_checkbox1'] : ""; 
        //   $node_checkbox2 = isset($_POST['node_checkbox2']) ? $_POST['node_checkbox2'] : ""; 
        //   $node_checkbox3 = isset($_POST['node_checkbox3']) ? $_POST['node_checkbox3'] : ""; 
        //   $node_checkbox4 = isset($_POST['node_checkbox4']) ? $_POST['node_checkbox4'] : ""; 
        //   $node_checkbox5 = isset($_POST['node_checkbox5']) ? $_POST['node_checkbox5'] : ""; 
        //   $node_checkbox6 = isset($_POST['node_checkbox6']) ? $_POST['node_checkbox6'] : ""; 
        //   $node_checkbox7 = isset($_POST['node_checkbox7']) ? $_POST['node_checkbox7'] : ""; 
          
          // $mode = isset($_POST['mode']) ? $_POST['mode'] : ""; 
          // switch($mode)
          // {
          //   case "submit" : {$node_status = 1;}break;
          //   case "save" : {$node_status = 2;}break;
          //   default : {$node_status = 1;}break;
          // }

        //   $node_checkbox1 = ($node_checkbox1=="on") ? true : false; 
        //   $node_checkbox2 = ($node_checkbox2=="on") ? true : false; 
        //   $node_checkbox3 = ($node_checkbox3=="on") ? true : false; 
        //   $node_checkbox4 = ($node_checkbox4=="on") ? true : false; 
        //   $node_checkbox5 = ($node_checkbox5=="on") ? true : false; 
        //   $node_checkbox6 = ($node_checkbox6=="on") ? true : false; 
        //   $node_checkbox7 = ($node_checkbox7=="on") ? true : false; 

        //   $node_photo1 = isset($_POST['node_photo1']) ? $_POST['node_photo1'] : ""; 
        //   $node_photo2 = isset($_POST['node_photo2']) ? $_POST['node_photo2'] : ""; 
        //   $node_photo3 = isset($_POST['node_photo3']) ? $_POST['node_photo3'] : ""; 
        //   $node_photo4 = isset($_POST['node_photo4']) ? $_POST['node_photo4'] : ""; 
        //   $node_photo5 = isset($_POST['node_photo5']) ? $_POST['node_photo5'] : ""; 

        //   $delete_node_photo1 = isset($_POST['delete_node_photo1']) ? $_POST['delete_node_photo1'] : ""; 
        //   $delete_node_photo2 = isset($_POST['delete_node_photo2']) ? $_POST['delete_node_photo2'] : ""; 
        //   $delete_node_photo3 = isset($_POST['delete_node_photo3']) ? $_POST['delete_node_photo3'] : ""; 
        //   $delete_node_photo4 = isset($_POST['delete_node_photo4']) ? $_POST['delete_node_photo4'] : ""; 
        //   $delete_node_photo5 = isset($_POST['delete_node_photo5']) ? $_POST['delete_node_photo5'] : ""; 

        //   $node_ulasan = isset($_POST['node_ulasan']) ? $_POST['node_ulasan'] : "";           
        //   $node_photo = isset($_POST['node_photo']) ? $_POST['node_photo'] : ""; 
        //   $node_photo = isset($_FILES["node_photo"]["name"]) ? $_FILES["node_photo"]["name"] : ""; 

          
          
          $message = "Insert Sukses!!";
        //   $tgl = (new \DateTime())->format('Y-m-d H:i:s');
        //   $hasil_upload1 = $hasil_upload2 = $hasil_upload3 = $hasil_upload4 = $hasil_upload5 = null;

          $uploadOk =1 ;
          
          $data = Array (
            "node_nama" => $node_nama
            // "node_email" => $node_email,
            // "node_tarikh" => $node_tarikh,
            // "node_tempat" => $node_tempat,
            // "node_daerah_id" => $node_daerah_id,
            // "node_daerah_name" => $node_daerah_name,
            // "node_negeri" => $node_negeri,
            // "node_agency" => $node_agency,
            // "node_agency_name" => $node_agency_name,
            // "node_agency_others" => $node_agency_others,
            // "node_jenis_program" => $node_jenis_program,
            // "node_jenis_program_name" => $node_jenis_program_name,
            // "node_program_name" => $node_program_name,
            // "node_program" => $node_program,
            // "node_bil_peserta" => $node_bil_peserta,
            // "node_checkbox1" => $node_checkbox1,
            // "node_checkbox2" => $node_checkbox2,
            // "node_checkbox3" => $node_checkbox3,
            // "node_checkbox4" => $node_checkbox4,
            // "node_checkbox5" => $node_checkbox5,
            // "node_checkbox6" => $node_checkbox6,
            // "node_checkbox7" => $node_checkbox7,
            // "node_ulasan" => $node_ulasan,
            // "node_status" => $node_status
      );
    //   if(isset($_FILES["node_photo1"]["name"]))
    //   { //echo 1;
    //     $hasil_upload1 = upload_files("node","node_photo1",0);
    //     $uploadOk .= "<br>".$hasil_upload1["uploadOk"];
    //     $message .= "<br>".$hasil_upload1["message"];
    //     $node_photo1 = $hasil_upload1["file_name"];
    //     $data += array('node_photo1' => $hasil_upload1["file_name"]);
    //   }


    //   if(isset($_FILES["node_photo2"]["name"]))
    //   { //echo 2;
    //     $hasil_upload2 = upload_files("node","node_photo2",1);
    //     $uploadOk .= "<br>".$hasil_upload2["uploadOk"];
    //     $message .= "<br>".$hasil_upload2["message"];
    //     $node_photo2 = $hasil_upload2["file_name"];
    //     $data += array('node_photo2' => $hasil_upload2["file_name"]);
    //   }


    //   if(isset($_FILES["node_photo3"]["name"]))
    //   { //echo 3;
    //     $hasil_upload3 = upload_files("node","node_photo3",2);
    //     $uploadOk .= "<br>".$hasil_upload3["uploadOk"];
    //     $message .= "<br>".$hasil_upload3["message"];
    //     $node_photo3 = $hasil_upload3["file_name"];
    //     $data += array('node_photo3' => $hasil_upload3["file_name"]);
    //   }


    //   if(isset($_FILES["node_photo4"]["name"]))
    //   { //echo 4;
    //     $hasil_upload4 = upload_files("node","node_photo4",3);
    //     $uploadOk .= "<br>".$hasil_upload4["uploadOk"];
    //     $message .= "<br>".$hasil_upload4["message"];
    //     $node_photo4 = $hasil_upload4["file_name"];
    //     $data += array('node_photo4' => $hasil_upload4["file_name"]);
    //   }


    //   if(isset($_FILES["node_photo5"]["name"]))
    //   { //echo 5;
    //     $hasil_upload5 = upload_files("node","node_photo5",4);
    //     $uploadOk .= "<br>".$hasil_upload5["uploadOk"];
    //     $message .= "<br>".$hasil_upload5["message"];
    //     $node_photo5 = $hasil_upload5["file_name"];
    //     $data += array('node_photo5' => $hasil_upload5["file_name"]);
    //   }
    //   if(isset($_POST['delete_node_photo1']))
    //   {
    //     $data += array('node_photo1' => null);
    //     $path_file = $target_dir.$filename1;
    //     if (file_exists($path_file)) {     unlink ( $path_file);   }

    //   }
    //   if(isset($_POST['delete_node_photo2']))
    //   {
    //     $data += array('node_photo2' => null);
    //     $path_file = $target_dir.$filename2;
    //     if (file_exists($path_file)) {     unlink ( $path_file);   }
    //   }
    //   if(isset($_POST['delete_node_photo3']))
    //   {
    //     $data += array('node_photo3' => null);
    //     $path_file = $target_dir.$filename3;
    //     if (file_exists($path_file)) {     unlink ( $path_file);   }
    //   }
    //   if(isset($_POST['delete_node_photo4']))
    //   {
    //     $data += array('node_photo4' => null);
    //     $path_file = $target_dir.$filename4;
    //     if (file_exists($path_file)) {     unlink ( $path_file);   }
    //   }
    //   if(isset($_POST['delete_node_photo5']))
    //   {
    //     $data += array('node_photo5' => null);
    //     $path_file = $target_dir.$filename5;
    //     if (file_exists($path_file)) {     unlink ( $path_file);   }
    //   }
        
        $hasil_eksekusi = false;

      if(isset($_POST['node_id']))
      {    
        if($mode == "delete" && $tipe=="ADMIN")
          {
            $db->where('node_id', $node_id);
            $hasil_eksekusi = $db->delete('node');
            $message = "Delete Success !!";
          }
          else
          {
            
            $data += array('node_modified_by' => $id_user);
            $data += array('node_modified_at' => $tgl);
            $data += array('node_is_deleted' => 0);

            $db->where ('node_id', $node_id);
            $hasil_eksekusi = $db->update ('node', $data);
            $message = "Update Success !!";

          }
          
          if ($hasil_eksekusi)
          {   
            echo json_encode( array("status" => true,"info" => $node_status,"messages" => $message ) );
          }//$db->count . ' records were updated';
          else
          {   
            echo json_encode( array("status" => false,"info" => 'update failed: ' . $db->getLastError(),"messages" => $message ) );

          }

        }
        else
        {  
          $data += array("node_id" => null);
        //   $data += array('node_created_by' => $id_user);
        //   $data += array('node_created_at' => $tgl);
          if($db->insert ('node', $data))
          {
            echo json_encode( array("status" => true,"info" => $node_status,"messages" => $message ) );
        
            // $message = 1;//"Insert berhasil!";
          }
          else
          {
            // echo 0;
            echo json_encode( array("status" => false,"info" => $db->getLastError(),"messages" => $message ) );
        
        
          }
        }
          // $data = Array (
          //         "node_nama" => $node_nama,
          //         "node_email" => $node_email,
          //         "node_tarikh" => $node_tarikh,
          //         "node_tempat" => $node_tempat,
          //         "node_agency" => $node_agency,//$sesi_tgl->format('Y-m-d'),
          //         "node_program" => $node_program,
          //         "node_jenis_program" => $node_jenis_program,
          //         "node_program_name" => $node_program_name,
          //         "node_bil_peserta" => $node_bil_peserta,
          //         "node_checkbox1" => $node_checkbox1,
          //         "node_checkbox2" => $node_checkbox2,
          //         "node_checkbox3" => $node_checkbox3,
          //         "node_checkbox4" => $node_checkbox4,
          //         "node_checkbox5" => $node_checkbox5,
          //         "node_checkbox6" => $node_checkbox6,
          //         "node_checkbox7" => $node_checkbox7,
          //         "node_ulasan" => $node_ulasan,
          //         "node_photo" => $node_photo,
          //         "node_status" => $node_status,
          //         "node_created_by" => $id_user,
          //         "node_created_at" => $tgl,
          //         "node_modified_by" => $id_user,
          //         "node_modified_at" => $tgl,
          //         "node_is_deleted" => 0
          //       );
      //     $db->where ('node_id', $node_id);
      //     if ($db->update ('node', $data))
      //     {   echo $node_status; }//$db->count . ' records were updated';
      //     else
      //     {   echo 'update failed: ' . $db->getLastError();   } 
      // }
      // else
      // {  
      //   $hasil = $db->insert ('node', $data);
      //   if($hasil)
      //   {
      //       echo $node_status;
      //     // $info = 1;//"Insert berhasil!";
      //   }
      //   else
      //   {
      //     // echo 0;
      //     echo $db->getLastError();

      //   }
      // }
              
        
        // $hasil = $db->rawQuery($sql);// or die(mysql_error());
        // echo "<script>alert('$hasil');</script>";
        // var_dump($hasil);
        
}
?>