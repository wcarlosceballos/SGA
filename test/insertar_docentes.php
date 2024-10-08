<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=gestion_notas', 'root', '');

// profesores a agregar (con correo)
$profesores = [
    ['nombre' => 'Carlos', 'apellido' => 'Gómez', 'especialidad' => 'Matemáticas', 'correo' => 'carlos.gomez@ejemplo.com'],
    ['nombre' => 'María', 'apellido' => 'Pérez', 'especialidad' => 'Lengua Castellana', 'correo' => 'maria.perez@ejemplo.com'],
    ['nombre' => 'Juan', 'apellido' => 'Martínez', 'especialidad' => 'Ciencias Naturales', 'correo' => 'juan.martinez@ejemplo.com'],
    ['nombre' => 'Ana', 'apellido' => 'Rodríguez', 'especialidad' => 'Ciencias Sociales', 'correo' => 'ana.rodriguez@ejemplo.com'],
    ['nombre' => 'Pedro', 'apellido' => 'López', 'especialidad' => 'Educación Física', 'correo' => 'pedro.lopez@ejemplo.com'],
    ['nombre' => 'Luisa', 'apellido' => 'Fernández', 'especialidad' => 'Arte', 'correo' => 'luisa.fernandez@ejemplo.com'],
    ['nombre' => 'Marta', 'apellido' => 'García', 'especialidad' => 'Inglés', 'correo' => 'marta.garcia@ejemplo.com'],
    ['nombre' => 'Diego', 'apellido' => 'Torres', 'especialidad' => 'Filosofía', 'correo' => 'diego.torres@ejemplo.com'],
    ['nombre' => 'Sofía', 'apellido' => 'Sánchez', 'especialidad' => 'Informática', 'correo' => 'sofia.sanchez@ejemplo.com']
];

// Preparar la consulta para insertar profesores
$sql = "INSERT INTO profesores (nombre, apellido, especialidad, correo) VALUES (:nombre, :apellido, :especialidad, :correo)";
$stmt = $pdo->prepare($sql);

// Insertar cada docente
foreach ($profesores as $docente) {
    $stmt->execute([
        ':nombre' => $docente['nombre'],
        ':apellido' => $docente['apellido'],
        ':especialidad' => $docente['especialidad'],
        ':correo' => $docente['correo']
    ]);
}

echo "profesores agregados correctamente.";
?>
