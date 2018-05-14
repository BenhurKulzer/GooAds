<!DOCTYPE html>
<html>
	<title>SPA Teste</title>

	<head>
	
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel='stylesheet' href='https://www.datarecover.com.br/datasis/sistemas/spa/lib/font-awesome2/css/font-awesome.css'/>
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">Nenhum dado encontrado...</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>

	</head>
	
	<body>
	
		<table id="employee-grid" class="display" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Atendente</th>
					<th>Via</th>
					<th>Cliente</th>
					<th>Telefone</th>
					<th>Status</th>
					<th>UF</th>
					<th>Data/Hora</th>
					<th>Ações</th>
				</tr>
			</thead>
		</table>

	</body>