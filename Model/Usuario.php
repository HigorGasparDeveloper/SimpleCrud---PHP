<?php 
  class User{
    public $nome, $sobrenome, $telefone, $senha, $email, $nomeCompleto;

    public function __construct($nome, $sobrenome, $telefone, $senha, $email){
      $this->nome = trim($nome);
      $this->sobrenome = trim($sobrenome);
      $this->nomeCompleto = trim($nome)." ".trim($sobrenome);
      $this->telefone = trim($telefone);
      $this->email = trim($email);
      $this->senha = md5($senha);
    }
    public function getNomeCompleto(){
      return $this->nomeCompleto;
    }
    public function getTelefone(){
      return $this->telefone;
    }
    public function getSenha(){
      return $this->senha;
    }
    public function getEmail(){
      return $this->email;
    }
  }
?>