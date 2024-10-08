<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=gestion_notas', 'root', '');

// Asignaturas
$asignaturas = [
    'Matemáticas',
    'Lengua Castellana',
    'Ciencias Naturales',
    'Ciencias Sociales',
    'Educación Física',
    'Arte',
    'Inglés',
    'Filosofía',
    'Informática'
];

// Preparar la consulta para insertar asignaturas
$sql = "INSERT INTO asignaturas (nombre) VALUES (:nombre)";
$stmt = $pdo->prepare($sql);

// Insertar cada asignatura
foreach ($asignaturas as $nombre) {
    $stmt->execute([':nombre' => $nombre]);
}

echo "Asignaturas agregadas correctamente.";
?>
