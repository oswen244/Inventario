<script>
	$(document).ready(function() {
		validar('#form_proveedor');
		// $('.selectpicker').selectpicker();

		// $('#form_proveedor').submit(function(event) {
		// 	event.preventDefault();

		// 	var formulario = $(this).serialize();

		// 	 $.post('create', {data: formulario})
		// 	 .done(function(data){
  //           	success(data,1);
		// 	 	$('#form_proveedor')[0].reset();
		// 	 	$(".selectpicker").selectpicker('refresh');
		// 	 });
			 
			 
		// });
	});
</script>
<h1 class="header-tittle">Proveedores</h1>

<div class="content">
	
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar proveedor</h3>
		  	</div>
			<div class="panel-body">

				<form id="form_proveedor" class="form form-horizontal" action="create" method="post" role="form"><br>
					<div class="form-group col-md-12">
						<label for="nombre" class="col-md-2 control-label">Nombre:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="texto" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="tipo_identi" class="col-md-5 control-label">Tipo de ID:</label>
						<div class="col-md-7">
							<select name="texto" data-width="100%" class="selectpicker">
								<option value="0">Seleccionar tipo id</option>
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
							<select name="texto" data-width="100%" class="selectpicker">
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

					

					<div class="buttons-submit col-md-10">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar proveedor</button>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<button href="" type="submit" class="btn btn-success">Cancelar</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>