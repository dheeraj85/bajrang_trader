<?php

/**
 * This is the model class for table "off_shelf_sale".
 *
 * The followings are the available columns in table 'off_shelf_sale':
 * @property integer $id
 * @property string $invoice_number
 * @property string $txn_type
 * @property string $customer_name
 * @property string $customer_mobile
 * @property integer $counter_id
 * @property integer $created_by
 * @property string $order_date
 * @property string $order_time
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property CashCounter $counter
 * @property Users $createdBy
 * @property OffShelfSaleItems[] $offShelfSaleItems
 */
class ShelfSale extends CActiveRecord {

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
            array('counter_id, created_by', 'numerical', 'integerOnly' => true),
            array('invoice_number', 'length', 'max' => 32),
            array('txn_type', 'length', 'max' => 8),
            array('customer_name', 'length', 'max' => 50),
            array('customer_mobile', 'length', 'max' => 10),
            array('order_date, order_time, comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_number, txn_type, customer_name, customer_mobile, counter_id, created_by, order_date, order_time, comment', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'counter' => array(self::BELONGS_TO, 'CashCounter', 'counter_id'),
            'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'offShelfSaleItems' => array(self::HAS_MANY, 'ShelfSaleItems', 'shelf_sale_id'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_number' => 'Invoice Number',
            'txn_type' => 'Txn Type',
            'customer_name' => 'Customer Name',
            'customer_mobile' => 'Customer Mobile',
            'counter_id' => 'Counter',
            'created_by' => 'Created By',
            'order_date' => 'Order Date',
            'order_time' => 'Order Time',
            'comment' => 'Comment',
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
        $criteria->compare('invoice_number', $this->invoice_number, true);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('customer_name', $this->customer_name, true);
        $criteria->compare('customer_mobile', $this->customer_mobile, true);
        $criteria->compare('counter_id', $this->counter_id);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('order_time', $this->order_time, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShelfSale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
     public static function gettotal($data){
        $sql = "SELECT SUM(amount) AS total FROM off_shelf_sale_items WHERE shelf_sale_id = $data->id";
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }
    
     public static function getpaid($data){
       $paid_sql = "SELECT SUM(credit_amount) AS total FROM pos_credit_account WHERE pos_id = $data->id";
        $paid_total = Yii::app()->db->createCommand("$paid_sql")->queryScalar();
        return $paid_total;
    }
    
     public static function getbalance($data){
        $sql = "SELECT SUM(amount) AS total FROM off_shelf_sale_items WHERE shelf_sale_id = $data->id";
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        $paid_sql = "SELECT SUM(credit_amount) AS total FROM pos_credit_account WHERE pos_id = $data->id";
        $paid_total = Yii::app()->db->createCommand("$paid_sql")->queryScalar();
        return $total - $paid_total;
    }

}
