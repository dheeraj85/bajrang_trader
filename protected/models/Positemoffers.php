<?php

/**
 * This is the model class for table "pos_item_offers".
 *
 * The followings are the available columns in table 'pos_item_offers':
 * @property integer $id
 * @property integer $item_id
 * @property integer $offer_dscount
 * @property string $offer_description
 * @property string $offer_code
 * @property string $from_date
 * @property string $to_date
 * @property string $status
 */
class Positemoffers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Positemoffers the static model class
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
		return 'pos_item_offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, offer_dscount', 'numerical', 'integerOnly'=>true),
			array('offer_description', 'length', 'max'=>255),
			array('status', 'length', 'max'=>6),
			array('from_date, to_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, offer_dscount, offer_code, offer_description, from_date, to_date, status', 'safe', 'on'=>'search'),
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
			'items' => array(self::BELONGS_TO, 'Shelfitems', 'item_id'),
//			'items' => array(self::BELONGS_TO, 'Menuitems', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Item',
			'offer_dscount' => 'Offer Discount in %',
			'offer_description' => 'Offer Description',
			'offer_code' => 'Offer Code',
			'from_date' => 'From Date(Y-M-D)',
			'to_date' => 'To Date',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('offer_dscount',$this->offer_dscount);
		$criteria->compare('offer_description',$this->offer_description,true);
		$criteria->compare('offer_code',$this->offer_code,true);
		$criteria->compare('from_date',$this->from_date,true);
		$criteria->compare('to_date',$this->to_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getitem($data) {
         $shelf = Shelfitems::model()->findByPk($data->item_id);   
         $menu = Purchaseitem::model()->findByPk($shelf->item_id);  
         echo $menu->itemname;
        }
}