<?php
// Conexión a la base de datos (usando PDO)
$pdo = new PDO('mysql:host=localhost;dbname=gestion_notas', 'root', '');

// Arrays de nombres y apellidos aleatorios
$first_names = ['Juan', 'Carlos', 'Maria', 'Ana', 'Luis', 'Sofia', 'Pedro', 'Laura', 'Andres', 'Camila'];
$last_names = ['Gomez', 'Rodriguez', 'Martinez', 'Perez', 'Garcia', 'Lopez', 'Torres', 'Ramirez', 'Hernandez', 'Diaz'];

// Función para generar un nombre aleatorio
function random_name($first_names, $last_names) {
    $first_name = $first_names[array_rand($first_names)];
    $last_name = $last_names[array_rand($last_names)];
    return [$first_name, $last_name];
}

// Función para generar un correo electrónico de ejemplo
function random_email($first_name, $last_name) {
    $domain = ['gmail.com', 'yahoo.com', 'outlook.com']; // Dominios de ejemplo
    return strtolower($first_name . '.' . $last_name . '@' . $domain[array_rand($domain)]);
}

// Preparar la consulta para insertar estudiantes
$sql = "INSERT INTO estudiantes (nombre, apellido, grado, correo) VALUES (:nombre, :apellido, :grado, :correo)";
$stmt = $pdo->prepare($sql);

// Insertar 10 estudiantes por cada grado (de 1º a 11º)
for ($grado = 1; $grado <= 11; $grado++) {
    for ($i = 0; $i < 10; $i++) {
        list($first_name, $last_name) = random_name($first_names, $last_names);
        $email = random_email($first_name, $last_name);
        
        // Ejecutar la consulta para insertar cada estudiante
        $stmt->execute([
            ':nombre'   => $first_name,
            ':apellido' => $last_name,
            ':grado'    => $grado,
            ':correo'   => $email
        ]);
    }
}

echo "Estudiantes insertados correctamente.";
?>
