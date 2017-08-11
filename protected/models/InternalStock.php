<?php

/**
 * This is the model class for table "internal_stock".
 *
 * The followings are the available columns in table 'internal_stock':
 * @property integer $id
 * @property integer $indent_item_id
 * @property integer $item_stock_id
 * @property integer $user_id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_brand
 * @property integer $stock_qty
 * @property string $stock_taking_scale
 * @property string $rate
 * @property string $amount
 * @property string $dealership_price
 * @property string $mrp
 * @property integer $is_mrd
 * @property integer $mrd_no
 * @property string $make_date
 * @property string $ready_date
 * @property string $discard_date
 * @property string $schedule_date
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class InternalStock extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'internal_stock';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('indent_item_id, item_stock_id, user_id, p_category_id, p_sub_category_id, item_id, stock_qty, is_mrd, mrd_no', 'numerical', 'integerOnly'=>true),
            array('item_name', 'length', 'max' => 100),
            array('item_brand', 'length', 'max' => 50),
            array('stock_taking_scale', 'length', 'max' => 10),
            array('rate, amount, dealership_price, mrp,stock_qty', 'length', 'max' => 12),
            array('make_date, ready_date, discard_date, schedule_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, indent_item_id, item_stock_id, user_id, p_category_id, p_sub_category_id, item_id, item_name, item_brand, stock_qty, stock_taking_scale, rate,tax ,amount, dealership_price, mrp, is_mrd, mrd_no, make_date, ready_date, discard_date, schedule_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'pcat' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'pscat' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
            'invoice' => array(self::BELONGS_TO, 'Purchaseinvoice', 'invoice_id'),
            'item' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'indent_item_id' => 'Indent Item',
            'item_stock_id' => 'Item Stock',
            'user_id' => 'User',
            'p_category_id' => 'P Category',
            'p_sub_category_id' => 'P Sub Category',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_brand' => 'Item Brand',
            'stock_qty' => 'Stock Qty',
            'stock_taking_scale' => 'Stock Taking Scale',
            'rate' => 'Rate',
            'tax' => 'Tax',
            'amount' => 'Amount',
            'dealership_price' => 'Dealership Price',
            'mrp' => 'Mrp',
            'is_mrd' => 'Is Mrd',
            'mrd_no' => 'Mrd No',
            'make_date' => 'Make Date',
            'ready_date' => 'Ready Date',
            'discard_date' => 'Discard Date',
            'schedule_date' => 'Schedule Date',
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
        $criteria->compare('indent_item_id', $this->indent_item_id);
        $criteria->compare('item_stock_id', $this->item_stock_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_brand', $this->item_brand, true);
        $criteria->compare('stock_qty', $this->stock_qty);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('dealership_price', $this->dealership_price, true);
        $criteria->compare('mrp', $this->mrp, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InternalStock the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
