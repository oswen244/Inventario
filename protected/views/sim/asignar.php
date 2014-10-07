<h1 class="header-tittle">Simcards</h1><br>
<div class="content">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Asignar Simcard <?php echo "aqui va el numero imei"; ?></h3>
			</div>
			<div class="panel-body">
				<form id="crearSimcar" class="form form-horizontal" method="post" role="form"><br>


					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Cliente:</label>
						<div class="col-md-7">
							<select id="cliente" name="cliente" class="selectpicker">
								<option value="0">Seleccionar cliente</option>
							</select>
						</div>
					</div>	

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Estado:</label>
						<div class="col-md-7">
							<select id="select_estado" name="estado" class="selectpicker">
								<option value="0">Seleccionar estado</option>
								<?php
										$connection = Yii::app()->db;
										$sql = "SELECT * FROM estados";
										$command=$connection->createCommand($sql);
										$dataReader=$command->query();
										foreach($dataReader as $row){?>
											<option value="<?php echo $row['id_estados'];?>"><?php echo $row['estado'];?></option>
										<?php $arrayEstados[] = $row['id_estados'];}?>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label for="dateAsi" class="col-md-5 control-label">Fecha de asignación:</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="dateAsi" placeholder="dd/mm/aaaa">
						</div>
					</div>

					
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Tipo de dispositivo:</label>
						<div class="col-md-7">
							<select id="tipoDisp" name="tipoDisp" class="selectpicker">
								<option value="0">Seleccionar dispositivo</option>
							</select>
						</div>
					</div>


					<div class="form-group col-md-12 text-center">
						<label class="col-md-3 control-label">Coomentarios:</label>
						<div class="col-md-9 col-md-offset-2">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>


					<div class="buttons-submit col-md-10">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Asignar simcard</button>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<button href="" type="submit" class="btn btn-success">Cancelar</button>
						</div>
					</div>	

				</form>
				
			</div>
		</div>
	</div>
</div>
