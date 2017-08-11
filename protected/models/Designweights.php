<?php

/**
 * This is the model class for table "design_weights".
 *
 * The followings are the available columns in table 'design_weights':
 * @property integer $id
 * @property integer $design_id
 * @property string $weight_for_design
 *
 * The followings are the available model relations:
 * @property ShapeDesign $design
 */
class Designweights extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Designweights the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'design_weights';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('weight_for_design', 'required'),
            array('weight_for_design', 'UniqueAttributesValidator', 'with'=>'design_id'),
//            array('design_id and weight_for_design', 'unique', 'message' => 'Weight for every Design should be unique.'),
            array('design_id', 'numerical', 'integerOnly' => true),
            array('weight_for_design', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, design_id, weight_for_design', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'design' => array(self::BELONGS_TO, 'ShapeDesign', 'design_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'design_id' => 'Design',
            'weight_for_design' => 'Weight For Design in kg',
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
        $criteria->compare('design_id', $this->design_id);
        $criteria->compare('weight_for_design', $this->weight_for_design, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
