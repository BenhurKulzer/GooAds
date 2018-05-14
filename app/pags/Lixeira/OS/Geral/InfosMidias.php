<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informações sobre a Mídia</a>
            </li>
        </ul>

        <div class="well">
            
            <?php

            // Código que define os dados que serão exibidos nas tabelas
             
            require_once("includes/ConnDatabase.php");
                       
                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                  while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC))
                  {

                    switch($tMC['SO_OS'])
                        {   
                            case '': $tSO = "Não Informado";     break;
                            default: $tSO = "{$tMC['$SO_OS']}";     break;
                        }

                    echo "
                        
                        <div class='row'>

                            <div class='col-md-4'>

                                <div><b> Marca:</b>      {$tMC['Marca_Equip_OS']}</div>
                                <div><b> Modelo:</b>     {$tMC['Modelo_Equip_OS']}</div>
                            
                            </div>

                                <div class='col-md-4'>

                                    <div><b> Serial:</b>     {$tMC['Serial_Equip_OS']}</div>
                                    <div><b> Tamanho:</b>    {$tMC['Tamanho_Equip_OS']}</div>
                                
                                </div>

                            <div class='col-md-4'>

                                <div><b> Interface:</b>              {$tMC['Interface_Equip_OS']}</div>
                                <div><b> Sistema Operacional:</b>    $tSO</div>
                            
                            </div>

                        </div>
                    ";
                  }
                    if (isset($_GET['Acao']) && isset($_GET['CodC']))
                    {
                    $tGet    = decodificarUrl($_GET['CodC']);
                    $tSqlDel = $tPdo->prepare("DELETE FROM os_ordens WHERE ID_C ='{$tGet}'");
                    $tSqlDel ->execute();
                    
                    if($tSqlDel == TRUE){ echo DELETESUCESSO . LogSistema(LOGEXCLUIRCONTA);} else{ echo DELETEERRO;}
                    
                    }

                    $tSqlTotal = $tPdo->prepare("SELECT * FROM os_ordens");
                    $tSqlTotal ->execute();
                    $tNumTotal = $tSqlTotal->rowCount($tSqlTotal);
                    $tTotalPag = ceil($tNumTotal/$tQuantidade);

            ?>

            <hr>

            <?php

            // Código que define os dados que serão exibidos nas tabelas
             
            require_once("includes/ConnDatabase.php");
                       
                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                  while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC))
                  { 
                    echo "
                        
                        <tr>

                            <td><b>Pastas e arquivos a restaurar:</b>   {$tMC['Pastas_Arquivos_OS']}.</td><br>
                        
                        </tr>
                        
                    ";
                  }
                    if (isset($_GET['Acao']) && isset($_GET['CodC']))
                    {
                    $tGet    = decodificarUrl($_GET['CodC']);
                    $tSqlDel = $tPdo->prepare("DELETE FROM os_ordens WHERE ID_C ='{$tGet}'");
                    $tSqlDel ->execute();
                    
                    if($tSqlDel == TRUE){ echo DELETESUCESSO . LogSistema(LOGEXCLUIRCONTA);} else{ echo DELETEERRO;}
                    
                    }

                    $tSqlTotal = $tPdo->prepare("SELECT * FROM os_ordens");
                    $tSqlTotal ->execute();
                    $tNumTotal = $tSqlTotal->rowCount($tSqlTotal);
                    $tTotalPag = ceil($tNumTotal/$tQuantidade);

            ?>

                <hr>

            <?php

            // Código que define os dados que serão exibidos nas tabelas
             
            require_once("includes/ConnDatabase.php");
                       
                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC)) { 

                    echo "
                        <tr>
                    ";
                    
                    echo "<td><b>Defeito Apresentado:</b> {$tMC['Defeito_Equip_OS']}</td><br></tr>";
                }

            ?>

        </div>

    </div>
</div>

<a>.</a>