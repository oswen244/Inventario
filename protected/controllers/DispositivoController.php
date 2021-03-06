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
				'actions'=>array('admin','delete','create','update','getTypes','getPrices','dataSource','asignar','facturar'),
				'users'=>array('admin'),
			),
			array('deny', // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionFacturar()
	{
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			$filas = explode('{-}', $data[1]);
			foreach ($filas as $key => $value) {
				$dispositivos[$key] = explode("{,}", $value);
			}
			$total_siva = 0;
			$total_iva = 0;
			foreach ($dispositivos as $key => $disp) {
				$total_siva += floatval($disp[1]);
				$total_iva += floatval($disp[2]);
			}
			$connection = Yii::app()->db;
			// $transaction=$connection->beginTransaction();
			// try
			// {
				$sql = "INSERT INTO facturas (f_venta, pv_siva, pv_iva, id_cliente) VALUES ('".date("Y-m-d H:i:s")."', ".$total_siva.", ".$total_iva.", ".$data[0].")";
				$result=$connection->createCommand($sql)->execute();

				$sql = "SELECT LAST_INSERT_ID() Id";
				$result=$connection->createCommand($sql)->queryAll();
				$idFactura = $result[0]['Id'];
				foreach ($dispositivos as $key => $disp) {
					$sql = "INSERT INTO detalle_fact (id_factura, id_disp) VALUES (".$idFactura.", ".$disp[0].")";
					$result=$connection->createCommand($sql)->execute();

					$sql = "UPDATE dispositivos SET facturado = 1 WHERE id_disp = ".$disp[0];
					$result=$connection->createCommand($sql)->execute();
					// $transaction->commit();
				}
				$r['mensaje'] = "Se ha generado la factura satisfactoriamente";
				$r['cod'] = "1";
				$r['accion'] = "1";
				// $r['mensaje'] = "Error! no se pudo generar la factura, intente nuevamente";
				// $r['cod'] = "3";
			// }
			// catch(Exception $e) // se arroja una excepción si una consulta falla
			// {
			// 	$transaction->rollBack();
			// 	$r['mensaje'] = $e->getMessage();
			// 	$r['cod'] = "1";
			// }
			echo CJSON::encode($r);
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT d.f_adquirido, d.imei_ref, d.id_estado, p.id_proveedor, d.tipo_disp, d.comentario, d.ubicacion, d.id_disp FROM tipo_disp t, dispositivos d, proveedores p WHERE d.tipo_disp=t.id_tipo AND t.id_proveedor = p.id_proveedor AND d.id_disp =".$_POST['id'];
		$result=$connection->createCommand($sql)->queryAll();
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
			$dbNames = $dispositivo->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			
			$sql = "SELECT nombre FROM tipo_disp WHERE id_tipo = ".$atributos['tipo_disp'];
			$out = Yii::app()->db->createCommand($sql)->queryAll();

			$elem = $atributos['imei_ref'].",".$out[0]['nombre'];
			$accion = "CREADO";
			$sql = "CALL historico('".Yii::app()->user->name."','".$dispositivo->tableName()."','".$elem."','".$accion."')";

			$dispositivo->attributes=$atributos; //se asignan los atributos al modelo
			if($dispositivo->save()){ //se guardan los datos en la bd
				Yii::app()->db->createCommand($sql)->query();
				$result['mensaje'] = "El dispositivo se registró correctamente";
				$result['cod'] = "1";
				// $this->redirect('/inventario');
			}else{
				$result['mensaje'] = "No se pudo guardar el dispositivo";
				$result['cod'] = "3";
			}

			echo json_encode($result);
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
			$sql = "SELECT id_tipo, nombre FROM tipo_disp WHERE id_proveedor=".$_POST['proveedor'];
			$result=$connection->createCommand($sql)->queryAll();
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
			$result=$connection->createCommand($sql)->queryAll();
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
		$model = new Dispositivo;
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			$id = $data[7];
			unset($data[7]);
			$criteria = new CDbCriteria();
			$criteria->condition = 'id_disp=:id_disp';
			$criteria->params = array(':id_disp'=>$id);
			$dispositivo = Dispositivo::model()->find($criteria);
			$dbNames = $dispositivo->getUpdatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values

			$sql = "CALL consulta('Referencia,Fecha_Adq,Estado,Proveedor,Tipo_disp,Comentario_disp,Ubicacion','detalles_disps','Id_dispositivo','".$id."')";
			$out = Yii::app()->db->createCommand($sql)->queryAll();
			$out = implode(",", $out[0]);

			$elem = $out;
			$accion = "EDITADO";

			$dispositivo->attributes=$atributos; //se asignan los atributos al modelo
			if($dispositivo->save()){

				$sql = "CALL consulta('Referencia,Fecha_Adq,Estado,Proveedor,Tipo_disp,Comentario_disp,Ubicacion','detalles_disps','Id_dispositivo','".$id."')";
				$out = Yii::app()->db->createCommand($sql)->queryAll();
				$out = implode(",", $out[0]);
				
				$elem = $elem." --> ".$out;
				$sql = "CALL historico('".Yii::app()->user->name."','".$model->tableName()."','".$elem."','".$accion."')";
				Yii::app()->db->createCommand($sql)->query();

				$result['mensaje'] = "Dispositivo actualizado correctamente";
				$result['cod'] = "1";
				// $this->redirect('/inventario');
			}else{
				$result['mensaje'] = "No se pudo actualizar el dispositivo, intente nuevamente";
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
		$d=$connection->createCommand($sql)->queryAll();
		echo CJSON::encode($d);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT * FROM detalles_disps";
		$d=$connection->createCommand($sql)->queryAll();
		if(Yii::app()->request->isPostRequest){
			echo CJSON::encode($d);
		}else{
			$dispositivo = CJSON::encode($d);
			$this->render('index', array('dispositivos' => $dispositivo));
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