<?php 

// Código "PHP" que define os parametros da edição do cadastro do cliente

if($_SESSION['NIVELUSER'] == 3)
{
	echo "<div class='alert alert-warning'>Sem permissão de acesso a essa página ou ela não existe, aguarde o redirecionamento..</div><meta http-equiv='refresh' content='4;url=?controle=Home'>";
}
else{
require_once("includes/ConnDatabase.php");

	$tGet   = decodificarUrl($_GET['CodC']);
	$tGetC  = $_GET['CodC'];
	$tSqlEC = $tPdo->prepare("SELECT * FROM spa_atendimentos WHERE ID_C ='{$tGet}'"); 
	$tSqlEC ->execute();
	
	$tMC	= $tSqlEC->fetch(PDO::FETCH_ASSOC);

		switch($tMC['Midia']) {
            case b1: $tTipo = "HD / SSD";                           break;  
            case b2: $tTipo = "RAID / NAS / Storages / VM";         break;
            case b3: $tTipo = "Cartões de Memória / Pen-Drive";     break;
            case b4: $tTipo = "Cloud";                              break;
            case b5: $tTipo = "Outras Mídias";                      break;
            case b6: $tTipo = "Não Informado";                      break;
        }
        
	}

?>

<div class="col-md-12">

	<div class="card">

	    <form method="post" action="#" enctype="multipart/form-data">
	        
	        <div class="card-header">
			    <h4 class="card-title">
					<div class="col-md-8">
			    		Visualização de Dados do Cliente <font color="#FF0000"><?=$tMC['Nome'];?></font>
			    	</div>
					<div class="col-md-4 text-right">
						<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
					</div>
				</h4>
				<hr>
			</div>
	        
	        <div class="card-content">

		            <div class="form-group col-md-6">
		                <label>Nome do Cliente</label>
		                <input type="text" class="form-control" value="<?=$tMC['Nome'];?>" readonly>
		            </div>

		            <div class="form-group col-md-6">
		                <label>Tipo de Mídia</label>
		                <input type="text" class="form-control" value="<?=$tTipo?>" readonly>
		        	</div>

		            <div class="form-group col-md-6">
		                <label>E-Mail</label>
		                <input type="text" class="form-control" value="<?=$tMC['Email'];?>" readonly>
		            </div>

		            <div class="form-group col-md-6">
		                <label>Origem do Atendimento</label>
		                <input type="text" class="form-control" value="<?=$tMC['Filial'];?>" readonly>
		        	</div>

		        	<div class="form-group col-md-6">
		                <label>Telefone</label>
		                <input type="text" class="form-control" value="<?=$tMC['Telefone'];?>" readonly>
		            </div>

		            <div class="form-group col-md-6">
		                <label>Meio de Atendimento</label>
		                <input type="text" class="form-control" value="<?=$tMC['MeioAtendimento'];?>" readonly>
		        	</div>

		            <div class="form-group col-md-6">
		                <label>Telefone 2</label>
		                <input type="text" class="form-control" value="<?=$tMC['Telefone2'];?>" readonly>
		            </div>

		            <div class="form-group col-md-6">
		                <label>Onde nos encontrou</label>
		                <input type="text" class="form-control" value="<?=$tMC['Encontrou_Em'];?>" readonly>
		            </div>

		            <div class="form-group col-md-12">
		                <label>Status de Atendimento</label>
		                <input type="text" class="form-control" value="<?=$tMC['Status'];?>" readonly>
		            </div>

		        	<div class="form-group col-md-12">
		                <label>Observação</label>
		                <textarea type="text" style="height: 200px;" readonly class="form-control"><?=$tMC['Observacao'];?></textarea>
		        	</div>

		        	<a>.</a>

	        </div>

		</form>

	</div>

</div>

<div class="col-md-12">

	<div class="card">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Histórico de Ocorrências
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        	<table width="100%" class="table table-striped">
		    	<thead>
			        <tr>
			         	<th>Atendente</th>
			        	<th>Ocorrencias</th>
			        	<th>Status</th>
			        	<th>Data/Hora</th>
			        </tr>
		      	</thead>
		      	
		      	<tbody>
			
				<?php

					// Código que define os dados para exibição nas tabelas
					require_once("includes/ConnDatabase.php");
				   
					$tQuantidade = 50;
					$tPagina     = (isset ($_GET['pg'])) ? (int)$_GET['pg'] :1;
					$tIniciar    = ($tQuantidade * $tPagina) - $tQuantidade;

					$tGet   = decodificarUrl($_GET['CodC']);

					$tSql = $tPdo->prepare("SELECT * FROM spa_ocorrencias WHERE ID_Cliente='{$tGet}' ORDER BY ID_C DESC LIMIT $tIniciar, $tQuantidade");
					$tSql ->execute();

				  	while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

			            //Faz o explode da Data e transforma do formato US para o formato BR
			            $data = $tMC['Data'];
			            $data_nova = explode("-",$data);

						echo "
							<tr>
								<td>{$tMC['Atendente']}</td>
								<td>{$tMC['Observacao']}</td>
								<td>{$tMC['Status']}</td>
								<td>$data_nova[2]/$data_nova[1]/$data_nova[0] às {$tMC['Hora']}</td>
							</tr>
						";
					
					}

		        ?>
		      </tbody>
		    </table>

		</div>

	</div>

</div>