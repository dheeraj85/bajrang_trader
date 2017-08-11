<?php

/**
 * This is the model class for table "bill_items".
 *
 * The followings are the available columns in table 'bill_items':
 * @property integer $id
 * @property integer $bill_id
 * @property integer $kata_parchi_id
 * @property string $weight
 * @property string $rate
 * @property string $tax
 * @property string $amount
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property KataParchy $kataParchi
 * @property Bill $bill
 */
class Billitems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Billitems the static model class
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
		return 'bill_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bill_id, kata_parchi_id', 'numerical', 'integerOnly'=>true),
			array('weight, rate', 'length', 'max'=>10),
			array('tax', 'length', 'max'=>5),
			array('amount', 'length', 'max'=>20),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bill_id, kata_parchi_id, weight, rate, tax, amount, created_date', 'safe', 'on'=>'search'),
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
			'kataParchi' => array(self::BELONGS_TO, 'KataParchy', 'kata_parchi_id'),
			'bill' => array(self::BELONGS_TO, 'Bill', 'bill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bill_id' => 'Bill',
			'kata_parchi_id' => 'Kata Parchi',
			'weight' => 'Weight',
			'rate' => 'Rate',
			'tax' => 'Tax',
			'amount' => 'Amount',
			'created_date' => 'Created Date',
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
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('kata_parchi_id',$this->kata_parchi_id);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('rate',$this->rate,true);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}