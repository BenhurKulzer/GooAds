<?php

require('includes/ConnDatabasePreos.php');

// SALVANDO O REQUEST (ie, get/post) ARRAY GLOBAL PARA A VARIABEL
$requestData= $_REQUEST;

$columns = array( 
// COLUNA DB - INDEX  => COLUNA DB - NOME
	0 => 'ID_C',
	1 => 'Nome_Completo',
	2 => 'Email',
	3 => 'Telefone',
	4 => 'Data',
	5 => 'Hora'
);

// PEGA TODOS OS REGISTRO QUANDO NÃO HÁ NENHUMA BUSCA
$sql = "SELECT * ";
$sql.=" FROM spa_preos WHERE 1=1";
$query=mysqli_query($conn, $sql) or die("employee-grid-preos.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // quando não há um parâmetro de pesquisa, o número total de linhas = número total de linhas filtradas.

$sql = "SELECT * ";
$sql.=" FROM spa_preos WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // SE OUVER ALGO NO PARAMETRO SEARCH, $requestData['search']['value'] CONTÉM O VALOR.
	$sql.=" AND ( ID_C LIKE '%".$requestData['search']['value']."%' ";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-preos.php: get employees");
$totalFiltered = mysqli_num_rows($query); // Quando há um parâmetro de pesquisa, temos que modificar o número total de linhas filtradas conforme o resultado da pesquisa.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $ requestData ['order'] [0] ['column'] contém índice COLUMN, $ requestData ['order'] [0] ['dir'] contém ordem como desc / asc */

$query=mysqli_query($conn, $sql) or die("employee-grid-preos.php: get employees");

$data = array();
while( $tMC=mysqli_fetch_array($query) ) {  // PREPARA O ARRAY


	$ListaDados=array(); 

	$ListaDados[] = "<td><div style='color:red;'># ".$tMC["Numero_Form"]."</div></td>";
	$ListaDados[] = "<td>".$tMC["Cliente_Form"]."</td>";
	$ListaDados[] = "<td>".$tMC["Email_Cliente"]."</td>";
	$ListaDados[] = "<td>".$tMC["Telefone_Cliente"]."</td>";
	$ListaDados[] = "<td><div style='color:red;'>".$tMC["Data_Form"]."</div> às ".$tMC["Hora_Form"]."</td>";

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