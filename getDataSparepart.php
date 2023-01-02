<?php

require_once 'config/Record.class.php';
$app = new Record();

try {
    $id_panel = isset($_GET['id_panel']) ? $_GET['id_panel'] : ""; 

    $output   = ['data' => []];

    $stmt=$app->query("SELECT id, code, name, volume, price, date, age, created_at, status FROM panel_detail where id_panel='$id_panel'");
    $stmt->execute();
    while ($row=$stmt->fetch()) {

        $actionbutton = '<a class="btn btn-info" href="index.php?page=detail_panel&id=' . $row['id'] . '">Sparepart</a> | <a class="btn btn-warning" href="index.php?page=editpanel&id=' . $row['id'] . '">Edit</a> |  <button  class="btn btn-danger" onclick="removePanel(' . $row['id'] . ')">Delete</button>';

        $output['data'][] = [
            // '<input class="form-check-input" type="button" value="' . $row['id'] . '" />',
            '<button onclick="deleteSparepart(\'' . $row['id'] . '\')" class="btn btn-danger"><i class="fa fa-trash"></i></button>',
            // '',
            $row['code'],
            $row['name'],
            $row['volume'],
            $row['price'],
            $row['date'],
            $row['age'],
            $row['created_at'],
            $app->getStatus($row['status']),
            // number_format($row['salary'],2),
            // $row['date_'],
            $actionbutton
        ];

    }

    $app = null;
    echo json_encode($output);

    return true;

} catch (PDOExecption $e) {
    echo "Error: " . $e->getMessage();
}
