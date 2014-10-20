<script>
	$(document).ready(function() {
		$('.selectpicker').selectpicker();

		$('#form_clientes').submit(function(event) {
			event.preventDefault();

			var formulario = $(this).serialize();
			 $.post('create', {data: formulario})
			 .done(function(data){
            	success(data,1);
			 	$('#form_clientes')[0].reset();
            	$(".selectpicker").selectpicker('refresh');
			 });
			 
			 
		});
	});
</script>
<h1 class="header-tittle">Clientes</h1>

<div class="content">
	
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar cliente</h3>
		  	</div>
			<div class="panel-body">

				<form id="form_clientes" class="form form-horizontal" action="create" method="post" role="form"><br>
					<div class="form-group col-md-12">
						<label for="nombre" class="col-md-2 control-label">Nombre:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="no.bre" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="tipo_identi" class="col-md-5 control-label">Tipo de ID:</label>
						<div class="col-md-7">
							<select name="tipo_identi" data-width="100%" class="selectpicker">
								<option value="">Seleccionar tipo id</option>
								<option value="CC">CC</option>
								<option value="NIT">NIT</option>
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
						<label class="col-md-5 control-label">Ciudad:</label>
						<div class="col-md-7">
							<select name="ciudad" data-width="100%" class="selectpicker">
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
							<input type="text" name="dir@cion" class="form-control" placeholder="Dirección">
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

					

					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar cliente</button>
						</div>
						<div class="col-md-2">
							<a href="#" class="btn btn-success">Cancelar</a>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>