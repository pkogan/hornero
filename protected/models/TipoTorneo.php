<?php

/**
 * This is the model class for table "TipoTorneo".
 *
 * The followings are the available columns in table 'TipoTorneo':
 * @property integer $idTipo
 * @property string $Tipo
 *
 * The followings are the available model relations:
 * @property Torneo[] $torneos
 */
class TipoTorneo extends CActiveRecord
{
    
    const ABIERTO=1;
    const CERRADO=2;
    const ABIERTOSINLIMITE=3;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TipoTorneo the static model class
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
		return 'TipoTorneo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Tipo', 'required'),
			array('Tipo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idTipo, Tipo', 'safe', 'on'=>'search'),
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
			'torneos' => array(self::HAS_MANY, 'Torneo', 'idTipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idTipo' => 'Id Tipo',
			'Tipo' => 'Tipo',
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

		$criteria->compare('idTipo',$this->idTipo);
		$criteria->compare('Tipo',$this->Tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}