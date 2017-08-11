<?php

/**
 * This is the model class for table "hr_employee".
 *
 * The followings are the available columns in table 'hr_employee':
 * @property integer $id
 * @property string $empname
 * @property string $fname
 * @property string $empcode
 * @property string $dob
 * @property string $contact
 * @property string $alter_contact
 * @property string $address
 * @property string $qualification
 * @property string $experience
 * @property string $speciality
 * @property string $martial_status
 * @property string $reference_by
 * @property string $aadhar_no
 * @property string $license_no
 * @property string $pan_no
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $ifsc
 * @property integer $designation_id
 * @property integer $emptype_id
 * @property string $bal_advance
 * @property string $bal_loan
 * @property integer $is_active
 * @property integer $created_by
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property EmpAttendance[] $empAttendances
 * @property EmployeeBenifits[] $employeeBenifits
 * @property EmployeeSalary[] $employeeSalaries
 * @property HrDesignation $designation
 * @property HrEmployeeSalarySettings[] $hrEmployeeSalarySettings
 * @property PurchaseInvoice[] $purchaseInvoices
 */
class Employee extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'hr_employee';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('designation_id, emptype_id, is_active, created_by', 'numerical', 'integerOnly' => true),
            array('empname, fname, alter_contact, speciality, reference_by, aadhar_no, license_no, pan_no, account_no, bank_name', 'length', 'max' => 100),
            array('empcode, contact, branch', 'length', 'max' => 50),
            array('address', 'length', 'max' => 200),
            array('martial_status', 'length', 'max' => 10),
            array('ifsc', 'length', 'max' => 20),
            array('bal_advance, bal_loan', 'length', 'max' => 12),
            array('dob, qualification, experience, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('empname, empcode, dob, contact, qualification, experience, speciality, martial_status, reference_by, designation_id, emptype_id', 'required'),
            //array('id, empname, fname, empcode, dob, contact, alter_contact, address, qualification, experience, speciality, martial_status, reference_by, aadhar_no, license_no, pan_no, account_no, bank_name, branch, ifsc, designation_id, emptype_id, bal_advance, bal_loan, is_active, created_by, created_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'attendance' => array(self::HAS_MANY, 'Attendance', 'employee_id'),
            'employeebenifits' => array(self::HAS_MANY, 'Employeebenifits', 'employee_id'),
            'employeesalaries' => array(self::HAS_MANY, 'Employeesalary', 'employee_id'),
            'designation' => array(self::BELONGS_TO, 'Designation', 'designation_id'),
            'emptype' => array(self::BELONGS_TO, 'Emptype', 'emptype_id'),
            'employeesalarysettings' => array(self::HAS_MANY, 'Employeesalarysettings', 'employee_id'),
            'purchaseinvoices' => array(self::HAS_MANY, 'Purchaseinvoice', 'received_by'),
            'users' => array(self::BELONGS_TO, 'Users', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'empname' => 'Employee Name',
            'fname' => 'Father Name',
            'empcode' => 'Employee Code',
            'dob' => 'Date of birth',
            'contact' => 'Mobile No.',
            'alter_contact' => 'Alter Contact',
            'address' => 'Address',
            'qualification' => 'Qualification',
            'experience' => 'Experience',
            'speciality' => 'Speciality',
            'martial_status' => 'Martial Status',
            'reference_by' => 'Reference By',
            'aadhar_no' => 'Aadhar No',
            'license_no' => 'Driving License No',
            'pan_no' => 'Pan No',
            'account_no' => 'Account No',
            'bank_name' => 'Bank Name',
            'branch' => 'Branch',
            'ifsc' => 'IFSC Code',
            'designation_id' => 'Designation',
            'emptype_id' => 'Employee type',
            'bal_advance' => 'Bal Advance',
            'bal_loan' => 'Bal Loan',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
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
        $criteria->compare('empname', $this->empname, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('empcode', $this->empcode, true);
        $criteria->compare('dob', $this->dob, true);
        $criteria->compare('contact', $this->contact, true);
        $criteria->compare('alter_contact', $this->alter_contact, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('qualification', $this->qualification, true);
        $criteria->compare('experience', $this->experience, true);
        $criteria->compare('speciality', $this->speciality, true);
        $criteria->compare('martial_status', $this->martial_status, true);
        $criteria->compare('reference_by', $this->reference_by, true);
        $criteria->compare('aadhar_no', $this->aadhar_no, true);
        $criteria->compare('license_no', $this->license_no, true);
        $criteria->compare('pan_no', $this->pan_no, true);
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('branch', $this->branch, true);
        $criteria->compare('ifsc', $this->ifsc, true);
        $criteria->compare('designation_id', $this->designation_id);
        $criteria->compare('emptype_id', $this->emptype_id);
        $criteria->compare('bal_advance', $this->bal_advance, true);
        $criteria->compare('bal_loan', $this->bal_loan, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Employee the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
