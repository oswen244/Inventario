<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = [];
	    var datos = <?php echo $clientes; ?>;
	    var atributos = ["nombre","tipo_identi","num_id","ciudad","direccion","telefono","email"];	    
	     $('#clienteTable tr:last-child th').each(function() {
	    	nombres.push($(this).html()+":");
	    });
	    var table = customDataTable('#clienteTable', datos, atributos, nombres); 


	    $('#dialog').click(function(event) {
	    	 borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');	    	
	    });


	     validar('#form_clientes');
	});

</script>


<h1 class="header-tittle">Clientes</h1>

<div class="content">


<div class="content-side">
	<input type="button" id="dialog" data-toggle="modal"  class="btnActions btn btn-danger btn-sm" value="Eliminar">
	<table id="clienteTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
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


	<div id="modalCascade" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Advertencia</h4>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<button id="deleteCascade" type="button" class="btn btn-primary" data-dismiss="modal">Si</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
	</div>

		<!-- Modal de edicion -->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modalEditLabel">Actualización de Cliente</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">

					<!-- Formulario			 -->
							<form id="form_clientes" class="form form-horizontal" action="update" method="post" role="form"><br>
								<div class="form-group col-md-12">
									<label for="nombre" class="col-md-2 control-label">Nombre:</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="texto" placeholder="Nombre">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="tipo_identi" class="col-md-5 control-label">Tipo de ID:</label>
									<div class="col-md-7">
										<select name="texto" data-live-search="true" data-width="100%" class="selectpicker">
											<option value="">Seleccionar tipo id</option>
											<option value="CC">CC</option>
											<option value="NIT">NIT</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Número de ID:</label>
									<div class="col-md-7">
										<input type="number" name="texto" class="form-control" placeholder="Número ID">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Ciudad:</label>
									<div class="col-md-7">
										<select name="texto" data-live-search="true" data-width="100%" class="selectpicker">
											<option value="">Seleccionar ciudad</option>
											<option value="Barranquilla">Barranquilla</option>
											<option value="Bogota">Bogotá</option>
											<option value="Medellin">Medellin</option>
											<option value="Cali">Cali</option>
											<option value="Cartagena">Cartagena</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Dirección:</label>
									<div class="col-md-7">
										<input type="text" name="texto" class="form-control" placeholder="Dirección">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Teléfono:</label>
									<div class="col-md-7">
										<input type="text" name="texto" class="form-control" placeholder="Teléfono">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">E-mail:</label>
									<div class="col-md-7">
										<input type="text" name="email" class="form-control" placeholder="E-mail">
									</div>
								</div>
								<input  type="text" name="helper" class="helper form-control" placeholder="">


								<div class="buttons-submit col-md-12">
									<div class="col-md-2 col-md-offset-4">
										<button id="btnGuardar" type="submit" class="btn btn-primary" data-dismiss="modal">Actualizar cliente</button>
									</div>
									<div class="col-md-2">
										<button id="cancelar" class="btn btn-success" data-dismiss="modal">Cancelar</button>
									</div>
								</div>					
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>