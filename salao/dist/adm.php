<?php
/*
  Autor: Paulo Gabriel Ronchini
  Data: 08/05/2017

  Página inicial do perfil do administrador.
*/
  session_start();
  #header('Content-Type: text/html; charset=ISO-8859-1');
#Verifica se o usuário esta logado, caso não esteja, ele é redirecionado para a tela de login.
  if(empty($_SESSION['chave']) || $_SESSION['chave']<>'ok'){
    header("Location:page_login.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
          <?php
            echo "<h1><i class='fa fa-dashboard'></i>  Bem Vindo ".$_SESSION['user']."</h1>"
          ?>
            <p>Perfil Administrador</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Painel</a></li>
            </ul>
          </div>
        </div>
        
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    
    <script src="js/essential-plugins.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/plugins/pace.min.js"></script>
    
    <script src="js/main.js"></script>
    
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    
    <script type="text/javascript" src="js/plugins/jquery.vmap.min.js"></script>
   
    <script type="text/javascript" src="js/plugins/jquery.vmap.world.js"></script>
    
    <script type="text/javascript" src="js/plugins/jquery.vmap.sampledata.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function(){
      	var data = {
      		labels: ["January", "February", "March", "April", "May"],
      		datasets: [
      			{
      				label: "My First dataset",
      				fillColor: "rgba(220,220,220,0.2)",
      				strokeColor: "rgba(220,220,220,1)",
      				pointColor: "rgba(220,220,220,1)",
      				pointStrokeColor: "#fff",
      				pointHighlightFill: "#fff",
      				pointHighlightStroke: "rgba(220,220,220,1)",
      				data: [65, 59, 80, 81, 56]
      			},
      			{
      				label: "My Second dataset",
      				fillColor: "rgba(151,187,205,0.2)",
      				strokeColor: "rgba(151,187,205,1)",
      				pointColor: "rgba(151,187,205,1)",
      				pointStrokeColor: "#fff",
      				pointHighlightFill: "#fff",
      				pointHighlightStroke: "rgba(151,187,205,1)",
      				data: [28, 48, 40, 19, 86]
      			}
      		]
      	};
      	var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      	var lineChart = new Chart(ctxl).Line(data);
      
      	var map = $('#demo-map');
      	map.vectorMap({
      		map: 'world_en',
      		backgroundColor: '#fff',
      		color: '#333',
      		hoverOpacity: 0.7,
      		selectedColor: '#666666',
      		enableZoom: true,
      		showTooltip: true,
      		scaleColors: ['#C8EEFF', '#006491'],
      		values: sample_data,
      		normalizeFunction: 'polynomial'
      	});
      });
    </script>
  </body>
</html>
