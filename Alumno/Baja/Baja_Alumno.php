<?php
require_once "../Clase/Alumno.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el DNI del alumno desde el formulario
    $dni = $_POST['dni'];

    // Llama a la función estática en la clase Alumno para dar de baja al alumno
    $result = Alumno::darDeBaja($dni);

    if ($result) {
        // La operación fue exitosa
        header("Location: /Boostrap/PanelDeControl.php?success=1");
        exit();
    } else {
        echo "Error al dar de baja al alumno.";
    }

}



?>
