<?php 

// CONFIGURAÇÃO PAGINAS --------------------------------------------------------------
function LinkPaginas ($tGet, $tInicio, $tPasta)
{
	 $tGet = (isset($tGet)) ? $tGet : '';
	 $tGet = trim($tGet);
	 $tGet = strip_tags($tGet);
	 
	 if(empty($tGet)){
		 include("$tPasta/$tInicio");
	 }
	 elseif(preg_match("/\.(http|www|.php|.asp|.exe|.gif|.jpg|){1}$/i",$tGet)){

	   include("$tPasta/$tInicio");
		  }
	 elseif(!file_exists("$tPasta/$tGet.php")){

	  include("$tPasta/$tInicio");}
	 else{

	   include("$tPasta/$tGet.php");
		}

}

// CRIPTOGRAFAR SENHA -----------------------------------------------------------------
	function  criptografar($senha,$chave)
	{
		$txt  = strrev($senha); 
		$txt  = str_repeat(md5($txt),2); 
		$txt  = md5($txt); 
		$txt .= md5($chave); 
		$txt  = md5($txt); 
		return $txt;
	}

//FORMATAR DATAS -----------------------------------------------------------------------
	function dataBr($tDataUs)
	{
		$tDt = implode("/", array_reverse(explode("-",$tDataUs)));
		return $tDt;
	}
	
	 function dataUs($tDataBr)
	{
		$tDt = implode("-", array_reverse(explode("/",$tDataBr)));
		return $tDt;
	}//FIM

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
	}
	
	function decodificarUrl($str)
	{
		$str = strtr($str,"a8rqxPtfiNOlYFGdonMweLCAm0TXERcugBbj79yDVIWsh3Z5vHS46pQzKJ1Uk2",
					 "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");
		for($i=0; $i<3; $i++)
		{
		  $str = base64_decode(strrev(substr($str,7)));
		}
		return $str;
	}//FIM


// EXIBINDO NOME DA LOCALIZAÇÃO NAS PÁGINAS ---------------------------------------------
	function LocalizacaoPagina($tGetPagina)
	{
		switch ($_GET['controle'])
		{
			case "Home":               echo "Home"; 					   break;
			case "FormCadastroContas": echo "Página de Cadastro Clientes";  break;
			case "ListaDeContas":      echo "Página Lista de Atendimentos "; break;
			case "ListaProcessoSeletivo":      echo "Página Avançada de Lista de Atendimentos "; break;
			case "PesquisaAvancada":   echo "Página Pesquisa Avançada ";   break;
			case "RelatorioMensal":    echo "Página Relatório Mensal ";    break;
			case "FormEditarConta":    echo "Página de edição de Cadastro ";break;
			default: echo "Home";
		}
	}
	
// FORMATAR VALOR R$ --------------------------------------------------------------------
 	function cadastrarValor($tVal)
	{
		$tValor = str_replace(',','.',str_replace('.','',$tVal));
		return $tValor;
	}
	function exibirValor($tVall)
	{
		$tValor1 = number_format($tVall,2,",",".");
		return $tValor1;
	}

// FUNÇÃO SELECT MARCADO DO BD

	function selectBD($tValue,$tSelected)
	{  
		return $tValue == $tSelected ? ' selected="selected"' : ''; 
	}
			
// EXIBIR TIPO DE UF -----------------------------------------------------------------
	function qualCand($tQualCand)
	{
		switch($tQualCand)
		{
			case 6: echo "<td><font color='#000099'>São Paulo</font></td>";       break; 
			case 5: echo "<td><font color='#FF0000'>Rio de Janeiro</font></td>";     break; 
			case 4: echo "<td><font color='#003300'>RS</font></td>";  break; 
			case 3: echo "<td><font color='#009900'>Curitíba</font></td>";  break; 
			case 2: echo "<td><font color='#223300'>Recife</font></td>";  break; 
			default:  echo "<td><font color='#666666'>Sem Definição</font></td>";
		}
	}

// EXIBIR STATUS DE CONTA -----------------------------------------------------------------
	function statusConta($tStatusConta)
	{
		switch($tStatusConta)
		{
			case 4: echo "<td><font color='#FF0000'>Em Atraso</font></td>";       break; 
			case 5: echo "<td><font color='#003300'>Conta Paga</font></td>"; break; 
			case 6: echo "<td><font color='#CC0033'>Vencidas</font></td>";  		break; 
			default:  echo "<td><font color='#666666'>Sem Definição</font></td>";
		}
	}

// VERIFICAR ARQUIVOS UPLOAD --------------------------------------------------------------

	function verificaUp($tArq)
	{
		$tArquivo = $tArq;
		list ($tNome,$tExtensao) = split('[.]',$tArquivo);
		switch($tExtensao)
		{	
			case "jpg": echo "<td><a href='up_arquivos/{$tMC['CONTA_IMG']}'><img src='images/icon-imagem.jpg'></a></td>"; break;
			case "png": echo "<td><a href='up_arquivos/{$tMC['CONTA_IMG']}'><img src='images/icon-imagem.jpg'></a></td>"; break;
			case "gif": echo "<td><a href='up_arquivos/{$tMC['CONTA_IMG']}'><img src='images/icon-imagem.jpg'></a></td>"; break;
			case "jpg": echo "<td><a href='up_arquivos/{$tMC['CONTA_IMG']}'><img src='images/icon-imagem.jpg'></a></td>"; break;
			case "pdf": echo "<td><a href='up_arquivos/{$tMC['CONTA_IMG']}'><img src='images/icon-pdf.gif'></a></td>";    break;
			default: echo "";
			
		}
	}
	
?>
