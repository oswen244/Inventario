<?php
/* @var $this DispositivoController */
/* @var $model Dispositivo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dispositivo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'f_adquirido'); ?>
		<?php echo $form->textField($model,'f_adquirido'); ?>
		<?php echo $form->error($model,'f_adquirido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_ref'); ?>
		<?php echo $form->textField($model,'tipo_ref',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tipo_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_disp'); ?>
		<?php echo $form->textField($model,'tipo_disp'); ?>
		<?php echo $form->error($model,'tipo_disp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imei_ref'); ?>
		<?php echo $form->textField($model,'imei_ref'); ?>
		<?php echo $form->error($model,'imei_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion'); ?>
		<?php echo $form->textField($model,'ubicacion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ubicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estado'); ?>
		<?php echo $form->textField($model,'id_estado'); ?>
		<?php echo $form->error($model,'id_estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->