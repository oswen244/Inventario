<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $sims; ?>;
	    var id = '#simTable';
	    var atributos = ["f_act","num_linea","imei_sc","tipo_plan","comentario","id_estados","id_proveedor","id_plan","imei_disp"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>

<h1 class="header-tittle">Simcards</h1>

<div class="content">
	
	<div class="content-side">
		<table id="simTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Fecha act</th>
					<th>Número linea</th>
					<th>Imei</th>
					<th>Tipo plan</th>
					<th>Comentario</th>
					<th>Estado</th>
					<th>Proveedor</th>
					<th>Plan</th>
					<th>Imei disp</th>
				</tr>
			</thead>
		
			<tbody>

			</tbody>
	</table>
	</div>

</div>