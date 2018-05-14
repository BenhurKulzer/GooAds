<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Gravação de Dados</a>
            </li>
        </ul>

        <div class="padbot text-right">
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarGravacao'>Adicionar Gravação</button>
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

                            <div class='col-md-12'>

                                <div><b> Responsável pela Gravação:</b>             </div>
                                <div><b> Cliente disponibilizou Mídia:</b>          </div>
                                <div><b> Midia Disponibilizada:</b>                 </div>
                                <div class='redtext'><b> Gravação:</b>              </div>
                                <div><b> Cópia Backup em:</b>                       </div>
                                <div><b> Entregue ao departamento:</b>              </div>
                                <div><b> Entregue em mãos de:</b>                   </div>
                                <div><b> Gravação Finalizada:</b>    </div>

                            </div>

                        </div>

                    ";

                ?>

        </div>
    </div>
</div>

<a>.</a>

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
        
        $tResponsavelRecup  = $_SESSION["LOGINUSER"];
        $tRecuperacao       = $_POST['txtRecuperacaoC'];
        $tNivelRecup        = $_POST['txtNivelRecupC'];
        $tID                = $_POST['txtID'];

        $tTamanhoDados      = $_POST['txtTamanhoDadosC'];
        $tPrecisaDispon     = $_POST['txtPrecisaDisponibilizarMidiaC'];
        $tTamanhoGravacao   = $_POST['txtTamanhoMidiaGravacaoC'];
        $tFinalizadaRecup   = $_POST['txtFinalizadaRecupC'];
        
        $tDataHoraRecupC    = date("Y-m-d H:i:s");
        $tDataRecupC        = date("Y-m-d");
        $tHoraRecupC        = date("H:i:s");

        if ($tID === 'gravacao') {
            
            $tCampos = "Tecnico_Recuperacao ='{$tResponsavelRecup}',Recuperacao_OS='{$tRecuperacao}',Nivel_Recuperacao_OS='{$tNivelRecup}',Tamanho_Dados_Recuperacao='{$tTamanhoDados}',Precisa_Disponibilizar_Midia_Recuperacao='{$tPrecisaDispon}',Tamanho_Midia_Gravacao='{$tTamanhoGravacao}',Finalizada_Recuperacao='{$tFinalizadaRecup}',Data_Hora_Recuperacao='{$tDataHoraRecupC}',Data_Recuperacao='{$tDataRecupC}',Hora_Recuperacao='{$tHoraRecupC}'";

            $tSql = $tPdo->prepare("UPDATE os_ordens SET {$tCampos} WHERE ID_C ='{$tGet}'");
            $tSql ->execute();

            ////////////////////////////////////////////////////////////////////////////////////////////////////

            if($tSql == TRUE) {

                #$tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";
                #$tValuesOcorr = "'$tGet','INFORMADA RECUPERAÇÃO DE DADOS: $tNivelRecup','Sistema (Automática)','$tResponsavelRecup','$tDataHoraRecupC','$tDataRecupC','$tHoraRecupC'";
                #$tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
                #$tSqlOcorr ->execute();

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

<div class="modal fade" id="ModalAdicionarGravacao" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarGravacao" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Nova Gravação</h4>
            </div>

            <form action="" method="post">

                <div class="modal-body">

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Cliente disponibilizou Mídia:</label>
                        <select type="text" name="txtFinalizadaRecupC" id="txtFinalizadaRecupC" class="form-control" required="">
                            <option value="Não"<?php echo selectBD( 'Não', @$tMC['Finalizada_Recuperacao'] ); ?>>Não</option>
                            <option value="Sim"<?php echo selectBD( 'Sim', @$tMC['Finalizada_Recuperacao'] ); ?>>Sim</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Gravação</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>