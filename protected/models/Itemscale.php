<?php

/**
 * This is the model class for table "item_scale".
 *
 * The followings are the available columns in table 'item_scale':
 * @property integer $id
 * @property string $scale_type
 * @property string $type_name
 * @property string $description
 */
class Itemscale extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'item_scale';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('scale_type', 'length', 'max' => 8),
            array('type_name', 'length', 'max' => 20),
            array('description', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('scale_type, type_name, description', 'required'),
            array('id, scale_type, type_name, description', 'safe', 'on' => 'search'),
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
            'scale_type' => 'Goods Scale Type',
            'type_name' => 'Scale Type',
            'description' => 'Description',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('scale_type', $this->scale_type, true);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 10,)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Itemscale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
