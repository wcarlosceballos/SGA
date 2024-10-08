<?php
$host = "localhost"; // Localizacion del servidor
$dbname = "gestion_notas"; // Nombre de la base de datos
$username = "root";  // usuario
$password = "";  // contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
