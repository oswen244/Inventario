<?php

/**
 * This is the model class for table "tipo_disp".
 *
 * The followings are the available columns in table 'tipo_disp':
 * @property integer $id_tipo
 * @property string $tipo_ref
 * @property string $nombre
 * @property string $descripcion
 * @property string $pc_siva
 * @property string $pc_iva
 * @property string $pv_siva
 * @property string $pv_iva
 * @property integer $id_proveedor
 * @property string $usa_sim
 * @property integer $total_sims
 *
 * The followings are the available model relations:
 * @property Dispositivos[] $dispositivoses
 * @property Proveedores $idProveedor
 */
class TipoDisp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_disp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_ref, pc_siva, pc_iva, id_proveedor, usa_sim', 'required'),
			array('id_proveedor, total_sims', 'numerical', 'integerOnly'=>true),
			array('tipo_ref, nombre, descripcion', 'length', 'max'=>45),
			array('pc_siva, pc_iva, pv_siva, pv_iva', 'length', 'max'=>10),
			array('usa_sim', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tipo, tipo_ref, nombre, descripcion, pc_siva, pc_iva, pv_siva, pv_iva, id_proveedor, usa_sim, total_sims', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'dispositivoses' => array(self::HAS_MANY, 'Dispositivos', 'tipo_disp'),
			'idProveedor' => array(self::BELONGS_TO, 'Proveedores', 'id_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo' => 'Id Tipo',
			'tipo_ref' => 'Tipo Ref',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'pc_siva' => 'Pc Siva',
			'pc_iva' => 'Pc Iva',
			'pv_siva' => 'Pv Siva',
			'pv_iva' => 'Pv Iva',
			'id_proveedor' => 'Id Proveedor',
			'usa_sim' => 'Usa Sim',
			'total_sims' => 'Total Sims',
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getCreatingAttributes()
	{
		return array(
			'nombre',
			'tipo_ref',
			'id_proveedor',
			'pc_siva',
			'pv_siva',
			'pc_iva',
			'pv_iva',
			'usa_sim',
			'descripcion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_tipo',$this->id_tipo);
		$criteria->compare('tipo_ref',$this->tipo_ref,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('pc_siva',$this->pc_siva,true);
		$criteria->compare('pc_iva',$this->pc_iva,true);
		$criteria->compare('pv_siva',$this->pv_siva,true);
		$criteria->compare('pv_iva',$this->pv_iva,true);
		$criteria->compare('id_proveedor',$this->id_proveedor);
		$criteria->compare('usa_sim',$this->usa_sim,true);
		$criteria->compare('total_sims',$this->total_sims);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoDisp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
