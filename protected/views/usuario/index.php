<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = [];
		var datos = <?php echo $users; ?>;
		var atributos = ["usuario","nombre","perfil"];
		$('#usuariosTable tr:last-child th').each(function() {
			nombres.push($(this).html()+":");
		});
		var table = customDataTable('#usuariosTable', datos, atributos,nombres);
		$('#btnEditar').unwrap();
		$('#btnEditar').removeClass();
		$('#btnEditar').addClass('btn btn-primary col-xs-4 col-xs-offset-4');
		$('#dialog').click(function(event) {
			borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');
		});

	    validar('#form_usuario');


	});

</script>


<h1 class="header-tittle">Usuarios</h1>

<div class="content">
	<div class="content-side">
		<input type="button" id="dialog" data-toggle="modal" class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<table id="usuariosTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr class="busqueda">
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Perfil</th>
					</tr>
				</thead>

				<tbody>

				</tbody>
		</table>
		

		<div id="modalCascade" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title">Advertencia</h4>
						</div>
						<div class="modal-body">
							<p></p>
						</div>
						<div class="modal-footer">
							<button id="deleteCascade" type="button" class="btn btn-primary" data-dismiss="modal">Si</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						</div>
					</div>
				</div>
			</div>

					<!-- Modal de edicion -->
		<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="modalEditLabel">Actualización de Usuario</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">

							<!-- Formulario-->
								<form id="form_usuario" class="form form-horizontal" action="update" method="post" role="form"><br>
									
									<div class="form-group col-md-9">
										<label for="nombre" class="col-md-5 control-label">Nombre:</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="texto" placeholder="Nombre">
										</div>
									</div>

									<div class="form-group col-md-9">
										<label for="usuario" class="col-md-5 control-label">Usuario:</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="texto" placeholder="Usuario">
										</div>
									</div>

									<div class="form-group col-md-9">
										<label class="col-md-5 control-label">Perfil:</label>
										<div class="col-md-7">
											<select data-live-search="true" data-width="100%" name="texto" class="selectpicker">
												<option value="">Seleccionar Perfil</option>
												<?php
													foreach($perfiles as $row){?>
														<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<input type="text" name="helper" class="helper form-control" placeholder="">

									<div class="buttons-submit col-sm-12">
										<div class="col-sm-3 col-sm-offset-2">
											<button id="btnGuardar" data-dismiss="modal" type="submit" class="btn btn-primary">Actualizar usuario</button>
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
</div>