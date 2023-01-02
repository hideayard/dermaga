<?php
require_once 'Database.class.php';

class Record
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $db         = $database->dbConnection();
        $this->conn = $db;
    }

    public function query($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function create($firstname, $lastname, $salary)
    {
        try {

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO employees (firstname, lastname, salary) VALUES (?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $salary]);

            $this->conn->commit();

            echo json_encode("Record added!");

            return true;

        } catch (PDOException $e) {

            $this->conn->rollback();
            echo $e->getMessage();

        }
    }

    public function createDetailSprepart($id_panel,$code,$name,$volume,$price,$age, $id_sparepart, $tgl)
    {
        try {

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO panel_detail (id_panel, code, name, volume, price, age, id_sparepart, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // var_dump($stmt);
            $stmt->execute([$id_panel, $code, $name, $volume, $price, intval($age), $id_sparepart, $tgl, 1]);

            $this->conn->commit();

            echo json_encode( array("status" => true,"info" => "OK","messages" => "sukses tambah sparepart" ) );

            return true;

        } catch (PDOException $e) {

            $this->conn->rollback();
            echo $e->getMessage();

        }
    }

    function getStatus($status) {
        switch($status) {
            case 1:{return "Active";}break;
            case 2:{return "Pending";}break;
            default:{return "Non Active";}break;
            
        }
    }

    public function update($firstname, $lastname, $salary, $id)
    {
        try {

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("UPDATE employees SET firstname=?, lastname=?, salary=? WHERE id=?");
            $stmt->execute([$firstname, $lastname, $salary, $id]);

            $this->conn->commit();

            echo json_encode("Record updated!");

            return true;

        } catch (PDOException $e) {

            $this->conn->rollback();
            echo $e->getMessage();

        }
    }

    public function delete($id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("DELETE FROM employees WHERE id=?");
            $stmt->execute([$id]);

            $this->conn->commit();

            echo json_encode("Record deleted!");
            
            return true;

        } catch (PDOExeption $e) {
            $this->conn->rollback();
            echo $e->getMessage();
        }
    }

    public function deleteSparepart($id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("DELETE FROM panel_detail WHERE id=?");
            $stmt->execute([$id]);

            $this->conn->commit();

            echo json_encode( array("status" => true,"info" => "OK","messages" => "sukses hapus sparepart" ) );

            return true;

        } catch (PDOExeption $e) {
            $this->conn->rollback();
            echo $e->getMessage();
        }
    }

}
