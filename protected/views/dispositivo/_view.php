<?php
/* @var $this DispositivoController */
/* @var $data Dispositivo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_disp')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_disp), array('view', 'id'=>$data->id_disp)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_adquirido')); ?>:</b>
	<?php echo CHtml::encode($data->f_adquirido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_ref')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_disp')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_disp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imei_ref')); ?>:</b>
	<?php echo CHtml::encode($data->imei_ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado); ?>
	<br />

	*/ ?>

</div>