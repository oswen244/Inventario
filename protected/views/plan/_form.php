<?php
/* @var $this PlanController */
/* @var $model Plan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_plan'); ?>
		<?php echo $form->textField($model,'nombre_plan',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre_plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo_voz'); ?>
		<?php echo $form->textField($model,'cargo_voz',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cargo_voz'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo_datos'); ?>
		<?php echo $form->textField($model,'cargo_datos',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cargo_datos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_p_voz'); ?>
		<?php echo $form->textField($model,'desc_p_voz',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'desc_p_voz'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_p_datos'); ?>
		<?php echo $form->textField($model,'desc_p_datos',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'desc_p_datos'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->