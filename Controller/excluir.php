<?php 
  $arq = "excluir";
  include 'BDManager.php';
  //recebendo os dados
  $infoLista = json_decode($_POST['data']);
  $id = $infoLista->idUser;
  //setando os dados na class
  $manager = new BDManager("", "", "", "", "");
  $manager->deleteInMysql($id);
?>