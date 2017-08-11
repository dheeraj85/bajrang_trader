<?php

/**
 * This is the model class for table "emp_attendance".
 *
 * The followings are the available columns in table 'emp_attendance':
 * @property integer $id
 * @property integer $employee_id
 * @property string $attendance
 * @property string $in_time
 * @property string $out_time
 * @property integer $half_day
 * @property string $date
 * @property integer $is_approved
 *
 * The followings are the available model relations:
 * @property HrEmployee $employee
 */
class Attendance extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'emp_attendance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('employee_id, half_day, is_approved', 'numerical', 'integerOnly' => true),
            array('attendance', 'length', 'max' => 100),
            array('in_time, out_time, date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, employee_id, attendance, in_time, out_time, half_day, date, is_approved', 'safe', 'on' => 'search'),
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
            'attendance' => 'Attendance',
            'in_time' => 'In Time',
            'out_time' => 'Out Time',
            'half_day' => 'Half Day',
            'date' => 'Date',
            'is_approved' => 'Is Approved',
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
        $criteria->compare('attendance', $this->attendance, true);
        $criteria->compare('in_time', $this->in_time, true);
        $criteria->compare('out_time', $this->out_time, true);
        $criteria->compare('half_day', $this->half_day);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('is_approved', $this->is_approved);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Attendance the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function getSundays($y, $m) {
        return new DatePeriod(
                new DateTime("first sunday of $y-$m"), DateInterval::createFromDateString('next sunday'), new DateTime("last day of $y-$m")
        );
    }

}
