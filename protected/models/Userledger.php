<?php

/**
 * This is the model class for table "user_ledger".
 *
 * The followings are the available columns in table 'user_ledger':
 * @property integer $id
 * @property string $type
 * @property integer $user_id
 * @property string $debit_amt
 * @property string $credit_amt
 * @property string $balance_amt
 * @property string $dated
 * @property string $description
 */
class Userledger extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Userledger the static model class
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
		return 'user_ledger';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>8),
			array('debit_amt, credit_amt, balance_amt', 'length', 'max'=>10),
			array('dated, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, user_id, debit_amt, credit_amt, balance_amt, dated, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'user_id' => 'User',
			'debit_amt' => 'Debit Amt',
			'credit_amt' => 'Credit Amt',
			'balance_amt' => 'Balance Amt',
			'dated' => 'Dated',
			'description' => 'Description',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('debit_amt',$this->debit_amt,true);
		$criteria->compare('credit_amt',$this->credit_amt,true);
		$criteria->compare('balance_amt',$this->balance_amt,true);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}