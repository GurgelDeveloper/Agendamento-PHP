<?php
class Doctor {
    private $conn;
    private $table_name = "doctors";

    public $id;
    public $name;
    public $specialization;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDoctorsBySpecialization($specialization) {
        $query = "SELECT id, name, specialization FROM " . $this->table_name . " WHERE specialization = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $specialization);
        $stmt->execute();

        return $stmt;
    }
}
?>
