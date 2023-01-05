<?php

require_once 'config/Record.class.php';
$app = new Record();
$now = (new \DateTime())->format('Y-m-d H:i:s');

try {
    $id_panels = isset($_GET['id_panel']) ? $_GET['id_panel'] : ""; 
    $tgl = isset($_GET['tgl']) ? $_GET['tgl'] : $now; 

    $output   = ['data' => []];

    // $stmt=$app->query("SELECT p.name as nama_panel,pd.id, pd.code, pd.name, pd.volume, pd.price, pd.date, pd.age, pd.created_at, pd.status FROM panel_detail pd
    // join panel p on p.id = pd.id_panel 
    // where id_panel in ($id_panels)");

    $sql = "select p.name as nama_panel,pd.id, pd.code, pd.name, pd.volume, pd.price, pd.date, pd.age, pd.created_at, pd.status   
    ,DATE_ADD( pd.date, INTERVAL (pd.age) DAY) as dateEnd
    ,(age - ( DATEDIFF( '$tgl' , pd.date ) )) as ageLeft
    , if ( (pd.age - ( DATEDIFF( '$tgl' , pd.date ) )) <= 30,'true','false' ) as isbelow30
    FROM panel_detail pd
    join panel p on p.id = pd.id_panel 
    where pd.id_panel in ($id_panels) and  ( (pd.age - ( DATEDIFF( '$tgl' , pd.date ) )) <= 30 )";
    
    // echo $sql;
    $stmt=$app->query($sql);
    $stmt->execute();
    while ($row=$stmt->fetch()) {

        $actionbutton = '<a class="btn btn-info" href="index.php?page=detail_panel&id=' . $row['id'] . '">Sparepart</a> | <a class="btn btn-warning" href="index.php?page=editpanel&id=' . $row['id'] . '">Edit</a> |  <button  class="btn btn-danger" onclick="removePanel(' . $row['id'] . ')">Delete</button>';

        $output['data'][] = [
            $row['nama_panel'],
            $row['code'],
            $row['name'],
            $row['volume'],
            $row['price'],
            $row['date'],
            $row['age'],
            // $row['created_at'],
            // $app->getStatus($row['status']),
            // number_format($row['salary'],2),
            // $row['date_'],
            $row['dateEnd'],
            $row['ageLeft'],
            $row['isbelow30'],
            $actionbutton
        ];

    }

    $app = null;
    echo json_encode($output);

    return true;

} catch (PDOExecption $e) {
    echo "Error: " . $e->getMessage();
}
