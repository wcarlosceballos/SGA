<?php
session_start();
require 'db_connection.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar usuario en la base de datos
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Si el usuario y la contraseña son correctos, iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirigir según el rol
        $response['redirect'] = ($user['role'] == 'admin') ? 'php/admin_dashboard.php' : (($user['role'] == 'teacher') ? 'php/teacher_dashboard.php' : 'php/student_dashboard.php');
    } else {
        // Si las credenciales son incorrectas
        $response['error'] = "¡Usuario o contraseña incorrectos!";
    }
}

echo json_encode($response);
?>
