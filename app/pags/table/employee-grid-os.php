<?php

require('includes/ConnDatabase.php');

// CODIFICAR URL ----------------------------------------------------------------------
    function codificarUrl($str)
    {
        $prfx = array('AFVxaIF', 'Vzc2ddS', 'ZEca3d1', 'aOdhlVq', 'QhdFmVJ', 'VTUaU5U',
                  'QRVMuiZ', 'lRZnhnU', 'Hi10dX1', 'GbT9nUV', 'TPnZGZz', 'ZGiZnZG',
                  'dodHJe5', 'dGcl0NT', 'Y0NeTZy', 'dGhnlNj', 'azc5lOD', 'BqbWedo',
                  'bFmR0Mz', 'Q1MFjNy', 'ZmFMkdm', 'dkaDIF1', 'hrMaTk3', 'aGVFsbG');
        for($i=0; $i<3; $i++)
        {
          $str = $prfx[array_rand($prfx)].strrev(base64_encode($str));
        }
        $str = strtr($str,"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
                     "a8rqxPtfiNOlYFGdonMweLCAm0TXERcugBbj79yDVIWsh3Z5vHS46pQzKJ1Uk2");
        return $str;
    }//FIM

// SALVANDO O REQUEST (ie, get/post) ARRAY GLOBAL PARA A VARIABEL
$requestData= $_REQUEST;

$columns = array( 
// COLUNA DB - INDEX  => COLUNA DB - NOME
	0 => 'ID_C',
	1 => 'Filial_OS',
	2 => 'Razao_Social_OS',
	3 => 'Responsavel_OS',
	4 => 'Modalidade_OS',
	5 => 'Responsavel_RespAdc_OS',
    6 => 'CPF_RespAdc_OS',
    7 => 'CPF_Resp_OS',
    8 => 'CNPJ_Cliente_OS',
    9 => 'Data_OS'
);

// PEGA TODOS OS REGISTRO QUANDO NÃO HÁ NENHUMA BUSCA
$sql = "SELECT * ";
$sql.=" FROM os_ordens";
$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // quando não há um parâmetro de pesquisa, o número total de linhas = número total de linhas filtradas.

$sql = "SELECT * ";
$sql.=" FROM os_ordens WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // SE OUVER ALGO NO PARAMETRO SEARCH, $requestData['search']['value'] CONTÉM O VALOR.
	$sql.=" AND ( ID_C LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR Filial_OS LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Razao_Social_OS LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Responsavel_OS LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR Modalidade_OS LIKE '%".$requestData['search']['value']."%' )";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");
$totalFiltered = mysqli_num_rows($query); // Quando há um parâmetro de pesquisa, temos que modificar o número total de linhas filtradas conforme o resultado da pesquisa.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $ requestData ['order'] [0] ['column'] contém índice COLUMN, $ requestData ['order'] [0] ['dir'] contém ordem como desc / asc */

$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");

$data = array();
while( $tMC=mysqli_fetch_array($query) ) {  // PREPARA O ARRAY

	switch($tMC['Tipo_Pessoa_OS']) {
        case "PF"	: $tCliente 	= $tMC['Responsavel_OS']; 				break;
        case "PJ"	: $tCliente		= $tMC['Razao_Social_OS'];				break;
        default 	: $tCliente 	= $tMC['Responsavel_OS'];				break;
    }

	switch($tMC['Modalidade_OS']) {
        case "urgencia"	: $tModalidade 	= "<b style='color: red;'>Urgência</b>";break;
        case "standard"	: $tModalidade 	= "Standard";  							break;
        default 	    : $tModalidade 	= "Standard";							break;
    }

    if ($tMC['Modalidade_OS'] == 'standard') {
        switch($tMC['TAXA_QUITADA_OS']) {
            default     : $tTaxaQuitada = "<b style='color: #ff0000;'>Sim</b>"; break;
        }
    } else {
        switch($tMC['TAXA_QUITADA_OS']) {
            case 0      : $tTaxaQuitada = "Não";                                break;
            case 1      : $tTaxaQuitada = "<b style='color: #ff0000;'>Sim</b>"; break;
            default     : $tTaxaQuitada = "Não";                                break;
        }
    }
    

  	switch($tMC['Diagnostico_OS']) {
        case ''		: $tDiagnostico	= "Não";   								break;
        default 	: $tDiagnostico = "<b style='color: #ff0000;'>Sim</b>"; break;
    }

  	switch($tMC['Recuperacao_OS']) {
        case ''		: $tRecup 		= "Não";								break;
        default 	: $tRecup 		= "<b style='color: #ff0000;'>Sim</b>"; break;
    }

    $acoes = "<ul class='nav navbar-nav navbar-right'>
                <li class='dropdown'>
                    <a href='#notifications' class='dropdown-toggle btn-rotate' data-toggle='dropdown' aria-expanded='true' style='background-color:transparent;'>
                        <button style='background-color: #66615b; color: white; border-color: #66615b; border-radius: 4px; display: flex;'>
                        Ações <i class='ti-angle-double-down' style='margin-left: 5px;'></i>
                        </button>
                    </a>
                    <ul class='dropdown-menu'>
                        <li><a href='#' rel='tooltip' title='Imprimir Via para a Empresa'><i class='ti-printer'> </i> Gerar Via OS </a></li>
                        <li><a rel='tooltip' href='?controle=EditarOS&CodC=".codificarUrl($tMC['ID_C'])."' title='Editar Ordem de Serviço'><i class='ti-marker-alt'> </i> Editar OS </a></li>
                    </ul>
                </li>
            </ul>";

	$ListaDados=array(); 

	$ListaDados[] = "<td><div style='color:red;'>".$tMC["Filial_OS"]." - ".$tMC["ID_C"]."</div></td>";
	$ListaDados[] = "<td><a style='color:#0088cc;' class=".$tMC['Midia']." rel='tooltip' href='?controle=OrdemDeServicoGeral&CodC=".codificarUrl($tMC['ID_C'])."' title='Visualizar Cadastro'>".$tCliente."</a></td>";
	$ListaDados[] = "<td>".$tModalidade."</td>";
	$ListaDados[] = "<td>".$tTaxaQuitada."</td>";
	$ListaDados[] = "<td>".$tDiagnostico."</td>";
	$ListaDados[] = "<td>X</td>";
	$ListaDados[] = "<td>".$tRecup."</td>";
	$ListaDados[] = "<td>".$tMC["Data_OS"]."</td>";
	$ListaDados[] = "<td>".$acoes."</td>";

	$data[] = $ListaDados;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // para cada pedido / sorteio por parte do cliente, eles enviam um número como um parâmetro, quando recebem uma resposta / dados, eles primeiro verificam o número do sorteio, então estamos enviando o mesmo número em sorteio.
			"recordsTotal"    => intval( $totalData ),  // numero total de registros
			"recordsFiltered" => intval( $totalFiltered ), // número total de registros após a busca, se não houver pesquisa, então totalFiltered = totalData
			"data"            => $data   // todo conteudo array data
			);

echo json_encode($json_data);  // Envia os dados em JSON

?>