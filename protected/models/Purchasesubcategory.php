<?php

/**
 * This is the model class for table "purchase_sub_category".
 *
 * The followings are the available columns in table 'purchase_sub_category':
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property PurchaseItem[] $purchaseItems
 * @property PurchaseCategory $category
 */
class Purchasesubcategory extends CActiveRecord {
    
    public $oldcategory_id;
    public $oldname;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_sub_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, is_active', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('type', 'length', 'max' => 9),
            array('description', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id', 'checkunique'),
            array('category_id,name, type, description', 'required'),
            array('id, category_id, name, type, description, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Purchasecategory', 'category_id'),
        );
    }

    public function checkunique($attribute,$params){
        if($this->category_id!==$this->oldcategory_id ||$this->name!==$this->oldname){
            $model=  Purchasesubcategory::model()->find('category_id=? AND name=?',array($this->category_id,$this->name));
            if($model!=null){
                $this->addError("name","This Category and Sub Category already exist");
            }
        }
    }
    protected function afterFind(){
        parent::afterFind();
        $this->oldcategory_id=$this->category_id;
        $this->oldname=$this->name;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
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
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('is_active', $this->is_active);

         return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 12,)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchasesubcategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
