<?php

/**
 * This is the model class for table "menu_sale".
 *
 * The followings are the available columns in table 'menu_sale':
 * @property integer $id
 * @property string $txn_type
 * @property string $invoice_number
 * @property string $customer_name
 * @property string $customer_mobile
 * @property integer $created_by
 * @property integer $table_id
 * @property integer $counter_id
 * @property string $order_date
 * @property string $order_time
 * @property string $sub_total
 * @property string $discount_percent
 * @property string $tax_name
 * @property string $tax_percent
 * @property string $total_amount
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property OrderTables $table
 * @property Users $createdBy
 * @property MenuSaleItems[] $menuSaleItems
 */
class Menusale extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menusale the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, table_id, counter_id', 'numerical', 'integerOnly'=>true),
			array('txn_type', 'length', 'max'=>8),
			array('invoice_number', 'length', 'max'=>32),
			array('customer_name', 'length', 'max'=>50),
			array('customer_mobile', 'length', 'max'=>10),
			array('sub_total, total_amount', 'length', 'max'=>12),
			array('discount_percent', 'length', 'max'=>15),
			array('comments', 'length', 'max'=>255),
			array('tax_name, tax_percent', 'length', 'max'=>250),
			array('order_date, order_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, txn_type, invoice_number, customer_name, customer_mobile, created_by, table_id, counter_id, order_date, order_time, sub_total, discount_percent, tax_name, tax_percent, total_amount, comments', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'table' => array(self::BELONGS_TO, 'Ordertables', 'table_id'),
			'counter' => array(self::BELONGS_TO, 'Cashcounter', 'table_id'),
			'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'menusaleitems' => array(self::HAS_MANY, 'Menusaleitems', 'menu_sale_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'txn_type' => 'Txn Type',
			'invoice_number' => 'Invoice Number',
			'customer_name' => 'Customer Name',
			'customer_mobile' => 'Customer Mobile',
			'created_by' => 'Created By',
			'table_id' => 'Table',
			'counter_id' => 'Counter',
			'order_date' => 'Order Date',
			'order_time' => 'Order Time',
			'sub_total' => 'Sub Total',
			'discount_percent' => 'Discount Percent',
			'tax_name' => 'Tax Name',
			'tax_percent' => 'Tax Percent',
			'total_amount' => 'Total Amount',
			'comments' => 'Comments',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('customer_name',$this->customer_name,true);
		$criteria->compare('customer_mobile',$this->customer_mobile,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('table_id',$this->table_id);
		$criteria->compare('counter_id',$this->counter_id);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('order_time',$this->order_time,true);
		$criteria->compare('sub_total',$this->sub_total,true);
		$criteria->compare('discount_percent',$this->discount_percent,true);
		$criteria->compare('tax_name',$this->tax_name,true);
		$criteria->compare('tax_percent',$this->tax_percent,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}