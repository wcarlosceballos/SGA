<?php
session_start();
include 'db_connection.php'; // Ruta base de datos

// Manejo de errores
$error = '';
$success = '';

// Comprobar si hay un usuario en sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirigir al login si no hay sesión
    exit();
}

// Crear o editar usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_user'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']); // Obtener el rol
    $image = ''; // Imagen por defecto vacía

    // Validar datos
    if (empty($username) || empty($password) || empty($role)) {
        $error = 'Por favor, completa todos los campos.';
    } else {
        // Subir imagen si se ha seleccionado una
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "img/";
            $image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $image_name;
            } else {
                $error = 'Error al subir la imagen.';
            }
        }

        // Cifrar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $query = "INSERT INTO users (username, password, role, image, created_at) VALUES (:username, :password, :role, :image, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role); // Vincular el rol
        $stmt->bindParam(':image', $image); // Vincular la imagen

        if ($stmt->execute()) {
            $success = 'Usuario registrado exitosamente.';
        } else {
            $error = 'Error al registrar el usuario. Inténtalo nuevamente.';
        }
    }
}

// Eliminar usuario
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $delete_id);

    if ($stmt->execute()) {
        $success = 'Usuario eliminado exitosamente.';
    } else {
        $error = 'Error al eliminar el usuario.';
    }
}

// Obtener usuarios
$query = "SELECT * FROM users"; // Cambiado a 'users'
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <style>
        /* Estilo para los iconos */
        .action-icon {
            font-size: 1.5rem; /* Tamaño del icono */
            margin-right: 5px; /* Espaciado entre iconos */
        }
        /* Imagen en la tabla */
        .user-image {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    
    <nav>
        <div class="nav-wrapper blue">
            <a href="admin_dashboard.php" class="brand-logo">SGA 0.02</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="admin_dashboard.php">Inicio</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h4 class="center-align">Gestión de Usuarios</h4>
        
        <!-- Mensajes de error o éxito -->
        <?php if ($error): ?>
            <div class="card-panel red lighten-4 red-text text-darken-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="card-panel green lighten-4 green-text text-darken-4">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para crear usuario -->
        <form action="crear_usuario.php" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="text" id="username" name="username" required>
                <label for="username">Nombre de usuario</label>
            </div>

            <div class="input-field">
                <input type="password" id="password" name="password" required>
                <label for="password">Contraseña</label>
            </div>

            <div class="input-field">
                <select name="role" id="role" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <option value="Admin">Administrador</option>
                    <option value="Teacher">Docente</option>
                    <option value="Student">Estudiante</option>
                </select>
                <label for="role">Rol</label>
            </div>

            <!-- Campo de imagen -->
            <div class="file-field input-field">
                <div class="btn">
                    <span>Subir Imagen</span>
                    <input type="file" name="image" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Selecciona una imagen de perfil">
                </div>
            </div>

            <div class="input-field center-align">
                <button class="btn waves-effect waves-light" type="submit" name="create_user">Registrar Usuario</button>
            </div>
        </form>

        <!-- Lista de usuarios -->
        <h5>Usuarios Registrados</h5>
        <table class="highlight">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td>
                            <?php if ($user['image']): ?>
                                <img src="../img/<?php echo htmlspecialchars($user['image']); ?>" alt="Imagen" class="user-image">
                            <?php else: ?>
                                <img src="../img/1.png" alt="Imagen por defecto" class="user-image">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $user['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                <i class="material-icons action-icon">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Importar JavaScript de Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Inicializar el select
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>
</html>
