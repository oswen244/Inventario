<script>

	$(document).ready(function() {

		$('#form_estado').submit(function(event) {
			event.preventDefault();

			var formulario = $(this).serialize();

			 $.post('create', {data: formulario}, function(data) {
            	success(data);
        	});
		});

	});
</script>

<h1 class="header-tittle">Estados</h1>
 <div class="content">
 	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar Estado</h3>
		  	</div>
		  	<div class="panel-body">
				<form id="form_estado" class="form form-horizontal" role="form">
					<div class="form-group col-md-12">
						<label for="estado" class="col-md-2 control-label">Nombre estado:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="estado" placeholder="Nombre">
						</div>
					</div>

					<div class="form-group col-md-12 text-center">
						<label  class="col-md-2 control-label">Comentario:</label>
						<div class="col-md-10 col-md-offset-2">
							<textarea type="textArea" name="descripcion" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>

					<div class="buttons-submit col-md-10">
						<div class="col-md-2 col-md-offset-4">
							<button id="reg" type="submit" class="btn btn-primary">Registrar estado</button>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<button type="submit" class="btn btn-success">Cancelar</button>
						</div>
					</div>
					
				</form>
		  	</div>
		</div>
	</div>
 </div>