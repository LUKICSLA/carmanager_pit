<?php
require_once 'config.php';

class Database {
    private $conn;

    public function __construct($mysqli) {
        $this->conn = $mysqli;
    }

    // pridanie zaznamu
    public function insertCar($znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane) {
        $query = "INSERT INTO cars (ZnackaAuta, Farba, MaxRychlost, RokVyroby, ECV, Burane) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiis", $znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane);
        return $stmt->execute();
    }

    // update zaznamu
    public function updateCar($id, $znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane) {
        $query = "UPDATE cars SET ZnackaAuta=?, Farba=?, MaxRychlost=?, RokVyroby=?, ECV=?, Burane=? WHERE ID=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiisi", $znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane, $id);
        return $stmt->execute();
    }

    // vymazanie zaznamu
    public function deleteCar($id) {
        $query = "DELETE FROM cars WHERE ID=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Vyhladanie zaznamu
    public function getCarById($id) {
        $query = "SELECT * FROM cars WHERE ID=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Ziskanie vsetkych zaznamov
    public function getAllCars() {
        $query = "SELECT * FROM cars";
        return $this->conn->query($query);
    }
}

// init
$db = new Database($mysqli);
?>
