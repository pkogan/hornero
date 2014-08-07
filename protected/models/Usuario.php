<?php

/**
 * This is the model class for table "Usuario".
 *
 * The followings are the available columns in table 'Usuario':
 * @property integer $idUsuario
 * @property string $NombreUsuario
 * @property string $Clave
 * @property integer $idRol
 * @property string $Email
 * @property integer $idLenguaje
 * @property string $Descripcion Descripcion
 *
 * The followings are the available model relations:
 * @property Resolucion[] $resolucions
 * @property TorneoUsuario[] $torneoUsuarios
 * @property Lenguaje $idLenguaje0
 * @property Rol $idRol0
 */
class Usuario extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Usuario the static model class
     */


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NombreUsuario, idRol, Descripcion, Email, idLenguaje', 'required'),

            array('idRol, idLenguaje', 'numerical', 'integerOnly' => true),
            array('NombreUsuario, Clave', 'length', 'max' => 15, 'min' =>2),
            array('Email', 'length', 'max' => 255),
            array('Descripcion', 'length', 'max' => 255),
            array('Email','email'),

            array('NombreUsuario','unique', 'attributeName' => 'NombreUsuario', 'className' => 'Usuario'),
            array('Email','unique', 'attributeName' => 'Email', 'className' => 'Usuario'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idUsuario, NombreUsuario, Clave, idRol, Email, idLenguaje, Descripcion', 'safe', 'on' => 'search'),
        );
    }

 
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'resolucions' => array(self::HAS_MANY, 'Resolucion', 'idUsuario'),
            'torneoUsuarios' => array(self::HAS_MANY, 'TorneoUsuario', 'idUsuario'),
            'idLenguaje0' => array(self::BELONGS_TO, 'Lenguaje', 'idLenguaje'),
            'idRol0' => array(self::BELONGS_TO, 'Rol', 'idRol'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idUsuario' => 'Id Usuario',
            'NombreUsuario' => 'Nombre Equipo',
            'Descripcion'=> 'Descripcion',
            'Clave' => 'Clave',
            'idRol' => 'Id Rol',
            'Email' => 'Email',
            'idLenguaje' => 'Lenguaje de programación de preferencia',
            'ReClave' => 'Reingrese la Clave'
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

        $criteria->compare('idUsuario', $this->idUsuario);
        $criteria->compare('NombreUsuario', $this->NombreUsuario, true);
        $criteria->compare('Clave', $this->Clave, true);
        $criteria->compare('idRol', $this->idRol);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('idLenguaje', $this->idLenguaje);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
