<?php

/**
 * This is the model class for table "cash_drawer".
 *
 * The followings are the available columns in table 'cash_drawer':
 * @property integer $id
 * @property integer $counter_id
 * @property integer $user_id
 * @property string $txn_type
 * @property string $cash
 * @property string $final_closing
 * @property string $date
 * @property string $dated
 * @property integer $user_from
 * @property integer $user_to
 * @property string $remark
 * @property integer $is_handover_verified
 * @property string $handover_remark
 *
 * The followings are the available model relations:
 * @property CashCounter $counter
 * @property Users $user
 */
class Cashdrawer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cashdrawer the static model class
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
		return 'cash_drawer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('counter_id, user_id, txn_type, date, cash', 'required'),
			array('counter_id, user_id, user_from, user_to, is_handover_verified', 'numerical', 'integerOnly'=>true),
			array('txn_type', 'length', 'max'=>8),
			array('cash, final_closing', 'length', 'max'=>15),
			array('remark, handover_remark', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, counter_id, date, user_id, txn_type, cash, final_closing, dated, user_from, user_to, remark, is_handover_verified, handover_remark', 'safe', 'on'=>'search'),
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
			'counter' => array(self::BELONGS_TO, 'CashCounter', 'counter_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'userfrom' => array(self::BELONGS_TO, 'Users', 'user_from'),
			'userto' => array(self::BELONGS_TO, 'Users', 'user_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'counter_id' => 'Counter',
			'user_id' => 'User',
			'txn_type' => 'Opening and Handover',
			'cash' => 'Cash',
			'final_closing' => 'Final Closing',
			'date' => 'Date',
			'dated' => 'Dated',
			'user_from' => 'Handover From',
			'user_to' => 'Handover To',
			'remark' => 'Remark',
			'is_handover_verified' => 'Is Handover Verified',
			'handover_remark' => 'Handover Remark',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchcounter()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                
                $date = date('Y-m-d');
                $criteria->order = 'id DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('counter_id',$this->counter_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('cash',$this->cash,true);
		$criteria->compare('final_closing',$this->final_closing,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('user_from',$this->user_from);
		$criteria->compare('user_to',$this->user_to);
		$criteria->compare('remark',$this->remark,true);
//		$criteria->compare('is_handover_verified',$this->is_handover_verified);
		$criteria->compare('handover_remark',$this->handover_remark,true);
		$criteria->condition = "date='$date'";
//		$criteria->condition = "txn_type!='handover'";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}