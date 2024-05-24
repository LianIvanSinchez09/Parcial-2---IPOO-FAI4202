<?php



class Torneo {
    private $colPartidos;
    private $importePremio;

    function __construct($colPartidos, $importePremio) {
    	$this->colPartidos = $colPartidos;
    	$this->importePremio = $importePremio;
    }

    public function getColPartidos() {
      return $this->colPartidos;
    }
    public function setColPartidos($value) {
      $this->colPartidos[] = $value;
    }

    public function getImportePremio() {
      return $this->importePremio;
    }
    public function setImportePremio($value) {
      $this->importePremio = $value;
    }

    public function ingresarPartido( Equipo $OBJEquipo1, Equipo $OBJEquipo2, $fecha, $tipoPartido){
      $partidoNuevo = null;
      if($tipoPartido == "Basquet" && $OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores() && $OBJEquipo1->getObjCategoria() == $OBJEquipo2->getObjCategoria()){
        $partidoNuevo = new PartidoBasquet(count($this->getColPartidos()), $fecha, $OBJEquipo1, $OBJEquipo2, 0, 0, 0);
        $this->setColPartidos($partidoNuevo);
      }elseif ($tipoPartido == "Futbol" && $OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores() && $OBJEquipo1->getObjCategoria() == $OBJEquipo2->getObjCategoria()) {
        $partidoNuevo = new PartidoFutbol(1, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
        $this->setColPartidos($partidoNuevo);
      }
      return $partidoNuevo;
    }

    public function buscarPorDeporte($deporte){
      $partidosDeporte = [];
      if($deporte == "PartidoBasquet"){
        foreach ($this->getColPartidos() as $partido) {
            if($partido instanceof $deporte){
              $partidosDeporte[] = $partido;
            }
        }
      }
      else{
        foreach ($this->getColPartidos() as $partido) {
          if($partido instanceof PartidoFutbol){
            $partidosDeporte[] = $partido;
          }
        }
      }
      return $partidosDeporte;
    }

    public function darGanadores($deporte){
      $equiposGanadores = [];
      $partidos = $this->buscarPorDeporte($deporte);
      foreach ($partidos as $partido) {
        if($partido->getCantGolesE1() > $partido->getCantGolesE2()){
            $equiposGanadores[] = $partido->getObjEquipo1();
        }else{
          $equiposGanadores[] = $partido->getObjEquipo2();
        }
      }
      return $equiposGanadores;
    }

    public function calcularPremioPartido($objPartido){
      //(premioPartido = Coef_partido * ImportePremio)
      $equipoGanador = $objPartido->darEquipoGanador();
      $importeTotal = $objPartido->coeficientePartido() * $this->getImportePremio();
      return ["equipoGanador" => $equipoGanador, "premioPartido" => $importeTotal];
    }


    public function __toString()
    {
        foreach ($this->getColPartidos() as $partido) {
            echo $partido;
        }
        return "Importe Premio: " . $this->getImportePremio();
    }
}