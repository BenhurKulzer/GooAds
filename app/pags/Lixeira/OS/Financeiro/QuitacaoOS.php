<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Quitação</a>
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

                  while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC)) {

                    echo "
                        
                        <div class='row'>

                            <div class='col-md-4'>

                                <div><b> Data da aprovação:</b>      --</div>
                                <div><b> Prazo para depósito:</b>    --</div>
                            
                            </div>

                            <div class='col-md-4'>

                                <div><b> Valor aprovado:</b>         --</div>
                                <div><b> Forma Pagamento:</b>        --</div>
                            
                            </div>

                            <div class='col-md-4'>

                                <div><b> Nível:</b>                 --</div>
                            
                            </div>

                        </div>

                    ";
                  }

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
                        
                        <div class='row'>

                            <div class='col-md-4'>

                                <div><b> Valor Entrada:</b>                             --</div>
                                <div class='padbot'><b> Data da Entrada:</b>            --</div>
                                
                            </div>

                            <div class='col-md-4'>

                                <div><b> Tem Contrato Assinado:</b>                     --</div>
                                <div class='padbot'><b> Data Contrato Assinado:</b>     --</div>
                            
                            </div>

                            <div class='col-md-4'>

                                <div><b> Valor Saldo:</b>                               --</div>
                                <div class='padbot'><b> Data Saldo:</b>                 --</div>
                            
                            </div>

                        </div>
                        
                    ";
                  }

            ?>

        </div>

    </div>
</div>