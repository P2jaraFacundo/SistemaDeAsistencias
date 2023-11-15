<?php
require_once '../Clase/Alumno.php';

header('Content-Type: application/json'); // Indicar que la respuesta será en formato JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $dni = $_POST['dni'];
    $nuevoNombre = $_POST['nombre'];
    $nuevoApellido = $_POST['apellido'];
    $nuevaFechaDeNacimiento = $_POST['fecha_nacimiento'];

    // Validación de la fecha de nacimiento
    $fechaNacimiento = strtotime($nuevaFechaDeNacimiento);
    $hoy = strtotime('now');
    $edad = floor(($hoy - $fechaNacimiento) / (365*60*60*24));

    if ($fechaNacimiento === false || $edad < 18 || $edad >= 90) {
        echo json_encode(["success" => false, "message" => "La fecha de nacimiento no es válida, el alumno es menor de 18 años o mayor o igual a 90 años."]);
        exit();
    }

    // Conectar a la base de datos
    require_once '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php';
    $conexionBD = new ConexionBD();
    $conexion = $conexionBD->getConexion();

    // Consulta para verificar la existencia del alumno por su DNI
    $sql = "SELECT dni FROM alumnos WHERE dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El alumno existe, llamar a la función estática en la clase Alumno para modificarlo
        $result = Alumno::modificarAlumno($dni, $nuevoNombre, $nuevoApellido, $nuevaFechaDeNacimiento);

        if ($result) {
            // La operación fue exitosa
            echo json_encode(["success" => true, "message" => "Alumno modificado exitosamente."]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Error al modificar al alumno."]);
            exit();
        }
    }
}
?>