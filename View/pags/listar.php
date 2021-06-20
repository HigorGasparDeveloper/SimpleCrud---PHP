<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../assets/javascript/class/ManipularComponentes.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/shared/forAll.css">
    <link rel="stylesheet" href="../assets/css/responsive/mediaList.css">
    <title>Listar</title>
    <script>
      manipula = new ComponentsManager();
      manipula.returnListSearch();
    </script>
  </head>
  <body>
    <?php include("fragments/header.php"); ?>
    <center>
      <?php include("fragments/menu_resp.php") ?>
    </center>
    <main>
    <div class = "main-body">
        <div class="div-form" align = "center">
          <!-- <form action="" method="POST" id = "form" style="width: 100%; height: 100%"> -->
            <div class = "div div-top-form">
              <form id = "formList" action="../../Controller/pesquisar.php" method="POST" style="display: flex;height:100%; width:100%; justify-content:center;">
                <div class = "div-search">
                  <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquise pelo e-mail">
                  <button type="submit" class="btn btn-primary" name = "buscar" onclick ="pesquisar();" id = "buscar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                  </button>
                </div>
              </form>
              <form action="../../Controller/actionsTable.php" method="POST">
                <div class = "div-btns-topo">
                  <button type="submit" class = "btn btn-success" name = "excel" id = "excel">Excel</button>
                  <button type="submit" class = "btn btn-danger" name = "pdf" id = "pdf">Pdf</button>
                  <!-- <button type="submit" class = "btn btn-secondary" name = "imprimir" id = "imprimir">Imprimir</button> onclick="cont()" -->
                </div>
              </form>
            </div>
          <!-- </form> -->
          <div class = "div div-corpo-form table-responsive"><!-- id = "table-print" -->
            <!-- Montar a tabela -->
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th style="text-align: center;">..</th>
                  <th style="text-align: center;">..</th>
                </tr>
              </thead>
              <tbody id = "tbody">
                <?php 
                  $arq = "listar";
                  include("../../Controller/BdManager.php");
                  include '../../Model/Conexao.php';
                  include '../../Model/Usuario.php';
                  $manager = new BDManager("","","","","");
                  $users = $manager->listAll();
                  $_SESSION['arrayList'] = $users;
                  foreach($users as $user){
                    ?>
                      <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['nome'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['telefone'] ?></td>
                        <td align="center"><button class = "btn btn-warning" data-toggle="modal" data-target="#modalAlterar<?php echo $user['id'] ?>">Alterar</button></td>
                        <td align="center"><button class = "btn btn-danger" data-toggle = "modal" data-target="#modalExcluir<?php echo $user['id'] ?>">Excluir</button></td>
                      </tr>
                      <div class="modal fade" id="modalExcluir<?php echo $user['id'] ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="color:white; background-color: #1a66ff;">
                                <h4 class="modal-title" id = "MsgTitle">Tem certeza que deseja excluir este usuário?</h4>
                                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                            </div>
                            <div class="modal-body">
                                <p id = "conteudoMsg">Essa alteração não poderá ser desfeita.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btModal" id = "btPositive" onclick="manipula.excluirUser('<?php echo $user['id'] ?>');">Sim</button>
                                <button type="button" class="btModal" data-dismiss="modal" id = "btModal">Não</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="modalAlterar<?php echo $user['id'] ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="color:white; background-color: #1a66ff;">
                                <h4 class="modal-title" id = "MsgTitle">Formulário de alteração de dados do usuário: </h4>
                                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                            </div>
                            <div class="modal-body">
                              <div class="div-alterar">
                                <input type="text" id = "nome<?php echo $user['id'] ?>" class = "form-control inpt" placeholder="Nome" value = "<?php echo $user['nome']?>" autocomplete="off">
                                <input type="text" id = "email<?php echo $user['id'] ?>" class = "form-control inpt" placeholder="E-mail" value = "<?php echo $user['email']?>" autocomplete="off">
                                <input type="text" id = "telefone<?php echo $user['id'] ?>" class = "form-control inpt" placeholder="Telefone" value = "<?php echo $user['telefone']?>" autocomplete="off">
                                <!-- <input type="password" id = "senhaA" class = "form-control inpt" placeholder="Senha antiga" autocomplete="off"> Colocar outro botao de alterar senha na lista -->
                                <input type="password" id = "senhaN<?php echo $user['id'] ?>" class = "form-control inpt" placeholder="Nova senha" autocomplete="off">
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btModal" id = "btAlterarPositive" onclick="manipula.alterarUser('<?php echo $user['id'] ?>');">Alterar</button>
                                <button type="button" class="btModal" data-dismiss="modal" id = "btAlterarNegative">Sair</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php 
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php include("fragments/modal.php") ?>
    </main>
  </body>
</html>
<script>
const objValor = {
    10: function(){
      input = $("#telefone").val();
      inputRetorna = "(" + input.substr(0,2) + ")" + input.substr(2,4) + "-" + input.substr(6,4);
      if(input.substr(2,1) != "9")
        $("#telefone").val(inputRetorna);
    },
    11: function(){
      input = $("#telefone").val();
      inputRetorna = "(" + input.substr(0,2) + ")" + input.substr(2,5) + "-" + input.substr(7,4);
      $("#telefone").val(inputRetorna);
    }
  }
  $("#telefone").keyup(function(){
    valor = document.getElementById("telefone").value.length;
    objValor[valor]();
  });
  
  function clickFecharModal(){
    setTimeout(() => {
      window.location.href = "listar.php";
    }, 20);
  }
</script>