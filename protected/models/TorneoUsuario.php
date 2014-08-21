<?php

/**
 * This is the model class for table "TorneoUsuario".
 *
 * The followings are the available columns in table 'TorneoUsuario':
 * @property integer $idTorneoUsuario
 * @property integer $idTorneo
 * @property integer $idUsuario
 * @property integer $Puntos
 * @property string $Token
 *
 * The followings are the available model relations:
 * @property Usuario $idUsuario0
 * @property Torneo $idTorneo0
 */
class TorneoUsuario extends CActiveRecord {

    public $equipo;

    public function getPosicion() {
        $idUsuario = $this->idUsuario;

        $equipos = $this->idTorneo0->torneoUsuarios;
        for ($i = 0; $i < count($equipos) && $equipos[$i]->idUsuario != $idUsuario; $i++);

        if ($i < count($equipos) && $equipos[$i]->idUsuario == $idUsuario) {
            return $i + 1;
        } else {
            return false;
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TorneoUsuario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTiempoOK() {
        $dateString = date('Ymd H:i:s', $this->Tiempo / 1000);
        $date = new DateTime($dateString);
        return $date->format('d/m/y H:i:s') . '.' . ($this->Tiempo % 1000);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'TorneoUsuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idTorneo, idUsuario, Token', 'required'),
            array('idTorneo, idUsuario, Puntos', 'numerical', 'integerOnly' => true),
            array('Token', 'length', 'max' => 32),
            array('Token', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idTorneoUsuario, idTorneo, idUsuario, Puntos, Token, equipo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idUsuario0' => array(self::BELONGS_TO, 'Usuario', 'idUsuario'),
            'idTorneo0' => array(self::BELONGS_TO, 'Torneo', 'idTorneo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idTorneoUsuario' => 'Id Torneo Usuario',
            'idTorneo' => 'Id Torneo',
            'idUsuario' => 'Id Usuario',
            'Puntos' => 'Puntos',
            'Token' => 'Token',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('idUsuario0');
        $criteria->compare('idTorneoUsuario', $this->idTorneoUsuario);
        $criteria->compare('idTorneo', $this->idTorneo);
        $criteria->compare('idUsuario', $this->idUsuario);
        $criteria->compare('Puntos', $this->Puntos);
        $criteria->compare('Token', $this->Token, true);
        $criteria->compare('idUsuario0.NombreUsuario', $this->equipo, true);
        $criteria->order = 'Puntos DESC, Tiempo';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
