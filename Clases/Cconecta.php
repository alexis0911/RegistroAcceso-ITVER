<?php
  class Cconecta{
    private $host;
    private $user;
    private $pw;
    private $nombreBD;
    
    protected $db;
    
    function __construct(){
        $this->host="localhost";
        $this->user="root";
        $this->pw="admin";
        $this->nombreBD="registro";
    }
    protected function conexion(){
        if($this->db= mysqli_connect($this->host, $this->user, $this->pw)){
            if(mysqli_select_db($this->db, $this->nombreBD)){
                return $this->db;
            }
            echo('<script language="javascript">alert("'.'Base de datos inexistente'.'");</script>');
        }
        die('<script language="javascript">alert("'.'No hay conexión'.'");</script>');
    }
    protected function queryExceute($SQLQuery){
      $temp=mysqli_query($this->conexion(), $SQLQuery);
      $this->db->close();
      return $temp;
    }
    protected function conexionUsuario($user,$pw){
      return mysqli_connect($this->host, $user, $pw);
      die('<script language="javascript">alert("'.'No hay conexión'.'");</script>');
    }
  }
?>