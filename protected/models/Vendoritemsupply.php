<?php

/**
 * This is the model class for table "vendor_item_supply".
 *
 * The followings are the available columns in table 'vendor_item_supply':
 * @property integer $id
 * @property integer $vendor_id
 * @property integer $purchase_item_id
 * @property string $itemname
 * @property string $brand
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property PurchaseItem $purchaseItem
 * @property Vendor $vendor
 */
class Vendoritemsupply extends CActiveRecord {

    public $p_category_id;
    public $p_sub_category_id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vendor_item_supply';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vendor_id, purchase_item_id, is_active', 'numerical', 'integerOnly' => true),
            array('itemname, brand', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('purchase_item_id, itemname', 'required'),
            //array('id, vendor_id, purchase_item_id, itemname, brand, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'purchaseItem' => array(self::BELONGS_TO, 'Purchaseitem', 'purchase_item_id'),
            'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'vendor_id' => 'Vendor',
            'purchase_item_id' => 'Purchase Item',
            'itemname' => 'Itemname',
            'brand' => 'Brand',
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
    public function search($vid) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('vendor_id', $vid);
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('vendor_id', $this->vendor_id);
        $criteria->compare('purchase_item_id', $this->purchase_item_id);
        $criteria->compare('itemname', $this->itemname, true);
        $criteria->compare('brand', $this->brand, true);
        $criteria->compare('is_active', $this->is_active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vendoritemsupply the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function request($data) {
        if ($data->is_active == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('vendoritemsupply/approval', array('id' => $data->id, 'is_active' => 1)); ?>"><i class="fa fa-lock"></i> Disabled</a>
            <?php
        } else {
            ?>
            <a href="<?php echo Yii::app()->createUrl('vendoritemsupply/approval', array('id' => $data->id, 'is_active' => 0)); ?>"><i class="fa fa-unlock"></i> Enabled</a>

            <?php
        }
    }

}
