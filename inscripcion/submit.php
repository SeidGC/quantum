<?php
require 'db.php';  // Asegúrate de que este archivo contiene la conexión correcta a la base de datos

try {
    // Preparar la consulta SQL
    $query = "INSERT INTO postulantes (nombre_completo, rut, cargo, telefono_celular, region_residencia, email, sitio_web, actor_ecosistema, nombre_solucion, descripcion_solucion, caracteristicas_solucion, estado_prototipo, equipo_descripcion, video_proyecto, video_seleccion, fuente_informacion, estado) VALUES (:nombre_completo, :rut, :cargo, :telefono_celular, :region_residencia, :email, :sitio_web, :actor_ecosistema, :nombre_solucion, :descripcion_solucion, :caracteristicas_solucion, :estado_prototipo, :equipo_descripcion, :video_proyecto, :video_seleccion, :fuente_informacion, 'finalizado')";

    $stmt = $pdo->prepare($query);

    // Vincular los parámetros
    $stmt->bindParam(':nombre_completo', $_POST['nombreCompleto']);
    $stmt->bindParam(':rut', $_POST['rut']);
    $stmt->bindParam(':cargo', $_POST['cargo']);
    $stmt->bindParam(':telefono_celular', $_POST['telefono']);
    $stmt->bindParam(':region_residencia', $_POST['region']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':sitio_web', $_POST['sitioWeb']);
    $stmt->bindParam(':actor_ecosistema', $_POST['actorPrevio']);
    $stmt->bindParam(':nombre_solucion', $_POST['nombreSolucion']);
    $stmt->bindParam(':descripcion_solucion', $_POST['descripcionSolucion']);
    $stmt->bindParam(':caracteristicas_solucion', $_POST['caracteristicas']);
    $stmt->bindParam(':estado_prototipo', $_POST['estadoPrototipo']);
    $stmt->bindParam(':equipo_descripcion', $_POST['equipo']);
    $stmt->bindParam(':video_proyecto', $_POST['videoProyecto']);
    $stmt->bindParam(':video_seleccion', $_POST['videoSeleccion']);
    $fuente_info = implode(',', $_POST['fuente'] ?? []);
    $stmt->bindParam(':fuente_informacion', $fuente_info);

    // Ejecutar la consulta
    $stmt->execute();

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
?>

