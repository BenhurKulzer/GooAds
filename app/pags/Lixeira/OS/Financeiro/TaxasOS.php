<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="lib/js/jquery.maskMoney.js" type="text/javascript"></script>

<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <div><button type='button' class='btn btn-success marbot10' data-toggle='modal' data-target='#ModalOcorrenciasFinanceiro'> Ocorrências Financeiro</button></div>
        </ul>

        <div class="well">
            
            <?php

                // Código que define os dados que serão exibidos nas tabelas 
                require_once("includes/ConnDatabase.php");
                       
                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC)) {

                    if ($tMC['TAXA_QUITADA_OS'] == '1') {
                        switch($tMC['Modalidade_OS']) {
                            case 'urgencia': $StatusTaxa = "<b class='text-success'>Pagamento Realizado!</b> <i class='text-success'>(Comprovante Disponível Abaixo)</i>"; break;
                            default: $StatusTaxa = "<b class='text-info'>Não se aplica nesta OS</b>";    break;
                        }
                    } else {
                        switch($tMC['Modalidade_OS']) {
                            case 'urgencia': $StatusTaxa = "<b class='text-red'>Taxa Pendente!</b> <i class='text-red'>(Algumas Funções estarão bloqueadas até o pagamento desta Taxa)</i>"; break;
                            default: $StatusTaxa = "<b class='text-info'>Não se aplica nesta OS</b>";    break;
                        }   
                    }

                    echo "
                        
                        <div class='row'>

                            <div class='col-md-12'>

                                <div><b> Status Taxa:</b>      $StatusTaxa</div>
                            
                            </div>

                    ";

                        if ($tMC['TAXA_QUITADA_OS'] == '1') {
                            echo 
                                "<div class='col-md-12'>
                                    <div><b>Comprovante de Quitação:</b>   <img class='img-circle' src='/images/foto.png'></div>
                                </div>
                            ";
                        }

                    echo "
                        </div>
                    ";
                }
            ?>

        </div>

    </div>
</div>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////-->

<?php

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];

    require_once("includes/ConnDatabase.php");
    require_once("includes/LogSistema.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $tIDFoto        = $_POST['tIDFoto'];
        $tValor                 = $_POST['txtValorC'];

        $tRespAdicC     = $_SESSION["LOGINUSER"];
        $tDataHoraRespC = date("Y-m-d H:i:s");
        $tDataRespC     = date("Y-m-d");
        $tHoraRespC     = date("H:i:s");
            
        $tCampos = "Responsavel_RespAdc_OS='{$tNomeRespC}',CPF_RespAdc_OS='{$tCPF}',DataNasc_RespAdc_OS='{$tDataNasc}',Email_RespAdc_OS='{$tEmail}',Telefone_RespAdc_OS='{$tTelefone}',AdicionadoPor_RespAdc_OS='{$tRespAdicC}',Data_RespAdc_OS='{$tDataRespC}',Hora_RespAdc_OS='{$tHoraRespC}'";

        $tSql = $tPdo->prepare("UPDATE os_ordens SET {$tCampos} WHERE ID_C ='{$tGet}'");
        $tSql ->execute();

        ////////////////////////////////////////////////////////////////////////////////////////////////////

        if($tSql == TRUE) {

            $tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";

            $tValuesOcorr = "'$tGet','tIDFoto no valor de $tValor','Sistema (Automática)','$tRespAdicC','$tDataHoraRespC','$tDataRespC','$tHoraRespC'";

            $tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
            $tSqlOcorr ->execute();

            $tMensagem = CADASTRARESPSOLICITACAO;
            echo "<meta http-equiv='refresh' content='0'>";

        } else {
            $tMensagem = CADASTRARESPSOLICITACAOERRO;
            echo "<meta http-equiv='refresh' content='0'>";
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////

    }

?>

<?php

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];

    require_once("includes/ConnDatabase.php");

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $tIDFoto            = $_POST['tIDFoto'];
        $tDescricao         = $_POST['tDescricao'];
        $tNumeroOS          = $_POST['tNumeroOS'];
        $tConta             = $_FILES['filFoto']['name'];

        $tAdicionadoPor     = $_SESSION["LOGINUSER"];

        $tDataHoraC         = date("Y-m-d H:i:s");
        $tDataC             = date("Y-m-d");
        $tHoraC             = date("H:s:i");

        // Define para Onde serão Upados os arquivos e o tipo de imagens aceitas pelo input file

            $tDir    = 'up_arquivos/FotosOS/';
            $tArray  = array("application/pdf","image/jpeg","image/jpg","image/gif","image/png","image/bmp");

        // Função faz o envio do código caso possua somente uma foto

        $tPega1     = explode(".",$tConta);
        $tImagemCt  = md5(uniqid(time())) . $tPega1[0];
        $tImagemCt .= "." . $tPega1[1];
        $tUpload1   = $tDir . $tImagemCt;
        
        if(!in_array($_FILES['filFoto']['type'],$tArray)){echo ARQUIVOAVISO;    }
        
        move_uploaded_file($_FILES['filFoto']['tmp_name'], $tUpload1);
        
        $tCampos = "ID_Foto,Descricao_Foto,Numero_OS_Foto,Imagem_Foto,Adicionado_Por,Data_Hora_Foto,Data_Foto,Hora_Foto";
        $tValues = "'$tIDFoto','$tDescricao','$tNumeroOS','$tImagemCt','$tAdicionadoPor','$tDataHoraC','$tDataC','$tHoraC'";
            
        $tSql = $tPdo->prepare("INSERT INTO os_fotos ({$tCampos}) VALUES ({$tValues})");
        $tSql ->execute();

        if($tSql == TRUE) {

            $tCamposOcorr = "ID_Identificacao,Descricao_Ocorrencia,Tipo_Ocorrencia,Adicionado_Por,Data_Hora_Ocorrencia,Data_Ocorrencia,Hora_Ocorrencia";
            $tValuesOcorr = "'$tGet','tIDFoto no valor de $tValor','Sistema (Automática)','$tRespAdicC','$tDataHoraRespC','$tDataRespC','$tHoraRespC'";

            $tSqlOcorr = $tPdo->prepare("INSERT INTO os_ocorrencias ({$tCamposOcorr}) VALUES ({$tValuesOcorr})");
            $tSqlOcorr ->execute();

            $tMensagem = CADASTROSUCESSO;
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            $tMensagem = CADASTROERRO;
            echo "<meta http-equiv='refresh' content='0'>";
        }

    }// FIM DO MÉTODO POST

