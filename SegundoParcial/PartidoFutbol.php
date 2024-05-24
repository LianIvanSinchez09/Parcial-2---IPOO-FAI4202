<?php



class PartidoFutbol extends Partido {
    private $coefBase;
    function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->coefBase = 0.5;
    }
    public function getCoefBase() {
      return $this->coefBase;
    }
    public function setCoefBase($value) {
      $this->coefBase = $value;
    }

    public function coeficientePartido(){
        $coefMenores = 0.13;
        $coefJuveniles = 0.19;
        $coefMayores = 0.27;
        $coef = parent::coeficientePartido();
        switch ($this->getObjEquipo1()->getObjCategoria()->getDescripcion()) {
          case "Menores":
            $coef += $coefMenores;
            break;
          case "Mayores":
            $coef += $coefMayores;
          default:
            $coef += $coefJuveniles;
          break;
        }
        return $coef;
    }
}
