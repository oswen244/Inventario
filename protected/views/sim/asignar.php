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
			$('#imeiDisp').val(data['imei']);
		}
		validar("#asignarSimcard");
	});
	
</script>
<h1 class="header-tittle">Simcards</h1><br>
<div class="content">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Asignar Simcard</h3>
			</div>
			<div class="panel-body">
				<form id="asignarSimcard" action="asignar" class="form form-horizontal" method="post" role="form"><br>
					<div class="form-group col-md-6">
						<label for="dateAsi" class="col-md-5 control-label">Fecha de asignación:</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="fecha" placeholder="dd/mm/aaaa">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Tipo de dispositivo:</label>
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
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Imei del dispositivo a asignar:</label>
						<div class="col-md-7">
							<input id="imeiDisp" type="text" readonly="true" class="form-control" name="texto" placeholder="Imei">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Plan:</label>
						<div class="col-md-7">
							<select id="plan" name="texto" data-width="100%" class="selectpicker">
								<option value="">Seleccionar plan</option>
								<?php
								$connection = Yii::app()->db;
								$sql = "SELECT * FROM planes";
								$command=$connection->createCommand($sql);
								$dataReader=$command->query();
								foreach($dataReader as $row){?>
									<option value="<?php echo $row['id_plan'];?>"><?php echo $row['nombre_plan'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group col-md-12 text-center">
						<label class="col-md-3 control-label">Comentarios:</label>
						<div class="col-md-9 col-md-offset-2">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>
					<div class="buttons-submit col-md-9">
						<div class="col-md-2 col-md-offset-5">
							<button id="btnAsignar" type="submit" class="btn btn-primary">Asignar simcard</button>
						</div>
						<div class="col-md-2 col-md-offset-1">
							<a href="#" class="btn btn-success">Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
