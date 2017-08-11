<?php

/**
 * This is the model class for table "expense_account".
 *
 * The followings are the available columns in table 'expense_account':
 * @property integer $id
 * @property integer $expense_heads_id
 * @property string $name
 * @property string $firm_name
 * @property string $mobile
 * @property string $contact_no
 * @property string $email
 * @property string $gstin_no
 * @property string $pan_no
 * @property string $address
 * @property integer $created_by
 * @property string $created_date
 * @property string $description
 *
 * The followings are the available model relations:
 * @property ExpenseHeads $expenseHeads
 * @property Users $createdBy
 * @property ExpenseInvoice[] $expenseInvoices
 */
class Expenseaccount extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'expense_account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('expense_heads_id, created_by', 'numerical', 'integerOnly' => true),
            array('name, firm_name', 'length', 'max' => 50),
            array('mobile, pan_no', 'length', 'max' => 10),
            array('contact_no', 'length', 'max' => 12),
            array('email, address', 'length', 'max' => 100),
            array('gstin_no', 'length', 'max' => 20),
            array('created_date, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('expense_heads_id, firm_name, mobile, email,address,description', 'required'),
            //array('id, expense_heads_id, name, firm_name, mobile, contact_no, email, gstin_no, pan_no, address, created_by, created_date, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'expenseheads' => array(self::BELONGS_TO, 'Expenseheads', 'expense_heads_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'expenseinvoices' => array(self::HAS_MANY, 'Expenseinvoice', 'vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'expense_heads_id' => 'Expense Heads',
            'name' => 'Name',
            'firm_name' => 'Firm Name',
            'mobile' => 'Mobile',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'gstin_no' => 'GSTIN No',
            'pan_no' => 'Pan No',
            'address' => 'Address',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'description' => 'Description',
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
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $criteria->compare('id', $this->id);
        $criteria->compare('expense_heads_id', $this->expense_heads_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('firm_name', $this->firm_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('contact_no', $this->contact_no, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('gstin_no', $this->gstin_no, true);
        $criteria->compare('pan_no', $this->pan_no, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Expenseaccount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
