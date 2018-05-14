<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Negociação</a>
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

                                <div><b> Códigos do Comercial:</b>      		--</div>
                                <div><b> Prazo para cliente Aprovar:</b>  		--</div>
                            
                            </div>

                            <div class='col-md-4'>

                            	<div><b> Idéia de valor do Cliente:</b>   		--</div>
                                <div><b> Cliente está disposto a Pagar:</b>     --</div> 
                            
                            </div>

                            <div class='col-md-4'>

                                <div><button class='btn btn-default'> Dados da Negociação</button></div>
                            
                            </div>

                        </div>

                    ";
                  }

            ?>

        </div>

    </div>
</div>