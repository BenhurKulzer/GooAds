<?php
	
	require_once("includes/ConnDatabase.php");

	$tGet   = $_SESSION['LOGINUSER'];
    $tSql = $tPdo->prepare("SELECT * FROM usuarios_colaboradores WHERE NOME_SOCIAL_U='{$tGet}'");
    $tSql ->execute();
    $tMC  = $tSql->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">

    <div class="col-lg-5 col-md-5">
        <div class="card card-user">
            <div class="image">
                <?php
              		if ($_SESSION["FOTOUSER"] !== '') {
              			echo '<img src="up_arquivos/Sistema/1.jpg" alt="...">';
              		} else {
              			echo '<img src="up_arquivos/Sistema/1.jpg" alt="...">';
              		}
              	?>
            </div>

            <div class="author" style="margin-top: -58px;">
                <?php
                    if ($_SESSION["FOTOUSER"] !== '') {
                        echo '<img class="sistema border-white" src="https://soshdrecuperacaodedados.com.br/assets/images/soslogo.png" style="background-color: #fff;">';
                    } else {
                        echo '<img class="sistema border-white" src="https://soshdrecuperacaodedados.com.br/assets/images/soslogo.png" style="background-color: #fff;">';
                    }
                ?>
            </div>
            <hr>
            <div class="alinhamento-centralizado">
                <div class="row" style="cursor: pointer;">
                    <div class="col-md-6 pad20" data-toggle='modal' data-target='#ModalAlteraFotoCapa'>
                        <div><img src="up_arquivos/Usuarios/BackDefault.png"></div>
                        <p>Alterar Background</p>
                    </div>
                    <div class="col-md-6 pad20" data-toggle='modal' data-target='#ModalAlteraFotoPerfil'>
                        <div><img src="up_arquivos/Sistema/logo.png"></div>
                        <p>Alterar Logo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-md-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Dados do Sistema</h4>
                <hr>
            </div>
            <div class="card-content">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Razão Social</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CNPJ</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do Sistema</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sigla Sistema</label>
                                <input type="text" class="form-control border-input" maxlength="3" value="<?=$tMC['NOME_SOCIAL_U']?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Título no Navegador</label>
                                <input type="text" class="form-control border-input" maxlength="3" value="<?=$tMC['NOME_SOCIAL_U']?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default">Salvar Alterações</button>
                    </div>
                    
                    <div class="clearfix"></div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-md-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Dados Bancarios do Sistema</h4>
                <hr>
            </div>
            <div class="card-content">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instituição Bancaria</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agencia</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Conta</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operação (Se houver)</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default">Salvar Alterações</button>
                    </div>
                    
                    <div class="clearfix"></div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7 col-md-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Telefones do Sistema</h4>
                <hr>
            </div>
            <div class="card-content">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instituição Bancaria</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agencia</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Conta</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operação (Se houver)</label>
                                <input type="text" class="form-control border-input" maxlength="12" value="<?=$tMC['NOME_U']?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default">Salvar Alterações</button>
                    </div>
                    
                    <div class="clearfix"></div>

                </form>
            </div>
        </div>
    </div>

</div>


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- PopModal que faz o cadastro do segundo responsável -->
<?php

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];

    require_once("includes/ConnDatabase.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////////////////////////////////////////////////

	    $tConta             = $_FILES['filFoto']['name'];
	    $tID 				= $_POST['txtID'];
	    $tAdicionadoPor     = $_SESSION["LOGINUSER"];


		if ($tID === 'FotoCapa') {

		    // Define para Onde serão Upados os arquivos e o tipo de imagens aceitas pelo input file

	    	$tDir    = 'up_arquivos/Usuarios/';
	    	$tArray  = array("application/pdf","image/jpeg","image/jpg","image/gif","image/png","image/bmp");

	    	// Função faz o envio do código caso possua somente uma foto

	        $tPega1     = explode(".",$tConta);
	        $tImagemCt  = md5(uniqid(time())) . $tPega1[0];
	        $tImagemCt .= "." . $tPega1[1];
	        $tUpload1   = $tDir . $tImagemCt;
	        
	        if(!in_array($_FILES['filFoto']['type'],$tArray)){echo ARQUIVOAVISO;}
	        
	        move_uploaded_file($_FILES['filFoto']['tmp_name'], $tUpload1);

	        $tCampos = "FotoCapa_U='{$tImagemCt}'";
	            
	        $tSql = $tPdo->prepare("UPDATE usuarios_colaboradores SET {$tCampos} WHERE NOME_SOCIAL_U ='{$tAdicionadoPor}'");
	        $tSql ->execute();

		} elseif ($tID === 'FotoPerfil') {
			
			// Define para Onde serão Upados os arquivos e o tipo de imagens aceitas pelo input file

	    	$tDir    = 'up_arquivos/Usuarios/';
	    	$tArray  = array("application/pdf","image/jpeg","image/jpg","image/gif","image/png","image/bmp");

	    	// Função faz o envio do código caso possua somente uma foto

	        $tPega1     = explode(".",$tConta);
	        $tImagemCt  = md5(uniqid(time())) . $tPega1[0];
	        $tImagemCt .= "." . $tPega1[1];
	        $tUpload1   = $tDir . $tImagemCt;
	        
	        if(!in_array($_FILES['filFoto']['type'],$tArray)){echo ARQUIVOAVISO;}
	        
	        move_uploaded_file($_FILES['filFoto']['tmp_name'], $tUpload1);

	        $tCampos = "FotoPerfil_U='{$tImagemCt}'";
	            
	        $tSql = $tPdo->prepare("UPDATE usuarios_colaboradores SET {$tCampos} WHERE NOME_SOCIAL_U ='{$tAdicionadoPor}'");
	        $tSql ->execute();

		} else {

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
				
		}

	    if($tSql == TRUE) {
	    	echo "<meta http-equiv='refresh' content='0'>";
	    } else {
	    	echo "<meta http-equiv='refresh' content='0'>";
	    }

	}// FIM DO MÉTODO POST

?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="modal fade" id="ModalAlteraFotoCapa" tabindex="-1" role="dialog" aria-labelledby="ModalAlteraFotoCapa" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Nova Foto de Capa</h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Imagem/Foto de Capa:</label>
                        <input type="file" name="filFoto" id="filFoto" class="form-control" required>
                        <input type="hidden" name="txtID" id="txtID" value="FotoCapa">
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Nova Foto de Capa</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="modal fade" id="ModalAlteraFotoPerfil" tabindex="-1" role="dialog" aria-labelledby="ModalAlteraFotoPerfil" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Nova Foto de Perfil</h4>
                <h5 style="color: red;" class="modal-title" id="exampleModalLongTitle">A alteração será aplicada na próxima vez que você acessar o sistema.</h5>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Imagem/Foto de Perfil:</label>
                        <input type="file" name="filFoto" id="filFoto" class="form-control" required>
                        <input type="hidden" name="txtID" id="txtID" value="FotoPerfil">
                    </div>

                    <div class="col-md-12 inputmodal">
                        <hr>
                        <p style="color: red;" class="modal-title" id="exampleModalLongTitle">A alteração será aplicada na próxima vez que você acessar o sistema.</p>
                        <hr>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Nova Foto de Capa</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="modal fade" id="ModalAlteraSenha" tabindex="-1" role="dialog" aria-labelledby="ModalAlteraSenha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Alterar Senha do Usuário</h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">

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

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Alterar Senha de Usuário</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
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