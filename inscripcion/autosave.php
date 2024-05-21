<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rut'], $_POST['field'], $_POST['value'])) {
    $rut = $_POST['rut'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Lista de campos permitidos para evitar inyecciones SQL
    $allowedFields = [
    'nombre_completo', 'cargo', 'telefono_celular', 'region_residencia', 'email',
    'sitio_web', 'actor_ecosistema', 'nombre_solucion', 'descripcion_solucion',
    'caracteristicas_solucion', 'estado_prototipo', 'equipo_descripcion',
    'video_proyecto', 'video_seleccion', 'fuente_informacion'
];


    if (!in_array($field, $allowedFields)) {
        echo "Campo no permitido";
        exit;
    }

    // Comprueba si el registro existe y actualiza o inserta según corresponda
    $stmt = $pdo->prepare("SELECT * FROM postulantes WHERE rut = ?");
    $stmt->execute([$rut]);
    if ($stmt->rowCount() > 0) {
        $updateStmt = $pdo->prepare("UPDATE postulantes SET $field = ? WHERE rut = ?");
        $updateStmt->execute([$value, $rut]);
        echo "Campo actualizado";
    } else {
        // Crea un registro de borrador si es la primera vez
        $insertStmt = $pdo->prepare("INSERT INTO postulantes (rut, $field) VALUES (?, ?)");
        $insertStmt->execute([$rut, $value]);
        echo "Nuevo registro creado como borrador";
    }
} else {
    echo "Datos insuficientes proporcionados";
}
?>


