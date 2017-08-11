<?php

/**
 * This is the model class for table "cancel_shelf_sale".
 *
 * The followings are the available columns in table 'cancel_shelf_sale':
 * @property integer $id
 * @property string $invoice_number
 * @property string $memo_number
 * @property string $txn_type
 * @property string $customer_name
 * @property string $customer_mobile
 * @property integer $customer_id
 * @property integer $counter_id
 * @property integer $created_by
 * @property string $order_date
 * @property string $order_time
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property CancelShelfItems[] $cancelShelfItems
 * @property Users $createdBy
 */
class Cancelshelfsale extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cancelshelfsale the static model class
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
		return 'cancel_shelf_sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, counter_id, created_by', 'numerical', 'integerOnly'=>true),
			array('invoice_number, memo_number', 'length', 'max'=>32),
			array('txn_type', 'length', 'max'=>8),
			array('customer_name', 'length', 'max'=>50),
			array('customer_mobile', 'length', 'max'=>10),
			array('order_date, order_time, comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, invoice_number, memo_number, txn_type, customer_name, customer_mobile, customer_id, counter_id, created_by, order_date, order_time, comment', 'safe', 'on'=>'search'),
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
			'cancelShelfItems' => array(self::HAS_MANY, 'CancelShelfItems', 'shelf_sale_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_number' => 'Invoice Number',
			'memo_number' => 'Memo Number',
			'txn_type' => 'Txn Type',
			'customer_name' => 'Customer Name',
			'customer_mobile' => 'Customer Mobile',
			'customer_id' => 'Customer',
			'counter_id' => 'Counter',
			'created_by' => 'Created By',
			'order_date' => 'Order Date',
			'order_time' => 'Order Time',
			'comment' => 'Comment',
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
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('memo_number',$this->memo_number,true);
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('customer_name',$this->customer_name,true);
		$criteria->compare('customer_mobile',$this->customer_mobile,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('counter_id',$this->counter_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('order_time',$this->order_time,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}