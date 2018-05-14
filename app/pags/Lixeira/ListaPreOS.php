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
                        url :"pags/table/employee-grid-preos.php", // Chamar Arquivo JSON
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
            Lista de Cadastros Pré OS
        </h4>
        <hr>
    </div>
        
    <div class="card-content">

        <table id="employee-grid" class="display" width="100%">
            <thead>
                <tr>
                    <th>ID Form</th>
                    <th>Nome Cliente</th>
                    <th>E-Mail</th>
                    <th>Telefone</th>
                    <th>Data</th>
                </tr>
            </thead>
        </table>

    </div>
</div>