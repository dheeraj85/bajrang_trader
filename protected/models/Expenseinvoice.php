<?php

/**
 * This is the model class for table "expense_invoice".
 *
 * The followings are the available columns in table 'expense_invoice':
 * @property integer $id
 * @property integer $expense_heads_id
 * @property string $invoice_type
 * @property string $gstin_no
 * @property integer $is_gstn_compliant
 * @property integer $compliants_category
 * @property integer $place_of_supply
 * @property integer $state_code
 * @property string $invoice_no
 * @property string $invoice_date
 * @property string $vendor_name
 * @property integer $vendor_id
 * @property integer $received_by
 * @property string $discount_type
 * @property string $total_amount
 * @property string $total_discount
 * @property string $round_off
 * @property integer $is_added_to_stock
 * @property integer $is_reviewed
 * @property integer $review_point
 * @property string $review_desc
 * @property string $truck_wagon_no
 * @property string $truck_wagon_owner_name
 * @property string $driver_name
 * @property string $driver_contact
 * @property string $driver_lic_no
 * @property string $rr_no
 * @property string $transport_name
 * @property string $dispatch_from
 * @property string $dispatch_to
 * @property string $crossing
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property ExpenseHeads $expenseHeads
 * @property Users $createdBy
 * @property ExpenseAccount $vendor
 * @property HrEmployee $receivedBy
 * @property ExpenseInvoiceItems[] $expenseInvoiceItems
 */
