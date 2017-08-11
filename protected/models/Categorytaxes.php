<?php

/**
 * This is the model class for table "category_taxes".
 *
 * The followings are the available columns in table 'category_taxes':
 * @property integer $id
 * @property string $pos_type
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $tax_id
 *
 * The followings are the available model relations:
 * @property PosTaxes $tax
 * @property PurchaseCategory $pCategory
 */
class Categorytaxes extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Categorytaxes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category_taxes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_category_id, tax_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, pos_type, p_category_id, p_sub_category_id, tax_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'taxtype' => array(self::BELONGS_TO, 'Postaxes', 'tax_id'),
            'pCategory' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'pSubCategory' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pos_type' => 'POS Type',
            'p_category_id' => 'Product Category',
            'p_sub_category_id' => 'Product Sub Category',
            'tax_id' => 'Tax',
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
        $criteria->compare('pos_type', $this->pos_type);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('tax_id', $this->tax_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getPOSType($data) {
        if ($data->pos_type == 'ots') {
            echo 'OTS';
        } else if ($data->pos_type == 'menu') {
            echo 'MENU';
        } else if ($data->pos_type == 'aos') {
            echo 'AOS';
        }
    }

}
