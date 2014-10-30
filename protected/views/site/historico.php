<script type="text/javascript">

	$(document).ready(function() {
		var nombres = [];
	    var datos = <?php echo $his; ?>;
	    var atributos = ["usuario","tabla","elementos","accion","fecha_hora"];
	     $('#historicoTable tr:last-child th').each(function() {
	    	nombres.push($(this).html()+":");
	    });
	    var table = customDataTable('#historicoTable', datos, atributos,nombres);

	    $('#btnEditar').html("Cerrar");
	});

</script>


<h1 class="header-tittle">Historico</h1>

<div class="content">
	
<div class="content-side">
	<table id="historicoTable" class="hist display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Usuario</th>
					<th>Tabla</th>
					<th>Elementos</th>
					<th>Acción</th>
					<th>Fecha-Hora</th>
				</tr>
			</thead>

			<tbody>

			</tbody>
	</table>
</div>