<?php

require_once 'config/Record.class.php';
$app = new Record();

if(isset($_POST['record_id'])) {
    try {
        
        $stmt=$app->query("SELECT firstname, lastname, salary FROM employees WHERE id=?");
        $stmt->execute([$_POST['record_id']]);
        $result = $stmt->fetch();

        echo json_encode($result);

    } catch (PDOExecption $e) {
        echo $e->getMessage();
    }
}