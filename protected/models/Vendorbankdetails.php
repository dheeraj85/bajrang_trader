<?php

/**
 * This is the model class for table "vendor_bank_details".
 *
 * The followings are the available columns in table 'vendor_bank_details':
 * @property integer $id
 * @property string $account_name
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $ifsc
 * @property integer $created_by
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 */
class Vendorbankdetails extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vendor_bank_details';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by', 'numerical', 'integerOnly' => true),
            array('account_name, account_no, bank_name', 'length', 'max' => 100),
            array('branch', 'length', 'max' => 50),
            array('ifsc', 'length', 'max' => 20),
            array('created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('account_name, account_no, bank_name, branch, ifsc', 'required'),
            array('id, account_name, account_no, bank_name, branch, ifsc, created_by, created_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'users' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'account_name' => 'Account Name',
            'account_no' => 'Account No',
            'bank_name' => 'Bank Name',
            'branch' => 'Branch',
            'ifsc' => 'IFSC Code',
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
    public function search($vid) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('vendor_id', $vid);
        $criteria->compare('id', $this->id);
        $criteria->compare('account_name', $this->account_name, true);
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('branch', $this->branch, true);
        $criteria->compare('ifsc', $this->ifsc, true);
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
     * @return Vendorbankdetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
