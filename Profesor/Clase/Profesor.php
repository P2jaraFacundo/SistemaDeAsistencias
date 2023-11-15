<?php 

require_once('../../ConexionBD/Conexion.php');

    class Profesor {
    
        public $dni;
        public $nombre;
        public $apellido;
        public $fechaDeNacimiento;
    
        public static function darDeAlta($dni, $nombre, $apellido, $fechaDeNacimiento) {
            
            $conexionBD = new ConexionBD();
            $conexion = $conexionBD->getConexion();
            
            $sql = "INSERT INTO profesores (dni, nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?, ?)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssss", $dni, $nombre, $apellido, $fechaDeNacimiento);
        
            if ($stmt->execute()) {
                // Cambio en esta línea, retorna true en caso de éxito
                return true;
            } else {
                // Cambio en esta línea, retorna un mensaje de error en caso de fallo
                return "Error al registrar: " . $stmt->error;
            }
        
            $stmt->close();
            $conexionBD->getConexion()->close();
        }
        
        
        
        
        
        public static function darDeBaja($dni) {
            $conexionBD = new ConexionBD();
            $conexion = $conexionBD->getConexion();
            
            $sql = "DELETE FROM profesores WHERE dni = ?";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $dni);
        
            if ($stmt->execute()) {
                // Mostrar mensaje de éxito
                echo "Eliminación exitosa";
            } else {
                echo "Error al eliminar al profesor: " . $stmt->error;
            }
        
            $stmt->close();
            $conexionBD->getConexion()->close();
        }
        
        
        
        
        public static function modificarProfesor($dni, $nuevoNombre, $nuevoApellido, $nuevaFechaDeNacimiento) {
            $conexionBD = new ConexionBD();
            $conexion = $conexionBD->getConexion();
            
            $sql = "UPDATE profesores SET nombre = ?, apellido = ?, fecha_nacimiento = ? WHERE dni = ?";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssss", $nuevoNombre, $nuevoApellido, $nuevaFechaDeNacimiento, $dni);
        
            if ($stmt->execute()) {
                // Cambio en esta línea, retorna true en caso de éxito
                return true;
            } else {
                // Cambio en esta línea, retorna un mensaje de error en caso de fallo
                return "Error al registrar: " . $stmt->error;
            }
        
            $stmt->close();
            $conexionBD->getConexion()->close();
        }
    }


?>