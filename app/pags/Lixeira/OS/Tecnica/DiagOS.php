<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Diagnóstico da Área Técnica</a>
            </li>
        </ul>

        <div class="padbot text-right">
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarDiagnostico'>Adicionar Diagnóstico</button>
        </div>

        <div class="well table-responsive">
        
                <?php

                    require_once("includes/ConnDatabase.php");

                    $tGet   = decodificarUrl($_GET['CodC']);
                    $tGetC  = $_GET['CodC'];
                    $tSql = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                    $tSql ->execute();

                    $tMC  = $tSql->fetch(PDO::FETCH_ASSOC);

                    echo "
                        
                        <div class='row text-left'>

                            <div class='col-md-8'>

                                <div><b> Responsável pelo Diagnóstico:</b>   {$tMC['Tecnico_Diagnostico']}</div>
                                <div class='redtext'><b> Diagnóstico:</b>                    {$tMC['Diagnostico_OS']}</div>
                                <div><b> Grau de Dificuldade de Recuperação:</b>            {$tMC['Dificuldade_Recuperacao_OS']} </div>
                                <div><b> Tempo Estimado de Recuperação:</b>  {$tMC['Prazo_Estimado_Recuperacao_OS']}</div>

                            </div>

                        </div>

                    ";

                ?>

        </div>
    </div>
</div>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!-- PopModal que faz o cadastro do segundo responsável -->
<?php

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];

    require_once("includes/ConnDatabase.php");
    require_once("includes/LogSistema.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $tResponsavel   = $_SESSION["LOGINUSER"];
        $tDiagnostico   = $_POST['txtDiagnosticoC'];
        $tNivel         = $_POST['txtNivelRecupC'];
        $tPrazo         = $_POST['txtPrazoRecupC'];
        $tID            = $_POST['txtID'];
        
        $tDataHoraC     = date("Y-m-d H:i:s");
        $tDataC         = date("Y-m-d");
        $tHoraC         = date("H:i:s");

        if ($tID === 'diagnostico') {

	        $tCampos = "Tecnico_Diagnostico='{$tResponsavel}',Diagnostico_OS='{$tDiagnostico}',Dificuldade_Recuperacao_OS='{$tNivel}',Prazo_Estimado_Recuperacao_OS='{$tPrazo}',Data_Hora_Diagnostico='{$tDataHoraC}',Data_Diagnostico='{$tDataC}',Hora_Diagnostico='{$tHoraC}'";

	        $tSql = $tPdo->prepare("UPDATE os_ordens SET {$tCampos} WHERE ID_C ='{$tGet}'");
	        $tSql ->execute();

	        ////////////////////////////////////////////////////////////////////////////////////////////////////

	        if($tSql == TRUE) {

	            $tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";
	            $tValuesOcorr = "'$tGet','Lançado Novo Diagnóstico: $tNivel','Sistema (Automática)','$tResponsavel','$tDataHoraC','$tDataC','$tHoraC'";
	            $tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
	            $tSqlOcorr ->execute();

	            $tMensagem = CADASTRARESPSOLICITACAO;
	            echo "<meta http-equiv='refresh' content='0'>";

	        } else {
	            $tMensagem = CADASTRARESPSOLICITACAOERRO;
	            echo "<meta http-equiv='refresh' content='0'>";
	        }

	    }

        ////////////////////////////////////////////////////////////////////////////////////////////////////

    }

?>

