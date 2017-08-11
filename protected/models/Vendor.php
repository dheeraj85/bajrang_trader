<?php

/**
 * This is the model class for table "vendor".
 *
 * The followings are the available columns in table 'vendor':
 * @property integer $id
 * @property string $name
 * @property string $firm_name
 * @property string $mobile
 * @property string $contact_no
 * @property string $email
 * @property string $tin_no
 * @property string $pan_no
 * @property string $address
 * @property integer $created_by
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property VendorItemSupply[] $vendorItemSupplies
 */
class Vendor extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vendor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by', 'numerical', 'integerOnly' => true),
            array('name, firm_name', 'length', 'max' => 50),
            array('mobile, pan_no', 'length', 'max' => 10),
            array('contact_no', 'length', 'max' => 12),
            array('email, address', 'length', 'max' => 100),
            array('tin_no', 'length', 'max' => 20),
            array('created_date', 'safe'),
            array('email', 'email'),
            array('pan_no', 'length', 'min' => 10, 'message' => 'You must enter minimum 10 characters'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, firm_name, mobile, tin_no', 'required'),
            array('id, name, firm_name, mobile, contact_no, email, tin_no, pan_no, address, created_by, created_date', 'safe', 'on' => 'search'),
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
            'name' => 'Owner Name',
            'firm_name' => 'Company Name',
            'mobile' => 'Mobile No',
            'contact_no' => 'Alternate Mobile No',
            'email' => 'Email',
            'tin_no' => 'GSTIN No',
            'pan_no' => 'PAN No',
            'address' => 'Address',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('firm_name', $this->firm_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('contact_no', $this->contact_no, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('tin_no', $this->tin_no, true);
        $criteria->compare('pan_no', $this->pan_no, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 20,)
        ));
    }
    public function searchPrint() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('firm_name', $this->firm_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('contact_no', $this->contact_no, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('tin_no', $this->tin_no, true);
        $criteria->compare('pan_no', $this->pan_no, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);

         return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => FALSE
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vendor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function bankdetails($data) {
        ?>
        <a href="<?php echo Yii::app()->createUrl('vendorbankdetails/admin', array('id' => $data->id)); ?>"><button type="button" class="btn btn-green">Add</button></a>
        <?php
    }
    
    public static function itemsupply($data) {
        ?>
        <a href="<?php echo Yii::app()->createUrl('vendoritemsupply/admin', array('id' => $data->id)); ?>"><button type="button" class="btn btn-green">Add</button></a>
        <?php
    }

}
