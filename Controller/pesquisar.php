<?php session_start();
  $arq = "pesquisar";
  include 'BDManager.php';
  $pesquisa = json_decode($_POST['data'])->pesquisa;

  $manager = new BDManager("","","","",$pesquisa);

  $listSearch = $manager->searchInMysql();
  $_SESSION['arrayList'] = $listSearch;
  foreach($listSearch as $user){
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