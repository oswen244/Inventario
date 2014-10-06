<?php
/* @var $this PlanController */
/* @var $model Plan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_plan'); ?>
		<?php echo $form->textField($model,'id_plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_plan'); ?>
		<?php echo $form->textField($model,'nombre_plan',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cargo_voz'); ?>
		<?php echo $form->textField($model,'cargo_voz',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cargo_datos'); ?>
		<?php echo $form->textField($model,'cargo_datos',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_p_voz'); ?>
		<?php echo $form->textField($model,'desc_p_voz',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_p_datos'); ?>
		<?php echo $form->textField($model,'desc_p_datos',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->