<?php

/**
 * This is the model class for table "production_kot_items".
 *
 * The followings are the available columns in table 'production_kot_items':
 * @property integer $id
 * @property integer $production_kot_id
 * @property integer $menu_item_id
 * @property integer $qty
 * @property string $status
 * @property integer $is_redraw
 * @property integer $is_added_to_shelf
 * @property string $added_date
 *
 * The followings are the available model relations:
 * @property ProductionKot $productionKot
 */
class Productionkotitems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productionkotitems the static model class
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
		return 'production_kot_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('production_kot_id, menu_item_id, qty, is_redraw, is_added_to_shelf', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>7),
			array('added_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, production_kot_id, menu_item_id, qty, status, is_redraw, is_added_to_shelf, added_date', 'safe', 'on'=>'search'),
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
			'productionKot' => array(self::BELONGS_TO, 'ProductionKot', 'production_kot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'production_kot_id' => 'Production Kot',
			'menu_item_id' => 'Menu Item',
			'qty' => 'Qty',
			'status' => 'Status',
			'is_redraw' => 'Is Redraw',
			'is_added_to_shelf' => 'Is Added To Shelf',
			'added_date' => 'Added Date',
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
		$criteria->compare('production_kot_id',$this->production_kot_id);
		$criteria->compare('menu_item_id',$this->menu_item_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_redraw',$this->is_redraw);
		$criteria->compare('is_added_to_shelf',$this->is_added_to_shelf);
		$criteria->compare('added_date',$this->added_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getItem($data) {
        $shelf = Shelfitems::model()->findByPk($data->menu_item_id);
        $item = Purchaseitem::model()->findByPk($shelf->item_id);
        return $item->itemname;
    }
}