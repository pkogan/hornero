<?php

/**
 * This is the model class for table "EstadoTorneo".
 *
 * The followings are the available columns in table 'EstadoTorneo':
 * @property integer $idEstado
 * @property string $Estado
 *
 * The followings are the available model relations:
 * @property Torneo[] $torneos
 */
class EstadoTorneo extends CActiveRecord
{
    const ANTESCOMIENZO =1;
    const ENPROCESO = 2;
    const TERMINADO = 3;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EstadoTorneo the static model class
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
		return 'EstadoTorneo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Estado', 'required'),
			array('Estado', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEstado, Estado', 'safe', 'on'=>'search'),
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
			'torneos' => array(self::HAS_MANY, 'Torneo', 'idEstado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEstado' => 'Id Estado',
			'Estado' => 'Estado',
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

		$criteria->compare('idEstado',$this->idEstado);
		$criteria->compare('Estado',$this->Estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}