<?php
  session_start();
 if(empty($_SESSION['chave']) || $_SESSION['chave']<>'ok'){
    header("Location:page_login.php");
  }
  /*
    Autor: Paulo Gabriel Ronchini
    Data: 08/05/2017

    Página com o formulário de atualização de diagnósticos.

  */

  if(isset($_GET['pagina'])){
      $itens_por_pagina = 25 * intval($_GET['pagina']);
      if($itens_por_pagina < 0){
        $itens_por_pagina = 0;
      }
  }else{
      $itens_por_pagina = 0;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Shalon Admin</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    
  </head>
 <?php
	include_once("cabecalho.php");
  ?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-edit"></i> Atualizar Diagnóstico</h1>
            
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li>Home</li>
              <li><a href="#">Novo procedimento</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <h3 class="card-title" style="margin-bottom:0px;">Consultar Diagnósticos</h3>
              <form method="get">
                    <div class="form-group">
                      <div class="col-xs-12 col-sm-6"><input class="form-control" type="text" placeholder="Nome do cliente" name="cpf" id="cpf"></div>
                      <div class="col-sm-2"><input class="form-control" type="submit" value="Buscar" name="ok"></div>         
                    </div>                         
                   </form> 
              <div class="card-body">
                  <?php
                      /*O primeiro if verifica se a variável $_POST['cpf'] está preenchida, caso seja verdadeiro essa verificação 
                    o programa faz a conexão com o banco de dados, em seguida a variável local $result recebe os diagnósticos encontrados no banco de dados relacionados ao cpf informado, em seguida é listado todos os registro com três botões de ação, um que redireciona o usuário para a tela de visualização dos dados, o segundo botão leva para a tela de alteração de dados, e o terceiro deleta o item selecionado.
                      */
                     if(isset($_GET['cpf'])){                      
                      $connect = mysqli_connect('localhost','root','', 'projeto shalon');

                      $result = mysqli_query($connect, "SELECT p.Nome, d.Funcionario,DATE_FORMAT(d.data, '%d/%m/%y') as data, d.ID from pessoa p, cliente c, diagnostico d where '".$_GET['cpf']."' = p.cpf and p.CPF = c.CPF and c.ID = d.ID_Cliente LIMIT 25 offset ".$itens_por_pagina)or die(mysqli_error($connect));

                      $pegar_todos = mysqli_query($connect,  "SELECT p.Nome, d.Funcionario,DATE_FORMAT(d.data, '%d/%m/%y') as data, d.ID from pessoa p, cliente c, diagnostico d where '".$_GET['cpf']."' = p.cpf and p.CPF = c.CPF and c.ID = d.ID_Cliente");

                      $num_paginas = ceil(mysqli_num_rows($pegar_todos)/25);

                      if(mysqli_num_rows($result) == 0){
                        echo "<script type='text/javascript'>
                                  alert('Cliente não encontrado');
                              </script>";
                      }else{
                        echo "<table class= 'table table-striped'>";
                        echo "<thead>";
                        echo " <tr>";
                        echo    "<th>Cliente</th>";
                        echo    "<th>Funcionário</th>";
                        echo    "<th>Data</th>"; 
                        echo    "<th>Ações</th>";                       
                        echo  "</tr>";
                        echo "</thead>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr><td>".$row['Nome']."</td><td>".$row['Funcionario']."</td><td>".$row['data']."</td><td class='actions'>
                                  <a class='btn btn-success btn-xs' href='view_diag.php?apagar=".$row['ID']."'><i class='fa fa-eye' aria-hidden='true'></i></a>
                                  <a class='btn btn-warning btn-xs' href='update_diag.php?apagar=".$row['ID']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                  <a class='btn btn-danger btn-xs'  href='../Controller/deletar_diag.php?apagar=".$row['ID']."'><i class='fa fa-trash-o' aria-hidden=true'></i></a>
                                  </td></tr>";                    
                        }
                        echo "</table>";
                        ?>
                            <nav aria-label="Page navigation">
                              <ul class="pagination">
                                <li>
                                  <a href="atualizar_diagnosticos.php?pagina=0&cpf=<?php echo $_GET['cpf'];?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                  </a>
                                </li>
                                <?php
                                  for($i=0; $i<$num_paginas; $i++){
                                    echo "<li><a href='atualizar_diagnosticos.php?pagina=".$i."&cpf=".$_GET['cpf']."'>".$i."</a></li>";
                                  }
                                ?>
                                <li>
                                  <a href='atualizar_diagnosticos.php?pagina=<?php echo $num_paginas-1; echo "&cpf=".$_GET['cpf'];?>' aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        <?php
                      }
                      mysqli_close($connect);
                      $_POST['cpf'] = NULL; 
                      
                    }                 
                 ?>
              </div>             
            </div>
          </div>        
        </div>
      </div>
    </div>
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/essential-plugins.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>