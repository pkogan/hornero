<?php

/**
 * This is the model class for table "Complejidad".
 *
 * The followings are the available columns in table 'Complejidad':
 * @property integer $idComplejidad
 * @property string $Complejidad
 *
 * The followings are the available model relations:
 * @property Problema[] $problemas
 */
class Complejidad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Complejidad the static model class
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
		return 'Complejidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Complejidad', 'required'),
			array('Complejidad', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idComplejidad, Complejidad', 'safe', 'on'=>'search'),
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
			'problemas' => array(self::HAS_MANY, 'Problema', 'idComplejidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idComplejidad' => 'Id Complejidad',
			'Complejidad' => 'Complejidad',
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

		$criteria->compare('idComplejidad',$this->idComplejidad);
		$criteria->compare('Complejidad',$this->Complejidad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}