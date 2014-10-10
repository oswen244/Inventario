<script>

	$(document).ready(function() {

		$('#form_plan').submit(function(event) {
			event.preventDefault();

			var formulario = $(this).serialize();

			 $.post('create', {data: formulario}, function(data) {
            	success(data);
        	});
		});

	});
</script>

<h1 class="header-tittle">Planes</h1>

<div class="content">

	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar Plan</h3>
		  	</div>
			<div class="panel-body">
				<form id="form_plan" class="form form-horizontal" action="create" method="post" role="form"><br>
					
					<div class="form-group col-md-9">
						<label for="nombre_plan" class="col-md-5 control-label">Nombre del plan:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="nombre_plan" placeholder="Nombre del plan">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="desc_p_datos" class="col-md-5 control-label">Plan datos:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="desc_p_datos" placeholder="Ej: 200MB">
						</div>
					</div>
					
					<div class="form-group col-md-9">
						<label for="desc_p_voz" class="col-md-5 control-label">Plan voz:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="desc_p_voz" placeholder="Ej: 200 MINS">
						</div>
					</div>
					
					<div class="form-group col-md-9">
						<label for="cargo_datos" class="col-md-5 control-label">Cargo por datos:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="cargo_datos" placeholder="$">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="cargo_voz" class="col-md-5 control-label">Cargo por voz:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="cargo_voz" placeholder="$">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="c_fijoM" class="col-md-5 control-label">Cargo fijo mensual:</label>
						<label for="c_fijoM" class="col-md-7 control-label">$0000</label>
					</div>



					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar plan</button>
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