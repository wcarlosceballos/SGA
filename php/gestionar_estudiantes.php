<?php

// Conexión a la base de datos

// Conexión a la base de datos
$servername = "localhost"; // Servidor Local
$username = "root"; // Usuario 
$password = ""; // Clave
$dbname = "gestion_notas"; // base de datos


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar variables
$id_estudiante = $nombre = $apellido = $grado = $correo = "";
$edit = false;

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la existencia del ID
    if (isset($_POST['id_estudiante'])) {
        $id_estudiante = $_POST['id_estudiante'];
    }

    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $grado = $_POST['grado'];
        $correo = $_POST['correo'];

        // Verificar duplicidad de ID
        $checkQuery = "SELECT * FROM estudiantes WHERE id_estudiante = '$id_estudiante'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('El ID del estudiante ya existe.');</script>";
        } else {
            // Crear
            $sql = "INSERT INTO estudiantes (id_estudiante, nombre, apellido, grado, correo) VALUES ('$id_estudiante', '$nombre', '$apellido', '$grado', '$correo')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Estudiante creado exitosamente.');</script>";
            } else {
                echo "<script>alert('Error al crear el estudiante: " . $conn->error . "');</script>";
            }
        }
    } elseif (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $grado = $_POST['grado'];
        $correo = $_POST['correo'];

        // Actualizar
        $sql = "UPDATE estudiantes SET nombre='$nombre', apellido='$apellido', grado='$grado', correo='$correo' WHERE id_estudiante='$id_estudiante'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Estudiante actualizado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al actualizar el estudiante: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar
        $sql = "DELETE FROM estudiantes WHERE id_estudiante='$id_estudiante'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Estudiante eliminado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al eliminar el estudiante: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['editar'])) {
        // Obtener datos del estudiante para editar
        $sql = "SELECT * FROM estudiantes WHERE id_estudiante='$id_estudiante'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $edit = $result->fetch_assoc();
        }
    }
}

// Obtener estudiantes
$sql = "SELECT * FROM estudiantes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Estudiantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

<nav>
    <div class="nav-wrapper blue">
        <a href="#" class="brand-logo">SGA 0.02</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="admin_dashboard.php">Inicio</a></li> 
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Gestión de Estudiantes</h1>

    <form action="" method="POST">
        <div class="input-field">
            <input type="number" name="id_estudiante" required value="<?php echo $edit ? $edit['id_estudiante'] : ''; ?>">
            <label>ID Estudiante</label>
        </div>
        <div class="input-field">
            <input type="text" name="nombre" required value="<?php echo $edit ? $edit['nombre'] : ''; ?>">
            <label>Nombre</label>
        </div>
        <div class="input-field">
            <input type="text" name="apellido" required value="<?php echo $edit ? $edit['apellido'] : ''; ?>">
            <label>Apellido</label>
        </div>
        <div class="input-field">
            <select name="grado" required>
                <option value="" disabled <?php echo !$edit ? 'selected' : ''; ?>>Seleccionar Grado</option>
                <?php for ($i = 1; $i <= 11; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo $edit && $edit['grado'] == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <label>Grado</label>
        </div>
        <div class="input-field">
            <input type="email" name="correo" required value="<?php echo $edit ? $edit['correo'] : ''; ?>">
            <label>Correo Electrónico</label>
        </div>
        <button type="submit" name="<?php echo $edit ? 'actualizar' : 'crear'; ?>" class="btn">
            <?php echo $edit ? 'Actualizar' : 'Crear'; ?>
        </button>
    </form>

    <h2>Lista de Estudiantes</h2>
    <table class="striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Grado</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_estudiante']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['grado']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_estudiante" value="<?php echo $row['id_estudiante']; ?>">
                                <button type="submit" name="eliminar" class="btn red">Eliminar</button>
                            </form>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_estudiante" value="<?php echo $row['id_estudiante']; ?>">
                                <button type="submit" name="editar" class="btn blue">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay estudiantes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    // Inicializa el select de Materialize
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
</script>
</body>
</html>

<?php
$conn->close();
?>
