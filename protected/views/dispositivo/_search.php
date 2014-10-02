<?php
/* @var $this DispositivoController */
/* @var $model Dispositivo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_disp'); ?>
		<?php echo $form->textField($model,'id_disp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_adquirido'); ?>
		<?php echo $form->textField($model,'f_adquirido'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_ref'); ?>
		<?php echo $form->textField($model,'tipo_ref',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_disp'); ?>
		<?php echo $form->textField($model,'tipo_disp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imei_ref'); ?>
		<?php echo $form->textField($model,'imei_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ubicacion'); ?>
		<?php echo $form->textField($model,'ubicacion',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estado'); ?>
		<?php echo $form->textField($model,'id_estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->