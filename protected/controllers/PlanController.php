<?php

class PlanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$sql = "SELECT nombre_plan,cargo_datos,cargo_voz,desc_p_datos,desc_p_voz,id_plan,cargo_datos+cargo_voz FROM planes WHERE id_plan = ".$_POST['id'];
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Plan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			parse_str($_POST['data'], $data);

			$dbNames = $model->getCreatingAttributes();
			$atributos = array_combine($dbNames, $data);
			$model->attributes=$atributos;
			if($model->save()){
				$result['mensaje'] = "El plan se registró correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo registrar el plan";
				$result['cod'] = "3";
			}
			echo json_encode($result);
		}else{

			$this->render('create',array(
				'model'=>$model,
			));
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if(Yii::app()->request->isPostRequest){

			parse_str($_POST['data'], $data);

			$criteria = new CDbCriteria();
			$criteria->condition = 'id_plan=:id_plan';
			$criteria->params = array(':id_plan'=>$data[5]);
			$plan = Plan::model()->find($criteria);
			$dbNames = $plan->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			
			unset($data[5]);
			
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$plan->attributes=$atributos; //se asignan los atributos al modelo
			if($plan->save()){
				$result['mensaje'] = "El plan se actualizó correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo actualizar el plan";
				$result['cod'] = "3";
			}
			echo json_encode($result);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$model = new Plan;
		
		$sql = "SELECT COUNT(id_sim) AS total FROM sims WHERE id_sim IN (".$_POST['data'].")";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$sims = $result[0]['total'];


		if($sims=="0"){
			$sql = "DELETE FROM planes WHERE id_plan IN (".$_POST['data'].")";
			try {
					Yii::app()->db->createCommand($sql)->query();
					echo "1;El(los) registro(s) se ha(n) borrado";		
			} catch (Exception $e) {
					echo "3;".$e->getMessage();
			}
		}else{
					echo "3;Error: existen Sims asociadas con ese(esos) Plan(es).";
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$sql = "SELECT id_plan,nombre_plan,cargo_voz,cargo_datos,(cargo_voz+cargo_datos) AS Total,desc_p_voz,desc_p_datos FROM planes";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$plan = CJSON::encode($result); 

		$this->render('index', array('planes' => $plan));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Plan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Plan']))
			$model->attributes=$_GET['Plan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Plan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Plan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Plan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
