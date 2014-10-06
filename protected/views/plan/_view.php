<?php
/* @var $this PlanController */
/* @var $data Plan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_plan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_plan), array('view', 'id'=>$data->id_plan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_plan')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_plan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo_voz')); ?>:</b>
	<?php echo CHtml::encode($data->cargo_voz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo_datos')); ?>:</b>
	<?php echo CHtml::encode($data->cargo_datos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_p_voz')); ?>:</b>
	<?php echo CHtml::encode($data->desc_p_voz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_p_datos')); ?>:</b>
	<?php echo CHtml::encode($data->desc_p_datos); ?>
	<br />


</div>