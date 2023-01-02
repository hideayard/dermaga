<?php

require_once 'config/Record.class.php';
$app = new Record();

try {
    
    $output   = ['data' => []];

    $stmt=$app->query("SELECT id, firstname, lastname, salary, date_ FROM employees");
    $stmt->execute();
    while ($row=$stmt->fetch()) {

        $actionbutton = '<button onclick="edit(' . $row['id'] . ')">Edit</button> <button onclick="remove(' . $row['id'] . ')">Delete</button>';

        $output['data'][] = [
            $row['firstname'],
            $row['lastname'],
            number_format($row['salary'],2),
            $row['date_'],
            $actionbutton
        ];

    }

    $app = null;
    echo json_encode($output);

    return true;

} catch (PDOExecption $e) {
    echo "Error: " . $e->getMessage();
}