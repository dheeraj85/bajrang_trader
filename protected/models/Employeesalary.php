<?php

/**
 * This is the model class for table "employee_salary".
 *
 * The followings are the available columns in table 'employee_salary':
 * @property integer $id
 * @property integer $employee_id
 * @property integer $month
 * @property integer $year
 * @property string $payment_mode
 * @property string $voucher_no
 * @property string $dated
 * @property integer $total_present_days
 * @property integer $total_absent_days
 * @property integer $total_leave_days
 * @property string $amount
 * @property string $advance
 * @property string $incentive
 * @property string $ta
 * @property string $da
 * @property string $hra
 * @property string $salary_deduction
 * @property string $remark
 * @property string $total_salary
 *
 * The followings are the available model relations:
 * @property HrEmployee $employee
 */
class Employeesalary extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'employee_salary';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('employee_id, month, year, total_present_days, total_absent_days, total_leave_days', 'numerical', 'integerOnly' => true),
            array('payment_mode', 'length', 'max' => 6),
            array('voucher_no', 'length', 'max' => 50),
            array('amount, advance, incentive, ta, da, hra, salary_deduction, total_salary', 'length', 'max' => 12),
            array('remark', 'length', 'max' => 255),
            array('dated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, employee_id, month, year, payment_mode, voucher_no, dated, total_present_days, total_absent_days, total_leave_days, amount, advance, incentive, ta, da, hra, salary_deduction, remark, total_salary', 'safe', 'on' => 'search'),
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
            'month' => 'Month',
            'year' => 'Year',
            'payment_mode' => 'Payment Mode',
            'voucher_no' => 'Voucher No',
            'dated' => 'Date',
            'total_present_days' => 'Total Present Days',
            'total_absent_days' => 'Total Absent Days',
            'total_leave_days' => 'Total Leave Days',
            'amount' => 'Gross Salary',
            'advance' => 'Advance',
            'incentive' => 'Incentive',
            'ta' => 'TA',
            'da' => 'DA',
            'hra' => 'HRA',
            'salary_deduction' => 'Salary Deduction',
            'remark' => 'Remark',
            'total_salary' => 'Total Salary',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('employee_id', $this->employee_id);
        $criteria->compare('month', $this->month);
        $criteria->compare('year', $this->year);
        $criteria->compare('payment_mode', $this->payment_mode, true);
        $criteria->compare('voucher_no', $this->voucher_no, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('total_present_days', $this->total_present_days);
        $criteria->compare('total_absent_days', $this->total_absent_days);
        $criteria->compare('total_leave_days', $this->total_leave_days);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('advance', $this->advance, true);
        $criteria->compare('incentive', $this->incentive, true);
        $criteria->compare('ta', $this->ta, true);
        $criteria->compare('da', $this->da, true);
        $criteria->compare('hra', $this->hra, true);
        $criteria->compare('salary_deduction', $this->salary_deduction, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('total_salary', $this->total_salary, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Employeesalary the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function request($data) {
        if (isset($data->month)) {
            echo Utils::Getmonth($data->month);
        }
    }

}
