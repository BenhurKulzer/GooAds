<body onload="BoasVindas()">

	<script type="text/javascript">
		var table = $('#container-fluid').DataTable( {
		    ajax: "data.json"
		} );
		 
		setInterval( function () {
		    table.ajax.reload();
		}, 1000 );
	</script>
	
	<div class="container-fluid">

		<!--<div class="row">
			<div class="col-lg-4 col-sm-6">
				<div class="card">
					<div class="card-content">-->

						<?php
		
							setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
							date_default_timezone_set( 'America/Sao_Paulo' );

							$mes1 = strftime('%h', strtotime("-1 months"));
							$mes2 = strftime('%h', strtotime("-2 months"));
							$mes3 = strftime('%h', strtotime("-3 months"));
							$mes4 = strftime('%h', strtotime("-4 months"));
							$mes5 = strftime('%h', strtotime("-5 months"));
							$mes6 = strftime('%h', strtotime("-6 months"));

								require("includes/ConnDatabase.php");

								$tSqlAtend  = $tPdo->prepare("SELECT * FROM spa_atendimentos WHERE Data BETWEEN date_sub(NOW(), INTERVAL 1 MONTH) AND CURRENT_DATE()");
								$tSqlAtend  ->execute();
								$tTotalAtend = $tSqlAtend->rowCount();

								$tSqlOS  = $tPdo->prepare("SELECT * FROM os_ordens WHERE Data_OS BETWEEN date_sub(NOW(), INTERVAL 1 MONTH) AND CURRENT_DATE()");
								$tSqlOS  ->execute();
								$tTotalOS = $tSqlOS->rowCount();

								$tSqlSolic  = $tPdo->prepare("SELECT * FROM os_solicitacoes WHERE Data BETWEEN date_sub(NOW(), INTERVAL 1 MONTH) AND CURRENT_DATE()");
								$tSqlSolic  ->execute();
								$tTotalSolic = $tSqlSolic->rowCount();

								$tSqlAtendTotal  = $tPdo->prepare("SELECT * FROM spa_atendimentos");
								$tSqlAtendTotal  ->execute();
								$tTotalAtendTotal = $tSqlAtendTotal->rowCount();

								$tSqlOSTotal  = $tPdo->prepare("SELECT * FROM os_ordens");
								$tSqlOSTotal  ->execute();
								$tTotalOSTotal = $tSqlOSTotal->rowCount();

								$tSqlSolicTotal  = $tPdo->prepare("SELECT * FROM os_solicitacoes");
								$tSqlSolicTotal  ->execute();
								$tTotalSolicTotal = $tSqlSolicTotal->rowCount();

								require("includes/ConnDatabasePreos.php");

								$tSqlPreOSTotal  = $tPdo->prepare("SELECT * FROM spa_preos");
								$tSqlPreOSTotal  ->execute();
								$tTotalPreOSTotal = $tSqlPreOSTotal->rowCount();

						?>

						<!--<div class="row">
							<div class="col-xs-7">
								<div class="numbers pull-left">
									<?=$tTotalAtend?>
								</div>
							</div>
							<div class="col-xs-5">
								<div class="pull-right">
									<span class="label label-warning">
											Relação Mês Anterior: xx %
									</span>
								</div>
							</div>
						</div>

						<h6 class="big-title">Total de Atendimentos <span class="text-muted">nos último </span>6 Mêses</h6>
	                    <div id="chartTotalEarnings">
	                    	
	                    </div>
					</div>
					<div class="card-footer">
						<hr>
						<div class="footer-title">Atualizar Gráfico</div>
						<div class="pull-right">
							<button class="btn btn-info btn-fill btn-icon btn-sm">
								<i class="ti-reload"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-7">
								<div class="numbers pull-left">
									<?=$tTotalOS;?>
								</div>
							</div>
							<div class="col-xs-5">
								<div class="pull-right">
									<span class="label label-success">
											Relação Mês Anterior: xx %
									</span>
								</div>
							</div>
						</div>
						<h6 class="big-title">Total de Ordens <span class="text-muted">nos últimos </span>6 Mêses</h6>
	                    <div id="chartTotalSubscriptions"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="210px" class="ct-chart-line" style="width: 100%; height: 210px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M50,79C55.429,81.667,71.714,87,82.571,95C93.429,103,104.286,127,115.143,127C126,127,136.857,105.667,147.714,95C158.571,84.333,169.429,65.667,180.286,63C191.143,60.333,202,84.333,212.857,79C223.714,73.667,234.571,41.667,245.429,31C256.286,20.333,272.571,17.667,278,15" class="ct-line ct-green"></path></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes6;?></span></foreignObject><foreignObject style="overflow: visible;" x="88" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes5;?></span></foreignObject><foreignObject style="overflow: visible;" x="126" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes4;?></span></foreignObject><foreignObject style="overflow: visible;" x="164" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes3;?></span></foreignObject><foreignObject style="overflow: visible;" x="202" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes2;?></span></foreignObject><foreignObject style="overflow: visible;" x="240" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes1;?></span></foreignObject><foreignObject style="overflow: visible;" y="155" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">0</span></foreignObject><foreignObject style="overflow: visible;" y="135" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">25</span></foreignObject><foreignObject style="overflow: visible;" y="115" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">50</span></foreignObject><foreignObject style="overflow: visible;" y="95" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">100</span></foreignObject><foreignObject style="overflow: visible;" y="75" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">200</span></foreignObject><foreignObject style="overflow: visible;" y="55" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">300</span></foreignObject><foreignObject style="overflow: visible;" y="35" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">400</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">500</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">600</span></foreignObject></g></svg></div>
					</div>
					<div class="card-footer">
						<hr>
						<div class="footer-title">Atualizar Gráfico</div>
						<div class="pull-right">
							<button class="btn btn-default btn-fill btn-icon btn-sm">
								<i class="ti-reload"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-7">
								<div class="numbers pull-left">
									<?=$tTotalSolic;?>
								</div>
							</div>
							<div class="col-xs-5">
								<div class="pull-right">
									<span class="label label-danger">
											Relação Mês Anterior: xx %
									</span>
								</div>
							</div>
						</div>
						<h6 class="big-title">Total de Solicitações <span class="text-muted">nos últimos </span>6 Mêses</h6>
	                    <div id="chartTotalDownloads"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="210px" class="ct-chart-line" style="width: 100%; height: 210px;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M50,153.667C56.333,154.259,75.333,164.007,88,157.222C100.667,150.437,113.333,134.719,126,112.956C138.667,91.193,151.333,25.951,164,26.644C176.667,27.338,189.333,99.993,202,117.116C214.667,134.239,233.667,127.338,240,129.382" class="ct-line ct-red"></path></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes6;?></span></foreignObject><foreignObject style="overflow: visible;" x="88" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes5;?></span></foreignObject><foreignObject style="overflow: visible;" x="126" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes4;?></span></foreignObject><foreignObject style="overflow: visible;" x="164" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes3;?></span></foreignObject><foreignObject style="overflow: visible;" x="202" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes2;?></span></foreignObject><foreignObject style="overflow: visible;" x="240" y="180" width="38" height="20"><span class="ct-label ct-horizontal ct-end" style="width: 38px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/"><?php echo $mes1;?></span></foreignObject><foreignObject style="overflow: visible;" y="155" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">0</span></foreignObject><foreignObject style="overflow: visible;" y="135" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">25</span></foreignObject><foreignObject style="overflow: visible;" y="115" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">50</span></foreignObject><foreignObject style="overflow: visible;" y="95" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">100</span></foreignObject><foreignObject style="overflow: visible;" y="75" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">200</span></foreignObject><foreignObject style="overflow: visible;" y="55" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">300</span></foreignObject><foreignObject style="overflow: visible;" y="35" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">400</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="20" width="30"><span class="ct-label ct-vertical ct-start" style="height: 20px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">500</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">600</span></foreignObject></g></svg></div>
					</div>
					<div class="card-footer">
						<hr>
						<div class="footer-title">Atualizar Gráfico</div>
						<div class="pull-right">
							<button class="btn btn-success btn-fill btn-icon btn-sm">
								<i class="ti-reload"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

		<div class="row">
	        <div class="col-lg-3 col-sm-6">
	            <div class="card">
	                <div class="card-content">
	                    <div class="row">
	                        <div class="col-xs-5">
	                            <div class="icon-big icon-warning text-center">
	                                <i class="ti-server"></i>
	                            </div>
	                        </div>
	                        <div class="col-xs-7">
	                            <div class="numbers">
	                                <p>Atendimentos</p>
	                                <?=$tTotalAtendTotal;?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
					<div class="card-footer">
						<hr>
						<div class="stats">
							<i class="ti-reload"></i> Atualizar Agora <br>
							Ultima Atualização em <?=date("d/m/Y");?> às <?=date("H:i:s");?>
						</div>
					</div>
	            </div>
	        </div>
	        <div class="col-lg-3 col-sm-6">
	            <div class="card">
	                <div class="card-content">
	                    <div class="row">
	                        <div class="col-xs-5">
	                            <div class="icon-big icon-success text-center">
	                                <i class="ti-receipt"></i>
	                            </div>
	                        </div>
	                        <div class="col-xs-7">
	                            <div class="numbers">
	                                <p>Ordens de Serviço</p>
	                                <?=$tTotalOSTotal;?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
					<div class="card-footer">
						<hr>
						<div class="stats">
							<i class="ti-calendar"></i> Atualizado em <?=date("d/m/Y");?> às <?=date("H:i:s");?>
						</div>
					</div>
	            </div>
	        </div>
	        <div class="col-lg-3 col-sm-6">
	            <div class="card">
	                <div class="card-content">
	                    <div class="row">
	                        <div class="col-xs-5">
	                            <div class="icon-big icon-danger text-center">
	                                <i class="ti-align-left"></i>
	                            </div>
	                        </div>
	                        <div class="col-xs-7">
	                            <div class="numbers">
	                                <p>Solicitações (SAS)</p>
	                                <?=$tTotalSolicTotal;?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
					<div class="card-footer">
						<hr>
						<div class="stats">
							<i class="ti-calendar"></i> Atualizado em <?=date("d/m/Y");?> às <?=date("H:i:s");?>
						</div>
					</div>
	            </div>
	        </div>
	        <div class="col-lg-3 col-sm-6">
	            <div class="card">
	                <div class="card-content">
	                    <div class="row">
	                        <div class="col-xs-5">
	                            <div class="icon-big icon-info text-center">
	                                <i class="ti-layout-tab"></i>
	                            </div>
	                        </div>
	                        <div class="col-xs-7">
	                            <div class="numbers">
	                                <p>Pré-OS</p>
	                                <?=$tTotalPreOSTotal;?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
					<div class="card-footer">
						<hr>
						<div class="stats">
							<i class="ti-reload"></i> Atualizar Agora <br>
							Ultima Atualização em <?=date("d/m/Y");?> às <?=date("H:i:s");?>
						</div>
					</div>
	            </div>
	        </div>
	    </div>

    <script>
		function BoasVindas() {
		    demo.showNotification('bottom','right');
		}
	</script>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Mês', 'Solicitações'],
      ['Jan',  1000],
      ['Fev',  1170],
      ['Mar',  660],
      ['Abr',  1030]
    ]);

    var options = {
      title: '',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>