<script>
	$(document).ready(function() {
		validar('#form_usuario');
	});
</script>
<h1 class="header-tittle">Usuarios</h1>

<div class="content">

	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Registrar Usuario</h3>
			</div>
			<div class="panel-body">
				<form id="form_usuario" class="form form-horizontal" action="create" method="post" role="form"><br>
					<div class="form-group col-md-9">
						<label for="nombre" class="col-md-5 control-label">Nombre:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Nombre">
						</div>
					</div>
					
					<div class="form-group col-md-9">
						<label for="usuario" class="col-md-5 control-label">Usuario:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Usuario">
						</div>
					</div>
					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">Perfil:</label>
						<div class="col-md-7">
							<select data-live-search="true" data-width="100%" name="texto" class="selectpicker">
								<option value="">Seleccionar Perfil</option>
								<?php
									foreach($perfiles as $row){?>
										<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group col-md-9">
						<label for="contrasena" class="col-md-5 control-label">Contraseña:</label>
						<div class="col-md-7">
							<input type="password" class="form-control" name="password" placeholder="Contraseña">
						</div>
					</div>
					<div class="form-group col-md-9">
						<label for="c_contrasena" class="col-md-5 control-label">Confirmar contraseña:</label>
						<div class="col-md-7">
							<input type="password" class="ignorar form-control" name="confirmPassword" placeholder="Confirmar contraseña">
						</div>
					</div>

					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar usuario</button>
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