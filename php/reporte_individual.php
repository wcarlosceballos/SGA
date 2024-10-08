<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notas";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los estudiantes
$estudiantesQuery = "SELECT id_estudiante, nombre, apellido FROM estudiantes";
$estudiantesResult = $conn->query($estudiantesQuery);

$id_estudiante_seleccionado = null;
$estudiante_nombre = "";
$notasResult = null;
$promedio_general = null;

if (isset($_GET['id_estudiante'])) {
    $id_estudiante_seleccionado = $_GET['id_estudiante'];

    // Obtener nombre completo del estudiante
    $nombreEstudianteQuery = "SELECT nombre, apellido FROM estudiantes WHERE id_estudiante = ?";
    $stmt = $conn->prepare($nombreEstudianteQuery);
    $stmt->bind_param("i", $id_estudiante_seleccionado);
    $stmt->execute();
    $nombreEstudianteResult = $stmt->get_result();
    
    if ($nombreEstudianteResult->num_rows > 0) {
        $estudiante = $nombreEstudianteResult->fetch_assoc();
        $estudiante_nombre = $estudiante['nombre'] . ' ' . $estudiante['apellido'];
    }

    // Obtener las notas del estudiante seleccionado por asignatura y periodo
    $notasQuery = "
        SELECT a.nombre AS nombre_asignatura,
               MAX(CASE WHEN n.periodo = 1 THEN n.nota ELSE NULL END) AS periodo_1,
               MAX(CASE WHEN n.periodo = 2 THEN n.nota ELSE NULL END) AS periodo_2,
               MAX(CASE WHEN n.periodo = 3 THEN n.nota ELSE NULL END) AS periodo_3,
               MAX(CASE WHEN n.periodo = 4 THEN n.nota ELSE NULL END) AS periodo_4,
               AVG(n.nota) AS promedio_asignatura
        FROM notas n
        JOIN asignaturas a ON n.id_asignatura = a.id_asignatura
        WHERE n.id_estudiante = ?
        GROUP BY a.nombre";
    
    $stmt = $conn->prepare($notasQuery);
    $stmt->bind_param("i", $id_estudiante_seleccionado);
    $stmt->execute();
    $notasResult = $stmt->get_result();

    // Calcular el promedio general del estudiante
    $promedioQuery = "SELECT AVG(nota) AS promedio_general FROM notas WHERE id_estudiante = ?";
    $stmt = $conn->prepare($promedioQuery);
    $stmt->bind_param("i", $id_estudiante_seleccionado);
    $stmt->execute();
    $promedioResult = $stmt->get_result();
    $promedio_general = $promedioResult->fetch_assoc()['promedio_general'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Notas por Estudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>
<body>
<div class="container center">
    <h5>Institucion Educativa el Remolino</h5>
    <!-- Filtro de estudiantes -->
    <form action="" method="GET">
        <label for="id_estudiante">Seleccionar Estudiante:</label>
        <select name="id_estudiante" onchange="this.form.submit()">
            <option value="">Seleccionar...</option>
            <?php while ($estudiante = $estudiantesResult->fetch_assoc()): ?>
                <option value="<?php echo $estudiante['id_estudiante']; ?>"
                    <?php echo ($id_estudiante_seleccionado == $estudiante['id_estudiante']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($estudiante['nombre'] . ' ' . $estudiante['apellido']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
</div>
<div class="container center" id="contenido">
<?php if ($id_estudiante_seleccionado): ?>
        <h5>Boletin Informativo Final : <?php echo htmlspecialchars($estudiante_nombre); ?></h5>
        
        <table class="striped">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Periodo 1</th>
                    <th>Periodo 2</th>
                    <th>Periodo 3</th>
                    <th>Periodo 4</th>
                    <th>Promedio Asignatura</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($notasResult && $notasResult->num_rows > 0): ?>
                    <?php while ($nota = $notasResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($nota['nombre_asignatura']); ?></td>
                            <td><?php echo htmlspecialchars($nota['periodo_1']); ?></td>
                            <td><?php echo htmlspecialchars($nota['periodo_2']); ?></td>
                            <td><?php echo htmlspecialchars($nota['periodo_3']); ?></td>
                            <td><?php echo htmlspecialchars($nota['periodo_4']); ?></td>
                            <td><?php echo number_format($nota['promedio_asignatura'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="5"><strong>Promedio General</strong></td>
                        <td><strong><?php echo number_format($promedio_general, 2); ?></strong></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No se encontraron notas para este estudiante.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Botones adicionales -->
        <div class="container center">
            <!-- Botón para imprimir -->
            <button class="btn orange" onclick="window.print()">Imprimir Boletin</button>

            <!-- Botón para generar PDF -->
            <button class="btn blue" onclick="generarPDF()">Generar PDF</button>

            <!-- Botón para regresar a reportes -->
            <a href="gestionar_reportes.php" class="btn green">Regresar a Reportes</a>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    // Función para generar PDF usando jsPDF
    function generarPDF() {
        var { jsPDF } = window.jspdf;
        var doc = new jsPDF();

        doc.text("Boletin Informativo Final", 10, 10);
        doc.text("Estudiante: <?php echo htmlspecialchars($estudiante_nombre); ?>", 10, 20);

        // Recorrer las filas de la tabla
        var table = document.querySelector("table");
        var rows = table.querySelectorAll("tr");

        var y = 30;
        rows.forEach(function(row, index) {
            var cols = row.querySelectorAll("td, th");
            var x = 10;
            cols.forEach(function(col) {
                doc.text(col.textContent, x, y);
                x += 40;
            });
            y += 10;
        });

        // Descargar el PDF
        doc.save("boletin_<?php echo htmlspecialchars($estudiante_nombre); ?>.pdf");
    }
</script>
</body>
</html>

<?php
$conn->close();
?>
