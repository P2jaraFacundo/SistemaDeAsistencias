<?php

require_once '../Clase/Profesor.php';

function sendResponse($status, $message) {
    echo json_encode(array('success' => $status, 'message' => $message));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fechaDeNacimiento = $_POST['fecha_nacimiento'];

    // Realiza las validaciones
    $errores = array();

    // Validación del DNI
    if (!preg_match('/^\d{8}$/', $dni)) {
        $errores[] = "El DNI debe contener exactamente 8 dígitos.";
    }

    // Validación de la fecha de nacimiento (asegúrate de que la fecha sea válida y que el profesor no sea menor de edad)
    $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $fechaDeNacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNacimiento)->y;

    if (!$fechaNacimiento || $edad < 18 || $edad >= 90) {
        $errores[] = "La fecha de nacimiento no es válida o el profesor es menor de edad.";
    }

    // Verifica si hay errores
    if (!empty($errores)) {
        // Hubo errores en los datos, muestra los mensajes de error
        sendResponse(false, $errores);
    } else {
        // No hubo errores, llama a la función estática en la clase Profesor para dar de alta al profesor
        $result = Profesor::darDeAlta($dni, $nombre, $apellido, $fechaDeNacimiento);

        if ($result) {
            // La operación fue exitosa
            sendResponse(true, "Profesor dado de alta exitosamente.");
        } else {
            sendResponse(false, "Error al dar de alta al profesor.");
        }
    }
}
?>
