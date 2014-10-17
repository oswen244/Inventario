<script type="text/javascript">
	$(document).ready(function() {
		validar("#editarDispositivo");
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var atributos = ["Referencia","Fecha_Adq","Estado","Proveedor","Imei_ref"];
		var nombres = ["Referencia:&nbsp","Tipo:&nbsp","Fecha de adquisición:&nbsp","Estado:&nbsp","Proveedor:&nbsp","IMEI:&nbsp","Precio de compra sin IVA:&nbsp","Precio de compra con IVA:&nbsp","Precio de venta sin IVA:&nbsp","Precio de venta con IVA:&nbsp","Comentario de dispositivo:&nbsp","Descripción del tipo de dispositivo:&nbsp","Ubicación:&nbsp"];
		// $('#tableInfo').dataTable({"paging": false, "searching": false, "ordering":false, "info": false} );
		pruebaDataTable(id, datos, atributos,nombres);
	});
	function pruebaDataTable(nombre, data, atributos, nombres) {
        
        var columnas = columnList(atributos);
        columnas = '['+columnList(atributos)+']';

        columnas = JSON.parse(columnas);
        var table = $(nombre).DataTable( {
            data: data,
            dataType: "json",
            lengthMenu: [10, 20, 50, 75, 100 ],
            bLengthChange: true,
            columns: columnas
              
        });

        $(nombre+' tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

		$(nombre+' tbody').on( 'dblclick', 'tr', function () {
			$('tr').removeClass('selected');
			$(this).toggleClass('selected');
			var p = table.row($(this)).data();
			valores = new Array(); //variable global
			$.each(p, function(index, val) {
				valores.push(val);
			});
			idDisp = valores[valores.length-1];
			$('#modalInfoLabel').html('Información del dispositivo: '+idDisp);
			$('#filas').html("");
			$(nombres).each(function(index, val) {
				if(valores[index]!=null){
					$('#filas').append('<tr><td class="text-right">'+nombres[index]+'</td><td>&nbsp'+valores[index]+'</td></tr>');
				}else{
					$('#filas').append('<tr><td class="text-right">'+nombres[index]+'</td><td>-</td></tr>');
				}
			});
			// table.ajax.reload();
			$('#modalInfo').modal({backdrop: 'static'});
			$.post('view', {id: idDisp}, function(data) {
				var x = JSON.parse(data);
				var datos = new Array();
				$.each(x[0], function(index, val) {
					datos.push(val);
				});
				$('form').find('[name]').each(function(index, el) {
					$(this).val(datos[index]);
					$(".selectpicker").selectpicker('refresh');
					// alert(el.name+": "+datos[index]);
				});
			});
        } );
        $('#btnEditar').on('click', function(event) {
        	event.preventDefault();
        	// $('#modalInfo').modal('toggle');
        	$('#modalEdit').modal({backdrop: 'static'});
        });
        $('#btnGuardar').on('click', function(event) {
        	$('#modalEdit').modal('toggle');
        });
  //       $('#modalEdit').on('hidden.bs.modal', function (e) {
        	
		// });
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
							<button id="btnAsignar" class="btn btn-success" type="button">Asignar Simcard</button>
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
											<?php
													$connection = Yii::app()->db;
													$sql = "SELECT * FROM tipo_disp";
													$command=$connection->createCommand($sql);
													$dataReader=$command->query();
													foreach($dataReader as $row){?>
														<option value="<?php echo $row['id_tipo'];?>"><?php echo $row['nombre'];?></option>
											<?php	}?>
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
										<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
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