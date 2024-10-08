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
$id_profesor = $nombre = $apellido = $especialidad = $correo = "";
$edit = false;

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la existencia del ID
    if (isset($_POST['id_profesor'])) {
        $id_profesor = $_POST['id_profesor'];
    }

    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        
    if (isset($_POST['especialidad'])) {
        $especialidad = $_POST['especialidad'];
    } else {
        $especialidad = ''; // O maneja el error como consideres
    }
    
        $correo = $_POST['correo'];

        // Verificar duplicidad de ID
        $checkQuery = "SELECT * FROM profesores WHERE id_profesor = '$id_profesor'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('El ID del profesor ya existe.');</script>";
        } else {
            // Crear
            $sql = "INSERT INTO profesores (id_profesor, nombre, apellido, especialidad, correo) VALUES ('$id_profesor', '$nombre', '$apellido', '$especialidad', '$correo')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('profesor creado exitosamente.');</script>";
            } else {
                echo "<script>alert('Error al crear el profesor: " . $conn->error . "');</script>";
            }
        }
    } elseif (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        
    if (isset($_POST['especialidad'])) {
        $especialidad = $_POST['especialidad'];
    } else {
        $especialidad = ''; // O maneja el error como consideres
    }
    
        $correo = $_POST['correo'];

        // Actualizar
        $sql = "UPDATE profesores SET nombre='$nombre', apellido='$apellido', especialidad='$especialidad', correo='$correo' WHERE id_profesor='$id_profesor'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('profesor actualizado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al actualizar el profesor: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['eliminar'])) {
        // Eliminar
        $sql = "DELETE FROM profesores WHERE id_profesor='$id_profesor'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('profesor eliminado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al eliminar el profesor: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['editar'])) {
        // Obtener datos del profesor para editar
        $sql = "SELECT * FROM profesores WHERE id_profesor='$id_profesor'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $edit = $result->fetch_assoc();
        }
    }
}

// Obtener profesor
$sql = "SELECT * FROM profesores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de profesor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

<nav>
    <div class="nav-wrapper blue">
        <a href="#" class="brand-logo">SGA 0.01</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="admin_dashboard.php">Inicio</a></li> 
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Gestión de profesor</h1>

    <form action="" method="POST">
        <div class="input-field">
            <input type="number" name="id_profesor" required value="<?php echo $edit ? $edit['id_profesor'] : ''; ?>">
            <label>ID profesor</label>
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
          <select name="especialidad" required>
         <option value="" disabled <?php echo !$edit ? 'selected' : ''; ?>>Seleccionar especialidad</option>
        <?php
        // Array de especialidads básicas de primaria y bachillerato
            $especialidad = [
            'Matemáticas',
            'Español',
            'Ciencias Naturales',
            'Ciencias Sociales',
            'Inglés',
            'Educación Física',
            'Religión',
            'Arte',
            'Tecnología e Informática',
            'Filosofía' // Puedes agregar más especialidads si es necesario
            ];

             // Iterar sobre las especialidad para crear las opciones
               foreach ($especialidad as $index => $especialidad): ?>
             <option value="<?php echo $index + 1; ?>" <?php echo $edit && $edit['especialidad'] == ($index + 1) ? 'selected' : ''; ?>>
                <?php echo $especialidad; ?>
            </option>
        <?php endforeach; ?>
             </select>
             <label>Especialidad</label>
         </div>

        <div class="input-field">
            <input type="email" name="correo" required value="<?php echo $edit ? $edit['correo'] : ''; ?>">
            <label>Correo Electrónico</label>
        </div>
        <button type="submit" name="<?php echo $edit ? 'actualizar' : 'crear'; ?>" class="btn">
            <?php echo $edit ? 'Actualizar' : 'Crear'; ?>
        </button>
    </form>

    <h2>Lista de profesor</h2>
    <table class="striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>especialidad</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_profesor']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['especialidad']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_profesor" value="<?php echo $row['id_profesor']; ?>">
                                <button type="submit" name="eliminar" class="btn red">Eliminar</button>
                            </form>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="id_profesor" value="<?php echo $row['id_profesor']; ?>">
                                <button type="submit" name="editar" class="btn blue">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay profesor registrados.</td>
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
