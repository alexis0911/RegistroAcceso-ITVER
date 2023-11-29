<?php
    require_once("Cconecta.php");
	class Calumno extends Cconecta{
		public $idAlumno;
		public $nControl;
		public $nombre;
		public $rfid;
		public $carrera;
		public $semestre;
		public $sexo;
		
		public function insert(){
            return $this->queryExceute("INSERT INTO `alumno` (`nControl`, `nombre`, `rfid`, `carrera`, `semestre`, `sexo`) VALUES ( '$this->nControl', '$this->nombre', '$this->rfid', '$this->carrera', '$this->semestre', '$this->sexo')");
		}

		public function delete(){
            return $this->queryExceute("DELETE FROM alumno WHERE `alumno`.`idAlumno` = $this->idAlumno");
		}
		
		public function update(){
            return $this->queryExceute("UPDATE `alumno` SET `idAlumno` = '$this->idAlumno', `nControl` = '$this->nControl', `nombre` = '$this->nombre', `rfid` = '$this->rfid', `carrera` = '$this->carrera', `semestre` = '$this->semestre', `sexo` = '$this->sexo' WHERE `alumno`.`idAlumno` = $this->idAlumno");
		}

		public function selectAll(){
			$query = $this->queryExceute("SELECT * FROM `alumno`");
            return $query?mysqli_fetch_assoc($query):false;
		}

		public function selectById($id){
			$query = $this->queryExceute("SELECT * FROM `alumno` WHERE idAlumno = $id");
			if($query){
				$temp = mysqli_fetch_assoc($query);
				$this->idAlumno			= $temp["idAlumno"];
				$this->nControl			= $temp["nControl"];
				$this->nombre			= $temp["nombre"];
				$this->rfid				= $temp["rfid"];
				$this->carrera			= $temp["carrera"];
				$this->semestre			= $temp["semestre"];
				$this->sexo				= $temp["sexo"];
			}
            return $query;
		}
	}
?>