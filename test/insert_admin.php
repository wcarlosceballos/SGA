<?php
// Conexión a la base de datos (usando PDO)
require 'db_connection.php';

$pdo = new PDO('mysql:host=localhost;dbname=gestion_notas', 'root', '');

// Datos del nuevo usuario administrador
$username = 'admin';
$password = 'admin';
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña
$role = 'admin';
$image_path = 'img/2.png'; // Ruta de la imagen del administrador

// Consulta para insertar el usuario en la tabla
$sql = "INSERT INTO users (username, password, role, image, created_at) 
        VALUES (:username, :password, :role, :image, NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':username' => $username,
    ':password' => $hashed_password, // Contraseña encriptada
    ':role'     => $role,
    ':image'    => $image_path
]);

echo "Usuario administrador creado correctamente.";
?>
