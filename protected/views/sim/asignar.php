<script>
	$(document).on('ready', function(event) {
		$('#tipoDispositivo').on('change', function(event) {
			if($('#tipoDispositivo').val()!=0){
				$.post('getDispDisponibles', {id_tipo: $('#tipoDispositivo').val()})
				.done(function(data){
					
				});
			}
		});
		data = <?php echo $data;?>;
		if(data['informado']=='1'){
			$('#tipoDispositivo').val(data['tipo']);
			$('#tipoDispositivo option:not(:selected)').attr('disabled', 'true');
			// $('#tipoDispositivo').val("si");
			$('#imeiDisp').val(data['imei']);
			$('#imeiDisp option:not(:selected)').attr('disabled', 'true');
		}else{
			$('#tipoDispositivo').attr('data-live-search', 'true');
			$('#imeiDisp').attr('data-live-search', 'true');
		}
		validar("#asignarSimcard");
	});
	
</script>
<h1 class="header-tittle">Simcards</h1><br>
<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Asignar Simcard</h3>
		</div>
		<div class="panel-body">
			<form id="asignarSimcard" action="asignar" class="form form-horizontal" method="post" role="form"><br>
				<div class="form-group col-md-12">
					<label class="col-md-3 control-label">Nuevo estado de la sim:</label>
					<div class="col-md-7">
						<select id="estado" data-live-search="true" name="texto" data-width="100%" class="selectpicker">
							<option value="">Seleccionar estado</option>
							<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM estados";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_estado'];?>"><?php echo $row['estado'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label for="dateAsi" class="col-md-3 control-label">Fecha de asignación:</label>
					<div class="col-md-7">
						<input type="date" class="form-control" name="fecha" placeholder="dd/mm/aaaa">
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="col-md-3 control-label">Tipo de dispositivo:</label>
					<div class="col-md-7">
						<select id="tipoDispositivo" name="texto" data-width="100%" class="selectpicker">
							<option value="">Seleccionar dispositivo</option>
							<?php
							$connection = Yii::app()->db;
							$sql = "SELECT * FROM tipo_disp WHERE usa_sim='si'";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['id_tipo'];?>"><?php echo $row['nombre'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="col-md-3 control-label">Imei del dispositivo a asignar:</label>
					<div class="col-md-7">
						<select id="imeiDisp" name="texto" data-width="100%" class="selectpicker">
							<option value="">Seleccionar Imei</option>
							<?php
							$connection = Yii::app()->db;
							$sql = "SELECT d.imei_ref imei FROM dispositivos d, tipo_disp t WHERE (t.total_sims-d.sims_asig)>0 AND d.tipo_disp = id_tipo";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['imei'];?>"><?php echo $row['imei'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="col-md-3 control-label">Plan:</label>
					<div class="col-md-7">
						<select id="plan" name="texto" data-width="100%" class="selectpicker">
							<option value="">Seleccionar plan</option>
							<?php
							$connection = Yii::app()->db;
							$sql = "SELECT DISTINCT p.id_plan Plan, p.nombre_plan Nombre FROM planes p RIGHT JOIN sims s ON p.id_plan = s.id_plan AND ISNULL(s.imei_disp)";
							$command=$connection->createCommand($sql);
							$dataReader=$command->query();
							foreach($dataReader as $row){?>
								<option value="<?php echo $row['Plan'];?>"><?php echo $row['Nombre'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="buttons-submit col-md-9">
					<div class="col-md-2 col-md-offset-5">
						<button id="btnAsignar" type="submit" class="btn btn-primary">Asignar simcard</button>
					</div>
					<div class="col-md-2 col-md-offset-1">
						<a href="<?php echo Yii::app()->user->returnUrl ?>" class="btn btn-success">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
