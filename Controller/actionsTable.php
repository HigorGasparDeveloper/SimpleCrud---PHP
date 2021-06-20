<?php
  session_start();
  $list = $_SESSION['arrayList'];
  //echo '<PRE>'; var_dump($list); echo '</PRE>';
  if(isset($_POST['excel'])){
    $table = "<table border = '2'>";
    $table .= "<tr>
                <td>Id</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Telefone</td>
              </tr>";
    foreach ($list as $value) {
      $table.= "<tr>
                  <td>".$value['id']."</td>
                  <td>".$value['nome']."</td>
                  <td>".$value['email']."</td>
                  <td>".$value['telefone']."</td>
                </tr>";
    }
    $table .= "</table>";
    $fileName = "relatorio-".date('d/m/Y H:i').".xls";
    header("Content-type: application/msexcel");
    header("Content-Disposition: attachment; filename=".$fileName);
    echo $table;
  }else if(isset($_POST['imprimir'])){
    $table = "<div id = 'table-print'><table class = 'table'>";
    $table .= "<thead><tr>
                <td>Id</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Telefone</td>
              </tr></thead>
              <tbody>";
    foreach ($list as $value) {
      $table.= "<tr>
                  <td>".$value['id']."</td>
                  <td>".$value['nome']."</td>
                  <td>".$value['email']."</td>
                  <td>".$value['telefone']."</td>
                </tr>";
    }
    $table .= "</tbody></table></div>
    <button onclick = 'impress()' id = 'bt'></button>
    ";
    echo $table;
    ?> 
    <script>
      setTimeout(() => {
        document.getElementById("bt").click();
      }, 100);
    </script>
<?php
  }else if(isset($_POST['pdf'])){
    $fileName = "relatorio-".date('d/m/Y H:i').".pdf";
    require_once("fpdf/fpdf.php");
    $pdf= new FPDF("P","pt","A4");
    $pdf->AddPage();
    $pdf->SetFont('arial','B',18);
    $pdf->Cell(0,5, iconv('utf-8','iso-8859-1', "Relatório de usuários cadastrados:"),0,1);
    $pdf->Ln(22);

    $pdf->SetFont('arial','B',14);
    $altura = 36;
    $largura = 160;
    $pdf->Cell(30, $altura, 'Id', 1, 0, 'L');
    $pdf->Cell($largura + 20, $altura, 'Nome', 1, 0, 'L');
    $pdf->Cell($largura + 40, $altura, 'E-mail', 1, 0, 'L');
    $pdf->Cell($largura-40, $altura, 'Telefone', 1, 0, 'L');
    $pdf->Ln($altura);

    $pdf->SetFont('arial','B',12);
    foreach ($list as $row) {
      $pdf->Cell(30, $altura, $row['id'], 1, 0, 'L');
      $pdf->Cell($largura + 20, $altura, $row['nome'], 1, 0, 'L');
      $pdf->Cell($largura + 40, $altura, $row['email'], 1, 0, 'L');
      $pdf->Cell($largura-40, $altura, $row['telefone'], 1, 0, 'L');
      $pdf->Ln($altura);
    }
    $pdf->Output($fileName,"D");
  }
?>
<script>
  function impress() {
    var conteudo = document.getElementById('table-print').innerHTML;
    tela_impressao = window.open('about:blank');
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
  }
</script>