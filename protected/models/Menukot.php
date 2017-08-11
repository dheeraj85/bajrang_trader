<?php

/**
 * This is the model class for table "menu_kot".
 *
 * The followings are the available columns in table 'menu_kot':
 * @property integer $id
 * @property integer $table_id
 * @property integer $counter_id
 * @property string $kot_no
 * @property string $kot_date
 * @property string $status
 * @property integer $is_added_to_bill
 * @property integer $is_print_kot
 * @property string $pos_comments
 * @property string $kitchen_comments
 *
 * The followings are the available model relations:
 * @property OrderTables $table
 * @property MenuKotItems[] $menuKotItems
 */
class Menukot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menukot the static model class
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
		return 'menu_kot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('table_id, counter_id, is_added_to_bill', 'numerical', 'integerOnly'=>true),
			array('kot_no', 'length', 'max'=>20),
			array('status', 'length', 'max'=>7),
			array('pos_comments, kitchen_comments', 'length', 'max'=>255),
			array('kot_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, table_id, counter_id, kot_no, kot_date, status, is_added_to_bill, pos_comments, kitchen_comments', 'safe', 'on'=>'search'),
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
			'table' => array(self::BELONGS_TO, 'Ordertables', 'table_id'),
			'menukotitems' => array(self::HAS_MANY, 'Menukotitems', 'menu_kot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'table_id' => 'Table',
			'counter_id' => 'Counter',
			'kot_no' => 'Kot No',
			'kot_date' => 'Kot Date',
			'status' => 'Status',
			'is_added_to_bill' => 'Is Added To Bill',
			'is_print_kot' => 'Is Print Kot',
			'pos_comments' => 'Pos Comments',
			'kitchen_comments' => 'Kitchen Comments',
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
		$criteria->compare('table_id',$this->table_id);
		$criteria->compare('counter_id',$this->counter_id);
		$criteria->compare('kot_no',$this->kot_no,true);
		$criteria->compare('kot_date',$this->kot_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_added_to_bill',$this->is_added_to_bill);
		$criteria->compare('is_print_kot',$this->is_print_kot);
		$criteria->compare('pos_comments',$this->pos_comments,true);
		$criteria->compare('kitchen_comments',$this->kitchen_comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}