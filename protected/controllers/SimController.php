<?php

class SimController extends Controller
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
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','asignar','getDispDisponibles','desasignar'),
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
		$sql = "SELECT imei_sc, f_act, f_asig, num_linea, id_plan, id_estado, id_proveedor, comentario, id_sim, imei_disp FROM sims WHERE id_sim = ".$_POST['id'];
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		echo CJSON::encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Sim;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			parse_str($_POST['data'], $data);
			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla
		
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			
			$sql = "CALL nombreProv(".$atributos['id_proveedor'].")";
			$proveedor = Yii::app()->db->createCommand($sql)->queryAll(); //Obtengo el nombre del proveedor

			$sql = "CALL nombrePlan(".$atributos['id_plan'].")";
			$plan = Yii::app()->db->createCommand($sql)->queryAll(); //Obtengo el nombre del plan

			$elem = $atributos['imei_sc'].", ".$atributos['num_linea'].", ".$proveedor[0]['nombre'].", ".$plan[0]['nombre_plan'];
			$accion = "CREADO";
			$sql = "CALL historico('".Yii::app()->user->name."','".$model->tableName()."','".$elem."','".$accion."')";

				$model->attributes=$atributos;
				
				if($atributos['id_plan']==0){
					$model->tipo_plan = "Prepago";
				}else{
					$model->tipo_plan = "Postpago";
				}

				if($model->save()){
					Yii::app()->db->createCommand($sql)->query();
					$result['mensaje'] = "La simcard se registró correctamente";
					$result['cod'] = "1";
				}else{
					$result['mensaje'] = "Error: No se pudo registrar la simcard";
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
		$model=new Sim;

		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			$id = $data[8];
			unset($data[8]);
			$criteria = new CDbCriteria();
			$criteria->condition = 'id_sim=:id_sim';
			$criteria->params = array(':id_sim'=>$id);
			$sim = Sim::model()->find($criteria);
			$dbNames = $sim->getUpdatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values

			// $sql = "CALL updateSim(".$id.")";
			$sql = "CALL consulta('Imei,Numero,Proveedor,Plan,Estado,Fecha_act,Comentario','detalles_sims','Sim','".$id."')";
			$out = Yii::app()->db->createCommand($sql)->queryAll();
			$out = implode(",", $out[0]);

			$elem = $out;
			$accion = "EDITADO";

			$sim->attributes=$atributos; //se asignan los atributos al modelo
			if($sim->save()){
				// $sql = "CALL updateSim(".$id.")";
				$sql = "CALL consulta('Imei,Numero,Proveedor,Plan,Estado,Fecha_act,Comentario','detalles_sims','Sim','".$id."')";
				$out = Yii::app()->db->createCommand($sql)->queryAll();
				$out = implode(",", $out[0]);
				
				$elem = $elem." --> ".$out;
				$sql = "CALL historico('".Yii::app()->user->name."','".$model->tableName()."','".$elem."','".$accion."')";
				Yii::app()->db->createCommand($sql)->query();

				$result['mensaje'] = "Simcard actualizada correctamente";
				$result['cod'] = "1";
				// $this->redirect('/inventario/sim/');
			}else{
				$result['mensaje'] = "No se pudo actualizar la simcard, intente nuevamente";
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

		//validar cuales sims se pueden borrar
		$sql = "DELETE FROM sims WHERE id_sim IN (".$_POST['data'].")";
		if(Yii::app()->db->createCommand($sql)->query())
			echo "1";
		else
			echo "2";
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$sql = "SELECT * FROM detalles_sims";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$sim = CJSON::encode($result);
		$this->render('index', array('sims' => $sim));
	}

	public function getDispDisponibles()
	{
		if(Yii::app()->request->isPostRequest && isset($_POST['id_tipo'])){
			$connection = Yii::app()->db;
			$sql = "SELECT d.imei_ref imei FROM dispositivos d, tipo_disp t WHERE (t.total_sims-d.sims_asig)>0 AND d.tipo_disp = ".$_POST['id_tipo'];
			$command=$connection->createCommand($sql);
			$result=$command->queryAll();
			echo CJSON::encode($result);
		}
	}

	public function actionDesasignar()
	{
		if(Yii::app()->request->isPostRequest && isset($_POST['sim'])){
			$connection = Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
				$sql = "SELECT imei_sc Imei_sc, imei_disp Imei FROM sims WHERE id_sim = ".$_POST['sim'];
				$result = $connection->createCommand($sql)->queryAll();
				$imei_sc = $result[0]['Imei_sc'];
				$imei_disp = $result[0]['Imei'];

				$sql = "UPDATE sims SET imei_disp = NULL, f_asig = NULL WHERE id_sim = ".$_POST['sim'];
				$result = $connection->createCommand($sql)->execute();

				$sql = "UPDATE dispositivos SET sims_asig = (sims_asig - 1) WHERE imei_ref = ".$imei_disp;
				$result = $connection->createCommand($sql)->execute();

				$transaction->commit();

				$r['mensaje'] = "La sim con IMEI: ".$imei_sc." del dispositivo con IMEI: ".$imei_disp;
				$r['cod'] = "1";
			}
			catch(Exception $e) // se arroja una excepción si una consulta falla
			{
				$transaction->rollBack();
				$r['mensaje'] = $e->getMessage();
				$r['cod'] = "3";
			}
			echo CJSON::encode($r);
		}
	}
	public function actionAsignar()
	{
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			$connection = Yii::app()->db;
			$transaction=$connection->beginTransaction();
			try
			{
				$criteria = new CDbCriteria();
				$criteria->condition = 'imei_ref=:imei_ref';
				$criteria->params = array(':imei_ref'=>$data[3]);
				$dispositivo = Dispositivo::model()->find($criteria);
				$dispositivo->sims_asig = (($dispositivo->sims_asig)+1);
				$dispositivo->save();

				$sql = "SELECT * FROM sims WHERE isnull(imei_disp) AND id_plan = ".$data[4]." ORDER BY id_sim ASC LIMIT 0,1";
				$command=$connection->createCommand($sql);
				$result=$command->queryAll();
				$sim = $result[0]['id_sim'];

				$sql = "UPDATE sims SET id_estado=".$data[0].", imei_disp='".$data[3]."', f_asig='".$data[1]."' WHERE id_sim = ".$sim;
				$command=$connection->createCommand($sql);
				$result=$command->execute();

				$transaction->commit();
				// if($transaction->commit()){
					$r['mensaje'] = "La sim se asignó correctamente al dispositivo";
					$r['cod'] = "1";
				// }else{
				// 	$r['mensaje'] = "Sino del commit()";
				// 	$r['cod'] = "2";
				// }
			}
			catch(Exception $e) // se arroja una excepción si una consulta falla
			{
				$transaction->rollBack();
				$r['mensaje'] = $e->getMessage();
				$r['cod'] = "3";
			}
			
			echo json_encode($r);

		}else{
			$data['informado'] = "0";
			if(isset($_GET['tipo_disp'])){
				$connection = Yii::app()->db;
				$sql = "SELECT id_tipo FROM tipo_disp WHERE nombre='".$_GET['tipo_disp']."'";
				$command=$connection->createCommand($sql);
				$result=$command->queryAll();
				$data['tipo'] = $result[0]['id_tipo'];
				$data['imei'] = $_GET['imei'];
				$data['informado'] = "1";
				// $this->renderPartial('/sim/asignar', array('data' => json_encode($data)));
			}
			$this->render('asignar', array('data' => json_encode($data)));
			// $this->redirect(array('asignar', 'data' => json_encode($data)));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sim('search');
		$model->unsetAttributes();// clear any default values
		if(isset($_GET['Sim']))
			$model->attributes=$_GET['Sim'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Sim the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Sim::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sim $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sim-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
