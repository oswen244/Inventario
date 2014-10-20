<script>
$(document).ready(function() {
	validar('#form_tipo');

	$('.precios').on('change', function(){
		var precios;
		if($('#pc_siva').val()!='' && $('#pc_siva').val()!='' && $('#pc_siva').val()!=''){
			var precios =[];
			var iva = parseFloat($('#porcIVA').val());
 			var pcsiva = parseFloat($('#pc_siva').val());
  			var pvsiva = parseFloat($('#pv_siva').val());
  			precios = precioIva(pcsiva,pvsiva,iva);
			$('#pc_iva').attr('value', '$'+precios[0]);
			$('#pv_iva').attr('value', '$'+precios[1]);
		}

	});


});
</script>

<h1 class="header-tittle">Tipos de dispositivos</h1>

<div class="content">

	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar Tipo Nuevo</h3>
		  	</div>
			<div class="panel-body">
				<form id="form_tipo" class="form form-horizontal" action="create" method="post" role="form"><br>

					<div class="form-group col-md-9">
						<label for="nombre" class="col-md-5 control-label">Nombre:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Nombre">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label for="tipo_ref" class="col-md-5 control-label">Tipo o referencia:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="texto" placeholder="Tipo o referencia">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">Proveedor:</label>
						<div class="col-md-7">
							<select id="proveedor" data-width="100%" name="texto" class="selectpicker">
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
					
					<div class="form-group col-md-9">
						<label for="pc_siva" class="col-md-5 control-label">Precio de compra sin IVA:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input id="pc_siva" value="" type="number" class="precios form-control" name="texto" placeholder="Precio compra sin iva"><span class="input-group-addon">.00</span>
						</div>
					</div>
					

					<div class="form-group col-md-9">
						<label for="pv_siva" class="col-md-5 control-label">Precio de venta sin IVA:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input id="pv_siva" value="" type="number" class="precios form-control" name="texto" placeholder="Precio venta sin iva"><span class="input-group-addon">.00</span>
						</div>
					</div>

					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">Porcentaje de IVA:</label>
						<div class="col-md-7">
							<select id="porcIVA" data-width="100%" name="texto" class="ignorar precios selectpicker">
								<option value="">Seleccionar porcentaje de IVA</option>
								<?php 
									$connection = Yii::app()->db;
									$sql = "SELECT * FROM ivas";
									$command=$connection->createCommand($sql);
									$dataReader=$command->query();
									foreach($dataReader as $row){?>
											<option value="<?php echo $row['valor_num'];?>"><?php echo $row['valor_nom'];?></option>
									<?php }?>
								 
							</select>
						</div>
					</div>

					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">¿Usa Simcard?:</label>
						<div class="col-md-7">
							<select id="usa_sim" data-width="100%" name="usa_sim" class="selectpicker">
								<option value="">Seleecione si el dispositivo usa simcard</option>
								<option value="si">Si usa</option>
								<option value="no">No usa</option>
							</select>
						</div>
					</div>
					
					<div class="form-group col-md-9">
						<label for="nombre" class="col-md-5 control-label">Precio de compra (con IVA):</label>
						<div class="col-md-7">
							<input id="pc_iva" type="text" readonly="true" class="text-center form-control" value="$0000" name="pc_iva" placeholder="$0000">
						</div>
					</div>
					<div class="form-group col-md-9">
						<label for="nombre" class="col-md-5 control-label">Precio de venta (con IVA):</label>
						<div class="col-md-7">
							<input id="pv_iva" type="text"  readonly="true" class="text-center form-control" value="$0000" name="pv_iva" placeholder="$0000">
						</div>
					</div>
					
					<!-- <div class="form-group col-md-9">
						<label for="pcCIVA" class="col-md-7 control-label">Precio de compra (con IVA): <?php echo "$0000"; ?></label>
						<label for="pvCIVA" class="col-md-7 control-label">Precio de venta (con IVA): <?php echo "$0000"; ?></label>
					</div> -->
					
					<div class="form-group col-md-9 text-center">
						<label class="col-md-5 control-label">Coomentarios:</label>
						<div class="col-md-7">
							<textarea type="textArea" name="comentario" class="form-control" placeholder="Comentario..."></textarea>
						</div>
					</div>


					<div class="buttons-submit col-md-12">
						<div class="col-md-2 col-md-offset-4">
							<button href="" type="submit" class="btn btn-primary">Registrar tipo</button>
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