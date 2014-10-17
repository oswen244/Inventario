<script>
	$(document).ready(function() {
		$('.selectpicker').selectpicker();


		$("#tipo_entidad").on('change', function() { //Cuando se cambia el tipo_entidad se crean los tipos de dispositivos en el select respectivo

			var id_tipo_entidad = $("#tipo_entidad").val();
			if(id_tipo_entidad=='Cliente'){				
				$.post('getClients',  function(data) {
					reloadTypes(data);
				});
			}else{
				if(id_tipo_entidad=='Proveedor'){				
					$.post('getProveedores',  function(data) {
						reloadTypes(data);
					});
				}else{
					$("#contactoDe").empty();
					$('#contactoDe').append('<option value="">Seleccione una entidad</option>');//TODO
					$("#contactoDe").selectpicker('refresh');
					
				}
			
			}
	});

		function reloadTypes(data){
			var x = [];
			$('#contactoDe').empty();
			$('#contactoDe').append('<option value="">Seleccionar entidad</option>');
			x = JSON.parse(data);
			$.each(x, function(index, element) {
				var p = new Array();
				var cont=1;
				$.each(element, function(i, e) {
					p[cont]= i;
					cont++;
				});
				$("#contactoDe").append('<option value='+element[p[1]]+'>'+element[p[2]]+'</option>');
			});
			$("#contactoDe").selectpicker('refresh');
		}

		$('#form_contacto').submit(function(event) {
			event.preventDefault();

			var formulario = $('#form_contacto').serialize();
			 $.post('create', {data: formulario}, function(data) {
            	success(data,1);
			 	$('#form_contacto')[0].reset();
			 	$(".selectpicker").selectpicker('refresh');
        	});
		});
	});
</script>
<h1 class="header-tittle">Contactos</h1>

<div class="content">
	
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar contacto</h3>
		  	</div>
			<div class="panel-body">

				<form id="form_contacto" class="form form-horizontal" action="create" method="post" role="form"><br>
					<div class="form-group col-md-12">
						<label for="nombre" class="col-md-2 control-label">Nombre:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="tipo_entidad" class="col-md-5 control-label">Tipo de entidad:</label>
						<div class="col-md-7">
							<select id="tipo_entidad" name="tipo_entidad" data-width="100%" class="selectpicker">
								<option value="">Seleccionar tipo entidad</option>
								<option value="Cliente">Cliente</option>
								<option value="Proveedor">Proveedor</option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label for="contactoDe" class="col-md-5 control-label">Contacto de:</label>
						<div class="col-md-7">
							<select id="contactoDe" name="contactoDe" data-width="100%" class="selectpicker">
								<option value="">Seleccionar entidad</option>
							</select>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Teléfono:</label>
						<div class="col-md-7">
							<input type="text" name="telefono" class="form-control" placeholder="Teléfono">
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">E-mail:</label>
						<div class="col-md-7">
							<input type="text" name="email" class="form-control" placeholder="E-mail">
						</div>
					</div>

					<div class="form-group col-md-6">
						<label class="col-md-5 control-label">Cargo:</label>
						<div class="col-md-7">
							<input type="text" name="cargo" class="form-control" placeholder="Cargo">
						</div>
					</div>
					

					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Guardar contacto</button>
						</div>
						<div class="col-md-2">
							<button href="" type="submit" class="btn btn-success">Cancelar</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>