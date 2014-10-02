<?php

/**
 * This is the model class for table "dispositivos".
 *
 * The followings are the available columns in table 'dispositivos':
 * @property integer $id_disp
 * @property string $f_adquirido
 * @property string $tipo_ref
 * @property integer $tipo_disp
 * @property integer $imei_ref
 * @property string $comentario
 * @property string $ubicacion
 * @property integer $id_estado
 *
 * The followings are the available model relations:
 * @property Estados $idEstado
 * @property DetalleFact $idDisp
 * @property TipoDisp $tipoDisp
 * @property Sims[] $sims
 */
class Dispositivo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dispositivos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_adquirido, tipo_ref, tipo_disp, imei_ref, id_estado', 'required'),
			array('tipo_disp, imei_ref, id_estado', 'numerical', 'integerOnly'=>true),
			array('tipo_ref', 'length', 'max'=>45),
			array('comentario', 'length', 'max'=>1000),
			array('ubicacion', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_disp, f_adquirido, tipo_ref, tipo_disp, imei_ref, comentario, ubicacion, id_estado', 'safe', 'on'=>'search'),
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
			'idEstado' => array(self::BELONGS_TO, 'Estados', 'id_estado'),
			'idDisp' => array(self::BELONGS_TO, 'DetalleFact', 'id_disp'),
			'tipoDisp' => array(self::BELONGS_TO, 'TipoDisp', 'tipo_disp'),
			'sims' => array(self::HAS_MANY, 'Sims', 'imei_disp'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_disp' => 'Id Disp',
			'f_adquirido' => 'F Adquirido',
			'tipo_ref' => 'Tipo Ref',
			'tipo_disp' => 'Tipo Disp',
			'imei_ref' => 'Imei Ref',
			'comentario' => 'Comentario',
			'ubicacion' => 'Ubicacion',
			'id_estado' => 'Id Estado',
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

		$criteria->compare('id_disp',$this->id_disp);
		$criteria->compare('f_adquirido',$this->f_adquirido,true);
		$criteria->compare('tipo_ref',$this->tipo_ref,true);
		$criteria->compare('tipo_disp',$this->tipo_disp);
		$criteria->compare('imei_ref',$this->imei_ref);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('id_estado',$this->id_estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dispositivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}