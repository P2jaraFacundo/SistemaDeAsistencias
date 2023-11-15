<?php

class calculo {
    public $porcentaje;
    public $nota1;
    public $nota2;

    public function __construct($porcentaje, $nota1, $nota2) {  
        $this->porcentaje = $porcentaje;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
    }

    public function calcular() {
        $promedio = ($this->nota1 + $this->nota2) / 2;
        $resultado = "";

        if ($this->porcentaje >= 80 && $promedio > 8) {
            $resultado = "<br> Condicion: PROMOCION ";
        } elseif ($this->porcentaje <= 80 && $this->porcentaje > 50 && $promedio > 6) {
            $resultado = "<br> Condicion: REGULAR ";
        } elseif ($this->porcentaje < 50 || $promedio < 6) {
            $resultado = "<br> Condicion: LIBRE ";
        }

        return $resultado;
    }
}

?>
