<?php
/* @var $this SimController */
/* @var $data Sim */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sim')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_sim), array('view', 'id'=>$data->id_sim)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_act')); ?>:</b>
	<?php echo CHtml::encode($data->f_act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_linea')); ?>:</b>
	<?php echo CHtml::encode($data->num_linea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imei_sc')); ?>:</b>
	<?php echo CHtml::encode($data->imei_sc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->id_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estados')); ?>:</b>
	<?php echo CHtml::encode($data->id_estados); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->id_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imei_disp')); ?>:</b>
	<?php echo CHtml::encode($data->imei_disp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_plan')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_plan); ?>
	<br />

	*/ ?>

</div>