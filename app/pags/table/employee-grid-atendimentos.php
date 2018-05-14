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
	1 => 'Atendente',
	2 => 'MeioAtendimento',
	3 => 'Nome',
	4 => 'Telefone',
	5 => 'Status',
	6 => 'Filial',
	7 => 'Data',
	8 => 'Email'
);

// PEGA TODOS OS REGISTRO QUANDO NÃO HÁ NENHUMA BUSCA
$sql = "SELECT * ";
$sql.=" FROM spa_atendimentos WHERE Contador='1'";
$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // quando não há um parâmetro de pesquisa, o número total de linhas = número total de linhas filtradas.

$sql = "SELECT * ";
$sql.=" FROM spa_atendimentos WHERE Contador='1' AND 1=1";
if( !empty($requestData['search']['value']) ) {   // SE OUVER ALGO NO PARAMETRO SEARCH, $requestData['search']['value'] CONTÉM O VALOR.
	$sql.=" AND ( ID_C LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR Atendente LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR MeioAtendimento LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Nome LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Telefone LIKE '%".$requestData['search']['value']."%' )";
	$sql.=" OR Status LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Filial LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Data LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Email LIKE '%".$requestData['search']['value']."%' ";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");
$totalFiltered = mysqli_num_rows($query); // Quando há um parâmetro de pesquisa, temos que modificar o número total de linhas filtradas conforme o resultado da pesquisa.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $ requestData ['order'] [0] ['column'] contém índice COLUMN, $ requestData ['order'] [0] ['dir'] contém ordem como desc / asc */

$query=mysqli_query($conn, $sql) or die("employee-grid-atendimentos.php: get employees");

$data = array();
while( $tMC=mysqli_fetch_array($query) ) {  // PREPARA O ARRAY

	switch($tMC['Envio_Email']) {                
        case 0  : $tEnvioEmail = "<a rel='tooltip' href='#' title='E-Mail Pendente'><img style='width: 30px;' src='https://www.datarecover.com.br/datasis/sistemas/spa/images/emailNaoEnviado.png'> E-Mail Pendente </a>"; break;
        case 1  : $tEnvioEmail = "<a rel='tooltip' title='E-Mail Enviado'><img style='width: 30px;' src='https://www.datarecover.com.br/datasis/sistemas/spa/images/emailEnviado.png'> E-Mail Enviado </a>"; 	break;
	}

	$acoes = "<ul class='nav navbar-nav navbar-right'>
                <li class='dropdown'>
                    <a href='#notifications' class='dropdown-toggle btn-rotate' data-toggle='dropdown' aria-expanded='true' style='background-color:transparent;'>
                        <button style='background-color: #66615b; color: white; border-color: #66615b; border-radius: 4px; display: flex;'>
                        Ações <i class='ti-angle-double-down' style='margin-left: 5px;'></i>
                        </button>
                    </a>
                    <ul class='dropdown-menu'>
                        <li><a rel='tooltip' href='?controle=OcorrenciasAtendimento&CodC=".codificarUrl($tMC['ID_C'])."' title='Inserir Ocorrências'><i class='ti-angle-double-right'></i> Inserir Ocorrências </a></li>
						<li><a rel='tooltip' href='?controle=EditarAtendimento&CodC=".codificarUrl($tMC['ID_C'])."' title='Editar Atendimento'><i class='ti-marker-alt'></i> Editar Atendimento </a></li>
                    </ul>
                </li>
            </ul>";


	$ListaDados=array(); 

	$ListaDados[] = "<td><div style='color:red;'>".$tMC["ID_C"]."</div></td>";
	$ListaDados[] = "<td>".$tMC["Atendente"]."</td>";
	$ListaDados[] = "<td>".$tMC["MeioAtendimento"]."</td>";
	$ListaDados[] = "<td><a style='color:#0088cc;' class=".$tMC['Midia']." rel='tooltip' href='?controle=Atendimento&CodC=".codificarUrl($tMC['ID_C'])."' title='Visualizar Cadastro'>".$tMC["Nome"]."</a></td>";
	$ListaDados[] = "<td>".$tMC["Telefone"]."</td>";
	
	if ($tMC["Status"] === 'Em Aberto') {
		$ListaDados[] = "<td><span style='color: grey;'>Em Aberto</span></td>";
	} elseif ($tMC["Status"] === 'Em Analise') {
		$ListaDados[] = "<td><span style='color: salmon;'>Em Analise</span></td>";
	} elseif ($tMC["Status"] === 'E-Mail Enviado') {
		$ListaDados[] = "<td><span style='color: green;'>E-Mail Enviado</span></td>";
	} elseif ($tMC["Status"] === 'Sem Interesse') {
		$ListaDados[] = "<td><span style='color: red;'>Sem Interesse</span></td>";
	} elseif ($tMC["Status"] === 'Sem Interesse para a Empresa') {
		$ListaDados[] = "<td><span style='color: red;'>Sem Interesse para a Empresa</span></td>";
	} elseif ($tMC["Status"] === 'Sem Contato') {
		$ListaDados[] = "<td><span style='color: yellow;'>Sem Contato</span></td>";
	} elseif ($tMC["Status"] === 'Pede Urgência') {
		$ListaDados[] = "<td><b style='color: teal;'>Pede Urgência</b></td>";
	} elseif ($tMC["Status"] === 'Pretende Enviar') {
		$ListaDados[] = "<td><span style='color: brown;'>Pretende Enviar</span></td>";
	} elseif ($tMC["Status"] === 'Ligar Novamente') {
		$ListaDados[] = "<td><b style='color: orange;'>Ligar Novamente</b></td>";
	} elseif ($tMC["Status"] === 'Cliente não atende') {
		$ListaDados[] = "<td><span style='color: olive;'>Cliente não atende</span></td>";
	} elseif ($tMC["Status"] === 'Abriu OS') {
		$ListaDados[] = "<td><span style='color: blue;'>Abriu OS</span></td>";
	} else {
		$ListaDados[] = "<td>".$tMC["Status"]."</td>";
	}

	$ListaDados[] = "<td>".$tMC["Filial"]."</td>";
	$ListaDados[] = "<td>".$tMC["Data"]."</td>";
	$ListaDados[] = "<td style='color:red;'>".$acoes."</td>";

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