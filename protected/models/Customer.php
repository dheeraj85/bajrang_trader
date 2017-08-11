<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $regdate
 * @property string $type
 * @property string $full_name
 * @property string $mobile_no
 * @property string $address
 * @property string $party_store_name
 * @property string $landline
 * @property string $email_id
 * @property string $balance
 */
class Customer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type', 'length', 'max' => 8),
            array('full_name', 'length', 'max' => 50),
            array('mobile_no', 'length', 'max' => 10),
            array('balance', 'length', 'max' => 15),
            array('address, party_store_name, landline, email_id', 'length', 'max' => 150),
            array('regdate', 'safe'),
            array('full_name,mobile_no,state_code', 'required','on'=>'signup'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, regdate, type, gstin_no,full_name, mobile_no, address, state_code,state,party_store_name, landline, email_id', 'safe', 'on' => 'search'),
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
            'regdate' => 'Regdate',
            'type' => 'Type',
            'gstin_no' => 'GSTIN',
            'full_name' => 'Full Name',
            'mobile_no' => 'Mobile No',
            'address' => 'Address',
            'state_code' => 'State Code',
            'state' => 'State',
            'party_store_name' => 'Store/Firm Name',
            'landline' => 'Landline',
            'email_id' => 'Email',
            'balance' => 'Balance',
            'regdate' => 'Create Date',
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
        $criteria->compare('regdate', $this->regdate, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('gstin_no', $this->gstin_no, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('mobile_no', $this->mobile_no, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('state', $this->state, true);
     //   $criteria->compare('state_code', $this->state_code, true);
        $criteria->compare('party_store_name', $this->party_store_name, true);
        $criteria->compare('landline', $this->landline, true);
        $criteria->compare('email_id', $this->email_id, true);
        $criteria->compare('balance', $this->balance, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
                  'pagination' => array(
                'PageSize' => 20,)
 
        ));
    }
    public function searchInternalCustomer() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
         $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('regdate', $this->regdate, true);
       // $criteria->compare('type', 'internal', true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('mobile_no', $this->mobile_no, true);
        $criteria->compare('address', $this->address, true);
                $criteria->compare('state', $this->state, true);
        $criteria->compare('state_code', $this->state_code, true);
        $criteria->compare('party_store_name', $this->party_store_name, true);
        $criteria->compare('landline', $this->landline, true);
        $criteria->compare('email_id', $this->email_id, true);
        $criteria->compare('balance', $this->balance, true);

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
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function ActionForInternal($data) {
        ?>
        <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('customerinternal/discount', array('id' => $data->id)); ?>">Discount</a>    
<!--        <a class="btn btn-success" href="<?php // echo Yii::app()->createUrl('customer/itemsale', array('id' => $data->id)); ?>">Sale Item</a>    -->
        <?php
    }
    public static function Action($data) {
        ?>
        <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('customer/discount', array('id' => $data->id)); ?>">Discount</a>    
<!--        <a class="btn btn-success" href="<?php // echo Yii::app()->createUrl('customer/itemsale', array('id' => $data->id)); ?>">Sale Item</a>    -->
        <?php
    }

}
