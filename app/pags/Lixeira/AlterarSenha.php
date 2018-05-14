<?php 

// Código que define os dados para efetuar edição na senha da atendente

require_once("includes/ConnDatabase.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

	$tSeAtual		=  addslashes(trim($_POST['passSenhaAtual']));
	$tSeNova		=  addslashes(trim($_POST['passNovaSenha']));
	$reNovaSenha 	=  addslashes(trim($_POST['passRepetirSenha']));

	$tSeNcpt        = criptografar($tSeNova    ,"k49fdk4030d");
	$tSeRcpt        = criptografar($reNovaSenha,"k49fdk4030d");
			
	$tSqlPS = $tPdo->prepare("SELECT SENHA_U FROM usuarios_colaboradores WHERE ID_USER ='{$_SESSION['IDUSER']}'");	
	$tSqlPS ->execute();
	$tV     = $tSqlPS->fetch(PDO::FETCH_ASSOC);
	$tSenha = $tV['SENHA_U'];
		

	if((!strcmp($tSenha)) and (!strcmp($tSeNcpt,$tSeRcpt))) {

		$tSqlPSA = $tPdo->prepare("UPDATE usuarios_colaboradores SET SENHA_U ='{$tSeNcpt}' WHERE ID_USER ='{$_SESSION['IDUSER']}'");	
		$tSqlPSA -> execute();	
		$tMensagem = "<div class='alert alert-success'>Sua senha foi atualizada com sucesso!</div><meta HTTP-EQUIV = 'Refresh' CONTENT = '2; URL =?controle=FormEditarSenhaUsuario'>"; 

	} else {
		$tMensagem = "<div class='alert alert-warning'>As novas senhas não são iguais!</div>";
	}

}//FIM REQUEST POST
?>

<div class="card">

    <form method="post" action="?controle=AlterarSenha" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
				Alterar Senha
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

    		<?php if(isset($tMensagem)){ echo $tMensagem;}?>

            <div class="col-md-12 inputmodal">
                <label for="recipient-name" class="col-form-label">Nova Senha:</label>
                <input type="password" name="passNovaSenha" id="passNovaSenha" class="form-control" onkeyup="javascript:verifica()" required>
            </div>

            <div class="col-md-12 inputmodal">
                <label for="recipient-name" class="col-form-label">Confirmar Nova Senha:</label>
                <input type="password" name="passRepetirSenha" id="passRepetirSenha" class="form-control" required>
            </div>

            <div class="col-md-12 inputmodal">
                <div id="mostra"></div>
            </div>

	        <button type="submit" class="btn btn-default btn-fill btn-wd">Alterar Senha</button>

        </div>

	</form>

</div>

<script>
function verifica() {
	
	senha = document.getElementById("passNovaSenha").value;
	forca = 0;
	mostra = document.getElementById("mostra");
	if((senha.length >= 4) && (senha.length <= 7)) {
		forca += 10;
	} else if(senha.length>7) {
		forca += 25;
	}
	if(senha.match(/[a-z]+/)) {
		forca += 10;
	}
	if(senha.match(/[A-Z]+/)) {
		forca += 20;
	}
	if(senha.match(/\d+/)) {
		forca += 20;
	}
	if(senha.match(/\W+/)) {
		forca += 25;
	}
	return mostra_res();

}

function mostra_res() {
	
	if(forca < 30) {
		mostra.innerHTML = '<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><p>Senha Fraca</p></div></div>';
	} else if((forca >= 30) && (forca < 60)) {
		mostra.innerHTML = '<div class="progress"><div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><p>Senha Médiana</p></div></div>';
	} else if((forca >= 60) && (forca < 85)) {
		mostra.innerHTML = '<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><p>Senha Ótima</p></div></div>';
	} else {
		mostra.innerHTML = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><p>Senha Excelente</p></div></div>';
	}

}
</script>