<?php

require_once 'config/Record.class.php';
$app = new Record();
$tglNow = (new \DateTime())->format('Y-m-d H:i:s');

if (isset($_GET['add'])) {
    $id_sparepart   = $_POST['sparepart'];
    $tgl            = $_POST['tgl'];
    $id_panel       = $_POST['id_panel'];

    if (empty($id_sparepart) || empty($tgl) || empty($id_panel)) {
        echo json_encode("All fields are required.");
        return false;
    }
    $tgl = (new \DateTime($tgl))->format('Y-m-d H:i:s');

    try {
        $stmt=$app->query("SELECT id, code, name, volume, price, date, age, created_at, status FROM sparepart where id='$id_sparepart'");
        $stmt->execute();
        $output = [];
        while ($row=$stmt->fetch()) {

    
            $output = [
                $row['code'],
                $row['name'],
                $row['volume'],
                $row['price'],
                $row['age'],
            ];
    
        }
        // var_dump($output);

        $i=-1;
        //createDetailSprepart($id_panel,$code,$name,$volume,$price,$age, $id_sparepart, $tgl)
        if ($app->createDetailSprepart($id_panel, $output[++$i], $output[++$i], $output[++$i], $output[++$i], $output[++$i], $id_sparepart, $tgl)) {
            return true;
        }
    } catch (PDOExecption $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['edit'])) {
    $id_sparepart   = $_POST['id_sparepart'];
    $tgl            = $_POST['tgl'];
    $id_panel       = $_POST['id_panel'];
    $id             = $_POST['id'];

    if (empty($id_sparepart) || empty($tgl) || empty($id_panel)) {
        echo json_encode("All fields are required.");
        return false;
    }

    try {
        if ($app->update($firstname, $lastname, $salary, $id)) {
            return true;
        }
    } catch (PDOExecption $e) {
        echo "Error: " . $e->getMessage();
    }
}

if(isset($_GET['id']) && isset($_GET['delete'])){
    try {
        $id = $_GET['id'];
        if ($app->softDeleteSparepart($id)) {
            return true;
        } 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}