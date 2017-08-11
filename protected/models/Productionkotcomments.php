<?php

/**
 * This is the model class for table "production_kot_comments".
 *
 * The followings are the available columns in table 'production_kot_comments':
 * @property integer $id
 * @property integer $production_kot_id
 * @property integer $from_id
 * @property integer $to_id
 * @property string $comments
 * @property string $dated
 *
 * The followings are the available model relations:
 * @property ProductionKot $productionKot
 */
class Productionkotcomments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productionkotcomments the static model class
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
		return 'production_kot_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('production_kot_id, from_id, to_id', 'numerical', 'integerOnly'=>true),
			array('comments', 'length', 'max'=>255),
			array('dated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, production_kot_id, from_id, to_id, comments, dated', 'safe', 'on'=>'search'),
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
			'productionkot' => array(self::BELONGS_TO, 'Productionkot', 'production_kot_id'),
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
			'from_id' => 'From',
			'to_id' => 'To',
			'comments' => 'Comments',
			'dated' => 'Dated',
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
		$criteria->compare('from_id',$this->from_id);
		$criteria->compare('to_id',$this->to_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('dated',$this->dated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}