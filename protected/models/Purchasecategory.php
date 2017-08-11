<?php

/**
 * This is the model class for table "purchase_category".
 *
 * The followings are the available columns in table 'purchase_category':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property PurchaseItem[] $purchaseItems
 * @property PurchaseSubCategory[] $purchaseSubCategories
 */
class Purchasecategory extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_active', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('type', 'length', 'max' => 9),
            array('description', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name', 'UniqueAttributesValidator', 'with'=>'type','message'=>'Product category already exists'),
            array('name, type, description', 'required'),
            array('id, name, type, description, is_active', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'is_active' => 'Is Active',
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
        if (Yii::app()->user->isSA() == 'sa' || Yii::app()->user->isCPS() == 'cps') {
        $criteria->compare('type', $this->type, true);    
        }else{
        $criteria->compare('type', 'Processed');    
        }
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('is_active', $this->is_active);

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
     * @return Purchasecategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
