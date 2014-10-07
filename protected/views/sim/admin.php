<?php
/* @var $this SimController */
/* @var $model Sim */

$this->breadcrumbs=array(
	'Sims'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Sim', 'url'=>array('index')),
	array('label'=>'Create Sim', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sim-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sims</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sim-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_sim',
		'f_act',
		'num_linea',
		'imei_sc',
		'comentario',
		'id_cliente',
		/*
		'id_estados',
		'id_proveedor',
		'imei_disp',
		'tipo_plan',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
