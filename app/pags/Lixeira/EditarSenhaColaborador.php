<script>
	function verifica(){
		
		senha = document.getElementById("passSenhaC").value;
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

	function mostra_res(){

		if(forca < 30) {
			mostra.innerHTML = '<div class="alert alert-danger col-md-12" width="'+forca+'"> <b> Senha Fraca </b> </div>';
		} else if((forca >= 30) && (forca < 60)) {
			mostra.innerHTML = '<div class="alert alert-warning" width="'+forca+'"> <b> Senha Regular </b> </div>';;
		} else if((forca >= 60) && (forca < 85)) {
			mostra.innerHTML = '<div class="alert alert-info" width="'+forca+'"> <b> Senha Forte </b> </div>';
		} else {
			mostra.innerHTML = '<div class="alert alert-success" width="'+forca+'"> <b> Senha Excelente </b> </div>';
		}

	}
</script>

<?php

	// Código que define os dados para efetuar edição na conta de usuario

	require_once("includes/ConnDatabase.php");
	$tGet   = decodificarUrl($_GET['CodC']);
  	$tGetC  = $_GET['CodC'];
  	$tSqlEC = $tPdo->prepare("SELECT * FROM usuarios_colaboradores WHERE ID_USER ='{$tGet}'"); 
  	$tSqlEC ->execute();
  	$tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$tID	  = $_POST['hidID'];
		$tIDU	  = $_POST['hidIDU'];
		
		$tSeNova		=  addslashes(trim($_POST['passNovaSenha']));
		$reNovaSenha 	=  addslashes(trim($_POST['passRepetirSenha']));
		$tSeNcpt        = criptografar($tSeNova    ,"k49fdk4030d");
		$tSeRcpt        = criptografar($reNovaSenha,"k49fdk4030d");

		$tSqlPS = $tPdo->prepare("SELECT SENHA_U FROM usuarios_colaboradores WHERE ID_USER ='{$tID}'");	
		$tSqlPS ->execute();
		$tV     = $tSqlPS->fetch(PDO::FETCH_ASSOC);
		$tSenha = $tV['SENHA_U'];
		
		if((!strcmp($tSeNcpt,$tSeRcpt))) {
			
			$tSqlPSA = $tPdo->prepare("UPDATE usuarios_colaboradores SET SENHA_U ='{$tSeNcpt}' WHERE ID_USER ='{$tID}'");	
			$tSqlPSA -> execute();	
			$tMensagem = "<div class='alert alert-success'>Senha de Usuário atualizada com sucesso!</div><meta HTTP-EQUIV = 'Refresh' CONTENT = '0; URL =?controle=ListaDeUsuarios'>";

		}		
		else {
			$tMensagem = "<div class='alert alert-warning'>As novas senhas não conferem, Por favor, tente novamente!</div>";
		}

	} //FIM REQUEST POST
?>

<div class="card">

    <form method="post" action="?controle=EditarSenhaColaborador&CodC=<?=$tGetC;?>" enctype="multipart/form-data">
        
        <div class="card-header">
		    <h4 class="card-title">
		    	<div class="col-md-8">
		    		Editar senha do Colaborador <strong class="text-red"><?=$tMC['NOME_SOCIAL_U'];?></strong>
		    	</div>
				<div class="col-md-4 text-right">
					<button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
				</div>
			</h4>
			<hr>
		</div>
        
        <div class="card-content">

        	<?php if(isset($tMensagem)){ echo $tMensagem;}?>
        	
	            <div class="form-group col-md-12">
	            	<hr>
	                <input type="hidden" name="hidIDC" id="hidIDC" value="<?=$tGetC;?>">
	                <input type="hidden" name="hidID" id="hidID" value="<?=$tGet;?>">
	            </div>

	            <div class="form-group col-md-12">
	                <label>Nova Senha</label>
	                <input type="password" name="passNovaSenha" id="passNovaSenha" class="form-control" onkeyup="javascript:verifica()">
	            </div>

	            <div class="form-group col-md-12">
	                <label>Repetir Senha</label>
	                <input type="password" name="passRepetirSenha" id="passRepetirSenha" class="form-control" onkeyup="javascript:verifica()">
	            </div>


	            <div class="form-group col-md-12">
	                <hr>
	            </div>

	        	<button type="submit" class="btn btn-default btn-fill btn-wd">Editar Senha Colaborador</button>

        </div>

	</form>

</div>

<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
   v_obj=o
   v_fun=f
   setTimeout("execmascara()",1)
}
function execmascara(){
   v_obj.value=v_fun(v_obj.value)
}
function mcpf(v){
   v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
function id( el ){
return document.getElementById( el );
}
window.onload = function(){
id('txtCpfC').onkeyup = function(){
mascara( this, mcpf );
}
}
</script>