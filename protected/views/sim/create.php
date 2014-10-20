<script>
	$(document).ready(function() {
		
		$("#link").on('click', function() { //Despliega el modal de cargar dispositivos por archivos
				$('#myModal').modal({backdrop: 'static'});
		});

	
		$('#crearSimcard').submit(function(event) {
			event.preventDefault();

			var formulario = $('#crearSimcard').serialize();

			 $.post('create', {data: formulario})
			 .done(function(data){
            	success(data,1);
			 	$('#crearSimcard')[0].reset();
            	$(".selectpicker").selectpicker('refresh');
			 });
			 
			 
		});
	});
</script>
<h1 class="header-tittle">Simcards</h1><br>
<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Registrar Simcard</h3>
		</div>
		<div class="panel-body">
			<form id="crearSimcard" class="form form-horizontal" action="create" method="post" role="form"><br>
				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">IMEI:</label>
					<div class="col-md-7">
						<input type="text" name="referencia" class="form-control" placeholder="N° Imei">
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="dateAct" class="col-md-5 control-label">Fecha de activación:</label>
					<div class="col-md-7">
						<input type="date" class="form-control" name="dateAct" placeholder="aaaa-mm-dd">
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">N° de linea:</label>
					<div class="col-md-7">
						<input type="text" name="numero" class="form-control" placeholder="N° de linea">
					</div>
				</div>
				
				<div  class="form-group col-md-6">
					<label class="col-md-5 control-label">Plan:</label>
					<div class="col-md-7">
						<select  id="plan" data-width="100%" name="plan" class="selectpicker">
							<option value="">Seleccionar Plan</option>
							<?php 
								$connection = Yii::app()->db;
								$sql = "SELECT id_plan, nombre_plan FROM planes";
								$command=$connection->createCommand($sql);
								$dataReader=$command->queryAll();
								foreach($dataReader as $row){?>
										<option value="<?php echo $row['id_plan'];?>"><?php echo $row['nombre_plan'];?></option>
								<?php }?>
							 ?>
						</select>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">Estado:</label>
					<div class="col-md-7">
						<select id="select_estado" data-width="100%" name="estado" class="selectpicker">
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

				<div class="form-group col-md-6">
					<label class="col-md-5 control-label">Proveedor:</label>
					<div class="col-md-7">
						<select id="proveedor" data-width="100%" name="proveedor" class="selectpicker">
							<option value="">Seleccionar Proveedor</option>
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


				<div class="form-group col-md-12 text-center">
					<a id="link">Ingresar simcards por archivo</a>
				</div>

				<div class="form-group col-md-12 text-center">
					<label class="col-md-3 control-label">Comentarios:</label>
					<div class="col-md-9 col-md-offset-2">
						<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
					</div>
				</div>

				<div class="buttons-submit col-md-9">
					<div class="col-md-2 col-md-offset-5">
						<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar dispositivo</button>
					</div>
					<div class="col-md-2 col-md-offset-1">
						<a href="#" class="btn btn-success">Cancelar</a>
					</div>
				</div>

			</form>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">INGRESAR SIMCARD AL INVENTARIO</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<form enctype="multipart/form-data" class="form form-horizontal" method="post" role="form">
									<div class="form-group col-md-12">
										<label for="archivo" class="col-md-2 control-label">Archivo:</label>
										<div class="col-md-7">
											<input class="filestyle" data-buttonText="Examinar" data-buttonName="btn-primary" type="file" class="form-control" name="archivo">
										</div>
									</div>
									<div class="col-xs-6 col-xs-offset-2">
										<button type="button" class="btn btn-success">Cargar archivo</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
