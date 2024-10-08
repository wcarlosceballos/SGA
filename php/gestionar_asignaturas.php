<?php
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
$id_asignatura = $nombre = $Id_profesor =  "";
$edit = false;

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la existencia del ID
    if (isset($_POST['id_asignatura'])) {
        $id_asignatura = $_POST['id_asignatura'];
    }

    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $Id_profesor = $_POST['Id_profesor'];

        // Verificar duplicidad de ID
        $checkQuery = "SELECT * FROM asignaturas WHERE id_asignatura = '$id_asignatura'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('El ID del asignatura ya existe.');</script>";
        } else {
            // Crear
            $sql = "INSERT INTO asignaturas (id_asignatura, nombre, Id_profesor) VALUES ('$id_asignatura', '$nombre', '$Id_profesor')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('asignatura creado exitosamente.');</script>";
            } else {
                echo "<script>alert('Error al crear el asignatura: " . $conn->error . "');</script>";
            }
        }
    } elseif (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $Id_profesor = $_POST['Id_profesor'];

        // Actualizar
        $sql = "UPDATE asignaturas SET nombre='$nombre', Id_profesor='$Id_profesor'
         WHERE id_asignatura='$id_asignatura'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('asignatura actualizado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al actualizar el asignatura: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar
        $sql = "DELETE FROM asignaturas WHERE id_asignatura='$id_asignatura'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('asignatura eliminado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al eliminar el asignatura: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['editar'])) {
        // Obtener datos del asignatura para editar
        $sql = "SELECT * FROM asignaturas WHERE id_asignatura='$id_asignatura'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $edit = $result->fetch_assoc();
        }
    }
}

// Obtener asignaturas
$sql = "SELECT * FROM asignaturas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de asignaturas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

 <!-- Barra de navegación -->
 <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo">SGA 0.02</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="../php/admin_dashboard.php">Inicio</a></li>
            </ul>
        </div>
    </nav>

<div class="container">
    <h1>Gestión de asignaturas</h1>

    <form action="" method="POST">
        <div class="input-field">
            <input type="number" name="id_asignatura" required value="<?php echo $edit ? $edit['id_asignatura'] : ''; ?>">
            <label>ID asignatura</label>
        </div>
        <div class="input-field">
            <input type="text" name="nombre" required value="<?php echo $edit ? $edit['nombre'] : ''; ?>">
            <label>Nombre</label>
        </div>
        <div class="input-field">
            <input type="text" name="Id_profesor" required value="<?php echo $edit ? $edit['Id_profesor'] : ''; ?>">
            <label>Id_profesor</label>
        </div>
        
        <button type="submit" name="<?php echo $edit ? 'actualizar' : 'crear'; ?>" class="btn">
            <?php echo $edit ? 'Actualizar' : 'Crear'; ?>
        </button>
    </form>

    <h2>Lista de asignaturas</h2>
    <table class="striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Id_profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_asignatura']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['Id_profesor']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_asignatura" value="<?php echo $row['id_asignatura']; ?>">
                                <button type="submit" name="eliminar" class="btn red">Eliminar</button>
                            </form>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_asignatura" value="<?php echo $row['id_asignatura']; ?>">
                                <button type="submit" name="editar" class="btn blue">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay asignaturas registrados.</td>
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
