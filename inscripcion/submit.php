<?php
require 'db.php';  // Asegúrate de que este archivo contiene la conexión correcta a la base de datos

// Verificar si todos los campos necesarios están presentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rut'], $_POST['nombreCompleto'], $_POST['cargo'], $_POST['telefono'], $_POST['region'], $_POST['email'], $_POST['sitioWeb'], $_POST['actorPrevio'], $_POST['nombreSolucion'], $_POST['descripcionSolucion'], $_POST['caracteristicas'], $_POST['estadoPrototipo'], $_POST['equipo'], $_POST['videoProyecto'], $_POST['videoSeleccion'], $_POST['fuente'])) {
    try {
        // Comprobar si el usuario ya tiene un borrador guardado
        $checkStmt = $pdo->prepare("SELECT * FROM postulantes WHERE rut = ? AND estado = 'borrador'");
        $checkStmt->execute([$_POST['rut']]);
        if ($checkStmt->rowCount() > 0) {
            // Actualizar el registro existente
            $query = "UPDATE postulantes SET nombre_completo = :nombre_completo, cargo = :cargo, telefono_celular = :telefono_celular, region_residencia = :region_residencia, email = :email, sitio_web = :sitio_web, actor_ecosistema = :actor_ecosistema, nombre_solucion = :nombre_solucion, descripcion_solucion = :descripcion_solucion, caracteristicas_solucion = :caracteristicas_solucion, estado_prototipo = :estado_prototipo, equipo_descripcion = :equipo_descripcion, video_proyecto = :video_proyecto, video_seleccion = :video_seleccion, fuente_informacion = :fuente_informacion, estado = 'enviado' WHERE rut = :rut";
        } else {
            // Insertar nuevo registro
            $query = "INSERT INTO postulantes (nombre_completo, rut, cargo, telefono_celular, region_residencia, email, sitio_web, actor_ecosistema, nombre_solucion, descripcion_solucion, caracteristicas_solucion, estado_prototipo, equipo_descripcion, video_proyecto, video_seleccion, fuente_informacion, estado) VALUES (:nombre_completo, :rut, :cargo, :telefono_celular, :region_residencia, :email, :sitio_web, :actor_ecosistema, :nombre_solucion, :descripcion_solucion, :caracteristicas_solucion, :estado_prototipo, :equipo_descripcion, :video_proyecto, :video_seleccion, :fuente_informacion, 'enviado')";
        }

        $stmt = $pdo->prepare($query);

        // Vincular los parámetros
        $fuente_info = implode(',', $_POST['fuente']);
        $params = [
            ':nombre_completo' => $_POST['nombreCompleto'],
            ':rut' => $_POST['rut'],
            ':cargo' => $_POST['cargo'],
            ':telefono_celular' => $_POST['telefono'],
            ':region_residencia' => $_POST['region'],
            ':email' => $_POST['email'],
            ':sitio_web' => $_POST['sitioWeb'],
            ':actor_ecosistema' => $_POST['actorPrevio'],
            ':nombre_solucion' => $_POST['nombreSolucion'],
            ':descripcion_solucion' => $_POST['descripcionSolucion'],
            ':caracteristicas_solucion' => $_POST['caracteristicas'],
            ':estado_prototipo' => $_POST['estadoPrototipo'],
            ':equipo_descripcion' => $_POST['equipo'],
            ':video_proyecto' => $_POST['videoProyecto'],
            ':video_seleccion' => $_POST['videoSeleccion'],
            ':fuente_informacion' => $fuente_info
        ];
        $stmt->execute($params);

        // Mostrar mensaje y redirigir después de 5 segundos
        echo '<script>
                alert("Datos guardados correctamente. Serás redirigido en 5 segundos.");
                setTimeout(function(){
                    window.location.href = "https://quantum.seidgc.cl";
                }, 5000);
              </script>';
    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
} else {
    echo '<script>
            alert("Error: No todos los campos requeridos están presentes.");
            window.history.back(); // Regresa al formulario
          </script>';
}
?>


