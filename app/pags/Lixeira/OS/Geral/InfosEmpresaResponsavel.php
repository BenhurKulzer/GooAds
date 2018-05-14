<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informações sobre Empresa/Responsável</a>
            </li>
        </ul>

        <div class="well table-responsive">
        
            <?php

                require_once("includes/ConnDatabase.php");

                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC)) {

                    $TipoPessoa     = $tMC['Tipo_Pessoa_OS'];
                    $Responsavel2   = $tMC['Responsavel_RespAdc_OS'];
                    $Cpf2           = $tMC['CPF_RespAdc_OS'];

                    $cnpj = $tMC['CNPJ_Cliente_OS'];
                    $CnpjSemPontuacao = preg_replace( '#[^0-9]#', '', $cnpj );

                    if ($TipoPessoa == 'PJ') {

                        echo "
                        <div class='row text-left'>

                            <div class='col-md-4'>

                                <div><b> Razão Social:</b>   {$tMC['Razao_Social_OS']}</div>
                                <div><b> CNPJ:</b>           {$tMC['CNPJ_Cliente_OS']}</div>
                                <div><b> CEP:</b>            {$tMC['CEP_Cliente_OS']} </div>
                                <div><b> Estado / Cidade:</b>{$tMC['Estado_Cliente_OS']} / {$tMC['Cidade_Cliente_OS']}</div>
                                <div><b> Endereço:</b>       {$tMC['Endereco_Cliente_OS']} </div>
                                <div><b> Nº / Complemento:</b>{$tMC['Numero_Cliente_OS']} / {$tMC['Complemento_Cliente_OS']} </div>
                                
                            </div>

                            <div class='col-md-4'>

                                <div><b>Responsável:</b>     {$tMC['Responsavel_OS']}</div>
                                <div><b>CPF:</b>             {$tMC['CPF_Resp_OS']}</div>
                                <div><b>E-Mail:</b>          {$tMC['Email_Resp_OS']} </div>
                                <div><b>Telefone:</b>        {$tMC['Telefone_Resp_OS']}</div>
                                <div><b>Telefone2:</b>       {$tMC['Telefone2_Resp_OS']}</div>
                                <div><b>Data Nascimento:</b> {$tMC['DataNasc_Resp_OS']}</div>
                            
                            </div>

                        ";

                    } else {

                        echo "
                        <div class='row'>

                            <div class='col-md-4'>

                                <div><b> Filial:</b>         {$tMC['Filial_OS']} </div>
                                <div><b> CEP:</b>            {$tMC['CEP_Cliente_OS']} </div>
                                <div><b> Estado / Cidade:</b>{$tMC['Estado_Cliente_OS']} / {$tMC['Cidade_Cliente_OS']}</div>
                                <div><b> Bairro:</b>         {$tMC['Bairro_Cliente_OS']} </div>
                                <div><b> Endereço:</b>       {$tMC['Endereco_Cliente_OS']} </div>
                                <div><b> Nº / Complemento:</b>{$tMC['Numero_Cliente_OS']} / {$tMC['Complemento_Cliente_OS']} </div>
                                
                            </div>

                            <div class='col-md-4'>

                                <div><b>Responsável:</b>     {$tMC['Responsavel_OS']}</div>
                                <div><b>CPF:</b>             {$tMC['CPF_Resp_OS']}</div>
                                <div><b>E-Mail:</b>          {$tMC['Email_Resp_OS']} </div>
                                <div><b>Telefone:</b>        {$tMC['Telefone_Resp_OS']}</div>
                                <div><b>Telefone2:</b>       {$tMC['Telefone2_Resp_OS']}</div>
                                <div><b>Data Nascimento:</b> {$tMC['DataNasc_Resp_OS']}</div>
                            
                            </div>

                        ";

                    }

                        if ($Responsavel2 == '') {

                            echo "

                                <div class='col-md-4'>

                                    <button type='button' class='btn btn-success' data-toggle='modal' data-target='#ModalAdicionarResponsavel'>Adicionar Responsável</button>

                                </div>

                            ";

                        } else {

                            echo "

                                <div class='col-md-4'>

                                    <div><b>Responsável 2:</b>   {$tMC['Responsavel_RespAdc_OS']}</div>
                                    <div><b>CPF:</b>             {$tMC['CPF_RespAdc_OS']}</div>
                                    <div><b>E-Mail:</b>          {$tMC['Email_RespAdc_OS']} </div>
                                    <div><b>Telefone:</b>        {$tMC['Telefone_RespAdc_OS']}</div>
                                    <div><b>Telefone 2:</b>      {$tMC['Telefone_RespAdc_OS']}</div>
                                    <div><b>Data Nascimento:</b> {$tMC['DataNasc_RespAdc_OS']}</div>

                                </div>

                            ";

                        }
                                
                    echo "

                        </div>

                    ";

                }

            ?>

            <div class="col-md-12">
                <?php if(isset($tMensagem)){ echo $tMensagem;}?>
            </div>

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
        
        $tNomeRespC     = $_POST['txtNomeRespC'];
        $tCPF           = $_POST['txtCpfC'];
        $tDataNasc      = $_POST['txtDataNascimentoC'];
        $tEmail         = $_POST['txtEmailC'];
        $tTelefone      = $_POST['Telefone'];

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

            $tValuesOcorr = "'$tGet','Adicionado Responsável: $tNomeRespC','Sistema (Automática)','$tRespAdicC','$tDataHoraRespC','$tDataRespC','$tHoraRespC'";

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
<div class="modal fade" id="ModalAdicionarResponsavel" tabindex="-1" role="dialog" aria-labelledby="ModalAdicionarResponsavel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
            <div class="modal-header text-centro">
                <h4 class="modal-title" id="exampleModalLongTitle">Adicionar Responsável a esta Ordem de Serviço</h4>
            </div>

            <form action="" method="post">
          
                <div class="modal-body">
                            
                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Nome do Responsável:</label>
                        <input type="text" name="txtNomeRespC" id="txtNomeRespC" class="form-control" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">CPF do Responsável:</label>
                        <input type="text" name="txtCpfC" id="txtCpfC" onkeyup="mascara(this, mcpf);" class="form-control" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">E-Mail do Responsável:</label>
                        <input type="email" name="txtEmailC" id="txtEmailC" class="form-control" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Telefone do Responsável:</label>
                        <input type="text" name="Telefone" id="Telefone" minlength="14" maxlength="15" onkeyup="mascara(this, mtel);" class="form-control" required>
                    </div>

                    <div class="col-md-12 inputmodal">
                        <label for="recipient-name" class="col-form-label">Data de Nascimento do Responsável:</label>
                        <input type="text" name="txtDataNascimentoC" id="txtDataNascimentoC" minlength="9" maxlength="10" onkeyup="mascara(this, mdat);" class="form-control" required>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <div class="inputmodal">
                        <button type="submit" class="btn btn-default">Cadastrar Novo Responsável</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
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
    
    function mtel(v){
        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }

    function mdat(v){
        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
        v=v.replace(/^(\d{2})(\d)/g,"$1/$2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{4})$/,"$1/$2");    //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }

    function mcpf(v){
        v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
</script>