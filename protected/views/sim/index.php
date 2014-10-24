<script type="text/javascript">

	$(document).ready(function() {
		var nombres = [];
	    var datos = <?php echo $sims; ?>;
	    var atributos = ["f_act","num_linea","imei_sc","tipo_plan","comentario","id_estado","id_proveedor","id_plan","imei_disp"];	    
	    var table= customDataTable('#simTable', datos, atributos,nombres); 

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#delete');
        });

	    $('#planTable tr th').each(function() {
	    	nombres.push($(this).html());
	    });
	});

</script>

<h1 class="header-tittle">Simcards</h1>

<div class="content">
	
	<div class="content-side">
		<input type="button" id="dialog" data-toggle="modal"  class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<table id="simTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Fecha de activación</th>
					<th>Número linea</th>
					<th>Imei</th>
					<th>Tipo plan</th>
					<th>Comentario</th>
					<th>Estado</th>
					<th>Proveedor</th>
					<th>Plan</th>
					<th>Imei de dispositivo</th>
				</tr>
			</thead>
		
			<tbody>

			</tbody>
	</table>
	<div id="myModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Advertencia</h4>
				</div>
				<div class="modal-body">
					<p>Se borrarán los registros seleccionados</p>
				</div>
				<div class="modal-footer">
					<button id="delete" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	</div>

</div>