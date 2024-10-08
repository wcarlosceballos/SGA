<?php
// Conectar a la base de datos
$host = 'localhost'; // Servidor
$dbname = 'gestion_notas'; // Base de datos
$username = 'root'; // usuario de base de datos
$password = ''; // contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Reportes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo">SGA 0.01</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="admin_dashboard.php">Inicio</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h1 class="center-align">Menú de Reportes</h1>

    <div class="row">
        <!-- Card para Reporte Individual -->
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Reporte Individual</span>
                    <p>Genera el boletín del estudiante seleccionado.</p>
                </div>
                <div class="card-action">
                    <a href="reporte_individual.php" class="btn blue">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Card para Estadísticas -->
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Estadísticas</span>
                    <p>Consulta estadísticas de estudiantes por curso y asignatura.</p>
                </div>
                <div class="card-action">
                    <a href="estadisticas.php" class="btn blue">Ver Estadísticas</a>
                </div>
            </div>
        </div>

        <!-- Card para Graficos -->
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Graficos</span>
                    <p>Consulta estadísticas de estudiantes por curso y asignatura.</p>
                </div>
                <div class="card-action">
                    <a href="graficos.php" class="btn blue">Ver Graficos</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
