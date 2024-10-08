<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo">SGA 0.02</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="crear_usuario.php">Usuarios</a></li>
                <li><a href="../php/gestionar_estudiantes.php">Estudiantes</a></li>
                <li><a href="../php/gestionar_profesores.php">Docentes</a></li>
                <li><a href="../php/gestionar_asignaturas.php">Asignaturas</a></li>
                <li><a href="../php/gestionar_notas.php">Notas</a></li>
                <li><a href="../php/gestionar_reportes.php">Reportes</a></li>
                <li><a href="../php/logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h4 class="center-align">Bienvenido, Administrador</h4>
        
        <div class="row">
            <!-- Tarjeta para gestión de usuarios -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">people</i>
                        <span class="card-title">Usuarios</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="crear_usuario.php">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para gestión de Estudiantes -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">school</i>
                        <span class="card-title">Estudiantes</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="gestionar_estudiantes.php">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para gestión de Docentes -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">person</i>
                        <span class="card-title">Docentes</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="gestionar_profesores.php">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para gestión de Asignaturas -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">assignment_turned_in</i>
                        <span class="card-title">Asignaturas</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="gestionar_asignaturas.php">Ingresar</a>
                    </div>
                </div>
            </div>

            

            <!-- Tarjeta para gestión de Notas -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">assignment</i>
                        <span class="card-title">Notas</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="gestionar_notas.php">Ingresar</a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta para generar reportes -->
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content center-align">
                        <i class="material-icons large">bar_chart</i>
                        <span class="card-title">Reportes</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="gestionar_reportes.php">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
