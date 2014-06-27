<?php

/**
 * This is the model class for table "Resolucion".
 *
 * The followings are the available columns in table 'Resolucion':
 * @property integer $idResolucion
 * @property integer $idUsuario
 * @property integer $idProblema
 * @property integer $idSolucion
 * @property integer $idTorneo
 * @property string $Token
 * @property string $FechaSolicitud
 * @property string $FechaRespuesta
 * @property string $Respuesta
 * @property integer $idEstado
 *
 * The followings are the available model relations:
 * @property Usuario $idUsuario0
 * @property Solucion $idSolucion0
 * @property Torneo $idTorneo0
 * @property EstadoResolucion $idEstado0
 * @property Problema $idProblema0
 */
class Resolucion extends CActiveRecord
{
        public $NombreEquipo;
        public $Estado;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resolucion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getFechaRespuestaOK(){
            $dateString = date('Ymd H:i:s', $this->FechaRespuesta/1000);
            $date = new DateTime($dateString);
            return $date->format('d/m/y H:i:s').'.'.($this->FechaRespuesta % 1000);
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Resolucion';
	}
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario, idProblema, idSolucion, idTorneo, Token, FechaSolicitud', 'required'),
			array('idUsuario, idProblema, idSolucion, idTorneo, idEstado', 'numerical', 'integerOnly'=>true),
			array('Token', 'length', 'max'=>32),
			array('Respuesta', 'length', 'max'=>2000),
			array('FechaRespuesta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idResolucion, idUsuario, idProblema, idSolucion, idTorneo, Token, FechaSolicitud, FechaRespuesta, Respuesta, idEstado, NombreEquipo, Estado', 'safe', 'on'=>'search'),
                    
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
			'idSolucion0' => array(self::BELONGS_TO, 'Solucion', 'idSolucion'),
			'idTorneo0' => array(self::BELONGS_TO, 'Torneo', 'idTorneo'),
			'idEstado0' => array(self::BELONGS_TO, 'EstadoResolucion', 'idEstado'),
			'idProblema0' => array(self::BELONGS_TO, 'Problema', 'idProblema'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idResolucion' => 'Id Resolucion',
			'idUsuario' => 'Id Usuario',
			'idProblema' => 'Id Problema',
			'idSolucion' => 'Id Solucion',
			'idTorneo' => 'Id Torneo',
			'Token' => 'Token',
			'FechaSolicitud' => 'Fecha Solicitud',
			'FechaRespuesta' => 'Fecha Respuesta',
			'Respuesta' => 'Respuesta',
			'idEstado' => 'Id Estado',
                        'nombreEquipo'=>'Equipo',
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
                $criteria->with=array('idUsuario0','idEstado0');
		$criteria->compare('idResolucion',$this->idResolucion);
		$criteria->compare('t.idUsuario',$this->idUsuario);
		$criteria->compare('idProblema',$this->idProblema);
		$criteria->compare('idSolucion',$this->idSolucion);
		$criteria->compare('idTorneo',$this->idTorneo);
		$criteria->compare('Token',$this->Token,true);
		$criteria->compare('FechaSolicitud',$this->FechaSolicitud,true);
		$criteria->compare('FechaRespuesta',$this->FechaRespuesta,true);
		$criteria->compare('Respuesta',$this->Respuesta,true);
		$criteria->compare('t.idEstado',$this->idEstado);
                $criteria->compare('idUsuario0.NombreUsuario',$this->NombreEquipo,true);
                $criteria->compare('idEstado0.Estado',$this->Estado,true);
                
                $criteria->order='FechaRespuesta';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}