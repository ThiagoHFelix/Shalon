<?php
  session_start();
 if(empty($_SESSION['chave']) || $_SESSION['chave']<>'ok'){
    header("Location:page_login.php");
  }
  /*
    Autor: Paulo Gabriel Ronchini
    Data: 08/05/2017

    Página com o formulário de agendamento.

  */

include_once("../Controller/gerenciar_agenda.php");
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
    <script type="text/javascript">
      function procurar() {
        document.getElementById('form_data').submit(); 
      }
    </script>
 
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
              <h3 class="card-title" style="margin-bottom:0px;">Agendar</h3>              
              <div class="card-body">   
              <form method="get" id='form_data'>
                <div class='form-group'>                                             
                  <label class="control-label">Selecione a data</label>          
                  <input class='form-control' type='date' name='data' id='data'>                  
                </div>
                <div class='form-group'>                                         
                  <input class='form-control' type='submit' value='Procurar' name='bt_data' id='bt_data' onclick="procurar();">        
                </div>
              </form>              
                  <?php

                  if(isset($_GET['st']) and isset($_GET['id'])){
                    gerenciar_agenda($_GET['st'],$_GET['id']);
                  }   

                  if(isset($_GET['data'])){

                  $connect = mysqli_connect('localhost','root','', 'projeto shalon');
                  $result = mysqli_query($connect, "select p.nome, cs.Servico, cs.hora, cs.status, cs.ID from cliente c, consulta cs, pessoa p where cs.data = '".$_GET['data']."' and cs.Id_cliente = c.Id and c.CPF = p.CPF");
                      if(mysqli_num_rows($result) == 0){
                        echo "<script type='text/javascript'>
                                  alert('Nenhum procedimento encontrado');
                              </script>";                        
                      }else{
                        echo "<table class= 'table'>";
                        echo "<thead>";
                        echo " <tr>";
                        echo    "<th>Cliente</th>";
                        echo    "<th>Procedimento</th>";
                        echo    "<th>Data</th>";                                                
                        echo    "<th>Status</th>";  
                        echo    "<th>Ações</th>";                                                
                        echo  "</tr>";
                        echo "</thead>";
                        while($row = mysqli_fetch_assoc($result)){
                          if($row['status']=='a'){
                            echo "<tr><td>".$row['nome']."</td><td>".$row['Servico']."</td><td>".$row['hora']."</td><td>Marcado</td><td class='actions'>
                                  <a data-toggle='tooltip' title='Realizar consulta' class='btn btn-warning btn-xs' href='listar_agenda.php?st=r&id=".$row['ID']."&data=".$_GET['data']."'><i class='fa fa-check-square-o' aria-hidden='true'></i></a>
                                  <a data-toggle='tooltip' title='Cancelar consulta' class='btn btn-danger btn-xs' href='listar_agenda.php?st=c&id=".$row['ID']."&data=".$_GET['data']."'><i class='fa fa-times' aria-hidden='true'></i></a></td></tr>";        
                          }elseif($row['status']=='r'){
                            echo "<tr><td>".$row['nome']."</td><td>".$row['Servico']."</td><td>".$row['hora']."</td><td>Realizado</td><td></td></tr>";
                          }elseif($row['status']=='c'){
                            echo "<tr><td>".$row['nome']."</td><td>".$row['Servico']."</td><td>".$row['hora']."</td><td>Cancelado</td><td></td></tr>";
                        }
                      }
                    }
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
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>
  </body>
</html>