<?php require_once("verifica.php"); require_once("includes/SistemaConfig.inc.php");  ?>

<head>

	<link rel="icon" type="image/png" href="assets/ico/favicon.png">

	<title>SOS HD - Sistema de Atendimentos</title>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap core CSS     -->
    <link href="lib/css/bootstrap.min.css" rel="stylesheet">

    <!--  Paper Dashboard core CSS    -->
    <link href="lib/css/paper-dashboard.css?v=1.2.1" rel="stylesheet">

    <!--  Fonts and icons     -->
    <link href="lib/css/font-awesome.min.css" rel="stylesheet">
    <link href='lib/css/google-fonts.css' rel='stylesheet' type='text/css'>
    <link href="stylesheets/css/themify-icons.css" rel="stylesheet">

</head>

<body>

	<div class="wrapper">
	    <div class="sidebar" data-background-color="brown" data-active-color="danger">
			<div class="logo">
				<a href="Gerenciador.php" class="simple-text logo-mini">
					SOS
				</a>

				<a href="Gerenciador.php" class="simple-text logo-normal">
					SOSHD &copy; <?=date("Y");?>
				</a>
			</div>
	    	<div class="sidebar-wrapper ps-container ps-theme-default ps-active-x ps-active-y" data-ps-id="48d91977-73d1-cd61-b895-3ec7da771bd4">
				<div class="user">
	                <div class="info">
						<div class="photo">
							<?php
								if ($_SESSION['FOTOUSER'] === '') {
									echo '<img src="up_arquivos/Usuarios/emptyPerson.png">';
								} else {
									echo '<img src="up_arquivos/Usuarios/'.$_SESSION["FOTOUSER"].'?>">';
								}
							?>
		                </div>

	                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								<?=$_SESSION['LOGINUSER'];?>
		                        <b class="caret"></b>
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <div class="collapse" id="collapseExample">
	                        <ul class="nav">

	                        	<li>
									<a href="?controle=MeusDadosDeUsuario">
										<span class="sidebar-mini">MD</span>
										<span class="sidebar-normal">Meus Dados de Usuário</span>
									</a>
								</li>
								
	                            <li>
									<a href="?controle=AlterarSenha">
										<span class="sidebar-mini">AU</span>
										<span class="sidebar-normal">Alterar Senha de Usuário</span>
									</a>
								</li>

	                        </ul>
	                    </div>
	                </div>
	            </div>
	            <ul class="nav">
	                <li class="active">
	                    <a href="?controle=Home">
	                        <i class="ti-dashboard"></i>
	                        <p>Dashboard
                            </p>
	                    </a>
	                </li>

	                <li>
						<a data-toggle="collapse" href="#Atendimentos">
	                        <i class="ti-view-list-alt"></i>
	                        <p>
								Atendimentos
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="Atendimentos">
							<ul class="nav">
								<li>
									<a href="?controle=CadastrarNovoAtendimento">
										<span class="sidebar-mini">Ca</span>
										<span class="sidebar-normal">Cadastrar Atendimento</span>
									</a>
								</li>

								<li>
									<a href="?controle=ListaDeAtendimentos">
										<span class="sidebar-mini">La</span>
										<span class="sidebar-normal">Lista de Atendimentos</span>
									</a>
								</li>

								<li>
									<a href="?controle=ListaPreOS">
										<span class="sidebar-mini">PO</span>
										<span class="sidebar-normal">Lista de Pré OS</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>

	                <li>
	                    <a href="?controle=ListaDeOS">
	                        <i class="ti-clipboard"></i>
	                        <p>Ordens de Serviço
                            </p>
	                    </a>
	                </li>

	                <!--<li>
	                    <a href="?controle=ListaPreOS">
	                        <i class="ti-bookmark-alt"></i>
	                        <p>Pré OS
                            </p>
	                    </a>
	                </li>-->

	            </ul>

	    	</div>

	    </div>

	    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="e32edbfc-d6c6-f733-878b-7ef081df9df3">

			<nav class="navbar navbar-default">
	            <div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
					</div>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar bar1"></span>
	                        <span class="icon-bar bar2"></span>
	                        <span class="icon-bar bar3"></span>
	                    </button>
	                    <a class="navbar-brand" href="#Dashboard">
							Sistema <span class="divider">/</span> <?php echo LocalizacaoPagina($_GET['controle']);?>
						</a>
	                </div>
	                <div class="collapse navbar-collapse">

	                    <ul class="nav navbar-nav navbar-right">
	                        
							<li class="dropdown">
	                            <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
	                                <i class="ti-settings"></i>
	                            </a>
	                            <ul class="dropdown-menu">
	                            	
	                            	<?php echo ($_SESSION["NIVELUSER"] == 1) ? '' : ' <li><a href="?controle=ConfiguracoesAdmin">Configurações do Sistema</a></li> ';?>

	                                <li><a href="Bloquear.php">Bloquear Sistema</a></li>
	                                <li><a href="?controle=SairSistema">Logout</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </nav>

	        <div class="content">

				<div class="container-fluid">
					<div class="row-fluid">
						<!-- -->
						<?php @LinkPaginas($_GET['controle'],"Home.php","pags"); ?>
					</div>
				</div>

			</div>

            <footer class="footer">
	            <div class="container-fluid">
	                <nav class="pull-left">
	                    <ul>

	                    	<li>
	                            <a href="#">
	                                <?=date("d/m/Y");?> | <?php print $_SERVER['REMOTE_ADDR']; ?>
	                            </a>
	                        </li>

	                        <li class="dropup">
							  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Informações do Sistema
							    	<span class="caret"></span>
							  	</button>
							  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								    <li>Versão do Sistema: 0.0.1</li>
		                            <li>Desenvolvido Por: Benhur Külzer</li>
		                            <li>Versão PHP: 7.5.3</li>
							  	</ul>
							</li>

	                    </ul>
	                </nav>
	                <div class="copyright pull-right">
	                    &copy; <script>document.write(new Date().getFullYear())</script>, Desenvolvido por <b>Departamento de TI - SOS HD</b>
	                </div>
	            </div>
	        </footer>

	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="lib/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="lib/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="lib/js/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="lib/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="lib/js/jquery.maskMoney.js" type="text/javascript"></script>

	<script src="lib/js/jquery.maskMoney.js" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="lib/js/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="lib/js/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="lib/js/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="lib/js/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="lib/js/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="lib/js/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="lib/js/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="lib/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="lib/js/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="lib/js/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="lib/js/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPQibxeDaLIUHsC6_KqDdFaUdhrbhZ3M"></script>

	<!-- Wizard Plugin    -->
	<script src="lib/js/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="lib/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="lib/js/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="lib/js/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="lib/js/paper-dashboard.js"></script>

    <!--   Sharrre Library    -->
    <script src="lib/js/jquery.sharrre.js"></script>

    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="lib/js/demo.js"></script>

</div>
</div>
</body>