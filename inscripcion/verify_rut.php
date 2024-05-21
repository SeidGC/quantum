<?php
require 'db.php';

$rut = $_POST['rut'] ?? '';
$response = ['exists' => false];

if ($rut) {
    $stmt = $pdo->prepare("SELECT * FROM postulantes WHERE rut = ?");
    $stmt->execute([$rut]);
    $data = $stmt->fetch();

    if ($data) {
        $response['exists'] = true;
        $response['data'] = $data;
    }
}

echo json_encode($response);
?>
