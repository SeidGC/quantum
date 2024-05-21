<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rut'])) {
    $rut = $_POST['rut'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM postulantes WHERE rut = ? AND estado = 'borrador'");
        $stmt->execute([$rut]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Retorna los datos encontrados porque ya existe un borrador.
            echo json_encode([
                'success' => true,
                'data' => $result
            ]);
        } else {
            // No se encontró un borrador, crear uno nuevo.
            $insertStmt = $pdo->prepare("INSERT INTO postulantes (rut, estado) VALUES (?, 'borrador')");
            $insertStmt->execute([$rut]);

            if ($insertStmt->rowCount() > 0) {
                // Confirma que el borrador fue creado.
                echo json_encode([
                    'success' => true,
                    'message' => "Nuevo borrador creado.",
                    'data' => ['rut' => $rut] // Retorna el RUT para confirmar la creación.
                ]);
            } else {
                // Maneja el caso de error al insertar.
                echo json_encode([
                    'success' => false,
                    'message' => "Error al crear un nuevo borrador."
                ]);
            }
        }
    } catch (PDOException $e) {
        // Error de conexión o consulta SQL.
        echo json_encode([
            'success' => false,
            'message' => "Error de conexión a la base de datos: " . $e->getMessage()
        ]);
    }
}
?>
