<?php

class ConexionBD {
    private $servername = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $database = 'sistemaasistenciasdb';
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->database);
        
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>
