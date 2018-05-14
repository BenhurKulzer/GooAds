<?php

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    require_once("includes/ConnDatabase.php");

    $tGet   = decodificarUrl($_GET['CodC']);
    $tGetC  = $_GET['CodC'];
    $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'"); 
    $tSqlEC ->execute();
    $tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC);

    require('Fotos/ListaDeFotosOS.php');

?>