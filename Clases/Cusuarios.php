<?php
    require_once("Cconecta.php");
	class Cusuarios extends Cconecta{
		public $idUsuario;
		public $nombreUsuario;
		public $password;
		public $accessLevel;
		
		public function insert(){
            return $this->queryExceute("INSERT INTO `usuarios` (`nombreUsuario`, `password`, `accessLevel`) VALUES ('$this->nombreUsuario', '$this->password', '$this->accessLevel')");
		}

		public function delete(){
            return $this->queryExceute("DELETE FROM usuarios WHERE `usuarios`.`idUsuario` = $this->idUsuario");
		}
		
		public function update(){
            return $this->queryExceute("UPDATE `usuarios` SET `idUsuario` = '$this->idUsuario', `nombreUsuario` = '$this->nombreUsuario', `password` = '$this->password', `accessLevel` = '$this->accessLevel' WHERE `usuarios`.`idUsuario` = $this->idUsuario;");
		}

		public function selectAll(){
			$query = $this->queryExceute("SELECT * FROM `usuarios`");
            return $query?mysqli_fetch_assoc($query):false;
		}

		public function selectById($id){
			$query = $this->queryExceute("SELECT * FROM `usuarios` WHERE idUsuario = $id");
			$this->setThis($query);
            return $query;
		}

		private function setThis($query){
			if($query){
				$temp = mysqli_fetch_assoc($query);
				$this->idUsuario	    = $temp["idUsuario"];
				$this->nombreUsuario    = $temp["nombreUsuario"];
				$this->password	        = $temp["password"];
				$this->accessLevel	    = $temp["accessLevel"];
			}
            return $query;
		}
        
        
	}
?>