class Expenseinvoice extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'expense_invoice';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('expense_heads_id, is_gstn_compliant, compliants_category, place_of_supply, state_code, vendor_id, received_by, is_added_to_stock, is_reviewed, review_point, created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('invoice_type', 'length', 'max' => 6),
            array('gstin_no', 'length', 'max' => 25),
            array('invoice_no, vendor_name, driver_contact', 'length', 'max' => 50),
            array('discount_type', 'length', 'max' => 13),
            array('total_amount', 'length', 'max' => 14),
            array('total_discount', 'length', 'max' => 12),
            array('round_off', 'length', 'max' => 5),
            array('review_desc, truck_wagon_no, truck_wagon_owner_name, driver_name, driver_lic_no, rr_no, transport_name, dispatch_from, dispatch_to, crossing', 'length', 'max' => 200),
            array('invoice_date, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('invoice_no', 'unique'),
            array('invoice_type, invoice_no, invoice_date, received_by', 'required'),
                //array('id, expense_heads_id, invoice_type, gstin_no, is_gstn_compliant, compliants_category, place_of_supply, state_code, invoice_no, invoice_date, vendor_name, vendor_id, received_by, discount_type, total_amount, total_discount, round_off, is_added_to_stock, is_reviewed, review_point, review_desc, truck_wagon_no, truck_wagon_owner_name, driver_name, driver_contact, driver_lic_no, rr_no, transport_name, dispatch_from, dispatch_to, crossing, created_by, updated_by, created_date', 'safe', 'on' => 'search'),
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
            'expenseinvoiceitems' => array(self::HAS_MANY, 'Expenseinvoiceitems', 'invoice_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'vendor' => array(self::BELONGS_TO, 'Expenseaccount', 'vendor_id'),
            'receivedby' => array(self::BELONGS_TO, 'Employee', 'received_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'expense_heads_id' => 'Expense Heads',
            'invoice_type' => 'Invoice Type',
            'gstin_no' => 'GSTIN No',
            'is_gstn_compliant' => 'Is Gstn Compliant',
            'compliants_category' => 'Supplies Classification',
            'place_of_supply' => 'Place Of Supply',
            'state_code' => 'State Code',
            'invoice_no' => 'Invoice No',
            'invoice_date' => 'Invoice Date',
            'vendor_name' => 'Vendor Name',
            'vendor_id' => 'Vendor',
            'received_by' => 'Received By',
            'discount_type' => 'Discount Type',
            'total_amount' => 'Total Amount',
            'total_discount' => 'Total Discount',
            'round_off' => 'Round Off',
            'is_added_to_stock' => 'Is Added To Stock',
            'is_reviewed' => 'Is Reviewed',
            'review_point' => 'Review Point',
            'review_desc' => 'Review Desc',
            'truck_wagon_no' => 'Truck Wagon No',
            'truck_wagon_owner_name' => 'Truck Wagon Owner Name',
            'driver_name' => 'Driver Name',
            'driver_contact' => 'Driver Contact',
            'driver_lic_no' => 'Driver License No',
            'rr_no' => 'Lr. No',
            'transport_name' => 'Transport Name',
            'dispatch_from' => 'Dispatch From',
            'dispatch_to' => 'Dispatch To',
            'crossing' => 'Crossing',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('expense_heads_id', $this->expense_heads_id);
        $criteria->compare('invoice_type', $this->invoice_type, true);
        $criteria->compare('gstin_no', $this->gstin_no, true);
        $criteria->compare('is_gstn_compliant', $this->is_gstn_compliant);
        $criteria->compare('compliants_category', $this->compliants_category);
        $criteria->compare('place_of_supply', $this->place_of_supply);
        $criteria->compare('state_code', $this->state_code);
        $criteria->compare('invoice_no', $this->invoice_no, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('vendor_name', $this->vendor_name, true);
        $criteria->compare('vendor_id', $this->vendor_id);
        $criteria->compare('received_by', $this->received_by);
        $criteria->compare('discount_type', $this->discount_type, true);
        $criteria->compare('total_amount', $this->total_amount, true);
        $criteria->compare('total_discount', $this->total_discount, true);
        $criteria->compare('round_off', $this->round_off, true);
        $criteria->compare('is_added_to_stock', $this->is_added_to_stock);
        $criteria->compare('is_reviewed', $this->is_reviewed);
        $criteria->compare('review_point', $this->review_point);
        $criteria->compare('review_desc', $this->review_desc, true);
        $criteria->compare('truck_wagon_no', $this->truck_wagon_no, true);
        $criteria->compare('truck_wagon_owner_name', $this->truck_wagon_owner_name, true);
        $criteria->compare('driver_name', $this->driver_name, true);
        $criteria->compare('driver_contact', $this->driver_contact, true);
        $criteria->compare('driver_lic_no', $this->driver_lic_no, true);
        $criteria->compare('rr_no', $this->rr_no, true);
        $criteria->compare('transport_name', $this->transport_name, true);
        $criteria->compare('dispatch_from', $this->dispatch_from, true);
        $criteria->compare('dispatch_to', $this->dispatch_to, true);
        $criteria->compare('crossing', $this->crossing, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('updated_by', $this->updated_by);
        $criteria->compare('created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Expenseinvoice the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function reqstatus($data) {
        if (!empty($data->vendor_name)) {
            echo $data->vendor_name;
        } else {
            if (isset($data->vendor->firm_name)) {
                echo $data->vendor->firm_name;
            }
        }
    }

    public static function req_gst($data) {
        echo $data->vendor->gstin_no;
    }

    public static function check_gst($data) {
        if (empty($data->vendor->gstin_no)) {
            echo "<span class='badge pull-right' style='background-color: #dd4b39'>Un-Registered</span>";
        } else if (empty($data->gstin_no)) {
            echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
        }
    }

    public static function statecode($data) {
        if ($data->place_of_supply == "1") {
            echo Gststatecodes::model()->findByAttributes(array("state_code" => $data->state_code))->state_name;
        } else {
            echo "In-State";
        }
    }

    public static function getamount($data) {
        $sql = "SELECT SUM(amount) AS total FROM invoice_pay WHERE invoice_id = $data->id";
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        echo $total;
    }

    public static function getbalance($data) {
        $sql = "SELECT SUM(amount) AS total FROM invoice_pay WHERE invoice_id = $data->id";
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $data->total_amount - $total;
    }

    public static function discount_type($data) {
        if ($data->discount_type == "bill_discount") {
            echo "Discount in Bill";
        } else {
            echo "Discount in Items";
        }
    }

    public static function reqaction($data) {
        if ($data->is_reviewed == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('purchaseinvoice/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Add/Edit</button></a>
            <?php
        } else {
            ?>
            <button type='button' class='btn btn-green btn-sm disabled'>Add/Edit</button>
            <?php
        }
        $checkpitem = Purchaseinvoiceitems::model()->countbyAttributes(array("invoice_id" => $data->id));
        if ($checkpitem > 0 && $data->is_reviewed == 0) {
            ?>
            <a href="#" onclick="authpurchasereview(<?php echo $data->id; ?>)"><button type='button' class='btn btn-warning btn-sm'>Review</button></a>
            <?php
        } else {
            ?>
            <button type='button' class='btn btn-warning btn-sm disabled'>Review</button>
            <?php
        }
        if ($data->is_added_to_stock == 0 && $data->is_reviewed == 1) {
            ?>
            <a href="#" onclick="addtostock(<?php echo $data->id; ?>)"><button type='button' class='btn btn-primary btn-sm'>Add to Invt.</button></a>
            <?php
        } else {
            ?>
            <button type='button' class='btn btn-primary btn-sm disabled'>Add to Invt.</button>
            <?php
        }
    }

}
