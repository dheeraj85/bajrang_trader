<?php

/**
 * This is the model class for table "off_shelf_sale_items".
 *
 * The followings are the available columns in table 'off_shelf_sale_items':
 * @property integer $id
 * @property integer $shelf_sale_id
 * @property integer $item_id
 * @property string $description
 * @property string $qty
 * @property string $unit_price
 * @property string $unit_tax
 * @property string $discount_percent
 * @property string $amount
 *
 * The followings are the available model relations:
 * @property OffShelfSale $shelfSale
 */
class ShelfSaleItems extends CActiveRecord
{
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
			//array('unit_price', 'required'),
			array('shelf_sale_id, item_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>30),
			array('qty, unit_price, unit_tax, discount_percent, amount', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shelf_sale_id, item_id, description, qty, unit_price, unit_tax, discount_percent, amount', 'safe', 'on'=>'search'),
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
			'shelfSale' => array(self::BELONGS_TO, 'OffShelfSale', 'shelf_sale_id'),
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
			'discount_percent' => 'Discount Percent',
			'amount' => 'Amount',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('shelf_sale_id',$this->shelf_sale_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('unit_tax',$this->unit_tax,true);
		$criteria->compare('discount_percent',$this->discount_percent,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShelfSaleItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
