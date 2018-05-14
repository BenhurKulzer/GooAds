<div class="col-md-12">

    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informações sobre Fotos</a>
            </li>
        </ul>
        
        <div class="well table-responsive">

            <table class="table table-striped backfotoos">
                
                <thead>

                    <tr class="BackTable">
                    
                        <th>Foto</th>
                        <th>Descrição</th>
                        <th>ID</th>
                        <th>Adicionado Por</th>
                        <th>Data</th>
                    
                    </tr>

                </thead>
                
                <tbody>
                    <?php 

                        // Código que define os dados para exibição nas tabelas
                        require_once("includes/ConnDatabase.php");

                            $tQuantidade =20;
                            $tPagina     = (isset ($_GET['pg'])) ? (int)$_GET['pg'] :1;
                            $tIniciar    = ($tQuantidade * $tPagina) - $tQuantidade;

                            $tSql = $tPdo->prepare("SELECT * FROM os_fotos WHERE Numero_OS_Foto='{$tGet}' ORDER BY ID_Foto DESC LIMIT $tIniciar, $tQuantidade");
                            $tSql ->execute();

                            while($tMC  = $tSql->fetch(PDO::FETCH_ASSOC)) {

                              //Faz o explode da Data e transforma do formato US para o formato BR
                              $data = $tMC['Data_Foto'];
                              $data_nova = explode("-",$data);

                                echo "

                                <tr>

                                    <td><a href='up_arquivos/FotosOS/{$tMC['Imagem_Foto']}' target='_BLANK' rel='tooltip' title='Exibir Foto/Comprovante'><img class='img-circle' src='/images/foto.png'></img></a></td>

                                    <td>{$tMC['Descricao_Foto']}</td>

                                    <td>{$tMC['ID_Foto']}</td>

                                    <td>{$tMC['Adicionado_Por']}</td>

                                    <td><div style='color:red;'>$data_nova[2]/$data_nova[1]/$data_nova[0]</div> às {$tMC['Hora_Foto']}</td>

                                </tr>";
                            
                            }

                        ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<a>.</a>