<script>
	$(document).ready(function() {
		validar('#form_plan');

		$('#datos').on('change', function() {
			var precios = parseFloat($('#datos').val())+parseFloat($('#voz').val());
			$('#cargo_fijo').attr('value', precios);
		});

		$('#voz').on('change', function() {
			var precios = parseFloat($('#datos').val())+parseFloat($('#voz').val());
			$('#cargo_fijo').attr('value', precios);
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
				<form id="form_plan" class="form form-horizontal" role="form"><br>
					
					<div class="form-group col-md-9">
						<label for="nombre_plan" class="col-md-5 control-label">Nombre del plan:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Nombre del plan">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="desc_p_datos" class="col-md-5 control-label">Plan datos:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Ej: 200MB">
						</div>
					</div>
					
					<div class="form-group col-md-9">
						<label for="desc_p_voz" class="col-md-5 control-label">Plan voz:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Ej: 200 MINS">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="cargo_datos" class="col-md-5 control-label">Cargo por datos:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input id="datos" type="number" class="form-control" name="texto"><span class="input-group-addon">.00</span>
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="cargo_voz" class="col-md-5 control-label">Cargo por voz:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input id="voz" type="number" class="form-control" name="texto"><span class="input-group-addon">.00</span>
						</div>
					</div>
					

					<div class="form-group col-md-9">
						<label for="c_fijoM" class="col-md-5 control-label">Cargo fijo mensual:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input id="cargo_fijo" type="number" readonly class="ignorar form-control" name="texto"><span class="input-group-addon">.00</span>
						</div>
					</div>



					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button id="reg" href="" type="submit" class="btn btn-primary">Registrar plan</button>
						</div>
						<div class="col-md-2">
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/plan/" class="btn btn-default">Volver</a>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>