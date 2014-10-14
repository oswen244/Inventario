<script>
	$(document).ready(function() {
		// var dbNames = ["f_adquirido", "imei_ref", "id_estado", "id_proveedor", "tipo_disp", "comentario"];
		var ignorar = ["proveedor"];
		validar("#crearDispositivo",ignorar); //Activa el bootstrapValidator
		$('.selectpicker').selectpicker(); //Convierte los selects
		$(":file").filestyle(); //Convierte los input tipo files
		$('#infoDisp').dataTable({"paging": false, "searching": false, "ordering":false, "info": false} ); //Crea el datatable sin paginación, sin filtros
		$("#proveedor").on('change', function() { //Cuando se cambia el proveedor se crean los tipos de dispositivos en el select respectivo
			var id_proveedor = $("#proveedor").val();
			if(id_proveedor!=0){
				$.post('getTypes', {proveedor: id_proveedor}, function(data) {
					reloadTypes(data);
					$("#crearDispositivo").bootstrapValidator('revalidateField', 'tipoDispositivo');
				});
			}
		});
		$("#tipoDispositivo").on('change', function() { //Acualiza la tabla de precios cuando se cambia un tipo de dispositivo
			var id_dispositivo = $("#tipoDispositivo").val();
			if(id_dispositivo!=0){
				$.post('getPrices', {tipo: id_dispositivo}, function(data) {
					reloadTable(data);
				});
			}
			// $('#infoDisp').ajax.reload();
		});
		$("#link").on('click', function() { //Despliega el modal de cargar dispositivos por archivos
				$('#myModal').modal({backdrop: 'static'});
		});
		// $('#crearDispositivo').submit(function(event) {
		// 	event.preventDefault();
		//     var fields = $('#crearDispositivo').data('bootstrapValidator').getOptions().fields,
		//         $parent;

		//     for (var field in fields) {
		//         $parent = $('[name="' + field + '"]').parent();
		//         alert(field+"  "+$parent.html());
		//     }
		        
		// 	// var formulario = $(this).serialize();
		// 	// $.post('create', {data: formulario}, function(data) {
  //  //          	success(data);
  //  //      	});
		// // alert(formulario);
		// });
		
	});
	function reloadTable(data){
		var x = [];
		x = JSON.parse(data);
		$('#prices').empty();
		$.each(x, function(index, element) {
			var p = new Array();
			var cont=1;
			$.each(element, function(i, e) {
				if(e==null){
					e="-";
				}
				$('#prices').append('<td>'+e+'</td>');
			});
		});
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
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Registrar dispositivo</h3>
			</div>
			<div class="panel-body">
				<form id="crearDispositivo" action="create" class="form form-horizontal" role="form"><br>
					<div class="form-group col-md-6">
						<label for="date" class="col-md-5 control-label">Fecha de adquisición:</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="date" placeholder="aaaa-mm-dd">
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
					<div class="col-md-10 col-lg-offset-1">
						<table id="infoDisp" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Prec_compra_sin_IVA</th>
									<th>Prec_compra_con_IVA</th>
									<th>Prec_venta_sin_IVA</th>
									<th>Prec_venta_con_IVA</th>
									<th>Descripción del tipo</th>
								</tr>
							</thead>
							<tbody>
								<tr id="prices" class="text-center">
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="form-group col-md-12">
						<label class="col-md-2 control-label">Comentario:</label>
						<div class="col-md-11 col-md-offset-1">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>
					<div class="buttons-submit col-sm-9">
						<div class="col-sm-2 col-sm-offset-5">
							<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar dispositivo</button>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<a href="#" class="btn btn-success">Cancelar</a>
						</div>
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
