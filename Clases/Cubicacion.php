<?php
    require_once("Cconecta.php");
	class Cubicacion extends Cconecta{
		public $idUbicacion;
		public $nombreUbicacion;
		public $pisos;
		public $descripcion;
		
		public function insert(){
            return $this->queryExceute("INSERT INTO `ubicacion` (`nombreUbicacion`, `pisos`, `descripcion`) VALUES ('$this->nombreUbicacion', '$this->pisos', '$this->descripcion')");
		}

		public function delete(){
            return $this->queryExceute("DELETE FROM ubicacion WHERE `ubicacion`.`idUbicacion` = $this->idUbicacion");
		}
		
		public function update(){
            return $this->queryExceute("UPDATE `ubicacion` SET `idUbicacion` = '$this->idUbicacion', `nombreUbicacion` = '$this->nombreUbicacion', `pisos` = '$this->pisos', `descripcion` = '$this->descripcion' WHERE `ubicacion`.`idUbicacion` = $this->idUbicacion");
		}

		public function selectAll(){
			$query = $this->queryExceute("SELECT * FROM `ubicacion`");
            return $query?mysqli_fetch_assoc($query):false;
		}

		public function selectById($id){
			$query = $this->queryExceute("SELECT * FROM `ubicacion` WHERE idUbicacion = $id");
			$this->setThis($query);
            return $query;
		}

		private function setThis($query){
			if($query){
				$temp = mysqli_fetch_assoc($query);
				$this->idUbicacion			= $temp["idUbicacion"];
				$this->nombreUbicacion		= $temp["nombreUbicacion"];
				$this->pisos			    = $temp["pisos"];
				$this->descripcion			= $temp["descripcion"];
			}
            return $query;
		}

	}
?>