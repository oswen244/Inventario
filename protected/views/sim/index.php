<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = ["Fecha de activación:", "Número de línea:", "Imei de la simcard:", "Estado:", "Proveedor:", "Tipo de plan:", "Plan:", "Comentario:", "Estado de asignación:", "Fecha de asignación:", "Imei del dispositivo asignado:"];
		var datos = <?php echo $sims; ?>;
		var atributos = ["Fecha_act","Numero","Imei","Estado","Proveedor","Plan"];
		var table= customDataTable('#simTable', datos, atributos, nombres);
		$('#dialog').click(function() {
            borrar(table,'#myModal','#delete');
        });
        validar('#editarSimcard');
	});

</script>

<h1 class="header-tittle">Simcards</h1>

<div class="content">
	
	<div class="content-side">
		<input type="button" id="dialog" data-toggle="modal" class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<table id="simTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Fecha de activación</th>
					<th>Número de linea</th>
					<th>Imei</th>
					<th>Estado</th>
					<th>Proveedor</th>
					<th>Plan</th>
				</tr>
			</thead>

			<tbody>

			</tbody>
		</table>
		<div id="myModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Advertencia</h4>
					</div>
					<div class="modal-body">
						<p>Se borrarán los registros seleccionados</p>
					</div>
					<div class="modal-footer">
						<button id="delete" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modalInfoLabel"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table id="tableInfo" class="table table-responsive table-hover table-striped" width="100%" cellspacing="0">
								<tbody id="filas">

								</tbody>
							</table>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-3 col-sm-offset-3">
							<button id="btnEditar" data-dismiss="modal" class="btn btn-primary" type="button">Editar</button>
						</div>
						<div class="col-sm-4">
							<a id="btnDesAsignar" class="btn btn-success" type="button">Desasignar Simcard</a>
							<p id="msjSim" class="text-center"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modalEditLabel">Actualización de simcard</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<form id="editarSimcard" method="post" action="update" accept-charset="utf-8" class="form form-horizontal" role="form"><br>
								<div class="form-group col-md-6">
									<label for="imei" class="col-md-5 control-label">Imei de la simcard:</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="texto" placeholder="Imei de sim">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="dateAct" class="col-md-5 control-label">Fecha de activación:</label>
									<div class="col-md-7">
										<input type="date" class="form-control" name="fecha" placeholder="aaaa-mm-dd">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="dateAsig" class="col-md-5 control-label">Fecha de asignación:</label>
									<div class="col-md-7">
										<input id="fechaAsig" type="date" class="form-control" name="date" placeholder="aaaa-mm-dd">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">N° de linea:</label>
									<div class="col-md-7">
										<input type="text" name="texto" class="form-control" placeholder="N° de linea">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Plan:</label>
									<div class="col-md-7">
										<select id="plan" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
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
										<select id="select_estado" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
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
										<select id="proveedor" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
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
									<label class="col-md-3 control-label">Comentarios:</label>
									<div class="col-md-9 col-md-offset-2">
										<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
									</div>
								</div>

								<input type="text" name="helper" class="helper form-control">

								<div class="buttons-submit col-md-9">
									<div class="col-md-2 col-md-offset-5">
										<button id="btnGuardar" type="submit" class="btn btn-primary">Actualizar simcard</button>
									</div>
									<div class="col-md-2 col-md-offset-1">
										<a href="" data-dismiss="modal" class="btn btn-success">Cancelar</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>