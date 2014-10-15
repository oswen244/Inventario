<?php

class EstadoController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Estado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($estado);

		if(Yii::app()->request->isPostRequest)
		{
			$data = str_replace('+', ' ', $_POST['data']);
			$values = preg_split("/[&]?([a-zA-Z0-9])+[=]{1}/", $data, null, PREG_SPLIT_NO_EMPTY);
			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla
			
			$atributos = array_combine($dbNames, $values); //se forma un nuevo array con las keys de dbNames y los valores de values
			$model->attributes=$atributos; //se asignan los datos al modelo

			if($model->save()){ //se guardan los datos en la bd
				echo "El estado se registró correctamente";
			}else{
				echo "Error";
			}
		}else{
			$this->render('create');
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Estado']))
		{
			$model->attributes=$_POST['Estado'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_estados));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		// $model = Estado::model();
		// $est = $model->findAll();

		$sql = "SELECT * FROM Estados";
		$est = Yii::app()->db->createCommand($sql)->queryAll();
		$estado = CJSON::encode($est); 

		$this->render('index', array('estados' => $estado));


		// $dataProvider=new CActiveDataProvider('Estado');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Estado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Estado']))
			$model->attributes=$_GET['Estado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Estado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Estado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Estado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='estado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
