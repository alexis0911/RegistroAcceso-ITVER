<?php
    require_once("Cconecta.php");
	class Cuso extends Cconecta{
		public $idUso;
		public $Alumno_idAlumno;
		public $Salon_idSalon;
		public $Usuario_idUsuario;
		public $dia;
		public $horaEntrada;
		
		public function insert(){
            return $this->queryExceute("INSERT INTO `uso` (`Alumno_idAlumno`, `Salon_idSalon`, `Usuario_idUsuario`, `dia`, `horaEntrada`) VALUES ($this->Alumno_idAlumno, $this->Salon_idSalon, $this->Usuario_idUsuario, '$this->dia', '$this->horaEntrada')");
		}

		public function delete(){
            return $this->queryExceute("DELETE FROM uso WHERE `uso`.`idUso` = $this->idUso");
		}
		
		public function update(){
            return $this->queryExceute("UPDATE `uso` SET `idUso` = '$this->idUso', `Alumno_idAlumno` = '$this->Alumno_idAlumno', `Salon_idSalon` = '$this->Salon_idSalon', `Usuario_idUsuario` = '$this->Usuario_idUsuario', `dia` = '$this->dia', `horaEntrada` = '$this->horaEntrada' WHERE `uso`.`idUso` = $this->idUso");
		}

		public function selectAll(){
			$query = $this->queryExceute("SELECT * FROM `uso`");
            return $query?mysqli_fetch_assoc($query):false;
		}

		public function selectById($id){
			$query = $this->queryExceute("SELECT * FROM `uso` WHERE idUso = $id");
			$this->setThis($query);
            return $query;
		}
		
		private function setThis($query){
			if($query){
				$temp = mysqli_fetch_assoc($query);
				$this->idUso			    = $temp["idUso"];
				$this->Alumno_idAlumno	    = $temp["Alumno_idAlumno"];
				$this->Salon_idSalon	    = $temp["Salon_idSalon"];
				$this->Usuario_idUsuario	= $temp["Usuario_idUsuario"];
				$this->dia		    	    = $temp["dia"];
				$this->horaEntrada		    = $temp["horaEntrada"];
			}
            return $query;
		}
        
	}
?>