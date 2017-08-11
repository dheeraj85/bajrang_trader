<?php

/**
 * This is the model class for table "menu_kot_items".
 *
 * The followings are the available columns in table 'menu_kot_items':
 * @property integer $id
 * @property integer $menu_kot_id
 * @property integer $menu_item_id
 * @property string $qty
 * @property string $price
 * @property string $status
 *
 * The followings are the available model relations:
 * @property MenuKot $menuKot
 */
class Menukotitems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menukotitems the static model class
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
		return 'menu_kot_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_kot_id, menu_item_id', 'numerical', 'integerOnly'=>true),
			array('qty', 'length', 'max'=>15),
			array('price', 'length', 'max'=>12),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_kot_id, menu_item_id, qty, price, status', 'safe', 'on'=>'search'),
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
			'menukot' => array(self::BELONGS_TO, 'Menukot', 'menu_kot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_kot_id' => 'Menu Kot',
			'menu_item_id' => 'Menu Item',
			'qty' => 'Qty',
			'price' => 'Price',
			'status' => 'Status',
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
		$criteria->compare('menu_kot_id',$this->menu_kot_id);
		$criteria->compare('menu_item_id',$this->menu_item_id);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getMenuItem($data) {
        $item = Purchaseitem::model()->findByPk($data->menu_item_id);
        return $item->itemname;
    }
        
    public static function getItem($itemid) {
        return Menuitems::model()->findByAttributes(array('item_id'=>$itemid));
    }
}