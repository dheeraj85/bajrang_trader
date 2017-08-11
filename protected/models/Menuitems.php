<?php

/**
 * This is the model class for table "menu_items".
 *
 * The followings are the available columns in table 'menu_items':
 * @property integer $id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $barcode
 * @property string $tax_type
 * @property string $sale_price
 */
class Menuitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'menu_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_category_id, p_sub_category_id, item_id', 'numerical', 'integerOnly' => true),
            array('barcode', 'length', 'max' => 100),
            array('tax_type', 'length', 'max' => 9),
            array('sale_price', 'length', 'max' => 15),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, p_category_id, p_sub_category_id, item_id, barcode, tax_type, sale_price', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'positem' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
            'category' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'subcategory' => array(self::BELONGS_TO, 'PurchasesubCategory', 'p_sub_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'p_category_id' => 'Purchase Category',
            'p_sub_category_id' => 'Purchase Sub Category',
            'item_id' => 'Item',
            'barcode' => 'Barcode',
            'tax_type' => 'Tax Type',
            'sale_price' => 'Sale Price',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('tax_type', $this->tax_type, true);
        $criteria->compare('sale_price', $this->sale_price, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Menuitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function Getimg($data) {
        ?>
        <img src="<?php echo Yii::app()->request->baseUrl . '/uploads/Itemimage/' . $data->item_image ?>" alt="<?php echo $data->item_image ?>" width="50px" height="50px">
        <?php
    }

}
