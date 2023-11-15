<?php
require_once '../Clase/Profesor.php';

header('Content-Type: application/json'); // Indicar que la respuesta será en formato JSON

function sendResponse($status, $message) {
    echo json_encode(["success" => $status, "message" => $message]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $dni = $_POST['dni'];
    $nuevoNombre = $_POST['nombre'];
    $nuevoApellido = $_POST['apellido'];
    $nuevaFechaDeNacimiento = $_POST['fecha_nacimiento'];

    // Validación del DNI
    if (!preg_match('/^\d{8}$/', $dni)) {
        sendResponse(false, "El DNI debe contener exactamente 8 dígitos.");
    }

    // Validación de la fecha de nacimiento
    $fechaNacimiento = strtotime($nuevaFechaDeNacimiento);
    $hoy = strtotime('now');
    $edad = floor(($hoy - $fechaNacimiento) / (365 * 60 * 60 * 24));

    if ($fechaNacimiento === false || $edad < 18 || $edad >= 90) {
        sendResponse(false, "La fecha de nacimiento no es válida");
    }

    // Conectar a la base de datos
    require_once '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php';
    $conexionBD = new ConexionBD();
    $conexion = $conexionBD->getConexion();

    // Consulta para verificar la existencia del profesor por su DNI
    $sql = "SELECT dni FROM profesores WHERE dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El profesor existe, llamar a la función estática en la clase profesor para modificarlo
        $result = Profesor::modificarProfesor($dni, $nuevoNombre, $nuevoApellido, $nuevaFechaDeNacimiento);

        if ($result === true) {
            sendResponse(true, "Profesor modificado exitosamente.");
        } else {
            sendResponse(false, "Error al modificar el profesor: " . $result);
        }
    } else {
        sendResponse(false, "El profesor con el documento $dni no existe en la base de datos. No se puede modificar.");
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>
