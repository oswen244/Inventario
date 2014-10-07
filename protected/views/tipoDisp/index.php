<h1 class="header-tittle">Tipos de dispositivos</h1>

<div class="content">

	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
		   		<h3 class="panel-title">Registrar Tipo Nuevo</h3>
		  	</div>
			<div class="panel-body">
				<form class="form form-horizontal" action="create" method="post" role="form"><br>

					<div class="form-group col-md-9">
						<label for="nombre" class="col-md-5 control-label">Nombre:</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre">
						</div>
					</div>

					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">Proveedor:</label>
						<div class="col-md-7">
							<select id="proveedor" data-width="100%" name="proveedor" class="selectpicker">
								<option value="0">Seleccionar proveedor</option>
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
						<label for="pcSIVA" class="col-md-5 control-label">Precio de compra sin IVA:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input type="number" class="form-control" name="pcSIVA" placeholder="Precio compra sin iva"><span class="input-group-addon">.00</span>
						</div>
					</div>
					

					<div class="form-group col-md-9">
						<label for="pvSIVA" class="col-md-5 control-label">Precio de venta sin IVA:</label>
						<div class="col-md-7 input-group">
							<span class="input-group-addon">$</span><input type="number" class="form-control" name="pvSIVA" placeholder="Precio venta sin iva"><span class="input-group-addon">.00</span>
						</div>
					</div>

					<div class="form-group col-md-9">
						<label class="col-md-5 control-label">Porcentaje de IVA:</label>
						<div class="col-md-7">
							<select id="porcIVA" data-width="100%" name="porcIVA" class="selectpicker">
								<option value="0">Seleccionar porcentaje de IVA</option>
							</select>
						</div>
					</div>

					
					<div class="form-group col-md-9">
						<label for="pcCIVA" class="col-md-7 control-label">Precio de compra (con IVA): <?php echo "$0000"; ?></label>
						<label for="pvCIVA" class="col-md-7 control-label">Precio de venta (con IVA): <?php echo "$0000"; ?></label>
					</div>
					
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