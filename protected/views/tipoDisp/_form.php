<?php
/* @var $this TipoDispController */
/* @var $model TipoDisp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-disp-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tipo'); ?>
		<?php echo $form->textField($model,'id_tipo'); ?>
		<?php echo $form->error($model,'id_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_ref'); ?>
		<?php echo $form->textField($model,'tipo_ref',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tipo_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_proveedor'); ?>
		<?php echo $form->textField($model,'id_proveedor'); ?>
		<?php echo $form->error($model,'id_proveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pc_iva'); ?>
		<?php echo $form->textField($model,'pc_iva',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pc_iva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pc_siva'); ?>
		<?php echo $form->textField($model,'pc_siva',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pc_siva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pv_iva'); ?>
		<?php echo $form->textField($model,'pv_iva',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pv_iva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pv_siva'); ?>
		<?php echo $form->textField($model,'pv_siva',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pv_siva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->