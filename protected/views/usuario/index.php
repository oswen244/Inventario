<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $users; ?>;
	    var id = '#usuariosTable';
	    var atributos = ["usuario","rol","nombre"];	    
	    var table = customDataTable(id, datos, atributos);

	    $('#dialog').click(function(event) {
	    	borrar(table,'#myModal','#delete');
	    }); 

	});

</script>


<h1 class="header-tittle">Usuarios</h1>

<div class="content">
	
<div class="content-side">
	<input type="button" id="dialog" data-toggle="modal"  class="btnActions btn btn-danger btn-sm" value="Eliminar">
	<table id="usuariosTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Rol</th>
					<th>Nombre</th>
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