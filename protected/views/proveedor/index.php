<script type="text/javascript">

	$(document).ready(function() {
		var nombres = [];
	    var datos = <?php echo $proveedores; ?>;
	    var atributos = ["nombre","tipo_identi","num_id","ciudad","direccion","telefono","email"];	    
	    var table = customDataTable('#proveedorTable', datos, atributos); 

	    $('#dialog').click(function(event) {
			 borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');	
	    });

	    $('#datatable tr th').each(function() {
	    	nombres.push($(this).html());
	    });
	});

</script>

<h1 class="header-tittle">Proveedores</h1>

<div class="content">
	
<div class="content-side">
	<input type="button" id="dialog" data-toggle="modal"  class="btnActions btn btn-danger btn-sm" value="Eliminar">
	<table id="proveedorTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Tipo id</th>
					<th>Número id</th>
					<th>Ciudad</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>E-mail</th>
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

	<div id="modalCascade" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Advertencia</h4>
					</div>
					<div class="cascada modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<button id="deleteCascade" type="button" class="btn btn-primary" data-dismiss="modal">Si</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
</div>

</div>