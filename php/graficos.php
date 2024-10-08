<?php
// Conectar a la base de datos
$host = 'localhost'; // servidor
$dbname = 'gestion_notas'; // nombre de tu base de datos
$username = 'root'; // usuario de base de datos
$password = ''; // contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}

// Consultas para las estadísticas
// Total de estudiantes por curso
$sql_total_estudiantes = "SELECT grado, COUNT(*) as total FROM estudiantes GROUP BY grado";
$stmt = $pdo->query($sql_total_estudiantes);
$total_estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total de aprobados y reprobados por curso
$sql_aprobados_reprobados = "SELECT grado, 
    SUM(CASE WHEN n.nota >= 3 THEN 1 ELSE 0 END) AS aprobados,
    SUM(CASE WHEN n.nota < 3 THEN 1 ELSE 0 END) AS reprobados
    FROM estudiantes e
    JOIN notas n ON e.id_estudiante = n.id_estudiante
    GROUP BY grado";
$stmt = $pdo->query($sql_aprobados_reprobados);
$aprobados_reprobados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Estadísticas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
                <!-- Barra de navegación -->
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">IE El Remolino</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="crear_usuario.php">Usuarios</a></li>
                <li><a href="gestionar_estudiantes.php">Estudiantes</a></li>
                <li><a href="gestionar_profesores.php">Docentes</a></li>
                <li><a href="gestionar_notas.php">Notas</a></li>
                <li><a href="gestionar_reportes.php">Reportes</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <h1 class="center-align">Estadísticas de Estudiantes</h1>
    
    <!-- Gráfico de Total de Estudiantes por Curso -->
    <h3>Total de Estudiantes por Curso</h3>
    <canvas id="graficoEstudiantesCurso" width="400" height="200"></canvas>
    
    <script>
        const ctx1 = document.getElementById('graficoEstudiantesCurso').getContext('2d');
        const datosEstudiantesCurso = {
            labels: [<?php foreach ($total_estudiantes as $row) { echo '"' . $row['grado'] . '",'; } ?>],
            datasets: [{
                label: 'Total Estudiantes',
                data: [<?php foreach ($total_estudiantes as $row) { echo $row['total'] . ','; } ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config1 = {
            type: 'bar',
            data: datosEstudiantesCurso,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        new Chart(ctx1, config1);
    </script>

    <!-- Gráfico de Aprobados y Reprobados por Curso -->
    <h3>Aprobados y Reprobados por Curso</h3>
    <canvas id="graficoAprobadosReprobados" width="400" height="200"></canvas>
    
    <script>
        const ctx2 = document.getElementById('graficoAprobadosReprobados').getContext('2d');
        const datosAprobadosReprobados = {
            labels: [<?php foreach ($aprobados_reprobados as $row) { echo '"' . $row['grado'] . '",'; } ?>],
            datasets: [{
                label: 'Aprobados',
                data: [<?php foreach ($aprobados_reprobados as $row) { echo $row['aprobados'] . ','; } ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Reprobados',
                data: [<?php foreach ($aprobados_reprobados as $row) { echo $row['reprobados'] . ','; } ?>],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        const config2 = {
            type: 'bar',
            data: datosAprobadosReprobados,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        new Chart(ctx2, config2);
    </script>
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
