<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Recuperação dos Dados</a>
            </li>
        </ul>

        <div class="padbot text-right">
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarRecuperacao'>Adicionar Recuperação</button>
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

                                <div><b> Responsável pela Recuperação:</b>           {$tMC['Tecnico_Recuperacao']}</div>
                                <div class='redtext'><b> Recuperação:</b>            {$tMC['Recuperacao_OS']}</div>
                                <div><b> Nível da Recuperação:</b>                   {$tMC['Nivel_Recuperacao_OS']} </div>
                                <div><b> Tamanho dos Dados Recuperados:</b>          {$tMC['Tamanho_Dados_Recuperacao']}</div>
                                <div><b> Cliente Precisa Disponibilizar Mídia:</b>   {$tMC['Precisa_Disponibilizar_Midia_Recuperacao']} </div>
                                <div><b> Tamanho da Mídia Necessitada:</b>           {$tMC['Tamanho_Midia_Gravacao']}</div>
                                <div><b> Recuperação Finalizada:</b>  {$tMC['Finalizada_Recuperacao']}</div>

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

        if ($tID === 'recuperacao') {
            
            $tCampos = "Tecnico_Recuperacao ='{$tResponsavelRecup}',Recuperacao_OS='{$tRecuperacao}',Nivel_Recuperacao_OS='{$tNivelRecup}',Tamanho_Dados_Recuperacao='{$tTamanhoDados}',Precisa_Disponibilizar_Midia_Recuperacao='{$tPrecisaDispon}',Tamanho_Midia_Gravacao='{$tTamanhoGravacao}',Finalizada_Recuperacao='{$tFinalizadaRecup}',Data_Hora_Recuperacao='{$tDataHoraRecupC}',Data_Recuperacao='{$tDataRecupC}',Hora_Recuperacao='{$tHoraRecupC}'";

            $tSql = $tPdo->prepare("UPDATE os_ordens SET {$tCampos} WHERE ID_C ='{$tGet}'");
            $tSql ->execute();

            ////////////////////////////////////////////////////////////////////////////////////////////////////

            if($tSql == TRUE) {

                $tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";
                $tValuesOcorr = "'$tGet','INFORMADA RECUPERAÇÃO DE DADOS: $tNivelRecup','Sistema (Automática)','$tResponsavelRecup','$tDataHoraRecupC','$tDataRecupC','$tHoraRecupC'";
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

<div class="modal fade" id="ModalAdicionarRecuperacao" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarRecuperacao" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Nova Recuperação</h4>
            </div>

            <form action="" method="post">

                <div class="modal-body">

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Recuperação:</label>
                        <textarea type="text" name="txtRecuperacaoC" id="txtRecuperacaoC" class="form-control"><?=$tMC['Recuperacao_OS']?></textarea>
                        <input type="hidden" name="txtID" id="txtID" value="recuperacao">
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Nível de Recuperação:</label>
                        <select type="text" name="txtNivelRecupC" id="txtNivelRecupC" class="form-control" required="">
                            <optgroup label="Selecione o Nível de Dificuldade"></optgroup>
                            <option value="1 - Sucesso (Todos os dados OK)"<?php echo selectBD( '1 - Sucesso (Todos os dados OK)', @$tMC['Nivel_Recuperacao_OS'] ); ?>>1 - Sucesso (Todos os dados OK)</option>
                            <option value="2 - Sucesso (Dados solicitados OK)"<?php echo selectBD( '2 - Sucesso (Dados solicitados OK)', @$tMC['Nivel_Recuperacao_OS'] ); ?>>2 - Sucesso (Dados solicitados OK)</option>
                            <option value="3 - Parcial (Dados solicitados parciais)"<?php echo selectBD( '3 - Parcial (Dados solicitados parciais)', @$tMC['Nivel_Recuperacao_OS'] ); ?>>3 - Parcial (Dados solicitados parciais)</option>
                            <option value="4 - Parcial (Volume de dados)"<?php echo selectBD( '4 - Parcial (Volume de dados)', @$tMC['Nivel_Recuperacao_OS'] ); ?>>4 - Parcial (Volume de dados)</option>
                            <option value="5 - NENHUM DADO RECUPERADO (OS cancelada tecnicamente)"<?php echo selectBD( '5 - NENHUM DADO RECUPERADO (OS cancelada tecnicamente)', @$tMC['Nivel_Recuperacao_OS'] ); ?>>5 - NENHUM DADO RECUPERADO (OS cancelada tecnicamente)</option>
                        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Tamanho dos Dados Recuperados:</label>
                        <input type="text" name="txtTamanhoDadosC" id="txtTamanhoDadosC" class="form-control" value="<?=$tMC['Tamanho_Dados_Recuperacao']?>" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Cliente Precisa Disponibilizar Mídia?</label>
                        <select type="text" name="txtPrecisaDisponibilizarMidiaC" id="txtPrecisaDisponibilizarMidiaC" class="form-control" required="">
                            <option value="Não"<?php echo selectBD( 'Não', @$tMC['Precisa_Disponibilizar_Midia_Recuperacao'] ); ?>>Não</option>
                            <option value="Sim"<?php echo selectBD( 'Sim', @$tMC['Precisa_Disponibilizar_Midia_Recuperacao'] ); ?>>Sim</option>
                        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Tamanho da Mídia Gravação:</label>
                        <select type="text" name="txtTamanhoMidiaGravacaoC" id="txtTamanhoMidiaGravacaoC" class="form-control" required="">
                            <optgroup label="Selecione o Tamanho da Mídia de Gravação"></optgroup>
                            <option value="Nuvem"<?php echo selectBD( 'Nuvem', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>Envio Pela Nuvem</option>
                            <option value="1 DVD"<?php echo selectBD( '1 DVD', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>1 DVD</option>
                            <option value="2 DVDs"<?php echo selectBD( '2 DVDs', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>2 DVD's</option>
                            <option value="10 Gb"<?php echo selectBD( '10 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>10 Gb</option>
                            <option value="20 Gb"<?php echo selectBD( '20 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>20 Gb</option>
                            <option value="40 Gb"<?php echo selectBD( '40 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>40 Gb</option>
                            <option value="80 Gb"<?php echo selectBD( '80 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>80 Gb</option>
                            <option value="160 Gb"<?php echo selectBD( '160 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>160 Gb</option>
                            <option value="300 Gb"<?php echo selectBD( '300 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>300 Gb</option>
                            <option value="400 Gb"<?php echo selectBD( '400 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>400 Gb</option>
                            <option value="500 Gb"<?php echo selectBD( '500 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>500 Gb</option>
                            <option value="750 Gb"<?php echo selectBD( '750 Gb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>750 Gb</option>
                            <option value="1 Tb"<?php echo selectBD( '1 Tb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>1 Tb</option>
                            <option value="1,5 Tb"<?php echo selectBD( '1,5 Tb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>1,5 Tb</option>
                            <option value="2 Tb"<?php echo selectBD( '2 Tb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>2 Tb</option>
                            <option value="3 Tb"<?php echo selectBD( '3 Tb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>3 Tb</option>
                            <option value="4 Tb"<?php echo selectBD( '4 Tb', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>4 Tb</option>
                            <option value="Maior"<?php echo selectBD( 'Maior', @$tMC['Tamanho_Midia_Gravacao'] ); ?>>Maior que 4 Tb</option>
                        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label class="col-form-label">Recuperação Finalizada?</label>
                        <select type="text" name="txtFinalizadaRecupC" id="txtFinalizadaRecupC" class="form-control" required="">
                            <option value="Não"<?php echo selectBD( 'Não', @$tMC['Finalizada_Recuperacao'] ); ?>>Não</option>
                            <option value="Sim"<?php echo selectBD( 'Sim', @$tMC['Finalizada_Recuperacao'] ); ?>>Sim</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Adicionar Recuperação</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>