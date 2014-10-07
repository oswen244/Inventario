<?php
/* @var $this SimController */
/* @var $model Sim */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sim-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'f_act'); ?>
		<?php echo $form->textField($model,'f_act'); ?>
		<?php echo $form->error($model,'f_act'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_linea'); ?>
		<?php echo $form->textField($model,'num_linea',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'num_linea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imei_sc'); ?>
		<?php echo $form->textField($model,'imei_sc',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'imei_sc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cliente'); ?>
		<?php echo $form->textField($model,'id_cliente'); ?>
		<?php echo $form->error($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estados'); ?>
		<?php echo $form->textField($model,'id_estados'); ?>
		<?php echo $form->error($model,'id_estados'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_proveedor'); ?>
		<?php echo $form->textField($model,'id_proveedor'); ?>
		<?php echo $form->error($model,'id_proveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imei_disp'); ?>
		<?php echo $form->textField($model,'imei_disp'); ?>
		<?php echo $form->error($model,'imei_disp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_plan'); ?>
		<?php echo $form->textField($model,'tipo_plan'); ?>
		<?php echo $form->error($model,'tipo_plan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->