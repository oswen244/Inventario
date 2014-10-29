<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = ["Fecha de activación:", "Número de línea:", "Imei de la simcard:", "Estado:", "Proveedor:", "Tipo de plan:", "Plan:", "Comentario:", "Estado de asignación:", "Fecha de asignación:", "Imei del dispositivo asignado:"];
		var datos = <?php echo $sims; ?>;
		var atributos = ["Fecha_act","Numero","Imei","Estado","Proveedor","Plan"];
		var table= customDataTable('#simTable', datos, atributos, nombres);
		$('#dialog').click(function() {
            borrar(table,'#myModal','#delete');
        });
        validar('#editarSimcard');
	});

</script>

<h1 class="header-tittle">Simcards</h1>

<div class="content">
	
	<div class="content-side">
		<input type="button" id="dialog" data-toggle="modal" class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<table id="simTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Fecha de activación</th>
					<th>Número de linea</th>
					<th>Imei</th>
					<th>Estado</th>
					<th>Proveedor</th>
					<th>Plan</th>
				</tr>
			</thead>

			<tbody>

			</tbody>
		</table>
	</div>
</div>