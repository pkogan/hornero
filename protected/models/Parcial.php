<?php

/**
 * This is the model class for table "Parcial".
 *
 * The followings are the available columns in table 'Parcial':
 * @property integer $id
 * @property integer $idCuenta
 * @property integer $idEquipo
 * @property integer $Tiempo
 *
 * The followings are the available model relations:
 * @property Equipo $idEquipo0
 * @property Cuenta $idCuenta0
 */
class Parcial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Parcial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Parcial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCuenta, idEquipo, Tiempo', 'required'),
			array('idCuenta, idEquipo, Tiempo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idCuenta, idEquipo, Tiempo', 'safe', 'on'=>'search'),
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
			'idEquipo0' => array(self::BELONGS_TO, 'Equipo', 'idEquipo'),
			'idCuenta0' => array(self::BELONGS_TO, 'Cuenta', 'idCuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCuenta' => 'Id Cuenta',
			'idEquipo' => 'Id Equipo',
			'Tiempo' => 'Tiempo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idCuenta',$this->idCuenta);
		$criteria->compare('idEquipo',$this->idEquipo);
		$criteria->compare('Tiempo',$this->Tiempo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}