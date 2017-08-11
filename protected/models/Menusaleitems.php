<?php

/**
 * This is the model class for table "menu_sale_items".
 *
 * The followings are the available columns in table 'menu_sale_items':
 * @property integer $id
 * @property integer $menu_sale_id
 * @property integer $menu_kot_id
 * @property integer $item_id
 * @property string $description
 * @property string $qty
 * @property string $unit_price
 * @property string $unit_tax
 * @property string $amount
 *
 * The followings are the available model relations:
 * @property MenuSale $menuSale
 */
class Menusaleitems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menusaleitems the static model class
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
		return 'menu_sale_items';
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
			array('menu_sale_id, menu_kot_id, item_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('qty, unit_price, unit_tax, amount', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_sale_id, menu_kot_id, item_id, description, qty, unit_price, unit_tax, amount', 'safe', 'on'=>'search'),
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
			'menusale' => array(self::BELONGS_TO, 'Menusale', 'menu_sale_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_sale_id' => 'Menu Sale',
			'menu_kot_id' => 'Menu Kot',
			'item_id' => 'Item',
			'description' => 'Description',
			'qty' => 'Qty',
			'unit_price' => 'Unit Price',
			'unit_tax' => 'Unit Tax',
			'amount' => 'Amount',
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
		$criteria->compare('menu_sale_id',$this->menu_sale_id);
		$criteria->compare('menu_kot_id',$this->menu_kot_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('unit_tax',$this->unit_tax,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}