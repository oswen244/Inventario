<?php
/* @var $this TipoDispController */
/* @var $data TipoDisp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tipo), array('view', 'id'=>$data->id_tipo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_ref')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->id_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pc_iva')); ?>:</b>
	<?php echo CHtml::encode($data->pc_iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pc_siva')); ?>:</b>
	<?php echo CHtml::encode($data->pc_siva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pv_iva')); ?>:</b>
	<?php echo CHtml::encode($data->pv_iva); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pv_siva')); ?>:</b>
	<?php echo CHtml::encode($data->pv_siva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	*/ ?>

</div>