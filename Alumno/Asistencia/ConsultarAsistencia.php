<?php

// Incluir el archivo de conexión a la base de datos
require_once '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar la fecha de asistencia del formulario
    $fechaAsistencia = $_POST['fecha_asistencia'];

    // Conexión a la base de datos
    $conexionBD = new ConexionBD();
    $conn = $conexionBD->getConexion();

    // Verificar la conexión
    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Error de conexión a la base de datos"]);
        exit();
    }

    // Consulta de asistencias para la fecha especificada
    $sql = "SELECT dni_alumno FROM asistencias WHERE fecha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fechaAsistencia);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Al menos una asistencia encontrada, recuperar los DNI
        $stmt->bind_result($dniAlumno);

        $asistencias = [];
        while ($stmt->fetch()) {
            // Ahora, por cada DNI, consulta el nombre y apellido correspondiente
            $sqlNombre = "SELECT nombre, apellido FROM alumnos WHERE dni = ?";
            $stmtNombre = $conn->prepare($sqlNombre);
            $stmtNombre->bind_param("s", $dniAlumno);
            $stmtNombre->execute();
            $stmtNombre->store_result();

            if ($stmtNombre->num_rows > 0) {
                $stmtNombre->bind_result($nombreAlumno, $apellidoAlumno);
                $stmtNombre->fetch();

                // Agregar el nombre y apellido a la lista de asistencias
                $asistencias[] = ["nombre" => $nombreAlumno, "apellido" => $apellidoAlumno];
            } else {
                // Manejar el caso en el que no se encuentra el nombre correspondiente
                $asistencias[] = ["nombre" => "Nombre no encontrado", "apellido" => "Apellido no encontrado"];
            }

            $stmtNombre->close();
        }

        // Enviar la respuesta JSON con los datos de asistencias
        echo json_encode(["success" => true, "data" => $asistencias]);
    } else {
        echo json_encode(["success" => true, "data" => []]); // No hay asistencias
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
