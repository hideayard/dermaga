<?php

require_once 'config/Record.class.php';
$app = new Record();

try {
    
    $output   = ['data' => []];

    $stmt=$app->query("SELECT id, name, created_at, status FROM panel ");
    $stmt->execute();
    while ($row=$stmt->fetch()) {

        $detail=$app->query('select count(id_panel) as expired from panel_detail 
        where id_panel = '.$row['id'].'
        and ( (age - ( DATEDIFF( NOW() , date ) )) <= 30 )
        group by id_panel');
        $detail->execute();
        $jml = 0;
        while ($rowDetail=$detail->fetch()) {
            $jml = $rowDetail[0][0];
        }
        $actionbutton = '<a class="btn btn-info" href="index.php?page=detail_panel&id=' . $row['id'] . '">Sparepart</a> | <a class="btn btn-warning" href="index.php?page=editpanel&id=' . $row['id'] . '">Edit</a> |  <button  class="btn btn-danger" onclick="removePanel(' . $row['id'] . ')">Delete</button>';

        $output['data'][] = [
            // '<input class="form-check-input" type="checkbox" value="' . $row['id'] . '" />',
            '<input type="hidden" value="' . $row['id'] . '">',
            $row['name'],
            $row['created_at'],
            $jml,
            getStatus($row['status']),
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

function getStatus($status) {
    switch($status) {
        case 1:{return "Active";}break;
        case 2:{return "Pending";}break;
        default:{return "Non Active";}break;
        
    }
}