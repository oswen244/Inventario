<script type="text/javascript">
	$(document).ready(function() {
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var x;
		var atributos = ["Referencia","Fecha_Adq","Estado","Proveedor","Imei_ref","Facturado"];
		var nombres = ["Referencia:","Tipo:","Fecha de adquisición:","Estado:","Proveedor:","IMEI:","Precio de compra sin IVA:","Precio de compra con IVA:","Precio de venta sin IVA:","Precio de venta con IVA:","Comentario de dispositivo:","Descripción del tipo de dispositivo:","Ubicación:"];
		$("#proveedor").on('change', function() { //Cuando se cambia el proveedor se crean los tipos de dispositivos en el select respectivo
			var id_proveedor = $("#proveedor").val();
			if(id_proveedor!=0){
				$.post('getTypes', {proveedor: id_proveedor}).done(function(data) {
					recargaTipos(data);
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
		$('.helper').hide(); //Esconde el textarea utilizado como comodín para pasar los parámetros por POST
		table = customDataTable(id, datos, atributos, nombres);
		// $('#btnRegistraFactura').on('click', function(event) {
			// $('#modalFacturar').modal('toggle');
		// });
		$('#modalFacturar').on('hidden.bs.modal', function (e) { //Cuando se oculta el modal de Edit se reestablecen los valores del Form y las validaciones anteriores
        	$('#facturaForm')[0].reset();
        	$(".selectpicker",$('#facturaForm')).selectpicker('refresh');
        	$('#facturaForm').data('bootstrapValidator').resetForm();
        });

		$('#btnFacturar').on('click', function() {
			if($('#dispTable .selected').length == 0){ // Se asegura de que haya seleccionado al menos un artículo para facturar
				success("Debes seleccionar algún Artículo para poder facturar",2);
			}else{
				var msj = "";
				cadDatos = "";
				var valoresFilas = valoresDeFila(table);
				$('#filasFact').empty();
				$.each(valoresFilas, function(index, fila) { //Recorrer los valores seleccionados y arma una cadena seteada para mandarla al controlador
					if(index != 0){
						if(index != valoresFilas.length){
							cadDatos += "{-}"; //Separador entre filas
						}
					}
					if(fila[14]=='Facturado' || fila[9] == null || fila[10] == null){
						if(fila[14]=='Facturado'){ // Si el dispositivo ya se facturó
							msj = "Seleccionaste algún artículo que ya ha sido facturado, asegurate de facturar sólo artículos disponibles";
						}
						if(fila[9] == null || fila[10] == null){
							msj = "El tipo de artículo "+fila[1]+" "+fila[6]+" no tiene precio de venta por el cual facturar, asignale un precio de venta a este tipo de artículo para poder realizar la facturación";
						}
						success(msj,2);
						return false; //Si encuentra un dispositivo ya facturado detiene el $.each
					}
					cadDatos += fila[0]+"{,}"+fila[9]+"{,}"+fila[10]; //Separador entre datos de fila
					$('#filasFact').append('<tr class="text-center"><td>'+fila[1]+'</td><td>'+fila[6]+'</td><td>'+fila[9]+'</td><td>'+fila[10]+'</td><td>'+fila[14]+'</td></tr>');
				});
				if(msj.length == 0){
					$('#helper').val(cadDatos);
					$('#modalFacturar').modal({backdrop: 'static'});
					
					// window.location.href = '<?php echo Yii::app()->request->baseUrl;?>/dispositivo/create';
				}
			}
		});
		validar("#editarDispositivo");
		validar("#facturaForm");
	});

function recargaTipos(data){ //Actualiza el select de tipo de dispositivo dependiendo del proveedor escogido
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
				$("#tipoDispositivo").append('<option value='+element[p[1]]+'>'+element[p[2]]+'</option>');
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
					<tr class="busqueda">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Referencia</th>
						<th>Fecha adquirido</th>
						<th>Estado</th>
						<th>Proveedor</th>
						<th>IMEI</th>
						<th>Estado de facturación</th>
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
						<form id="facturaForm" class="form form-horizontal" action="facturar" role="form">
							<div class="form-group col-md-10">
								<label class="col-md-5 control-label">Cliente:</label>
								<div class="col-md-7">
									<select id="cliente" data-live-search="true" data-width="100%" name="texto" class="selectpicker">
										<option value="">Seleccionar cliente</option>
										<?php
										$connection = Yii::app()->db;
										$sql = "SELECT * FROM clientes";
										$command=$connection->createCommand($sql);
										$dataReader=$command->query();
										foreach($dataReader as $row){?>
											<option value="<?php echo $row['id_cliente'];?>"><?php echo $row['nombre'];?></option>
										<?php }?>
									</select>
								</div>
							</div>
								<textarea id="helper" name="helper"></textarea>
							<div class="col-xs-12">
								<table id="tableFactura" class="table table-hover table-bordered table-striped" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th class="text-center">Referencia</th>
											<th class="text-center">Imei</th>
											<th class="text-center">Precio de venta sin IVA</th>
											<th class="text-center">Precio de venta con IVA</th>
											<th class="text-center">Estado de facturación</th>
										</tr>
									</thead>
									<tbody id="filasFact">
										
									</tbody>
								</table>
							</div>
							<div class="buttons-submit col-sm-12">
								<div class="col-sm-4 col-sm-offset-2">
									<button id="btnRegistraFactura" class="btn btn-success" type="submit">Registrar factura</button>
								</div>
								<div class="col-sm-3">
									<button data-dismiss="modal" class="btn btn-primary" type="button">Volver</button>
								</div>
							</div>
						</form>
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
						<div class="col-sm-3">
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
								<input type="text" name="helper" class="helper form-control">
								<div class="buttons-submit col-sm-12">
									<div class="col-sm-3 col-sm-offset-2">
										<button id="btnGuardar" data-dismiss="modal" type="submit" class="btn btn-primary">Actualizar dispositivo</button>
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