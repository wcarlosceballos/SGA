<?php
// Conexión a la base de datos
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener estudiantes y sus promedios por grado
function obtenerEstudiantesPorGrado($conn, $grado) {
    $sql = "SELECT e.nombre, e.apellido, AVG(n.nota) AS promedio
            FROM estudiantes e
            JOIN notas n ON e.id_estudiante = n.id_estudiante
            WHERE e.grado = ?
            GROUP BY e.id_estudiante";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $grado);
    $stmt->execute();
    return $stmt->get_result();
}

// Consulta para obtener el total de estudiantes por curso (grado)
$sql_total_estudiantes = "SELECT grado, COUNT(*) AS total_estudiantes FROM estudiantes GROUP BY grado ORDER BY grado";
$result_total_estudiantes = $conn->query($sql_total_estudiantes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes por Grado</title>
    <!-- Importa Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .perdedor {
            color: red;
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-wrapper blue">
        <a href="#" class="brand-logo">IE El Remolino</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="admin_dashboard.php">Inicio</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h3 class="center-align">Estudiantes por Grado</h3>

    <!-- Pestañas -->
    <ul class="tabs">
        <li class="tab col s3"><a href="#total-estudiantes">Total de Estudiantes</a></li>
        <?php for ($grado = 1; $grado <= 11; $grado++): ?>
            <li class="tab col s3"><a href="#grado-<?php echo $grado; ?>">Grado <?php echo $grado; ?></a></li>
        <?php endfor; ?>
    </ul>

    <!-- Contenido de las Pestañas -->
    <div id="total-estudiantes" class="col s12">
        <h4>Total de Estudiantes por Curso</h4>
        <div class="row">
            <div class="col s4">
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_total_estudiantes->num_rows > 0) {
                            while ($row = $result_total_estudiantes->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['grado']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td>No se encontraron datos</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="col s8">
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>Total de Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_total_estudiantes->data_seek(0); // Reiniciar el puntero del resultado
                        if ($result_total_estudiantes->num_rows > 0) {
                            while ($row = $result_total_estudiantes->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['total_estudiantes']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td>No se encontraron datos</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php for ($grado = 1; $grado <= 11; $grado++): ?>
        <div id="grado-<?php echo $grado; ?>" class="col s12">
            <h4>Estudiantes del Grado <?php echo $grado; ?></h4>
            <?php
            // Obtener estudiantes y promedios
            $result = obtenerEstudiantesPorGrado($conn, $grado);
            $totalEstudiantes = 0;
            $perdedores = 0;

            if ($result->num_rows > 0) {
                echo "<table class='striped centered'>";
                echo "<thead><tr><th>Nombre</th><th>Apellido</th><th>Promedio</th></tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    $totalEstudiantes++;
                    $promedio = $row['promedio'];

                    // Contar perdedores (promedio menor a 3)
                    if ($promedio < 3) {
                        $perdedores++;
                        echo "<tr class='perdedor'>";
                    } else {
                        echo "<tr>";
                    }

                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($promedio, 2)) . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No hay estudiantes registrados en este grado.</p>";
            }

            echo "<p>Total de estudiantes: $totalEstudiantes</p>";
            echo "<p>Estudiantes que no aprobaron: $perdedores</p>";
            ?>
        </div>
    <?php endfor; ?>
</div>

<!-- Importa Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.tabs');
        var instances = M.Tabs.init(elems);
    });
</script>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión a la base de datos
?>
