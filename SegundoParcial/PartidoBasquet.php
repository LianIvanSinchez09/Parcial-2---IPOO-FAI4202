<?php

include_once "Equipo.php";




class PartidoBasquet extends Partido {
    private $coefPenalizacion;
    private $cantInfracciones;
    public function __construct($idpartido, $fecha, $equipo1, $equipo2, $golesEQ1, $golesEQ2, $cantInfracciones) {
      parent::__construct($idpartido, $fecha, $equipo1, $golesEQ1, $equipo2, $golesEQ2);
      $this->cantInfracciones = $cantInfracciones;
      $this->coefPenalizacion = 0.75;
    }
    public function getCantInfracciones() {
      return $this->cantInfracciones;
    }
    public function setCantInfracciones($value) {
      $this->cantInfracciones = $value;
    }
    public function getCoefPenalizacion() {
      return $this->coefPenalizacion;
    }
    public function setCoefPenalizacion($value) {
      $this->coefPenalizacion = $value;
    }
    public function coeficientePartido(){
      $coef = parent::coeficientePartido();
      return $coef - ($this->getCoefPenalizacion()*$this->getCantInfracciones());
  }
}