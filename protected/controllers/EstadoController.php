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
				'actions'=>array('admin','delete','deleteCascade'),
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
		// $sql = "CALL consulta('estado,descripcion,id_estado','estados','id_estado','".$_POST['id']."')";
		$sql = "SELECT estado,descripcion,id_estado FROM estados WHERE id_estado=".$_POST['id'];
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($result);
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
			parse_str($_POST['data'], $data);
			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla
			
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values

			$model->attributes=$atributos; //se asignan los datos al modelo
			if($model->save()){ //se guardan los datos en la bd
				$result['mensaje'] = "El estado se registró correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo registrar el estado";
				$result['cod'] = "3";
			}
			echo json_encode($result);
		}else{
			$this->render('create');
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		parse_str($_POST['data'], $data);

			$criteria = new CDbCriteria();
			$criteria->condition = 'id_estado=:id_estado';
			$criteria->params = array(':id_estado'=>$data[2]);
			$estado = Estado::model()->find($criteria);
			$dbNames = $estado->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			
			unset($data[2]);
			
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$estado->attributes=$atributos; //se asignan los atributos al modelo
			if($estado->save()){
				$result['mensaje'] = "El estado se editó correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo editar el estado";
				$result['cod'] = "3";
			}
			echo json_encode($result);
			echo $atributos;
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		
		$model = new Estado;

		// $sql = "SELECT COUNT(id_disp) AS total FROM dispositivos WHERE id_estado IN (".$_POST['data'].")";
		// $result = Yii::app()->db->createCommand($sql)->queryAll();
		// $estados = $result[0]['total'];

		// $sql = "SELECT COUNT(id_sim) AS total FROM sims WHERE id_estado IN (".$_POST['data'].")";
		// $result = Yii::app()->db->createCommand($sql)->queryAll();
		// $sims = $result[0]['total'];



		// if($estados=="0" && $sims=="0"){

			$sql = "DELETE FROM estados WHERE id_estado IN (".$_POST['data'].")";

			try {
				Yii::app()->db->createCommand($sql)->query();
				echo "1;El(los) registro(s) se ha(n) borrado";			
			} catch (Exception $e) {
				echo "3;Error: No se pueden borrar los estados seleccionados, existen activos asociados con esos estados.";
					
			}

		// }else{
		// 	echo "3;Error: existen activos asociados con ese estado.
		// 	¿Borrar de todas formas?
		// 	Advertencia: Se borrarán tambien los registros asociados.";
		// }
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$model = Estado::model();
		$est = $model->findAll();
		$estado = CJSON::encode($est); 
		$this->render('index', array('estados' => $estado));
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
