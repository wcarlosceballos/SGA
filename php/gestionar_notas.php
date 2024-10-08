<?php
session_start();

$servername = "localhost";  // Definir variables antes de usarlas
$username = "root";
$password = "";
$dbname = "gestion_notas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_estudiante = $id_asignatura = $id_profesor = $periodo = $nota = "";
$edit = false;

// Procesamiento de datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear'])) {
        $id_estudiante = $_POST['id_estudiante'];
        $id_asignatura = $_POST['id_asignatura'];
        $id_profesor = $_POST['id_profesor'];
        $periodo = $_POST['periodo'];
        $nota = $_POST['nota'];

        $sql = "INSERT INTO notas (id_estudiante, id_asignatura, id_profesor, periodo, nota) 
                VALUES ('$id_estudiante', '$id_asignatura', '$id_profesor', '$periodo', '$nota')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>M.toast({html: 'Nota ingresada exitosamente.'});</script>";
        } else {
            echo "<script>M.toast({html: 'Error al ingresar la nota: " . $conn->error . "'});</script>";
        }
    } elseif (isset($_POST['actualizar'])) {
        $id_nota = $_POST['id_nota'];
        $id_estudiante = $_POST['id_estudiante'];
        $id_asignatura = $_POST['id_asignatura'];
        $id_profesor = $_POST['id_profesor'];
        $periodo = $_POST['periodo'];
        $nota = $_POST['nota'];

        $sql = "UPDATE notas SET id_estudiante='$id_estudiante', id_asignatura='$id_asignatura', 
                id_profesor='$id_profesor', periodo='$periodo', nota='$nota' WHERE id_nota='$id_nota'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>M.toast({html: 'Nota actualizada exitosamente.'});</script>";
        } else {
            echo "<script>M.toast({html: 'Error al actualizar la nota: " . $conn->error . "'});</script>";
        }
    } elseif (isset($_POST['eliminar'])) {
        $id_nota = $_POST['id_nota'];

        $sql = "DELETE FROM notas WHERE id_nota='$id_nota'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>M.toast({html: 'Nota eliminada exitosamente.'});</script>";
        } else {
            echo "<script>M.toast({html: 'Error al eliminar la nota: " . $conn->error . "'});</script>";
        }
    } elseif (isset($_POST['editar'])) {
        $id_nota = $_POST['id_nota'];

        $sql = "SELECT * FROM notas WHERE id_nota='$id_nota'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $edit = $result->fetch_assoc();
        }
    }
}

// Consulta para obtener las listas para los selects
$estudiantes = $conn->query("SELECT id_estudiante, nombre FROM estudiantes");
$asignaturas = $conn->query("SELECT id_asignatura, nombre FROM asignaturas");
$profesores = $conn->query("SELECT id_profesor, nombre FROM profesores");

// Consulta para listar las notas
$sql = "SELECT notas.id_nota, estudiantes.nombre AS nombre_estudiante, asignaturas.nombre AS nombre_asignatura, 
        profesores.nombre AS nombre_profesor, notas.periodo, notas.nota 
        FROM notas 
        JOIN estudiantes ON notas.id_estudiante = estudiantes.id_estudiante
        JOIN asignaturas ON notas.id_asignatura = asignaturas.id_asignatura
        JOIN profesores ON notas.id_profesor = profesores.id_profesor";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Notas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

<nav>
    <div class="nav-wrapper blue">
        <a href="#" class="brand-logo">SGA 0.01</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="../php/admin_dashboard.php">Inicio</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Gestión de Notas</h1>

    <form action="" method="POST">
        <div class="input-field">
            <select name="id_estudiante" required>
                <option value="" disabled selected>Seleccione un estudiante</option>
                <?php while ($row = $estudiantes->fetch_assoc()): ?>
                    <option value="<?php echo $row['id_estudiante']; ?>" <?php echo $edit && $edit['id_estudiante'] == $row['id_estudiante'] ? 'selected' : ''; ?>>
                        <?php echo $row['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label>Estudiante</label>
        </div>
        
        <div class="input-field">
            <select name="id_asignatura" required>
                <option value="" disabled selected>Seleccione una asignatura</option>
                <?php while ($row = $asignaturas->fetch_assoc()): ?>
                    <option value="<?php echo $row['id_asignatura']; ?>" <?php echo $edit && $edit['id_asignatura'] == $row['id_asignatura'] ? 'selected' : ''; ?>>
                        <?php echo $row['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label>Asignatura</label>
        </div>
        
        <div class="input-field">
            <select name="id_profesor" required>
                <option value="" disabled selected>Seleccione un profesor</option>
                <?php while ($row = $profesores->fetch_assoc()): ?>
                    <option value="<?php echo $row['id_profesor']; ?>" <?php echo $edit && $edit['id_profesor'] == $row['id_profesor'] ? 'selected' : ''; ?>>
                        <?php echo $row['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label>Profesor</label>
        </div>

        <div class="input-field">
            <input type="number" name="periodo" required value="<?php echo $edit ? $edit['periodo'] : ''; ?>">
            <label>Periodo</label>
        </div>
        <div class="input-field">
            <input type="text" name="nota" required value="<?php echo $edit ? $edit['nota'] : ''; ?>">
            <label>Nota</label>
        </div>
        
        <button type="submit" name="<?php echo $edit ? 'actualizar' : 'crear'; ?>" class="btn">
            <?php echo $edit ? 'Actualizar' : 'Crear'; ?>
        </button>
    </form>

    <h2>Lista de Notas</h2>
    <table class="striped">
        <thead>
            <tr>
                <th>ID Nota</th>
                <th>Estudiante</th>
                <th>Asignatura</th>
                <th>Profesor</th>
                <th>Periodo</th>
                <th>Nota</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_nota']; ?></td>
                        <td><?php echo $row['nombre_estudiante']; ?></td>
                        <td><?php echo $row['nombre_asignatura']; ?></td>
                        <td><?php echo $row['nombre_profesor']; ?></td>
                        <td><?php echo $row['periodo']; ?></td>
                        <td><?php echo $row['nota']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_nota" value="<?php echo $row['id_nota']; ?>">
                                <button type="submit" name="eliminar" class="btn red">Eliminar</button>
                            </form>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_nota" value="<?php echo $row['id_nota']; ?>">
                                <button type="submit" name="editar" class="btn blue">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron notas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        M.FormSelect.init(elems);
    });
</script>
</body>
</html>

<?php
$conn->close();
?>
