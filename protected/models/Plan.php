<?php

/**
 * This is the model class for table "planes".
 *
 * The followings are the available columns in table 'planes':
 * @property integer $id_plan
 * @property string $nombre_plan
 * @property string $cargo_voz
 * @property string $cargo_datos
 * @property string $desc_p_voz
 * @property string $desc_p_datos
 * @property integer $borrado
 *
 * The followings are the available model relations:
 * @property Sims[] $sims
 */
class Plan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'planes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cargo_voz, cargo_datos, desc_p_voz, desc_p_datos', 'required'),
			array('borrado', 'numerical', 'integerOnly'=>true),
			array('nombre_plan', 'length', 'max'=>45),
			array('cargo_voz, cargo_datos', 'length', 'max'=>10),
			array('desc_p_voz, desc_p_datos', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_plan, nombre_plan, cargo_voz, cargo_datos, desc_p_voz, desc_p_datos, borrado', 'safe', 'on'=>'search'),
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
			'sims' => array(self::HAS_MANY, 'Sims', 'id_plan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_plan' => 'Id Plan',
			'nombre_plan' => 'Nombre Plan',
			'cargo_voz' => 'Cargo Voz',
			'cargo_datos' => 'Cargo Datos',
			'desc_p_voz' => 'Desc P Voz',
			'desc_p_datos' => 'Desc P Datos',
			'borrado' => 'Borrado',
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getCreatingAttributes()
	{
		return array(
			'nombre_plan',
			'cargo_datos',
			'cargo_voz',
			'desc_p_datos',
			'desc_p_voz',
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

		$criteria->compare('id_plan',$this->id_plan);
		$criteria->compare('nombre_plan',$this->nombre_plan,true);
		$criteria->compare('cargo_voz',$this->cargo_voz,true);
		$criteria->compare('cargo_datos',$this->cargo_datos,true);
		$criteria->compare('desc_p_voz',$this->desc_p_voz,true);
		$criteria->compare('desc_p_datos',$this->desc_p_datos,true);
		$criteria->compare('borrado',$this->borrado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
