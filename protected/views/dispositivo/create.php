<script>
	$(document).ready(function() {
		$('.selectpicker').selectpicker();
	});
</script>
<h1 class="header-tittle">Dispositivos</h1>
<div class="col-md-10 col-md-offset-1">
	<form class="form form-horizontal" action="create" method="post" role="form"><br>
		<div class="form-group col-md-6">
			<label for="dateAdq" class="col-md-5 control-label">Fecha de adquisición:</label>
			<div class="col-md-7">
				<input type="date" class="form-control" name="dateAdq" placeholder="dd/mm/aaaa">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label">Referencia:</label>
			<div class="col-md-7">
				<input type="text" name="referencia" class="form-control" placeholder="Referencia">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label">IMEI o referencia:</label>
			<div class="col-md-7">
				<input type="text" name="imei" class="form-control" placeholder="IMEI o referencia">
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label">Estado:</label>
			<div class="col-md-7">
				<select name="estado" class="selectpicker">
					<option value="0">Seleccionar estado</option>
					<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM estados";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_estados'];?>"><?php echo $row['estado'];?></option>
							<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label">Proveedor:</label>
			<div class="col-md-7">
				<select name="proveedor" class="selectpicker">
					<option value="0">Seleccionar proveedor</option>
					<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM proveedores";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_proveedor'];?>"><?php echo $row['nombre'];?></option>
							<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-md-5 control-label">Tipo de dispositivo:</label>
			<div class="col-md-7">
				<select name="tipoDispositivo" class="selectpicker">
					<option value="0">Seleccionar Tipo de dispositivo</option>
					<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM tipo_disp";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_tipo'];?>"><?php echo $row['tipo_ref'];?></option>
							<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-6 col-md-offset-3">
				<a href="" type="submit" class="btn btn-primary">Guardar dispositivo</a>
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-6 col-md-offset-3">
				<a href="" type="submit" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form>
</div>