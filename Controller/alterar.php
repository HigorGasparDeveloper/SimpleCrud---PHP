<?php 
  $arq = "cadastrar";
  include 'BDManager.php';
  //recebendo os dados
  $infoForm = json_decode($_POST['data']);
  $id = $infoForm->idUser;
  $nome = $infoForm->nomeUser;
  $senha = $infoForm->senhaNovaUser;
  //$senhaAntiga = $infoForm->senhaAntigaUser;
  $telefone = $infoForm->telefoneUser;
  $email = $infoForm->emailUser;
  //setando os dados na class
  $manager = new BDManager($nome, "", $telefone, $senha, $email);
  
  $mgUpdate = $manager->updateInMysql($id) ? "sucesso" : "erro";

  echo $mgUpdate;
?>