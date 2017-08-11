<?php

/**
 * This is the model class for table "bill".
 *
 * The followings are the available columns in table 'bill':
 * @property integer $id
 * @property string $bill_no
 * @property string $bill_date
 * @property string $bill_from_date
 * @property string $bill_to_date
 * @property integer $customer_id
 * @property integer $purchase_order_id
 * @property integer $item_id
 * @property string $bill_type
 * @property string $print_type
 * @property string $added_on
 * @property string $particulars
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property PurchaseOrder $purchaseOrder
 * @property PurchaseItem $item
 * @property BillItems[] $billItems
 */
class Bill extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bill the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bill';
    }

    public $weight;
    public $rate;
    public $tax;
    public $amount;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_id, purchase_order_id, item_id', 'numerical', 'integerOnly' => true),
            array('bill_no', 'length', 'max' => 20),
            array('bill_type', 'length', 'max' => 16),
            array('print_type', 'length', 'max' => 17),
            array('particulars', 'length', 'max' => 255),
            array('bill_date, bill_from_date, bill_to_date, added_on', 'safe'),
           // array('customer_id,bill_date, bill_from_date, bill_to_date', 'required', 'on' => 'create', 'message' => 'Required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, bill_no, bill_date, bill_from_date, bill_to_date, customer_id, purchase_order_id, item_id, bill_type, print_type, added_on, particulars', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'purchaseOrder' => array(self::BELONGS_TO, 'PurchaseOrder', 'purchase_order_id'),
            'item' => array(self::BELONGS_TO, 'PurchaseItem', 'item_id'),
            'billItems' => array(self::HAS_MANY, 'Billitems', 'bill_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'bill_no' => 'Bill No',
            'bill_date' => 'Bill Date',
            'bill_from_date' => 'Bill From Date',
            'bill_to_date' => 'Bill To Date',
            'customer_id' => 'Customer',
            'purchase_order_id' => 'Purchase Order',
            'item_id' => 'Item',
            'bill_type' => 'Bill Type',
            'print_type' => 'Print Type',
            'added_on' => 'Added On',
            'particulars' => 'Weight Report No',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchCostBill() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('bill_no', $this->bill_no, true);
      //  $criteria->compare('bill_date', $this->bill_date, true);
        $criteria->compare('bill_from_date', $this->bill_from_date, true);
        $criteria->compare('bill_to_date', $this->bill_to_date, true);
        $criteria->compare('customer_id', $this->customer_id);
   //     $criteria->compare('purchase_order_id', $this->purchase_order_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('bill_type', $this->bill_type, true);
        $criteria->compare('print_type', $this->print_type, true);
        $criteria->compare('added_on', $this->added_on, true);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->condition="bill_type='cost_bill'";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchIncrementalBill() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('bill_no', $this->bill_no, true);
      //  $criteria->compare('bill_date', $this->bill_date, true);
        $criteria->compare('bill_from_date', $this->bill_from_date, true);
        $criteria->compare('bill_to_date', $this->bill_to_date, true);
        $criteria->compare('customer_id', $this->customer_id);
   //     $criteria->compare('purchase_order_id', $this->purchase_order_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('bill_type', $this->bill_type, true);
        $criteria->compare('print_type', $this->print_type, true);
        $criteria->compare('added_on', $this->added_on, true);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->condition="bill_type='incremental_bill'";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getTotalBillAmt($data) {
        $sql = "Select sum(amount) as amount from bill_items where bill_id=$data->id";
        $m = Yii::app()->db->createCommand("$sql")->queryScalar();
        //print_r($m);
        return isset($m) ? $m : 0.00;
    }
    public static function getWeight($data) {
        $sql = "Select weight from bill_items where bill_id=$data->id";
        $m = Yii::app()->db->createCommand("$sql")->queryScalar();
       // print_r($m);
        return isset($m) ? $m : 0.00;
    }
    public static function getRate($data) {
        $sql = "Select rate from bill_items where bill_id=$data->id";
        $m = Yii::app()->db->createCommand("$sql")->queryScalar();
        return isset($m) ? $m : 0.00;
    }

    public static function Action($data) {
        if (empty($data->bill_no)) {
            ?>
            <a class="btn btn-success btn-sm" href="<?php echo Yii::app()->createUrl('bill/generatebill', array('id' => $data->id)); ?>">Manage Bill Items</a>    
        <?php } else {
            ?>
            <a class="btn btn-success btn-sm" href="<?php echo Yii::app()->createUrl('bill/showbill', array('id' => $data->id)); ?>">Print Bill</a>    
        <?php
        }
    }

}
