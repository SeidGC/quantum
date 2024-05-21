<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';  // Host de la base de datos
$db   = 'quantum_postulantes';  // Nombre de la base de datos
$user = 'seid';  // Nombre de usuario de la base de datos
$pass = 'Seid2024@';  // Contraseña de la base de datos
$charset = 'utf8mb4';

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
