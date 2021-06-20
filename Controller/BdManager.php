<?php 
  if($arq != "listar"){
    include '../Model/Conexao.php';
    include '../Model/Usuario.php';
  }
  class BDManager{
    public $conexao, $user;
    public function __construct($nome, $sobrenome, $telefone, $senha, $email){
      $this->conexao = new Connection();
      $this->user = new User($nome, $sobrenome, $telefone, $senha, $email);
    }
    public function infoInsertValidate(){
      $email = $this->user->getEmail();
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "SELECT * FROM usuario WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        return true;
      }else{
        return false;
      }
    }
    public function insertInMysql(){
      $email = $this->user->getEmail();
      $nomeCompleto = $this->user->getNomeCompleto();
      $senha = $this->user->getSenha();
      $telefone = $this->user->getTelefone();
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "INSERT INTO usuario (nome, email, senha, telefone) 
      VALUES ('".$nomeCompleto."','".$email."','".$senha."','".$telefone."')";
      $result = mysqli_query($conn, $sql);
      if($result){
        return true;
      }else{
        return false;
      }
    }
    public function updateInMysql($id){
      //$nome, $email, $telefone, $senha
      $nome = $this->user->getNomeCompleto();
      $email = $this->user->getEmail();
      $senha = $this->user->getSenha();
      $telefone = $this->user->getTelefone();

      $this->conexao->startConect();
      $conn = $this->conexao->getConect();

      $sql = "UPDATE usuario SET email = '$email',senha = '$senha', nome = '$nome', telefone = '$telefone' WHERE id = $id";
      $result = mysqli_query($conn,$sql);
      if($result)
        return true;
      else
        return false;
    }
    public function deleteInMysql($id){
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "DELETE FROM usuario WHERE id = $id";
      $result = mysqli_query($conn,$sql);
    }
    public function logInAccount(){
      $email = $this->user->getEmail();
      $senha = $this->user->getSenha();
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "SELECT * FROM usuario WHERE email = '".$email."' AND senha = '".$senha."'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
        return true;
      }else{
        return false;
      }
    }
    public function listAll(){
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "SELECT * FROM usuario";
      $dados = mysqli_fetch_array(mysqli_query($conn,$sql));
      $result = mysqli_query($conn, $sql);
      $list = [];
      while($dados = mysqli_fetch_assoc($result)){
        array_push($list,$dados);
      }
      return $list;
    }
    public function searchInMysql(){
      $email = $this->user->getEmail();
      $this->conexao->startConect();
      $conn = $this->conexao->getConect();
      $sql = "SELECT * FROM usuario WHERE email like '%$email%'";
      $dados = mysqli_fetch_array(mysqli_query($conn, $sql));
      $result = mysqli_query($conn,$sql);
      $list = [];
      while($dados = mysqli_fetch_assoc($result)){
        array_push($list,$dados);
      }
      return $list;
    }
    public function listarOrder($order){
      
    }

  }
?>