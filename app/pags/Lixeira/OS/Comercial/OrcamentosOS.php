<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Orçamentos</a>
            </li>
        </ul>

        <div class="padbot text-right">
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarOrcamentoTodos'> Todos</button>
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarOrcamentoPre'> Adicionar Pré</button>
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarOrcamentoP1'> Adicionar P1</button>
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarOrcamentoP2'> Adicionar P2</button>
            <button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#ModalAdicionarOrcamentoPN'> Adicionar PN</button>
        </div>

        <div class="well">
            
            <?php

            // Código que define os dados que serão exibidos nas tabelas
             
            require("includes/ConnDatabase.php");
            include("ModalsOrcamentosOS.php");
                       
                $tGet   = decodificarUrl($_GET['CodC']);
                $tGetC  = $_GET['CodC'];
                $tSqlEC = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C ='{$tGet}'");
                $tSqlEC ->execute();

                  while($tMC  = $tSqlEC->fetch(PDO::FETCH_ASSOC)) {

                    echo "
                        
                        <div class='row'>

                            <div class='col-md-12'>

                                <div><b> Pré-Orçamento:</b>             --</div>
                            
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

                            <div class='col-md-12'>

                                <div><b> Orçamento P1:</b>             --</div>
                            
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

                            <div class='col-md-12'>

                                <div><b> Orçamento P2:</b>             --</div>
                            
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

                            <div class='col-md-12'>

                                <div><b> Orçamento PN:</b>             --</div>
                            
                            </div>

                        </div>

                    ";
                  }

            ?>

        </div>

    </div>
</div>

<a>.</a>