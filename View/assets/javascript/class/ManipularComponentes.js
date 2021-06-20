class ComponentsManager{
  setStateDisplayComponent(id, state){
    document.getElementById(id).style.display = state;
  }
  returnModalLogin(){
    const objModal = {
      "Existe": () => {
        //setar campos de mensagem no modal
        document.getElementById("MsgTitle").innerHTML = "Sucesso!! Seja bem vindo!!";
        document.getElementById("conteudoMsg").innerHTML ="Logado com sucesso.";
        $("#btModal").html("Concluir");
      },
      "Erro": () => {
        //setar campos de mensagem no modal
        document.getElementById("MsgTitle").innerHTML = "Houve um erro ao tentar logar!!";
        document.getElementById("conteudoMsg").innerHTML = "Conta não encontrada na base de dados!! Verifique os dados fornecidos ou se efetuou o cadastro anteriormente.";
        $("#btModal").html("Fechar");
      }
    }
    $(document).ready(function(){
      $("#form").submit(function(e){
          var dadosCadUser = {
              'email': document.getElementById("email").value,
              'senha': document.getElementById("senha").value,
          }
          var dados = JSON.stringify(dadosCadUser);
          $.ajax({
              url: '../../Controller/logar.php',
              type: 'POST',
              data: {data: dados},
              success: function(result){
                $("#modal-mensagem").modal();
                objModal[result]();
                document.getElementById("email").value = "";
                document.getElementById("senha").value = "";
              },
              error: function(jqXHR, textStatus, errorThrown) {
              }
          });
          e.preventDefault();
      });
    });
  }
  returnModalCadastro(){
    const objModal = {
      "Existe": () => {
        //setar campos de mensagem no modal
        document.getElementById("MsgTitle").innerHTML = "Erro.";
        document.getElementById("conteudoMsg").innerHTML ="Este email já está cadastrado na nossa base de dados!!";
        $("#btModal").html("Fechar");
      },
      "Inserido": () => {
        //setar campos de mensagem no modal
        document.getElementById("MsgTitle").innerHTML = "Sucesso!!";
        document.getElementById("conteudoMsg").innerHTML = "Usuário inserido com sucesso!!";
        $("#btModal").html("Concluir");
      },
      "Erro ao inserir" : () => {
        //setar campos de mensagem no modal
        document.getElementById("MsgTitle").innerHTML = "Houve um erro ao inserir!!";
        document.getElementById("conteudoMsg").innerHTML = "Usuário não inserido!!";
        $("#btModal").html("Fechar");
      }
    }
    $(document).ready(function(){
      $("#form").submit(function(e){
          var dadosCadUser = {
              'email': document.getElementById("email").value,
              'senha': document.getElementById("senha").value,
              'nome': document.getElementById("nome").value,
              'sobrenome': document.getElementById("sobrenome").value,
              'telefone': document.getElementById("telefone").value
          }
          var dados = JSON.stringify(dadosCadUser);
          $.ajax({
              url: '../../Controller/cadastrar.php',
              type: 'POST',
              data: {data: dados},
              success: function(result){
                $("#modal-mensagem").modal();
                objModal[result]();
                document.getElementById("email").value = "";
                document.getElementById("senha").value = "";
                document.getElementById("nome").value = "";
                document.getElementById("sobrenome").value = "";
                document.getElementById("telefone").value = "";
              },
              error: function(jqXHR, textStatus, errorThrown) {
              }
          });
          e.preventDefault();
      });
    });
  }
  excluirUser(id){
    var dadosUser = {
      idUser:id
    }
    var dados = JSON.stringify(dadosUser);
    $.ajax({
      url: '../../Controller/excluir.php',
      type: 'POST',
      data: {data: dados}
    });
    window.location.href = "listar.php";
  }
  
  alterarUser(id){
    const objModal = {
      "sucesso": function(){
        document.getElementById("MsgTitle").innerHTML = "Sucesso!!";
        document.getElementById("conteudoMsg").innerHTML = "Dados do usuário atualizados com sucesso!!";
      },
      "erro": function(){
        document.getElementById("MsgTitle").innerHTML = "Erro ao tentar atualizar!!";
        document.getElementById("conteudoMsg").innerHTML = "Houve um erro ao tentar atualizar os dados do usuário no banco, contate o administrador!!";
      }
    };
    var dadosUserAlterar = {
      idUser: id,
      nomeUser: document.getElementById("nome"+id).value,
      emailUser: document.getElementById("email"+id).value,
      telefoneUser: document.getElementById("telefone"+id).value,
      senhaNovaUser: document.getElementById("senhaN"+id).value
    }
    var dados = JSON.stringify(dadosUserAlterar);
    $.ajax({
      url: '../../Controller/alterar.php',
      type: 'POST',
      data: {data:dados},
      success: function(result){
        $("#modalAlterar"+id).modal("hide");
        $("#modal-mensagem").modal();
        objModal[result]();
      },
      error: function(jqXHR, textStatus, errorThrown) {
      }
    });
  }

  returnListSearch(){
    $(document).ready(function(){
      $("#formList").submit(function(e){
        var caixaPesquisa = {
          pesquisa: document.getElementById("pesquisa").value
        }
        var dados = JSON.stringify(caixaPesquisa);
        $.ajax({
          url: '../../Controller/pesquisar.php',
          type: 'POST',
          data: {data:dados},
          success: function(result){
            document.getElementById("tbody").innerHTML = result;
          },
          error: function(jqXHR, textStatus, errorThrown) {
          }
        });
        e.preventDefault();
      });
    });
  }

  // transformarEmArquivoExcel(){

  // }

  // transformarEmArquivoPDF(){

  // }

  // imprimir(){
    
  // }
}
var conta = 0;
function clickExibirHeader(){
  (conta == 0)  ?  abrirHeader() : fecharHeader();
}
function abrirHeader(){
  document.getElementById("header").style.transform = "translateY(0vh)";
  document.getElementById("divhideshow").style.transform = "translateY(0vh)";
  document.getElementById("setaBaixo").style.display = "none";
  document.getElementById("setaCima").style.display = "block";
  // document.getElementById("div-resp").style.top = "7vh";
  conta = 1;
}
function fecharHeader(){
  document.getElementById("header").style.transform = "translateY(-7vh)";
  document.getElementById("divhideshow").style.transform = "translateY(-7vh)";
  document.getElementById("setaBaixo").style.display = "block";
  document.getElementById("setaCima").style.display = "none";
  // document.getElementById("div-resp").style.top = "0%";
  fecharMenuResp();
  conta = 0;
}
var contaMenuResp = 0;
function clickMenu(){
  (contaMenuResp == 0) ? abrirMenuResp() : fecharMenuResp();
}
function abrirMenuResp(){
  document.getElementById("men-resp").style.height = "30vh";
  var divName = document.getElementsByClassName("div-options-resp");
  for(var i = 0; i < divName.length; i++){
    divName[i].style.visibility = "visible";
  }
  contaMenuResp = 1;
}
function fecharMenuResp(){
  document.getElementById("men-resp").style.height = "0vh";
  var divName = document.getElementsByClassName("div-options-resp");
  for(var i = 0; i < divName.length; i++){
    divName[i].style.visibility = "hidden";
  }
  contaMenuResp = 0;
}