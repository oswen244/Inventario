<h1 class="header-tittle">Simcards</h1><br>
<div class="content">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Registrar Simcard</h3>
			</div>
			<div class="panel-body">
				<form id="crearSimcar" class="form form-horizontal" method="post" role="form"><br>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">IMEI:</label>
						<div class="col-md-7">
							<input type="text" name="referencia" class="form-control" placeholder="N° Imei">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="dateAct" class="col-md-5 control-label">Fecha de activación:</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="dateAct" placeholder="dd/mm/aaaa">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">N° de linea:</label>
						<div class="col-md-7">
							<input type="text" name="numero" class="form-control" placeholder="N° de linea">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Tipo de plan:</label>
						<div class="col-md-7">
							<select id="tipoPlan" data-width="100%" name="tipoPlan" class="selectpicker">
								<option value="0">Seleccionar plan</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Estado:</label>
						<div class="col-md-7">
							<select id="select_estado" data-width="100%" name="estado" class="selectpicker">
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
						<label class="col-md-5 control-label">Plan:</label>
						<div class="col-md-7">
							<select id="plan" name="plan" class="selectpicker">
								<option value="0">Seleccionar Plan</option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Proveedor:</label>
						<div class="col-md-7">
							<select id="proveedor" data-width="100%" name="proveedor" class="selectpicker">
								<option value="0">Seleccionar Proveedor</option>
							</select>
						</div>
					</div>


					<div class="form-group col-md-12 text-center">
						<a href="#" data-toggle="modal" data-target="#myModal">Ingresar simcards por archivo</a>
					</div>

					<div class="form-group col-md-12 text-center">
						<label class="col-md-3 control-label">Coomentarios:</label>
						<div class="col-md-9 col-md-offset-2">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>


					<div class="buttons-submit col-md-10">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar Simcard</button>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<button href="" type="submit" class="btn btn-success">Cancelar</button>
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
</div>