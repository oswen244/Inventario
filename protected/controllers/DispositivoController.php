<?php

class DispositivoController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','getTypes','getPrices'),
				'users'=>array('admin'),
			),
			array('deny', // deny all users
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
		$dispositivo=new Dispositivo;
		if(Yii::app()->request->isPostRequest){
			$data = str_replace('+', ' ', $_POST['data']);
			$values = preg_split("/[&]?([a-zA-Z0-9])+[=]{1}/", $data, null, PREG_SPLIT_NO_EMPTY); //Extrae los valores que vienen en el POST
			$dbNames = $dispositivo->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $values); //se forma un nuevo array con las keys de dbNames y los valores de values
			$dispositivo->attributes=$atributos; //se asignan los atributos al modelo
			
			if($dispositivo->save()){
				echo "Dispositivo agregado correctamente";
				// $this->redirect('/inventario');
			}else{
				echo "No se pudo agregar el dispositivo, intente nuevamente";
			}
		}else{
			$this->render('create',array(
				'model'=>$dispositivo,
			));
		}
	}

// La función GetTypes() devuelve los tipos de dispositivos/activos en un JSON

	public function actionGetTypes(){
		if(Yii::app()->request->isPostRequest && isset($_POST['proveedor'])){
			$connection = Yii::app()->db;
			$sql = "SELECT * FROM tipo_disp WHERE id_proveedor=".$_POST['proveedor'];
			$command=$connection->createCommand($sql);
			$result=$command->queryAll();
			echo CJSON::encode($result);
		}else{
			echo "nada!";
		}
	}
	// La función GetPrices() devuelve en un JSON los precios del tipo de dispositivo enviado por POST
	public function actionGetPrices(){
		if(Yii::app()->request->isPostRequest && isset($_POST['tipo'])){
			$connection = Yii::app()->db;
			$sql = "SELECT pc_siva, pc_iva, pv_siva, pv_iva, descripcion FROM tipo_disp WHERE id_tipo=".$_POST['tipo'];
			$command=$connection->createCommand($sql);
			$result=$command->queryAll();
			echo CJSON::encode($result);
		}else{
			echo "nada!";
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

		if(isset($_POST['Dispositivo']))
		{
			$model->attributes=$_POST['Dispositivo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_disp));
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
		// $model = Dispositivo::model();
		// $d = $model->findAll();
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM detalles_disps";
		$command=$connection->createCommand($sql);
		$d=$command->queryAll();
		$dispositivo = CJSON::encode($d);
		$this->render('index', array('dispositivos' => $dispositivo));
	}

	public function actionDispositivos()
	{
		$this->render('dispositivos');
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Dispositivo('search');
		$model->unsetAttributes();// clear any default values
		if(isset($_GET['Dispositivo']))
			$model->attributes=$_GET['Dispositivo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Dispositivo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Dispositivo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dispositivo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dispositivo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}