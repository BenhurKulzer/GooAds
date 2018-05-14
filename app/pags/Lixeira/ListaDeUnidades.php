<link rel="stylesheet" type="text/css" href="pags/table/css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="pags/table/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="pags/table/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                var dataTable = $('#employee-grid').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "aaSorting" : [[0, 'desc']],
                    "ajax":{
                        url :"pags/table/employee-grid-unidades.php", // Chamar Arquivo JSON
                        type: "post",  // Metodo  , Por default Get
                        error: function(){  // Mensagem de Erros...
                            $(".employee-grid-error").html("");
                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">Nenhum dado encontrado...</th></tr></tbody>');
                            $("#employee-grid_processing").css("display","none");
                            
                        }
                    }
                } );
            } );
        </script>

<div class="card">

    <div class="card-header">
        <h4 class="card-title">
            <div class="row">
                <div class="col-md-6">
                    Lista de Unidades
                </div>

                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-danger" onclick="document.location.href = '?controle=CadastrarNovaUnidade'">Adicionar Unidade</button>
                </div>
            </div>
        </h4>
        <hr>
    </div>
        
    <div class="card-content table-responsive">

        <table id="employee-grid" class="display" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Unidade</th>
                    <th>Sigla</th>
                    <th>Adc Por</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>

    </div>
</div>