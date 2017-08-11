<?php

/**
 * This is the model class for table "bank_details".
 *
 * The followings are the available columns in table 'bank_details':
 * @property integer $id
 * @property string $account_no
 * @property string $account_holder
 * @property string $bank_name
 * @property string $branch
 * @property string $ifsc
 */
class Bankdetails extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bank_details';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_no, account_holder', 'length', 'max' => 20),
            array('bank_name, branch, ifsc', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('account_no, account_holder, bank_name, branch', 'required'),
            //array('id, account_no, account_holder, bank_name, branch, ifsc', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'account_no' => 'Account No / Mobile No',
            'account_holder' => 'Account Holder / Person Name',
            'bank_name' => 'Bank Name / Entity Name',
            'branch' => 'Branch / Address',
            'ifsc' => 'IFSC / Other Information',
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
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('account_holder', $this->account_holder, true);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('branch', $this->branch, true);
        $criteria->compare('ifsc', $this->ifsc, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 20,)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bankdetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
