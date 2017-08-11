<?php

/**
 * This is the model class for table "voucher".
 *
 * The followings are the available columns in table 'voucher':
 * @property integer $id
 * @property integer $voucher_type_id
 * @property string $payment_receiver_type
 * @property string $txn_type
 * @property integer $receiver_id
 * @property string $other_name
 * @property string $mobile
 * @property string $address
 * @property string $amount
 * @property integer $expense_nature_id
 * @property string $remark
 * @property string $dated
 * @property string $payment_mode
 * @property string $payment_date
 * @property string $c_number_t_num_utr_num
 * @property string $account_no
 * @property string $bank_card_name
 * @property integer $created_by
 * @property integer $is_assigned
 * @property string $voucher_no
 */
class Voucher extends CActiveRecord {
    public $from_date;
    public $to_date;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'voucher';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('voucher_type_id, receiver_id, expense_nature_id, created_by, is_assigned', 'numerical', 'integerOnly' => true),
            array('payment_receiver_type, amount', 'length', 'max' => 12),
            array('txn_type', 'length', 'max' => 7),
            array('other_name, c_number_t_num_utr_num, account_no, bank_card_name', 'length', 'max' => 100),
            array('mobile', 'length', 'max' => 50),
            array('address', 'length', 'max' => 255),
            array('payment_mode', 'length', 'max' => 6),
            array('dated, payment_date,remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            
            array('remark', 'required'),
            array('id, voucher_type_id, payment_receiver_type, txn_type, receiver_id, other_name, mobile, address, amount, expense_nature_id, remark, dated, payment_mode, payment_date, c_number_t_num_utr_num, account_no, bank_card_name, created_by, is_assigned', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'voucher' => array(self::BELONGS_TO, 'Vouchertype', 'voucher_type_id'),
            'counter' => array(self::BELONGS_TO, 'Cashcounter', 'counter_id'),
            'expnature' => array(self::BELONGS_TO, 'Expensenature', 'expense_nature_id'),
            'users' => array(self::BELONGS_TO, 'Users', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'voucher_type_id' => 'Voucher Type',
            'payment_receiver_type' => 'Receiver Type',
            'txn_type' => 'Txn Type',
            'receiver_id' => 'Receiver',
            'other_name' => 'Other Name',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'amount' => 'Amount',
            'expense_nature_id' => 'Expense Nature',
            'remark' => 'Narration',
            'dated' => 'Dated',
            'payment_mode' => 'Payment Mode',
            'payment_date' => 'Payment Date',
            'c_number_t_num_utr_num' => 'Cheque/DD/RTGS/TXN No',
            'account_no' => 'Account No',
            'bank_card_name' => 'Bank/Card Name',
            'received_by' => 'Received By',
            'received_mobileno' => 'Received Mobile No',
            'created_by' => 'Created By',
            'is_assigned' => 'Is Assigned',
            'voucher_no' => 'Voucher No'
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
        if(!empty($this->from_date) && empty($this->to_date) && empty($this->voucher_type_id))
        {
            $criteria->condition = "dated >= '$this->from_date'"; 
        }elseif(!empty($this->to_date) && empty($this->from_date) && empty($this->voucher_type_id))
        {
            $criteria->condition = "dated <= '$this->to_date'";
        }elseif(!empty($this->to_date) && !empty($this->from_date) && empty($this->voucher_type_id))
        {
            $criteria->condition = "dated  >= '$this->from_date' and dated <= '$this->to_date'";
        }
        elseif(!empty($this->to_date) && !empty($this->from_date) && !empty($this->voucher_type_id))
        {
            $criteria->condition = "dated  >= '$this->from_date' and dated <= '$this->to_date' and voucher_type_id=$this->voucher_type_id";
        }
        $criteria->compare('id', $this->id);
        $criteria->compare('voucher_type_id', $this->voucher_type_id);
        $criteria->compare('payment_receiver_type', $this->payment_receiver_type, true);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('receiver_id', $this->receiver_id);
        $criteria->compare('other_name', $this->other_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('expense_nature_id', $this->expense_nature_id);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('payment_mode', $this->payment_mode, true);
        $criteria->compare('payment_date', $this->payment_date, true);
        $criteria->compare('c_number_t_num_utr_num', $this->c_number_t_num_utr_num, true);
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('bank_card_name', $this->bank_card_name, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_assigned', $this->is_assigned);
        $criteria->compare('voucher_no', $this->voucher_no, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function search1() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('voucher_type_id', $this->voucher_type_id);
        $criteria->compare('payment_receiver_type', $this->payment_receiver_type, true);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('receiver_id', $this->receiver_id);
        $criteria->compare('other_name', $this->other_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('expense_nature_id', $this->expense_nature_id);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('payment_mode', $this->payment_mode, true);
        $criteria->compare('payment_date', $this->payment_date, true);
        $criteria->compare('c_number_t_num_utr_num', $this->c_number_t_num_utr_num, true);
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('bank_card_name', $this->bank_card_name, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_assigned', $this->is_assigned);
        $criteria->compare('voucher_no', $this->voucher_no,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function history($vendorid) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('payment_receiver_type', "vendor");
        $criteria->compare('receiver_id', $vendorid);
        $criteria->compare('id', $this->id);
        $criteria->compare('voucher_type_id', $this->voucher_type_id);
        $criteria->compare('payment_receiver_type', $this->payment_receiver_type, true);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('receiver_id', $this->receiver_id);
        $criteria->compare('other_name', $this->other_name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('expense_nature_id', $this->expense_nature_id);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('payment_mode', $this->payment_mode, true);
        $criteria->compare('payment_date', $this->payment_date, true);
        $criteria->compare('c_number_t_num_utr_num', $this->c_number_t_num_utr_num, true);
        $criteria->compare('account_no', $this->account_no, true);
        $criteria->compare('bank_card_name', $this->bank_card_name, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_assigned', $this->is_assigned);
        $criteria->compare('voucher_no', $this->voucher_no, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Voucher the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function reqstatus($data) {
        if (!empty($data)) {
            if ($data->payment_receiver_type == "employee") {
                echo Employee::model()->findByPk($data->receiver_id)->empname;
            } else if ($data->payment_receiver_type == "customer") {
                $cust = Customer::model()->findByPk($data->receiver_id);
                echo $cust->full_name . '&nbsp;(' . $cust->party_store_name . ')';
            } else if ($data->payment_receiver_type == "vendor") {
                $vend = Vendor::model()->findByPk($data->receiver_id);
                echo $vend->name . '&nbsp;(' . $vend->firm_name . ')';
            } else if ($data->payment_receiver_type == "expense_head") {
                echo Expenseheads::model()->findByPk($data->receiver_id)->name;
            } else if ($data->payment_receiver_type == "others") {
                if (!empty($data->receiver_id)) {
                    $bd = Bankdetails::model()->findByPk($data->receiver_id);
                    echo $bd->account_holder . " (" . $bd->bank_name . "-" . $bd->branch . ")";
                } else {
                    echo $data->other_name;
                }
            } else {
                echo $data->other_name;
            }
        }
    }

    public static function viewaction($data) {
        ?>   
        <a href="<?php echo Yii::app()->createUrl('vendor/historyview', array('id' => $data->id)); ?>"><button type='button' class='btn btn-info btn-sm'>View</button></a>
        <a href="<?php echo Yii::app()->createUrl('vendor/historyprint', array('id' => $data->id)); ?>"><button type='button' class='btn btn-info btn-sm'>Print</button></a>
        <?php
    }

    public static function action($data) {
        ?>    
        <?php if (Yii::app()->user->isSA()) { ?>
            <a href="<?php echo Yii::app()->createUrl('voucher/update', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Edit</button></a>
        <?php } ?>
        <a href="<?php echo Yii::app()->createUrl('voucher/view', array('id' => $data->id)); ?>"><button type='button' class='btn btn-info btn-sm'>View</button></a>
        <?php if ($data->received_status == "0") { ?>
            <a href="<?php echo Yii::app()->createUrl('voucher/review', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Receive by</button></a>
        <?php } else { ?>
            <a href="#"><button type='button' class='btn btn-green btn-sm disabled'>Received</button></a>
        <?php } ?>
        <a href="<?php echo Yii::app()->createUrl('voucher/print', array('id' => $data->id)); ?>"><button type='button' class='btn btn-info btn-sm'>Print</button></a>
        <?php
    }

}