?>
<div class="modal fade" id="ModalOcorrenciasFinanceiro" tabindex="-1" role="dialog" aria-labelledby="ModalOcorrenciasFinanceiro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Ocorrência a Ordem de Serviço</h4>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
          
                <div class="modal-body">

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">ID da Foto:</label>
                        <select type="text" name="tIDFoto" id="tIDFoto" class="form-control" required>
                        
                            <optgroup label="Pagamentos"></optgroup>
                            <option value="Pagamento - Entrada">21 - Pagamento - Entrada</option>
                            <option value="Pagamento - Saldo">22 - Pagamento - Saldo</option>
                            <option selected value="Pagamento - Taxa Diagnóstico">23 - Pagamento - Taxa Diagnóstico</option>
                            <option value="Pagamento - Outros">24 - Pagamento - Outros</option>
                            <option value="Pagamento - Taxa FRETE Mídia OS">30 - Pagamento - Taxa Frete Mídia OS</option>
                            <option value="Pagamento - Taxa FRETE Mídia Gravação">31 - Pagamento - Taxa Frete Mídia Gravação</option>

                            <optgroup label="Notas Fiscais"></optgroup>
                            <option value="Nota Fiscal - Taxas">32 - Nota Fiscal - Taxas</option>
                            <option value="Nota Fiscal - Entrada">33 - Nota Fiscal - Entrada</option>
                            <option value="Nota Fiscal - Saldo">34 - Nota Fiscal - Saldo</option>
                            <option value="Nota Fiscal - Mídia Gravação">35 - Nota Fiscal - Mídia Gravação</option>

                        </select>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input type="text" name="txtValorC" id="valor" class="form-control" required/>        
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Imagem em Anexo:</label>
                        <input type="file" name="filFoto" id="filFoto" class="form-control" required>
                    </div>
                    
                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Observação:</label>
                        <textarea type="text" name="Descricao" id="Descricao" class="form-control"></textarea>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-success">Adicionar Ocorrência</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="lib/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){ $("#valor").maskMoney(); })

    $(function(){ $("#demo4").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true}); })
</script>