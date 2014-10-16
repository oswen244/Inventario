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
			var nombres = ["Referencia:","Tipo:","Fecha de adquisición:","Estado:","Proveedor","IMEI","Precio de compra sin IVA:","Precio de compra con IVA:","Precio de venta sin IVA:","Precio de venta con IVA:","Comentario de dispositivo:","Descripción del tipo de dispositivo:"];
			var valores = new Array();
			$.each(p, function(index, val) {
				valores.push(val);
			});
			$('#modalInfoLabel').html('Información del dispositivo: '+valores[valores.length-1]);
			$('.filita').each(function(index, val) {
				$(this).empty();
				$(this).append('<td>'+nombres[index]+'</td><td>'+valores[index]+'</td>');
			});
			$('#modalInfo').modal({backdrop: 'static'});
        } );
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
					<div class="modal-dialog modal-lg">
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
									<div class="col-xs-2 col-xs-offset-4">
										<button id="btnEditar" class="btn btn-success" type="button">Editar</button>
									</div><br>
									<div class="col-xs-6">
										<button id="btnAsignar" class="btn btn-primary" type="button">Asignar Simcard</button>
									</div>
									<div class="col-xs-2 col-xs-offset-4">
										<button id="btnCerrar" class="btn btn-primary" type="button">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
</div>