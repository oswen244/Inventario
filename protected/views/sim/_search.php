<?php
/* @var $this SimController */
/* @var $model Sim */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_sim'); ?>
		<?php echo $form->textField($model,'id_sim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_act'); ?>
		<?php echo $form->textField($model,'f_act'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_linea'); ?>
		<?php echo $form->textField($model,'num_linea',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imei_sc'); ?>
		<?php echo $form->textField($model,'imei_sc',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cliente'); ?>
		<?php echo $form->textField($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estados'); ?>
		<?php echo $form->textField($model,'id_estados'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_proveedor'); ?>
		<?php echo $form->textField($model,'id_proveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imei_disp'); ?>
		<?php echo $form->textField($model,'imei_disp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_plan'); ?>
		<?php echo $form->textField($model,'tipo_plan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->