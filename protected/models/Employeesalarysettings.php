<?php

/**
 * This is the model class for table "hr_employee_salary_settings".
 *
 * The followings are the available columns in table 'hr_employee_salary_settings':
 * @property integer $id
 * @property integer $employee_id
 * @property string $total_ctc
 * @property string $per_day_ctc
 * @property string $pf_deduction
 * @property string $other_deduction
 * @property string $hra
 * @property integer $earned_leaves
 * @property integer $medical_leaves
 * @property integer $lwp
 *
 * The followings are the available model relations:
 * @property HrEmployee $employee
 */
class Employeesalarysettings extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'hr_employee_salary_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('employee_id, earned_leaves, medical_leaves, lwp', 'numerical', 'integerOnly' => true),
            array('total_ctc, per_day_ctc, pf_deduction, other_deduction, hra', 'length', 'max' => 12),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('employee_id, total_ctc, per_day_ctc, pf_deduction, other_deduction, hra, earned_leaves, medical_leaves, lwp', 'required'),
            //array('id, employee_id, total_ctc, per_day_ctc, pf_deduction, other_deduction, hra, earned_leaves, medical_leaves, lwp', 'safe', 'on' => 'search'),
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
            'total_ctc' => 'Total CTC',
            'per_day_ctc' => 'Per Day CTC',
            'pf_deduction' => 'PF Deduction',
            'other_deduction' => 'Other Deduction',
            'hra' => 'House Rent Allowance',
            'earned_leaves' => 'Available Leaves',
            'used_earned_leaves' => 'Earned Leaves',
            'medical_leaves' => 'Available Medical Leaves',
            'used_medical_leaves' => 'Medical Leaves',
            'lwp' => 'Available Leave Without Pay',
            'used_lwp_leaves' => 'LWP',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('employee_id', $this->employee_id);
        $criteria->compare('total_ctc', $this->total_ctc, true);
        $criteria->compare('per_day_ctc', $this->per_day_ctc, true);
        $criteria->compare('pf_deduction', $this->pf_deduction, true);
        $criteria->compare('other_deduction', $this->other_deduction, true);
        $criteria->compare('hra', $this->hra, true);
        $criteria->compare('earned_leaves', $this->earned_leaves);
        $criteria->compare('medical_leaves', $this->medical_leaves);
        $criteria->compare('lwp', $this->lwp);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Employeesalarysettings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
