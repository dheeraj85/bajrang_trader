<?php

/**
 * This is the model class for table "sale_reverse_charge".
 *
 * The followings are the available columns in table 'sale_reverse_charge':
 * @property integer $id
 * @property integer $shelf_sale_id
 * @property integer $invoice_settings_id
 * @property string $amount
 * @property string $tax_amount
 *
 * The followings are the available model relations:
 * @property OffShelfSale $shelfSale
 */
class Salereversecharge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Salereversecharge the static model class
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
		return 'sale_reverse_charge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shelf_sale_id, invoice_settings_id', 'numerical', 'integerOnly'=>true),
			array('amount, tax_amount', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shelf_sale_id, invoice_settings_id, amount, tax_amount', 'safe', 'on'=>'search'),
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
			'invoice_settings_id' => 'Invoice Settings',
			'amount' => 'Amount',
			'tax_amount' => 'Tax Amount',
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
		$criteria->compare('invoice_settings_id',$this->invoice_settings_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('tax_amount',$this->tax_amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}