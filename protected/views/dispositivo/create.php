<script>
	$(document).ready(function() {
		validar("#crearDispositivo");
		$('.selectpicker').selectpicker();
		$(":file").filestyle();
		$("#proveedor").on('change', function() {
			var id_proveedor = $("#proveedor").val();
			if(id_proveedor!=0){
				$.post('getTypes', {proveedor: id_proveedor}, function(data) {
					reloadTypes(data);
					$("#crearDispositivo").bootstrapValidator('revalidateField', 'tipoDispositivo');
				});
			}
		});
		$("#link").on('click', function() {
				$('#myModal').modal({backdrop: 'static'});
		});
	});
	function verifySelects(){
		var selects = $("select");
		var decision = true;
		$.each(selects, function(index, val) {
			if($("#"+val.id).val()==0){
				decision = false;
			}
		});
		return decision;
	}
	function reloadTypes(data){
		var x = [];
		$('#tipoDispositivo').empty();
		$('#tipoDispositivo').append('<option value="">Seleccionar Tipo de dispositivo</option>');
		x = JSON.parse(data);
		$.each(x, function(index, element) {
			var p = new Array();
			var cont=1;
			$.each(element, function(i, e) {
				p[cont]= i;
				cont++;
			});
				$("#tipoDispositivo").append('<option value='+element[p[1]]+'>'+element[p[3]]+'</option>');
			});
			$("#tipoDispositivo").selectpicker('refresh');
	}
</script>
<h1 class="header-tittle">Dispositivos</h1><br>
<div class="content">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Registrar dispositivo</h3>
			</div>
			<div class="panel-body">
				<form id="crearDispositivo" action="create" class="form form-horizontal" method="post" role="form"><br>
					<div class="form-group col-md-6">
						<label for="dateAdq" class="col-md-5 control-label">Fecha de adquisición:</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="dateAdq" placeholder="dd/mm/aaaa">
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
							<select id="estado" data-width="100%" name="estado" class="selectpicker">
								<option value="">Seleccionar estado</option>
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
							<select id="proveedor" data-width="100%" name="proveedor" class="selectpicker">
								<option value="">Seleccionar proveedor</option>
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
							<select id="tipoDispositivo" data-width="100%" name="tipoDispositivo" class="selectpicker">
								<option value="">Seleccionar Tipo de dispositivo</option>
								<option value="">Debes escoger un proveedor</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-12 text-center">
						<a id="link">Ingresar dipositivos por archivo</a>
					</div>
					<div class="form-group col-md-12">
						<label class="col-md-2 control-label">Coomentario:</label>
						<div class="col-md-10 col-md-offset-2">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-3">
						<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar dispositivo</button>
					</div><br>
					<div class="col-md-3">
						<a href="#" class="btn btn-success">Cancelar</a>
					</div>
				</form>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">INGRESAR DISPOSITIVOS AL INVENTARIO</h4>
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
											<a class="btn btn-success">Cargar archivo</a>
											<a class="btn btn-danger" data-dismiss="modal">Close</a>
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
