<?php

  require_once("includes/ConnDatabase.php");

  $tGet   = decodificarUrl($_GET['CodC']);
  $tGetC  = $_GET['CodC'];
  $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
  $tSqlEC ->execute();

  $tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);

?>

<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">
          <div class="col-md-8">
              Ordem de Serviço <font color="#FF0000"><?=$tGet;?> - <?php if ($tMC['Tipo_Pessoa_OS'] == 'PJ') { echo $tMC['Razao_Social_OS']; } else { echo $tMC['Responsavel_OS'];} ?> <?php if ($tMC['Modalidade_OS'] == 'urgencia') { echo "**Urgência**"; } ?></font>
          </div>
          <div class="col-md-4 text-right">
            <button class="btn btn-default" onclick="window.history.go(-1); return false;"> Retornar</button>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
        </h4>
    </div>
    <div class="card-content">
      
      <?php require('OS/Menu.php'); ?>

      <div id="my-tab-content" class="tab-content text-center">
        <div class="tab-pane active" id="home">
            <?php require('OS/DadosGeraisOS.php'); ?>
        </div>
        
      </div>
      
    </div>
  </div>
</div>