<?php

require_once 'config/Record.class.php';
$app = new Record();

try {
    $id_panel = isset($_GET['id_panel']) ? $_GET['id_panel'] : ""; 

    $output   = ['data' => []];

    $sql = "SELECT * FROM sparepart";
    
    $stmt=$app->query($sql);
    $stmt->execute();
    while ($row=$stmt->fetch()) {

        $actionbutton = '<a class="btn btn-warning" href="index.php?page=editsparepart&id=' . $row['id'] . '">Edit</a>';

        $output['data'][] = [
            // '<input class="form-check-input" type="button" value="' . $row['id'] . '" />',
            // '<button onclick="deleteSparepart(\'' . $row['id'] . '\')" class="btn btn-danger"><i class="fa fa-trash"></i></button>',
            // '',
            $row['code'],
            $row['name'],
            $row['volume'],
            $row['price'],
            $row['age'],
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
