<?php

/**
 * This is the model class for table "order_tables".
 *
 * The followings are the available columns in table 'order_tables':
 * @property integer $id
 * @property string $table_no
 * @property string $is_running
 *
 * The followings are the available model relations:
 * @property MenuKot[] $menuKots
 * @property MenuSale[] $menuSales
 */
class Ordertable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ordertable the static model class
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
		return 'order_tables';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('table_no', 'length', 'max'=>50),
			array('is_running', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, table_no, is_running', 'safe', 'on'=>'search'),
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
			'menukots' => array(self::HAS_MANY, 'Menukot', 'table_id'),
			'menusales' => array(self::HAS_MANY, 'Menusale', 'table_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'table_no' => 'Table No',
			'is_running' => 'Is Running',
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
		$criteria->compare('table_no',$this->table_no,true);
		$criteria->compare('is_running',$this->is_running,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}