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
				'actions'=>array('admin','delete','create','update','getTypes','getPrices','dataSource','asignar'),
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
	public function actionView()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT d.f_adquirido, d.imei_ref, d.id_estado, p.id_proveedor, d.tipo_disp, d.comentario, d.ubicacion FROM tipo_disp t, dispositivos d, proveedores p WHERE d.tipo_disp=t.id_tipo AND t.id_proveedor = p.id_proveedor AND d.id_disp =".$_POST['id'];
		$command=$connection->createCommand($sql);
		$result=$command->queryAll();
		echo CJSON::encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$dispositivo=new Dispositivo;
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			// $values = preg_split("/[&]?([a-zA-Z0-9])+[=]{1}/", $data, null, PREG_SPLIT_NO_EMPTY); //Extrae los valores que vienen en el POST
			$dbNames = $dispositivo->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$dispositivo->attributes=$atributos; //se asignan los atributos al modelo
			if($dispositivo->save()){ //se guardan los datos en la bd
				$result['mensaje'] = "La sim se registró correctamente";
				$result['cod'] = "1";
				// $this->redirect('/inventario');
			}else{
				$result['mensaje'] = "No se pudo guardar las sim";
				$result['cod'] = "3";
			}
		}else{
			$this->render('create',array(
				'model'=>$dispositivo,
			));
		}
	}

	public function actionAsignar()
	{
		if(Yii::app()->request->isPostRequest){
			$data['tipo_disp'] = $_POST['tipo_disp'];
			$data['imei'] = $_POST['imei'];
			$data['informado'] = "1";
			// $this->renderPartial('/sim/asignar', array('data' => json_encode($data)));
			$html = $this->render('//sim/asignar', array('data' => json_encode($data)), true);
			echo $html;
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
			echo "No disponible";
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
			echo "No disponible";
		}
	}



	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		// $dispositivo=$this->loadModel($id);
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			// $data = str_replace('+', ' ', $_POST['data'].'.');
			// $values = preg_split("/[&]?([a-zA-Z0-9])+[=]{1}/", $data, null, PREG_SPLIT_NO_EMPTY); //Extrae los valores que vienen en el POST
			$criteria = new CDbCriteria();
			$criteria->condition = 'imei_ref=:imei_ref';
			$criteria->params = array(':imei_ref'=>$data[1]);
			$dispositivo = Dispositivo::model()->find($criteria);
			$dbNames = $dispositivo->getUpdatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$dispositivo->attributes=$atributos; //se asignan los atributos al modelo
			if($dispositivo->save()){
				echo "Dispositivo actualizado correctamente";
				// $this->redirect('/inventario');
			}else{
				echo "No se pudo actualizar el dispositivo, intente nuevamente";
			}
		}
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

	public function actionDataSource()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM detalles_disps";
		$command=$connection->createCommand($sql);
		$d=$command->queryAll();
		echo CJSON::encode($d);
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
		if(Yii::app()->request->isPostRequest){
			echo CJSON::encode($d);
		}else{
			$dispositivo = CJSON::encode($d);
			$this->render('index', array('dispositivos' => $dispositivo));
			// $this->render('index');
		}
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