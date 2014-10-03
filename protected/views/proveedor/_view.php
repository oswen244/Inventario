<?php
/* @var $this ProveedorController */
/* @var $data Proveedor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_proveedor), array('view', 'id'=>$data->id_proveedor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_id')); ?>:</b>
	<?php echo CHtml::encode($data->num_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	*/ ?>

</div>