<div class="modal fade" id="ModalAdicionarDiagnostico" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarDiagnostico" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Novo Diagnóstico</h4>
            </div>

            <form action="" method="post">
          
                <div class="modal-body">
                            
                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Diagnóstico:</label>
                        <textarea type="text" name="txtDiagnosticoC" id="txtDiagnosticoC" class="form-control"><?=$tMC['Diagnostico_OS']?></textarea>
                        <input type="hidden" name="txtID" id="txtID" value="diagnostico">
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Dificuldade de Acesso aos Dados:</label>
                        <select type="text" name="txtNivelRecupC" id="txtNivelRecupC" class="form-control" required="">
                            <optgroup label="Selecione o Nível de Dificuldade"></optgroup>
                            <option value=""<?php echo selectBD( '', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>Selecione uma Opção</option>
                            <option value="NR 2"<?php echo selectBD( 'NR 2', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>Dados Já Recuperados (100% de Chance)</option>
                            <option value="NR 3"<?php echo selectBD( 'NR 3', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>Alta Chance de Recuperação (Acima de 80%)</option>
                            <option value="NR 4"<?php echo selectBD( 'NR 4', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>Chance Média de Recuperação (Acima de 50%)</option>
                            <option value="IVR" <?php echo selectBD( 'IVR', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>IVR - Baixa Chance de Recuperação (Abaixo de 50%)</option>
                            <option value="NR 5"<?php echo selectBD( 'NR 5', @$tMC['Dificuldade_Recuperacao_OS'] ); ?>>Não é Possível Recuperar os Dados</option>
                        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Tempo Estimado de Recuperação:</label>
                        <select type="text" name="txtPrazoRecupC" id="txtPrazoRecupC" class="form-control" required="">
                            <optgroup label="Selecione o Tempo Estimado"></optgroup>
                            <option value="01 Dia"<?php echo selectBD( '01 Dia', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>01 Dia</option>
                            <option value="02 Dias"<?php echo selectBD( '02 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>02 Dias</option>
                            <option value="03 Dias"<?php echo selectBD( '03 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>03 Dias</option>
                            <option value="04 Dias"<?php echo selectBD( '04 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>04 Dias</option>
                            <option value="05 Dias"<?php echo selectBD( '05 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>05 Dias</option>
                            <option value="06 Dias"<?php echo selectBD( '06 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>06 Dias</option>
                            <option value="07 Dias"<?php echo selectBD( '07 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>07 Dias</option>
                            <option value="08 Dias"<?php echo selectBD( '08 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>08 Dias</option>
                            <option value="09 Dias"<?php echo selectBD( '09 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>09 Dias</option>
                            <option value="10 Dias"<?php echo selectBD( '10 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>10 Dias</option>
                            <option value="11 Dias"<?php echo selectBD( '11 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>11 Dias</option>
                            <option value="12 Dias"<?php echo selectBD( '12 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>12 Dias</option>
                            <option value="13 Dias"<?php echo selectBD( '13 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>13 Dias</option>
                            <option value="14 Dias"<?php echo selectBD( '14 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>14 Dias</option>
                            <option value="15 Dias"<?php echo selectBD( '15 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>15 Dias</option>
                            <option value="16 Dias"<?php echo selectBD( '16 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>16 Dias</option>
                            <option value="17 Dias"<?php echo selectBD( '17 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>17 Dias</option>
                            <option value="18 Dias"<?php echo selectBD( '18 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>18 Dias</option>
                            <option value="19 Dias"<?php echo selectBD( '19 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>19 Dias</option>
                            <option value="20 Dias"<?php echo selectBD( '20 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>20 Dias</option>
                            <option value="21 Dias"<?php echo selectBD( '21 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>21 Dias</option>
                            <option value="22 Dias"<?php echo selectBD( '22 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>22 Dias</option>
                            <option value="23 Dias"<?php echo selectBD( '23 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>23 Dias</option>
                            <option value="24 Dias"<?php echo selectBD( '24 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>24 Dias</option>
                            <option value="25 Dias"<?php echo selectBD( '25 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>25 Dias</option>
                            <option value="26 Dias"<?php echo selectBD( '26 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>26 Dias</option>
                            <option value="27 Dias"<?php echo selectBD( '27 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>27 Dias</option>
                            <option value="28 Dias"<?php echo selectBD( '28 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>28 Dias</option>
                            <option value="29 Dias"<?php echo selectBD( '29 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>29 Dias</option>
                            <option value="30 Dias"<?php echo selectBD( '30 Dias', @$tMC['Prazo_Estimado_Recuperacao_OS'] ); ?>>30 Dias</option>
                        </select>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Diagnóstico</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>