<?php
    require_once("Cconecta.php");
	class Csalon extends Cconecta{
		public $idSalon;
		public $identificador;
		public $piso;
		public $categoria;
		public $capacidadUso;
		public $climas;
		public $horaApertura;
		public $horaCierre;
		public $Ubicacion_idUbicacion;
		
		public function insert(){
            return $this->queryExceute("INSERT INTO `salon` (`identificador`, `piso`, `categoria`, `capacidadUso`, `climas`, `horaApertura`, `horaCierre`, `Ubicacion_idUbicacion`) VALUES ('$this->identificador', '$this->piso', '$this->categoria', '$this->capacidadUso', '$this->climas', '$this->horaApertura', '$this->horaCierre', '$this->Ubicacion_idUbicacion')");
		}

		public function delete(){
            return $this->queryExceute("DELETE FROM salon WHERE `salon`.`idSalon` = $this->idSalon");
		}
		
		public function update(){
            return $this->queryExceute("UPDATE `salon` SET `idSalon` = '$this->idSalon', `identificador` = '$this->identificador', `piso` = '$this->piso', `categoria` = '$this->categoria', `capacidadUso` = '$this->capacidadUso', `climas` = $this->climas, `horaApertura` = '$this->horaApertura', `horaCierre` = '$this->horaCierre', `Ubicacion_idUbicacion` = '$this->Ubicacion_idUbicacion' WHERE `salon`.`idSalon` = $this->idSalon");
		}

		public function selectAll(){
			$query = $this->queryExceute("SELECT * FROM `salon`");
            return if($query)?mysqli_fetch_assoc($query):false;
		}

		public function selectById($id){
			$query = $this->queryExceute("SELECT * FROM `salon` WHERE idSalon = $id");
			$this->setThis($query);
            return $query;
		}

		private function setThis($query){
			if($query){
				$temp = mysqli_fetch_assoc($query);
				$this->idSalon			        = $temp["idSalon"];
				$this->identificador	        = $temp["identificador"];
				$this->piso		    	        = $temp["piso"];
				$this->categoria		        = $temp["categoria"];
				$this->capacidadUso		        = $temp["capacidadUso"];
				$this->climas                   = $temp["climas"];
				$this->horaApertura		        = $temp["horaApertura"];
				$this->horaCierre		        = $temp["horaCierre"];
				$this->Ubicacion_idUbicacion	= $temp["Ubicacion_idUbicacion"];
			}
            return $query;
		}

	}
?>