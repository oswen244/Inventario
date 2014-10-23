<script type="text/javascript">
	$(document).ready(function() {
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var x;
		var atributos = ["Referencia","Fecha_Adq","Estado","Proveedor","Imei_ref"];
		var nombres = ["Referencia:&nbsp","Tipo:&nbsp","Fecha de adquisición:&nbsp","Estado:&nbsp","Proveedor:&nbsp","IMEI:&nbsp","Precio de compra sin IVA:&nbsp","Precio de compra con IVA:&nbsp","Precio de venta sin IVA:&nbsp","Precio de venta con IVA:&nbsp","Comentario de dispositivo:&nbsp","Descripción del tipo de dispositivo:&nbsp","Ubicación:&nbsp"];
		$("#proveedor").on('change', function() { //Cuando se cambia el proveedor se crean los tipos de dispositivos en el select respectivo
			var id_proveedor = $("#proveedor").val();
			if(id_proveedor!=0){
				$.post('getTypes', {proveedor: id_proveedor}, function(data) {
					reloadTypes(data);
				});
			}else{
				$('#tipoDispositivo').empty().append('<option value="">Debes seleccionar un proveedor</option>');
				$(".selectpicker").selectpicker("refresh");
			}
		});
		$('#btnAsignar').on('mouseover', function() {
			$('#btnAsignar').attr('href', '<?php echo Yii::app()->request->baseUrl;?>/sim/asignar?tipo_disp='+valores[2]+'&imei='+valores[6]);
		});
		// $('#tableInfo').dataTable({"paging": false, "searching": false, "ordering":false, "info": false} );
		table = customDataTable(id, datos, atributos,nombres);
		$('#btnFacturar').on('click', function() {
			var msj = "";
			$.each(valoresDeFila(table), function(index, fila) { //Recorrer los valores seleccionados
				if(fila[14]==0){ // Si el dispositivo no se ha facturado
					msj = "Seleccionaste algún dispositivo que no está disponible, asegurate de facturar sólo dispositivos disponibles";
					success(msj,2);
					return false;
				}
			});
			if(msj.length != 0){
			}else{
				// success("Bien",1);
				// $.post('view');
				// window.location.href = '<?php echo Yii::app()->request->baseUrl;?>/dispositivo/create';
			}
		});
		validar("#editarDispositivo");
	});

function reloadTypes(data){ //Actualiza el select de tipo de dispositivo dependiendo del proveedor escogido
		var x = [];
		$('#tipoDispositivo').empty().append('<option value="">Seleccionar Tipo de dispositivo</option>');
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
<h1 class="header-tittle">Dispositivos</h1>

<div class="content">
	<div class="content-side">
		<button id="btnEliminar" class="btnActions btn btn-danger btn-sm">Eliminar</button>
		<button id="btnFacturar" class="btnActions btn btn-success btn-sm">Facturar</button>
		<table id="dispTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Referencia</th>
						<th>Fecha adq</th>
						<th>Estado</th>
						<th>Proveedor</th>
						<th>IMEI</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
		</table>
	</div>
	<div class="modal fade" id="modalFacturar" tabindex="-1" role="dialog" aria-labelledby="modalFacturarLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Facturación de artículos</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table id="tableFact" class="display responsive nowrap table-striped" width="100%" cellspacing="0">
								<thead>
									<tr class="text-center">
										<th>Referencia</th>
										<th>Imei</th>
										<th>Precio de venta sin IVA</th>
										<th>Precio de venta con IVA</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div><br>
					<div class="row">
						<div class="buttons-submit col-sm-3">
							<a id="btnRegistraFactura" class="btn btn-success" type="button">Registrar factura</a>
						</div>
						<div class="buttons-submit col-sm-3 col-sm-offset-3">
							<button data-dismiss="modal" class="btn btn-primary" type="button">Volver</button>
						</div>
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
							<table id="tableInfo" class="display responsive nowrap table-hover table-striped" width="100%" cellspacing="0">
								<tbody id="filas">

								</tbody>
							</table>
						</div>
					</div><br>
					<div class="row">
						<div class="buttons-submit col-sm-3 col-sm-offset-3">
							<button id="btnEditar" data-dismiss="modal" class="btn btn-warning" type="button">Editar</button>
						</div>
						<div class="buttons-submit col-sm-3">
							<a id="btnAsignar" class="btn btn-success" type="button">Asignar Simcard</a>
							<p id="msjSim" class="text-center"></p>
						</div>
						<!-- <div class="buttons-submit col-sm-4">
							<button id="btnCerrar" data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
						</div> -->
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
					<h4 class="modal-title" id="modalEditLabel">Actualización de dispositivo</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<form id="editarDispositivo" action="update" accept-charset="utf-8" class="form form-horizontal" role="form"><br>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Fecha de adquisición:</label>
									<div class="col-md-7">
										<input type="date" class="form-control" name="fecha" placeholder="aaaa-mm-dd">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">IMEI o referencia:</label>
									<div class="col-md-7">
										<input type="text" name="texto" class="form-control" placeholder="IMEI o referencia">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Estado:</label>
									<div class="col-md-7">
										<select id="estado" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
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
										<select id="proveedor" data-live-search="true" data-width="100%" name="texto" class="ignorar selectpicker">
											<option value="">Seleccionar proveedor</option>
											<?php
													$connection = Yii::app()->db;
													$sql = "SELECT * FROM proveedores";
													$command=$connection->createCommand($sql);
													$dataReader=$command->query();
													foreach($dataReader as $row){?>
														<option value="<?php echo $row['id_proveedor'];?>"><?php echo $row['nombre'];?></option>
											<?php	}?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Tipo de dispositivo:</label>
									<div class="col-md-7">
										<select id="tipoDispositivo" data-width="100%" name="texto" class="selectpicker">
											<option value="">Seleccionar Tipo de dispositivo</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-2 control-label">Comentario:</label>
									<div class="col-md-11 col-md-offset-1">
										<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-2 control-label">Ubicación:</label>
									<div class="col-md-11 col-md-offset-1">
										<textarea type="textArea" name="comentario" class="form-control" placeholder="Ubicación..."></textarea>
									</div>
								</div>
								<div class="buttons-submit col-sm-12">
									<div class="col-sm-3 col-sm-offset-2">
										<button id="btnGuardar" type="submit" class="btn btn-primary">Actualizar dispositivo</button>
									</div>
									<div class="col-sm-2 col-sm-offset-2">
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