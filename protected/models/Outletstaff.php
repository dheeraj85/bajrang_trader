<?php

/**
 * This is the model class for table "outlet_staff".
 *
 * The followings are the available columns in table 'outlet_staff':
 * @property integer $id
 * @property integer $created_by
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile_no
 * @property string $address
 * @property string $loginid
 * @property string $password
 * @property string $staff_role
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 */
class Outletstaff extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'outlet_staff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by', 'numerical', 'integerOnly' => true),
            array('first_name, last_name, address, loginid, password', 'length', 'max' => 50),
            array('mobile_no', 'length', 'max' => 10),
            array('staff_role', 'length', 'max' => 9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('first_name, last_name, mobile_no, address, loginid, password', 'required'),
            array('id, created_by, first_name, last_name, mobile_no, address, loginid, password, staff_role', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'created_by' => 'Created By',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile_no' => 'Mobile No',
            'address' => 'Address',
            'loginid' => 'Loginid',
            'password' => 'Password',
            'staff_role' => 'Staff Role',
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
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('mobile_no', $this->mobile_no, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('loginid', $this->loginid, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('staff_role', $this->staff_role, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Outletstaff the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
