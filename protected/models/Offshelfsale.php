<?php

/**
 * This is the model class for table "off_shelf_sale".
 *
 * The followings are the available columns in table 'off_shelf_sale':
 * @property integer $id
 * @property string $invoice_number
 * @property integer $memo_number
 * @property string $txn_type
 * @property string $customer_name
 * @property string $customer_mobile
 * @property integer $customer_id
 * @property integer $counter_id
 * @property integer $supply_state_code
 * @property string $invoice_type
 * @property string $previous_invoice_no
 * @property string $is_consignee_same
 * @property string $consignee_name
 * @property string $consignee_address
 * @property string $consignee_state
 * @property integer $consignee_state_code
 * @property string $consignee_gstin_code
 * @property string $is_reverse_charge_applicable
 * @property integer $created_by
 * @property string $order_date
 * @property string $order_time
 * @property string $comment
 * @property string $pay_status
 * @property integer $cancel_bill
 * @property string $cancel_date
 */
class Offshelfsale extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Offshelfsale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'off_shelf_sale';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('memo_number, customer_id, counter_id, supply_state_code, consignee_state_code, created_by, cancel_bill', 'numerical', 'integerOnly' => true),
            array('invoice_number', 'length', 'max' => 32),
            array('txn_type', 'length', 'max' => 20),
            array('customer_name, consignee_state', 'length', 'max' => 50),
            array('customer_mobile', 'length', 'max' => 10),
            array('invoice_type', 'length', 'max' => 11),
            array('previous_invoice_no, consignee_gstin_code', 'length', 'max' => 20),
            array('is_consignee_same, is_reverse_charge_applicable', 'length', 'max' => 1),
            array('consignee_name', 'length', 'max' => 100),
            array('consignee_address', 'length', 'max' => 200),
            array('pay_status', 'length', 'max' => 7),
            array('order_date, order_time, comment, cancel_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, invoice_number, memo_number, txn_type, customer_name, customer_mobile, customer_id, counter_id, supply_state_code, invoice_type, previous_invoice_no, is_consignee_same, consignee_name, consignee_address, consignee_state, consignee_state_code, consignee_gstin_code, is_reverse_charge_applicable, created_by, order_date, order_time, comment, pay_status, cancel_bill, cancel_date', 'safe', 'on' => 'search'),
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
            'counter' => array(self::BELONGS_TO, 'Cashcounter', 'counter_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'offshelfsaleitems' => array(self::HAS_MANY, 'Offshelfsaleitems', 'shelf_sale_id'),
            'reverse' => array(self::HAS_MANY, 'Salereversecharge', 'shelf_sale_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_number' => 'Invoice Number',
            'memo_number' => 'Memo Number',
            'txn_type' => 'Txn Type',
            'customer_name' => 'Customer Name',
            'customer_mobile' => 'Customer Mobile',
            'customer_id' => 'Customer',
            'counter_id' => 'Counter',
            'supply_state_code' => 'Supply State Code',
            'invoice_type' => 'Invoice Type',
            'previous_invoice_no' => 'Previous Invoice No',
            'is_consignee_same' => 'Is Consignee Same',
            'consignee_name' => 'Consignee Name',
            'consignee_address' => 'Consignee Address',
            'consignee_state' => 'Consignee State',
            'consignee_state_code' => 'Consignee State Code',
            'consignee_gstin_code' => 'Consignee GSTIN',
            'is_reverse_charge_applicable' => 'Is Reverse Charge Applicable',
            'created_by' => 'Created By',
            'order_date' => 'Order Date',
            'order_time' => 'Order Time',
            'comment' => 'Comment',
            'pay_status' => 'Pay Status',
            'cancel_bill' => 'Cancel Bill',
            'cancel_date' => 'Cancel Date',
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
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('invoice_number', $this->invoice_number, true);
        $criteria->compare('memo_number', $this->memo_number);
     $criteria->compare('txn_type', $this->txn_type);
        
        $criteria->compare('customer_name', $this->customer_name, true);
        $criteria->compare('customer_mobile', $this->customer_mobile, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('counter_id', $this->counter_id);
        $criteria->compare('supply_state_code', $this->supply_state_code);
        //$criteria->compare('invoice_type', $this->invoice_type, true);
        $criteria->compare('previous_invoice_no', $this->previous_invoice_no, true);
        //$criteria->compare('is_consignee_same', $this->is_consignee_same, true);
        //$criteria->compare('consignee_name', $this->consignee_name, true);
        //$criteria->compare('consignee_address', $this->consignee_address, true);
        //$criteria->compare('consignee_state', $this->consignee_state, true);
       // $criteria->compare('consignee_state_code', $this->consignee_state_code);
       // $criteria->compare('consignee_gstin_code', $this->consignee_gstin_code, true);
        //$criteria->compare('is_reverse_charge_applicable', $this->is_reverse_charge_applicable, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('order_time', $this->order_time, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('pay_status', $this->pay_status, true);
        $criteria->compare('cancel_bill', $this->cancel_bill);
        $criteria->compare('cancel_date', $this->cancel_date, true);
      //  $criteria->addInCondition('txn_type',array("special_cash","customer"));
        $criteria->condition="txn_type='special_cash'or txn_type='customer'";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchInternalCustomer() {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('invoice_number', $this->invoice_number, true);
        $criteria->compare('memo_number', $this->memo_number);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('customer_name', $this->customer_name, true);
        $criteria->compare('customer_mobile', $this->customer_mobile, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('counter_id', $this->counter_id);
        $criteria->compare('supply_state_code', $this->supply_state_code);
        $criteria->compare('invoice_type', $this->invoice_type, true);
        $criteria->compare('previous_invoice_no', $this->previous_invoice_no, true);
        $criteria->compare('is_consignee_same', $this->is_consignee_same, true);
        $criteria->compare('consignee_name', $this->consignee_name, true);
        $criteria->compare('consignee_address', $this->consignee_address, true);
        $criteria->compare('consignee_state', $this->consignee_state, true);
        $criteria->compare('consignee_state_code', $this->consignee_state_code);
        $criteria->compare('consignee_gstin_code', $this->consignee_gstin_code, true);
        $criteria->compare('is_reverse_charge_applicable', $this->is_reverse_charge_applicable, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('order_time', $this->order_time, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('pay_status', $this->pay_status, true);
        $criteria->compare('cancel_bill', $this->cancel_bill);
        $criteria->compare('cancel_date', $this->cancel_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getTotalBillAmt($data){
      $sql="Select sum(amount) as amount from off_shelf_sale_items where shelf_sale_id=$data->id";
       $m=Yii::app()->db->createCommand("$sql")->queryScalar();
      //print_r($m);
      return isset($m)?$m:0.00;
      
    }


    public static function Action($data) {
              if(!empty($data->invoice_number)) {
        ?>
        <a class="btn btn-success btn-sm" href="<?php echo Yii::app()->createUrl('offshelfsale/sale', array('id' => $data->id)); ?>">View/Print Invoice</a>    
                <!--<a class="btn btn-success" href="<?php // echo Yii::app()->createUrl('customer/itemsale', array('id' => $data->id));  ?>">Sale Item</a>-->    
        <?php
        } else { ?>
        <a class="btn btn-primary btn-sm" href="<?php echo Yii::app()->createUrl('offshelfsale/sale', array('id' => $data->id)); ?>">Add/Edit Items</a>    
        
    <?php } } 

    public static function ActionInternalSale($data) {
        if (!empty($data->invoice_number)) {
            ?>

            <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('internalsale/sale', array('id' => $data->id)); ?>">View Invoice</a>    
            <!--        <a class="btn btn-success" href="<?php // echo Yii::app()->createUrl('customer/itemsale', array('id' => $data->id)); ?>">Sale Item</a>    -->
            <?php } else {
            ?>
            <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('internalsale/sale', array('id' => $data->id)); ?>">Add Items</a>    

        <?php
        }
    }

}
