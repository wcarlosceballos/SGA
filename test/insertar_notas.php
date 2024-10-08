<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=gestion_notas', 'root', '');

// Obtener todos los estudiantes
$estudiantesStmt = $pdo->query("SELECT id_estudiante FROM estudiantes");
$estudiantes = $estudiantesStmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las asignaturas
$asignaturasStmt = $pdo->query("SELECT id_asignatura, id_profesor FROM asignaturas");
$asignaturas = $asignaturasStmt->fetchAll(PDO::FETCH_ASSOC);

// Definir los periodos
$periodos = [1, 2, 3, 4]; // Los cuatro periodos académicos

// Preparar la consulta para insertar notas
$sql = "INSERT INTO notas (id_estudiante, id_asignatura, id_profesor, periodo, nota) VALUES (:id_estudiante, :id_asignatura, :id_profesor, :periodo, :nota)";
$stmt = $pdo->prepare($sql);

// Asignar notas aleatorias
foreach ($estudiantes as $estudiante) {
    foreach ($asignaturas as $asignatura) {
        foreach ($periodos as $periodo) {
            $nota = rand(1, 5); // Generar una nota aleatoria entre 1 y 5

            // Verifica que id_profesor no sea nulo
            if ($asignatura['id_profesor'] !== null) {
                $stmt->execute([
                    ':id_estudiante' => $estudiante['id_estudiante'],
                    ':id_asignatura' => $asignatura['id_asignatura'],
                    ':id_profesor' => $asignatura['id_profesor'], // Usar el id_profesor de la asignatura
                    ':periodo' => $periodo,
                    ':nota' => $nota
                ]);
            } else {
                echo "El id_profesor es nulo para la asignatura con id: " . $asignatura['id_asignatura'] . "\n";
            }
        }
    }
}

echo "Notas aleatorias asignadas correctamente para todos los periodos con el profesor correspondiente.";
?>
