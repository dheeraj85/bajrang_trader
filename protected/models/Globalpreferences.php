<?php

/**
 * This is the model class for table "global_preferences".
 *
 * The followings are the available columns in table 'global_preferences':
 * @property integer $id
 * @property string $label_name
 * @property string $name
 * @property string $value
 * @property string $added_on
 * @property integer $added_by
 */
class Globalpreferences extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Globalpreferences the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'global_preferences';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('added_by', 'numerical', 'integerOnly' => true),
            array('label_name, name, value', 'length', 'max' => 255),
            array('added_on', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, label_name, name, value, added_on, added_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'label_name' => 'Label Name',
            'name' => 'Name',
            'value' => 'Value',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('label_name', $this->label_name, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('added_on', $this->added_on, true);
        $criteria->compare('added_by', $this->added_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getValueByParamName($name) {
        return self::model()->findByAttributes(array('name' => $name))->value;
    }
    public static function getAllValueByParamName($name) {
        return self::model()->findByAttributes(array('name' => $name));
    }

}
