<?php 
  class Connection{
    public $conn;
    public $host, $user, $pass, $bd;
    public function startConect(){
      $this->host = "localhost:3308";
      $this->user = "root";
      $this->pass = "";
      $this->bd = "testePDO";
      $this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->bd) or die(mysqli_error($this->conn));
    }
    public function getConect(){
      return $this->conn;
    }
  }
?>