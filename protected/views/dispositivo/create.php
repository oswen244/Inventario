<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/validator.js"></script>
<script>
	$(document).ready(function() {
		validar("#crearDispositivo");
		function typesBlock(){
			$("#tipoDispositivo").attr('disabled', '');
			$("#tipoDispositivo").selectpicker('refresh');
		}
			$("#btnGuardar").attr('disabled', '');
		$('.selectpicker').selectpicker();
		$(":file").filestyle();
		typesBlock();
		$("#proveedor").on('change', function() {
			var id_proveedor = $("#proveedor").val();
			if(id_proveedor!=0){
				$.post('getTypes', {proveedor: id_proveedor}, function(data) {
					reloadTypes(data);
				});
			}else{
				typesBlock();
			}
		});
		$("#estado").on('change', function() {
			validarBtn();
		});
	});
	function validarBtn(){
		if($("#tipoDispositivo").val()!=0 && $("#estado").val()!=0){
			$("#btnGuardar").removeAttr('disabled')
		}else{
			$("#btnGuardar").attr('disabled', '');
			if($("#estado").val()==0){
				alert("Debes seleccionar un estado");
			}
		}
	}
	function reloadTypes(data){
		var x = [];
		var parent = $("#tipoDispositivo").parent();
		$('#tipoDispositivo').selectpicker('destroy');
		parent.append('<select id="tipoDispositivo" onchange="validarBtn()" data-width="100%" name="tipoDispositivo" class="selectpicker"><option value="0">Seleccionar Tipo de dispositivo</option></select>');
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
			$('#tipoDispositivo').selectpicker();
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
					<div class="col-md-12">
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
						
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-6">
							<label class="col-md-5 control-label">Estado:</label>
							<div class="col-md-7">
								<select id="estado" data-width="100%" name="estado" class="selectpicker">
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
								<select id="proveedor" data-width="100%" name="proveedor" class="selectpicker">
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
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-6">
							<label class="col-md-5 control-label">Tipo de dispositivo:</label>
							<div class="col-md-7">
								<select id="tipoDispositivo" data-width="100%" name="tipoDispositivo" class="selectpicker">
									<option value="0">Seleccionar Tipo de dispositivo</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12 text-center">
						<a href="#" data-toggle="modal" data-target="#myModal">Ingresar dipositivos por archivo</a>
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
