<?php

/**
 * This is the model class for table "employee_benifits".
 *
 * The followings are the available columns in table 'employee_benifits':
 * @property integer $id
 * @property integer $employee_id
 * @property string $txn_type
 * @property integer $month
 * @property integer $year
 * @property string $amount
 * @property string $interest
 * @property string $dated
 *
 * The followings are the available model relations:
 * @property HrEmployee $employee
 */
class Employeebenifits extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Employeebenifits the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'employee_benifits';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('employee_id, month, year', 'numerical', 'integerOnly' => true),
            array('txn_type', 'length', 'max' => 7),
            array('amount, interest', 'length', 'max' => 12),
            array('dated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('employee_id, txn_type, month, year, amount, dated', 'required'),
            array('id, employee_id, txn_type, month, year, amount, interest, dated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'employee_id' => 'Employee',
            'txn_type' => 'Transaction Type',
            'month' => 'Month',
            'year' => 'Year',
            'amount' => 'Amount',
            'interest' => 'Interest',
            'dated' => 'Dated',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('employee_id', $this->employee_id);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('month', $this->month);
        $criteria->compare('year', $this->year);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('interest', $this->interest, true);
        $criteria->compare('dated', $this->dated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

      public static function request($data) {
        if (isset($data->month)) {
            echo Utils::Getmonth($data->month);
        }
    }
}
