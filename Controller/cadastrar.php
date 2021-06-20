<?php 
  $arq = "cadastrar";
  include 'BDManager.php';
  //recebendo os dados
  $infoForm = json_decode($_POST['data']);
  $nome = $infoForm->nome;
  $sobrenome = $infoForm->sobrenome;
  $senha = $infoForm->senha;
  $telefone = $infoForm->telefone;
  $email = $infoForm->email;
  //setando os dados na class
  $manager = new BDManager($nome, $sobrenome, $telefone, $senha, $email);

  $mgInsert = $manager->infoInsertValidate() ?  $mgInsert = "Existe" : $mgInsert = inserir();
  
  echo $mgInsert;

  function inserir(){
    global $manager;
    //validar e chamar método de inserir
    $msg = $manager->insertInMysql() ? $msg = "Inserido" : $msg = "Erro ao inserir";
    return $msg;
  }
?>