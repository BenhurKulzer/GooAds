<?php
	require_once("SistemaFuncoes.php");


// MENSAGENS --------------------------------------------------------------------------------------------------------

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////                MENSAGENS DE LOGIN              /////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	define("LOGINACEITO"," aguarde o redirecionamento...<meta http-equiv='refresh' content='2;url=Gerenciador.php'>");

	define("LOGINERRO", " CPF/E-Mail Incorreto!");
	
	define("SENHAERRO"," Senha Incorreta!");

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////                 DEFINES QUANDO CADASTRA        /////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	define("CADASTROATENDIMENTOSUCESSO","<div class='alert alert-success'>Seu atendimento foi cadastrado com sucesso, aguarde o redirecionamento...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeAtendimentos'>");

	define("CADASTROATENDIMENTOERRO","<div class='alert alert-danger'>Infelizmente, houve uma falha ao cadastrar seu atendimento, Contate o Administrador e aguarde o redirecionamento...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeAtendimentos'>");

	///////////////////////

	define("CADASTROUNIDADESUCESSO", "<div class='alert alert-success'>Unidade foi cadastrada com sucesso, aguarde o redirecionamento...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeUnidades'>");

	define("CADASTROUNIDADEERRO", "<div class='alert alert-danger'>Infelizmente, houve uma falha ao cadastrar a unidade, Contate o Administrador e aguarde o redirecionamento...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeUnidades'>");

	///////////////////////

	define("CADASTROOCORRENCIAATENDIMENTOSUCESSO","<div class='alert alert-success'>Sua ocorrência foi cadastrado com sucesso, aguarde o redirecionamento...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeAtendimentos'>");

	define("CADASTROOCORRENCIAATENDIMENTOERRO","<div class='alert alert-danger'>Infelizmente, houve uma falha ao cadastrar sua ocorrência, Contate o Administrador e aguarde o redirecionamento...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeAtendimentos'>");

	///////////////////////

	define("CAMPOSVAZIOSOS","<div class='alert alert-warning'>Ainda há campos obrigatórios não preenchidos...</div>");

	define("CADASTROOSSUCESSO","<div class='alert alert-success'>Sua Ordem de Serviço foi cadastrada com sucesso, aguarde o redirecionamento...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeOS'>");

	define("CADASTROOSERRO","<div class='alert alert-danger'>Infelizmente, houve uma falha ao cadastrar sua Ordem de Serviço, Contate o Administrador e aguarde o redirecionamento...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeOS'>");

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////                 DEFINES QUANDO EDITA           /////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	define("EDITARATENDIMENTOSUCESSO","<div class='alert alert-success'>Os dados de seu atendimento estão sendo atualizados com sucesso, aguarde...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeAtendimentos'>");

	define("EDITARATENDIMENTOERRO","<div class='alert alert-danger'>Por algum motivo os dados não puderam ser cadastrados no sistema, Informe a equipe de desenvolvimento, Obrigado...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeAtendimentos'>");

	/////////////////////////////////////

	define("EDITAROSSUCESSO","<div class='alert alert-success'>Os dados desta Ordem de Serviço estão sendo atualizados com sucesso, aguarde...</div><meta http-equiv='refresh' content='1;url=?controle=ListaDeOS'>");

	define("EDITAROSERRO","<div class='alert alert-danger'>Por algum motivo os dados não puderam ser cadastrados no sistema, Informe a equipe de desenvolvimento, Obrigado...</div><meta http-equiv='refresh' content='2;url=?controle=ListaDeOS'>");

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////                 GERADORES DE LOGS              /////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	define("LOGEXCLUIRCONTAVENCIDA","Excluiu Candidato");
	
	define("LOGCADASTROUSER","Cadastrou Usuário");
	
	define("LOGSISTEMA","Login no Sistema");
	
	define("LOGSISTEMASAIR","Fez Logoff do Sistema");

// DIRETORIOS -------------------------------------------------------------------------------------------------------

	define("HEAD","includes/Head.php");
	define("MENU","includes/PainelMenu.php");
	define("JQUERY","includes/jquerys.php");
// DADOS DO SISTEMA -------------------------------------------------------------------------------------------------

	define("TITULOSISTEMA","Sistema de Pagamentos");
	define("BEMVINDO","Seja bem vindo(a) ao Sistema de Pagamentos!");
?>