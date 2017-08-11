<?php

/**
 * This is the model class for table "pos_credit_account".
 *
 * The followings are the available columns in table 'pos_credit_account':
 * @property integer $id
 * @property string $pos_type
 * @property integer $pos_id
 * @property integer $bill_no
 * @property string $credit_amount
 * @property string $dated
 * @property string $voucher_no
 * @property string $remark
 */
class Creditaccount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Creditaccount the static model class
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
		return 'pos_credit_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pos_id', 'numerical', 'integerOnly'=>true),
			//array('pos_type', 'length', 'max'=>10),
			//array('credit_amount', 'length', 'max'=>12),
			//array('voucher_no', 'length', 'max'=>50),
			array('remark', 'length', 'max'=>255),
			array('dated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pos_type, pos_id, bill_no, credit_amount, dated, voucher_no, remark', 'safe', 'on'=>'search'),
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
			'pos_type' => 'Pos Type',
			'pos_id' => 'Pos',
			'bill_no' => 'Bill No',
			'credit_amount' => 'Credit Amount',
			'dated' => 'Dated',
			'voucher_no' => 'Voucher No',
			'remark' => 'Remark',
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
		$criteria->compare('pos_type',$this->pos_type,true);
		$criteria->compare('pos_id',$this->pos_id);
		$criteria->compare('bill_no',$this->bill_no);
		$criteria->compare('credit_amount',$this->credit_amount,true);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('voucher_no',$this->voucher_no,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}