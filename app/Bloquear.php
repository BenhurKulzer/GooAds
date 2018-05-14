<?php require_once("verifica.php"); require_once("includes/SistemaConfig.inc.php");  ?>

<html lang="pt-BR" class="perfect-scrollbar-on">

	<head>

		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    	<meta name="viewport" content="width=device-width">
		<meta charset="utf-8">
		<link rel="apple-touch-icon" sizes="76x76" href="stylesheets/img/background12.png">

		<title>SOS HD - Sistema Bloqueado!</title>

	     <!-- Bootstrap core CSS -->
	    <link href="stylesheets/css/bootstrap.min.css" rel="stylesheet">

	    <!--  Paper Dashboard core CSS -->
	    <link href="stylesheets/css/paper-dashboard-pro.css?v=1.2.1" rel="stylesheet">

	    <!--  CSS for Demo Purpose, don't include it in your project     -->
	    <link href="stylesheets/css/demo.css" rel="stylesheet">

	    <!--  Fonts and icons     -->
	    <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css">
	    <link href="stylesheets/css/themify-icons.css" rel="stylesheet">

	</head>

	<body>
	
	<?php

        require_once("includes/ConnDatabase.php");

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          $tUsuario = $_SESSION['LOGINUSER'];
          $tSenha 	= isset($_POST["txtSenha"]) ? trim($_POST["txtSenha"]) : FALSE;
          $tSenha 	= criptografar($tSenha,"k49fdk4030d");
          
          $tSql   	= $tPdo->prepare ("SELECT * FROM usuarios_colaboradores WHERE NOME_SOCIAL_U = '{$tUsuario}'");
          $tSql   	->execute();
          $tTotal 	= $tSql->rowCount();
          
            if($tTotal) {
              $tDU = $tSql->fetch(PDO::FETCH_ASSOC);

              if(!strcmp($tSenha, $tDU["SENHA_U"])) {

                $tMensagem = '<p style="color:#f00">Tudo Certo, Só redirecionar</p>';
                header("Location: Gerenciador.php");

              } else {
                $tMensagem = '<p style="color:#f00">Senha Errada</p>';
              }

          } else {
              $tMensagem = '<p style="color:#f00">Usuário Incorreto</p>';
          } // Finaliza script Consulta SQL
        
        } // finaliza metódo POST

    ?>

	    <nav class="navbar navbar-transparent navbar-absolute">
		    <div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		            <a class="navbar-brand" href="#">SOS HD - Sistema Bloqueado!</a>
		        </div>
		        <div class="collapse navbar-collapse">
		            <ul class="nav navbar-nav navbar-right">

		            </ul>
		        </div>
		    </div>
		</nav>

		<div class="wrapper wrapper-full-page">
			<div class="full-page lock-page" data-color="azure" data-image="stylesheets/img/background/background-5.png">
		    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
		        <div class="content">    
            	    <div class="card card-lock">

	                    <div class="author">
	                        
	                        <?php
								if ($_SESSION['FOTOUSER'] !== '') {
									echo '<img class="avatar" src="up_arquivos/Usuarios/'.$_SESSION["FOTOUSER"].'?>">';
								} else {
									
									echo '<img src="up_arquivos/Usuarios/emptyPerson.png">';
								}
							?>
	                    </div>
		                    
		                <h4><?=$_SESSION['LOGINUSER'];?></h4>

		                <form role="form" action="Bloquear.php" method="post">
		                    
		                    <div class="col-md-12">
		                        <?php if(isset($tMensagem)){ echo $tMensagem;}?>
		                    </div>

		                    <div class="col-md-12 form-group">
		                        <input type="password" placeholder="Digitar Senha" class="form-control" name="txtSenha" id="txtSenha">
		                    </div>
		                    
		                    <div class="col-md-12 form-group">
		                    	<button type="submit" class="btn btn-wd btn-move-left"><i class="ti-unlock"></i> Desbloquear Sistema</button>
		                    </div>

		                </form>

		                    <hr>
		                    
	                    <div class="col-md-12 form-group">
	                    	<a type="button" href="Gerenciador.php?controle=SairSistema" class="btn btn-wd btn-danger btn-move-left"><i class="ti-angle-double-left"></i> Sair do Sistema</a>
	                	</div>
		            
		            </div>
		        </div>
		    	
		    	<footer class="footer footer-transparent">
		            <div class="container">
		                <div class="copyright">
		                    &copy; <script>document.write(new Date().getFullYear())</script>, Desenvolvido por Departamento de TI - Grupobras
		                </div>
		            </div>
		        </footer>
		    <div class="full-page-background" style="background-image: url(images/backbloqueio.jpg) "></div></div>
		</div>


	</body>

</html>

<script type="text/javascript">
/**  
	Script adiciona uma hash no botão voltar e impede o funcionamento do mesmo, bloqueando o acesso indevido no sistema
*/ 

(function(window) { 
  'use strict'; 
 
var noback = { 
	 
	//globals 
	version: '0.0.1', 
	history_api : typeof history.pushState !== 'undefined', 
	 
	init:function(){ 
		window.location.hash = '#no-back'; 
		noback.configure(); 
	}, 
	 
	hasChanged:function(){ 
		if (window.location.hash == '#no-back' ){ 
			window.location.hash = '#Bloqueio';
			//mostra mensagem que não pode usar o btn volta do browser
			if($( "#msgAviso" ).css('display') =='none'){
				$( "#msgAviso" ).slideToggle("slow");
			}
		} 
	}, 
	 
	checkCompat: function(){ 
		if(window.addEventListener) { 
			window.addEventListener("hashchange", noback.hasChanged, false); 
		}else if (window.attachEvent) { 
			window.attachEvent("onhashchange", noback.hasChanged); 
		}else{ 
			window.onhashchange = noback.hasChanged; 
		} 
	}, 
	 
	configure: function(){ 
		if ( window.location.hash == '#no-back' ) { 
			if ( this.history_api ){ 
				history.pushState(null, '', '#Bloqueio'); 
			}else{  
				window.location.hash = '#Bloqueio';
				//mostra mensagem que não pode usar o btn volta do browser
				if($( "#msgAviso" ).css('display') =='none'){
					$( "#msgAviso" ).slideToggle("slow");
				}
			} 
		} 
		noback.checkCompat(); 
		noback.hasChanged(); 
	} 
	 
	}; 
	 
	// AMD support 
	if (typeof define === 'function' && define.amd) { 
		define( function() { return noback; } ); 
	}  
	// For CommonJS and CommonJS-like 
	else if (typeof module === 'object' && module.exports) { 
		module.exports = noback; 
	}  
	else { 
		window.noback = noback; 
	} 
	noback.init();
}(window)); 
</script>