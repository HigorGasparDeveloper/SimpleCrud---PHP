<?php 
  $arq = "logar";
  include 'BDManager.php';
  //recebendo os dados
  $infoForm = json_decode($_POST['data']);
  $email = $infoForm->email;
  $senha = $infoForm->senha;
  //setando os dados na class
  $manager = new BDManager(" ", " ", " ", $senha, $email);

  $mgLogin = $manager->logInAccount() ? $mgLogin = "Existe" : $mgLogin = "Erro";

  echo $mgLogin;
?>