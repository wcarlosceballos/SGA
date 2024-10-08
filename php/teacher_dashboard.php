<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es docente
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teacher') {
    // Redirigir al inicio de sesión si no está autenticado o no es docente
    header('Location: teacher_dashboard.php');
    exit;
}

// Conexión a la base de datos (esto puede ajustarse a tus datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notas";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener información del usuario docente
$teacher_id = $_SESSION['user_id'];  // Asumiendo que el ID del docente está en la sesión
$teacher_name = $_SESSION['username'];  // Asumiendo que el nombre del docente está en la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Docente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .card-icon {
            font-size: 60px;
            color: #42a5f5; /* Color del icono */
        }
    </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Panel de Docente</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Bienvenido, <?php echo htmlspecialchars($teacher_name); ?></h1>
    
    <div class="row">
        <!-- Tarjeta para la gestión de notas -->
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">
                        <i class="material-icons card-icon">edit</i>
                        Gestión de Notas
                    </span>
                    <p>En esta sección, puedes agregar y modificar las notas de los estudiantes.</p>
                </div>
                <div class="card-action">
                    <a href="gestionar_notas.php" class="btn">Crear/Modificar Notas</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta para reportes -->
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">
                        <i class="material-icons card-icon">assessment</i>
                        Reportes
                    </span>
                    <p>Genera reportes detallados de las notas por estudiante o por curso.</p>
                </div>
                <div class="card-action">
                    <a href="gestionar_reportes.php" class="btn">Ver Reportes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
