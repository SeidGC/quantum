<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rut'])) {
    $rut = $_POST['rut'];

    $stmt = $pdo->prepare("SELECT * FROM postulantes WHERE rut = ? AND estado = 'borrador'");
    $stmt->execute([$rut]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
