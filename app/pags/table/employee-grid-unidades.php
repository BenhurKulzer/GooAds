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
	1 => 'Estado_Unidade',
	2 => 'Sigla_Unidade',
	3 => 'Adicionado_Por',
	4 => 'Data_Unidade',
	5 => 'Hora_Unidade'
);

// PEGA TODOS OS REGISTRO QUANDO NÃO HÁ NENHUMA BUSCA
$sql = "SELECT * ";
$sql.=" FROM sistema_unidades WHERE Contador='1'";
$query=mysqli_query($conn, $sql) or die("employee-grid-unidades.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // quando não há um parâmetro de pesquisa, o número total de linhas = número total de linhas filtradas.

$sql = "SELECT * ";
$sql.=" FROM sistema_unidades WHERE Contador='1' AND 1=1";
if( !empty($requestData['search']['value']) ) {   // SE OUVER ALGO NO PARAMETRO SEARCH, $requestData['search']['value'] CONTÉM O VALOR.
	$sql.=" AND ( ID_C LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR Estado_Unidade LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Sigla_Unidade LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Adicionado_Por LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR Data_Unidade LIKE '%".$requestData['search']['value']."%' )";
	$sql.=" OR Hora_Unidade LIKE '%".$requestData['search']['value']."%' ";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-unidades.php: get employees");
$totalFiltered = mysqli_num_rows($query); // Quando há um parâmetro de pesquisa, temos que modificar o número total de linhas filtradas conforme o resultado da pesquisa.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $ requestData ['order'] [0] ['column'] contém índice COLUMN, $ requestData ['order'] [0] ['dir'] contém ordem como desc / asc */

$query=mysqli_query($conn, $sql) or die("employee-grid-unidades.php: get employees");

$data = array();
while( $tMC=mysqli_fetch_array($query) ) {  // PREPARA O ARRAY

	$acoes = "<button style='background-color: #66615b; color: white; border-color: #66615b; border-radius: 4px;' id='dLabel' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Ações<span style='border-top: 4px solid #fff; vertical-align: middle;' class='caret'></span></button>
            <ul class='dropdown-menu' style='position: inherit !important;' aria-labelledby='dLabel'>
				<li><a rel='tooltip' title='...'><i class='ti-angle-double-right'></i> Editar Unidade </a></li>
                <li><a rel='tooltip' title='...'><i class='ti-angle-double-right'></i> Excluir Unidade </a></li>
            </ul>";


	$ListaDados=array(); 

	$ListaDados[] = "<td><div style='color:red;'>".$tMC["ID_C"]."</div></td>";
	$ListaDados[] = "<td>".$tMC["Estado_Unidade"]."</td>";
	$ListaDados[] = "<td>".$tMC["Sigla_Unidade"]."</td>";
	$ListaDados[] = "<td>".$tMC["Adicionado_Por"]."</td>";
	$ListaDados[] = "<td>".$tMC["Data_Unidade"]."</td>";
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