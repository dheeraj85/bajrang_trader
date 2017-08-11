<?php

/**
 * This is the model class for table "design_complexity".
 *
 * The followings are the available columns in table 'design_complexity':
 * @property integer $id
 * @property string $design_code
 * @property string $description
 * @property integer $rate
 *
 * The followings are the available model relations:
 * @property CakeOrder[] $cakeOrders
 */
class Designcomplexity extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Designcomplexity the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'design_complexity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rate', 'numerical', 'integerOnly' => true),
            array('design_code', 'length', 'max' => 10),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, design_code, description, rate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rates' => array(self::BELONGS_TO, 'Cakerate', 'rate'),
            'cakeOrders' => array(self::HAS_MANY, 'CakeOrder', 'design_complexity_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'design_code' => 'Design Code',
            'description' => 'Description',
            'rate' => 'Rate',
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
        $criteria->compare('design_code', $this->design_code, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('rate', $this->rate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
