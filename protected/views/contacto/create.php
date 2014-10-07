<script>
	$(document).ready(function() {
		$('.selectpicker').selectpicker();
	});
</script>
<h1 class="header-tittle">Contactos</h1>

<div class="content">
	
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar contacto</h3>
		  	</div>
			<div class="panel-body">

				<form class="form form-horizontal" action="create" method="post" role="form"><br>
					<div class="form-group col-md-12">
						<label for="nombre" class="col-md-2 control-label">Nombre:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="tipo_id" class="col-md-5 control-label">Tipo de entidad:</label>
						<div class="col-md-7">
							<select name="tipo_entidad" data-width="100%" class="selectpicker">
								<option value="0">Seleccionar tipo entidad</option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label for="tipo_id" class="col-md-5 control-label">Contacto de:</label>
						<div class="col-md-7">
							<select name="tipo_entidad" data-width="100%" class="selectpicker">
								<option value="0">Seleccionar entidad</option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Número de ID:</label>
						<div class="col-md-7">
							<input type="text" name="num_id" class="form-control" placeholder="Número ID">
						</div>
					</div>
					
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Teléfono:</label>
						<div class="col-md-7">
							<input type="text" name="telefono" class="form-control" placeholder="Teléfono">
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">E-mail:</label>
						<div class="col-md-7">
							<input type="text" name="email" class="form-control" placeholder="E-mail">
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Cargo:</label>
						<div class="col-md-7">
							<input type="text" name="email" class="form-control" placeholder="Cargo">
						</div>
					</div>
					

					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Guardar contacto</button>
						</div>
						<div class="col-md-2">
							<button href="" type="submit" class="btn btn-success">Cancelar</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>