<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Fotos Financeiro</a>
            </li>
        </ul>

        <div class="well">
        	<div class="row">
            
				<?php 

					// Código que define os dados para exibição nas tabelas

					require_once("includes/ConnDatabase.php");
				   
					$tQuantidade =20;
					$tPagina     = (isset ($_GET['pg'])) ? (int)$_GET['pg'] :1;
					$tIniciar    = ($tQuantidade * $tPagina) - $tQuantidade;

					$tSql = $tPdo->prepare("SELECT * FROM os_fotos WHERE ID_Foto LIKE '%Pagamento%' AND Numero_OS_Foto='{$tGet}'");
				 	$tSql ->execute();

					while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

						echo "

						    <div class='col-md-3'>

							    <div class='well' style='background: #fff; padding: 0px !important;'>

							    	<div class='card-header' style='padding: 0px !important;'>
							        	<img src='up_arquivos/FotosOS/{$tMC['Imagem_Foto']}' style='width: 100%;height: 200px;'>
							        </div>

							        <div class='card-content'>
							        	<p style='margin-bottom: 0px;'>{$tMC['ID_Foto']}</p>
							        </div>

							        <div class='card-footer'>
										<hr>
										<div class='stats'>06/04/2018 às 14:28:37</div>
									</div>

							    </div>

							</div>

						";

					}

				?>

        	</div>
        </div>

    </div>
</div>

<a>.</a>