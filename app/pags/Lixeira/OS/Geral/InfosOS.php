<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informações sobre a OS</a>
            </li>
        </ul>
        
        <div class="well table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <th>Nº OS</th>
                        <th>Razão Social</th>
                        <th>Responsável</th>
                        <th>Modalidade</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        require_once("includes/ConnDatabase.php");

                        $tGet   = decodificarUrl($_GET['CodC']);
                        $tSql = $tPdo->prepare("SELECT * FROM os_ordens WHERE ID_C='{$tGet}'");
                        $tSql ->execute();

                        $data_nova = $tMC['Data_OS'];
                        $data = explode('-', $data_nova);

                        switch ($tMC['Modalidade_OS']) {
                            case 'urgencia':
                                $tModalidade = '<b style="color:red;">Urgência</b>';
                                break;

                            case 'standard':
                                $tModalidade = 'Standard';
                                break;
                            
                            default:
                                $tModalidade = 'Standard';
                                break;
                        }

                        while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

                            echo "
                                <tr>
                                    <td>{$tMC['Filial_OS']} - {$tMC['ID_C']}</td>
                                    <td>{$tMC['Razao_Social_OS']}</td>
                                    <td>{$tMC['Responsavel_OS']}</td>
                                    <td>{$tModalidade}</td>
                                    <td>$data[2]/$data[1]/$data[0]</td>
                                    </td>
                                </tr>
                            ";

                        }

                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>