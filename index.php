<?php
require_once 'Database.php';

// sprocesovanie formulara
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $znacka = $_POST['znacka'] ?? null;
    $farba = $_POST['farba'] ?? null;
    $maxrychlost = $_POST['maxrychlost'] ?? null;
    $rokvyroby = $_POST['rokvyroby'] ?? null;
    $ecv = $_POST['ecv'] ?? null;
    $burane = $_POST['burane'] ?? null;

    if (isset($_POST['insert'])) {
        $db->insertCar($znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane);
    } elseif (isset($_POST['update']) && $id) {
        $db->updateCar($id, $znacka, $farba, $maxrychlost, $rokvyroby, $ecv, $burane);
    } elseif (isset($_POST['delete']) && $id) {
        $db->deleteCar($id);
    }
}

$cars = $db->getAllCars();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>DBENTRY MANAGEMENT FORM</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <h2>FORMULÁR NA HĽADANIE & MANAGEMENT ZÁZNAMOV V MYSQL DATABÁZI</h2>

    <form action="" method="post">
        <input type="number" name="id" placeholder="ID záznamu">
        <input type="text" name="znacka" placeholder="Značka vozidla">
        <input type="text" name="farba" placeholder="Farba vozidla">
        <input type="number" name="maxrychlost" placeholder="Maximálna rýchlosť" min="1" max="1300">
        <input type="number" name="rokvyroby" placeholder="Rok výroby" min="1769" max="2025">
        <input type="text" name="ecv" placeholder="EČV vozidla">
        <input type="text" name="burane" placeholder="Je búrané? (0 alebo 1)">
        <br>
        <button type="submit" name="insert" class="button">PRIDAJ</button>
        <button type="submit" name="update" class="button">UPRAV</button>
        <button type="submit" name="delete"class="button">VYMAŽ</button>
    </form>

    <h3>Zoznam vozidiel</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Značka</th>
            <th>Farba</th>
            <th>Max. Rýchlosť</th>
            <th>Rok Výroby</th>
            <th>EČV</th>
            <th>Búrané</th>
        </tr>
        <?php while ($car = $cars->fetch_assoc()): ?>
            <tr>
                <td><?= $car['ID'] ?></td>
                <td><?= htmlspecialchars($car['ZnackaAuta']) ?></td>
                <td><?= htmlspecialchars($car['Farba']) ?></td>
                <td><?= $car['MaxRychlost'] ?></td>
                <td><?= $car['RokVyroby'] ?></td>
                <td><?= htmlspecialchars($car['ECV']) ?></td>
                <td><?= $car['Burane'] ? 'Áno' : 'Nie' ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>