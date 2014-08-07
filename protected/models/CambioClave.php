<?php

/**
 * This is the model class for table "CambioClave".
 *
 * The followings are the available columns in table 'CambioClave':
 * @property integer $idCambio
 * @property integer $idUsuario
 * @property string $fecha
 * @property string $token
 * @property integer $estado
 * 
 * The followings are the available model relations:
 * @property Usuario $idUsuario0
 */
class CambioClave extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $email;
        public $verifyCode;
        
        
        
	public function tableName()
	{
		return 'CambioClave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required','on'=>'insert'),
			array('idUsuario, estado', 'numerical', 'integerOnly'=>true),
			array('token', 'length', 'max'=>32),
                        array('email','exist', 'on'=>'insert', 'attributeName'=>'Email', 'className'=>'Usuario'),
                        
                        array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCambio, idUsuario, fecha, token, estado', 'safe', 'on'=>'search'),
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
			'idUsuario0' => array(self::BELONGS_TO, 'Usuario', 'idUsuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCambio' => 'Id Cambio',
			'idUsuario' => 'Id Usuario',
			'fecha' => 'Fecha',
			'token' => 'Token',
			'estado' => 'Estado',
                    'verifyCode'=>'Código de verificación',
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

		$criteria->compare('idCambio',$this->idCambio);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CambioClave the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
