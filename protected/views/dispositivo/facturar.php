<script>
	$(document).on('ready', function(event) {
		validar("#facturar");
	});
</script>
<h1 class="header-tittle">Facturación</h1><br>
<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Facturar dispositivos</h3>
		</div>
		<div class="panel-body">
			<form id="facturar" action="facturar" class="form form-horizontal" method="post" role="form"><br>
				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">Cliente:</label>
					<div class="col-md-7">
						<select id="cliente" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
							<option value="">Seleccionar cliente</option>
							<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM clientes";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_cliente'];?>"><?php echo $row['nombre'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">IMEI o referencia:</label>
					<div class="col-md-7">
						<input type="text" name="texto" class="form-control" placeholder="IMEI o referencia">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
