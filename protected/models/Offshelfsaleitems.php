<?php

/**
 * This is the model class for table "off_shelf_sale_items".
 *
 * The followings are the available columns in table 'off_shelf_sale_items':
 * @property integer $id
 * @property integer $shelf_sale_id
 * @property integer $item_id
 * @property string $description
 * @property integer $qty
 * @property string $unit_price
 * @property string $unit_tax
 * @property string $tax_amt
 * @property string $disc_amt
 * @property string $amt_without_tax
 * @property string $discount_percent
 * @property string $amount
 */
class Offshelfsaleitems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Offshelfsaleitems the static model class
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
		return 'off_shelf_sale_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_price', 'required'),
			array('shelf_sale_id, item_id,item_stock_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('unit_price, tax_amt, disc_amt, amt_without_tax, discount_percent, amount', 'safe'),
			array('unit_tax', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shelf_sale_id, item_id, description, qty, unit_price, unit_tax, tax_amt, disc_amt, amt_without_tax, discount_percent, amount,item_stock_id', 'safe', 'on'=>'search'),
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
			'shelfsale' => array(self::BELONGS_TO, 'OffShelfsale', 'shelf_sale_id'),
			'item_model' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shelf_sale_id' => 'Shelf Sale',
			'item_id' => 'Item',
			'description' => 'Description',
			'qty' => 'Qty',
			'unit_price' => 'Unit Price',
			'unit_tax' => 'Unit Tax',
			'tax_amt' => 'Tax Amt',
			'disc_amt' => 'Disc Amt',
			'amt_without_tax' => 'Amt Without Tax',
			'discount_percent' => 'Discount Percent',
			'amount' => 'Amount',
			'item_stock_id' => 'item stock id',
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
		$criteria->compare('shelf_sale_id',$this->shelf_sale_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('unit_tax',$this->unit_tax,true);
		$criteria->compare('tax_amt',$this->tax_amt,true);
		$criteria->compare('disc_amt',$this->disc_amt,true);
		$criteria->compare('amt_without_tax',$this->amt_without_tax,true);
		$criteria->compare('discount_percent',$this->discount_percent,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getItem($data) {
       // $shelf = Shelfitems::model()->findByPk($data->item_id);
        $item = Purchaseitem::model()->findByPk($data->item_id);
        return $item->itemname;
    }
}