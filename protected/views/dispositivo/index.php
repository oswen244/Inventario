<script type="text/javascript">
	$(document).ready(function() {
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var atributos = ["Referencia","Fecha_Adq","Estado","Proveedor","Imei_ref"];
		// $('#tableInfo').dataTable({"paging": false, "searching": false, "ordering":false, "info": false} );
		pruebaDataTable(id, datos, atributos);
	});
	function pruebaDataTable(nombre, data, atributos) {
        
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
			var p = table.row($(this)).data();
			var nombres = ["Referencia:&nbsp","Tipo:&nbsp","Fecha de adquisición:&nbsp","Estado:&nbsp","Proveedor:&nbsp","IMEI:&nbsp","Precio de compra sin IVA:&nbsp","Precio de compra con IVA:&nbsp","Precio de venta sin IVA:&nbsp","Precio de venta con IVA:&nbsp","Comentario de dispositivo:&nbsp","Descripción del tipo de dispositivo:&nbsp"];
			var valores = new Array();
			$.each(p, function(index, val) {
				valores.push(val);
			});
			$('#modalInfoLabel').html('Información del dispositivo: '+valores[valores.length-1]);
			$('.filita').each(function(index, val) {
				$(this).empty();
				$(this).append('<td class="text-right">'+nombres[index]+'</td><td>&nbsp'+valores[index]+'</td>');
			});
			$('#modalInfo').modal({backdrop: 'static'});
        } );
        $('#btnEditar').on('click', function(event) {
        	event.preventDefault();
        	$('#modalInfo').modal('toggle');
        	$('#modalEdit').modal({backdrop: 'static'});
        });
        $('#modalEdit').on('hidden.bs.modal', function (e) {
        	$('#modalInfo').modal('toggle');
		})

}
</script>
<h1 class="header-tittle">Dispositivos</h1>

<div class="content">
	<div class="content-side">
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
								<tbody>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
									<tr class="filita"></tr>
								</tbody>
							</table>
						</div>
					</div><br>
					<div class="row">
						<div class="col-xs-3 col-xs-offset-3">
							<button id="btnEditar" class="btn btn-warning" type="button">Editar&nbsp</button>
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
							<form id="editarDispositivo" action="update" class="form form-horizontal" role="form"><br>
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
													<?php }?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="col-md-5 control-label">Tipo de dispositivo:</label>
									<div class="col-md-7">
										<select id="tipoDispositivo" data-width="100%" name="texto" class="selectpicker">
											<option value="">Seleccionar Tipo de dispositivo</option>
											<option value="">Debes escoger un proveedor</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-2 control-label">Comentario:</label>
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