<?php

	////////////////////////////////////////////////////////////////////////////////////////////////////

	require_once("includes/ConnDatabase.php");
	require_once("includes/LogSistema.php");

	// Se o método for POST faz o cadastro no BD
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$tAdicionadoC  	= $_SESSION["LOGINUSER"];
		$tUnidadeC 	  	= $_POST['txtUnidadeC'];
		$tSiglaC 		= $_POST['txtSiglaC'];

		$tDataHora      = date("Y-m-d H:i:s");
		$tData      	= date("Y-m-d");
		$tHora      	= date("H:i:s");

		$tCampos = "Estado_Unidade,Sigla_Unidade,Adicionado_Por,Data_Hora_Unidade,Data_Unidade,Hora_Unidade";
		$tValues = "'$tUnidadeC','$tSiglaC','$tAdicionadoC','$tDataHora','$tData','$tHora'";
				
		$tSql = $tPdo->prepare("INSERT INTO sistema_unidades ({$tCampos}) VALUES ({$tValues})");
		$tSql ->execute();

		if($tSql == TRUE){ $tMensagem = CADASTROUNIDADESUCESSO;} else{ $tMensagem = CADASTROUNIDADEERRO;}

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<div class="card">

    <form method="post" action="?controle=CadastrarNovaUnidade" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
				Cadastrar Nova Unidade
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        		<?php if(isset($tMensagem)){ echo $tMensagem;}?>

	            <div class="form-group col-md-6">
	                <label>Nome da Unidade</label>
	                <input type="text" tabindex="1" class="form-control" name="txtUnidadeC" id="txtUnidadeC" required>
	            </div>

	            <div class="form-group col-md-6">
	                <label>Sigla da Unidade</label>
	                <input type="text" tabindex="1" class="form-control" name="txtSiglaC" id="txtSiglaC" minlength="2" maxlength="3" required>
	        	</div>

	        <button type="submit" class="btn btn-default btn-fill btn-wd">Cadastrar Unidade</button>

        </div>

	</form>

</div>