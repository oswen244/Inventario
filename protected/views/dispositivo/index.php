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
		$('#btnAsignar').on('mouseover', function(event) {
			event.preventDefault();
			// $('#modalInfo').modal('toggle');
			// $.post('asignar', {tipo_disp: valores[2], imei: valores[6]})
			// .done(function(data){
			// 	// $(':root').html(data);
			// 	alert("Se debería cargar");
			// });
		// $.get('/inventario/sim/asignar', {tipo_disp: valores[2], imei: valores[6]})
		// 	.done(function(data){
		// 		// $(':root').html(data);
		// 		alert("Se debería cargar");
			$('#btnAsignar').attr('href', '<?php echo Yii::app()->request->baseUrl;?>/sim/asignar?tipo_disp='+valores[2]+'&imei='+valores[6]);
			// $('#btnAsignar').trigger('click');
			// });
		});
		// $('#tableInfo').dataTable({"paging": false, "searching": false, "ordering":false, "info": false} );
		pruebaDataTable(id, datos, atributos,nombres);
		validar("#editarDispositivo");
	});
	function pruebaDataTable(nombre, data, atributos, nombres) {
		
        // var columnas = columnList(atributos);
        var columnas = '['+columnList(atributos)+']';
        columnas = JSON.parse(columnas);
        var table = $(nombre).DataTable({
            data: data,
            dataType: "json",
            lengthMenu: [10, 20, 50, 75, 100 ],
            bLengthChange: true,
            columns: columnas
        });

        $(nombre+' tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
            // alert(table.fnGetPosition( this ));
        } );

		$(nombre+' tbody').on( 'dblclick', 'tr', function () { //Evento doble click sobre una fila de la tabla
			// editado = $(this);
			tr = $(this);
			$('tr').removeClass('selected'); // Se quitan las columnas seleccionadas
			$(this).toggleClass('selected'); // Sombrea la fila que se le hizo doble click por medio de la calse selected
			var p = table.row($(this)).data(); //obtiene los datos de la fila a partir del datasource del dataTable
			valores = new Array(); //variable global
			$.each(p, function(index, val) {
				valores.push(val); //se guardan únicamente los valores de la fila en un array
			});
			idDisp = valores[0]; //En la última posisición del Array está el id
			$('#modalInfoLabel').html('Información del dispositivo: '+idDisp); //Título del modal de Info
			$('#filas').empty(); //Se borra la info actual del modal de Info
			$(nombres).each(function(index, val) { //Se coloca la información en el modal
				if(valores[index+1]!=null){
					$('#filas').append('<tr><td width="50%" class="text-right">'+nombres[index]+'</td><td>&nbsp'+valores[index+1]+'</td></tr>');
				}else{
					$('#filas').append('<tr><td width="50%" class="text-right">'+nombres[index]+'</td><td>-</td></tr>');
				}
			});
			if(valores[valores.length-1]=='no'){
				$('#btnAsignar').addClass('disabled');
			}else{
				$('#btnAsignar').removeClass('disabled');
			}
			// table.ajax.reload();
			$('#modalInfo').modal({backdrop: 'static'}); //Muestra el modal con el fondo bloqueado
			$.post('view', {id: idDisp}) //Se obtienen los datos para el modal de Edit
			.done(function(data){
				var x = JSON.parse(data);
				var value = new Array();
				$.each(x[0], function(index, val) { //Coloca los datos para editar en un array para luego asignarlo a cada campo de entrada
					value.push(val);
				});
				$.post('getTypes', {proveedor: value[3]}) //Busca los tipos de dispositivo del proveedor actual
				.done(function(data){
					reloadTypes(data);
					$('form').find('[name]').each(function(index, el) { //Asigna los valores al formulario de edición
						$(this).val(value[index]);
					});
					$(".selectpicker").selectpicker('refresh'); //Refresca los selectpicker
				});
			});
        });
        $('#btnEditar').on('click', function(event) {
        	event.preventDefault();
        	// $('#modalInfo').modal('toggle'); //Quita el modal de Info
        	$('#modalEdit').modal({backdrop: 'static'}); //Muestra el modal de Edit
        });
        $('#btnGuardar').on('click', function(event) { //Oculta el modal de Edit, las acciones las maneja el Bootstrap Validator en el evento success
        	$('#modalEdit').modal('toggle');
        });
        $('#modalEdit').on('hidden.bs.modal', function (e) {
        	$('#editarDispositivo')[0].reset();
            $(".selectpicker",$('#editarDispositivo')).selectpicker('refresh');
            $('#editarDispositivo').data('bootstrapValidator').resetForm();
		});
}

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
		<input type="button" data-toggle="modal" class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<input type="button" data-toggle="modal" class="btnActions btn btn-success btn-sm" value="Facturar">
		<table id="dispTable" class="display responsive nowrap" width="100%" cellspacing="0">
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
						<div class="col-xs-3 col-xs-offset-3">
							<button id="btnEditar" data-dismiss="modal" class="btn btn-warning" type="button">Editar&nbsp</button>
						</div><br><br>
						<div class="col-xs-6">
							<a id="btnAsignar" class="btn btn-success" type="button">Asignar Simcard</a>
						</div>
						<div class="col-xs-3 col-xs-offset-3">
							<button id="btnCerrar" data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
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
										<select id="estado" data-width="100%" name="texto" class="selectpicker">
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
										<select id="proveedor" data-width="100%" name="texto" class="ignorar selectpicker">
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