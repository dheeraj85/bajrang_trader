<?php

/**
 * This is the model class for table "internal_indent_master".
 *
 * The followings are the available columns in table 'internal_indent_master':
 * @property integer $id
 * @property string $sync_id
 * @property string $indent_date
 * @property string $indent_type
 * @property string $purchase_type
 * @property integer $created_by
 * @property string $created_user_role
 * @property string $supply_type
 * @property string $invoice_id
 * @property string $invoice_date
 * @property integer $issued_by
 * @property string $discount
 * @property string $remark
 * @property integer $is_indenting_done
 * @property integer $is_order_done
 * @property integer $is_sync
 * @property string $sync_date
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 */
class Indentmaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'internal_indent_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // array('issued_by', 'required'),
            array('created_by, issued_by, is_indenting_done, is_order_done, is_sync', 'numerical', 'integerOnly' => true),
            array('sync_id', 'length', 'max' => 20),
            array('indent_type, supply_type', 'length', 'max' => 7),
            array('purchase_type', 'length', 'max' => 11),
            array('created_user_role', 'length', 'max' => 30),
            array('invoice_id', 'length', 'max' => 50),
            array('discount', 'length', 'max' => 12),
            array('remark', 'length', 'max' => 255),
            array('indent_date, invoice_date, sync_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sync_id, indent_date, indent_type, purchase_type, created_by, created_user_role, supply_type, invoice_id, invoice_date, issued_by, discount, remark, is_indenting_done, is_order_done, is_sync, sync_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'issuedby' => array(self::BELONGS_TO, 'Users', 'issued_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Indent No',
            'sync_id' => 'Sync',
            'indent_date' => 'Indent Date',
            'indent_type' => 'Indent Type',
            'purchase_type' => 'Purchase Type',
            'created_by' => 'Created By',
            'created_user_role' => 'Created User Role',
            'supply_type' => 'Supply Type',
            'invoice_id' => 'Invoice No',
            'invoice_date' => 'Invoice Date',
            'issued_by' => 'Issued By',
            'discount' => 'Discount',
            'remark' => 'Remark',
            'is_indenting_done' => 'Indenting Status',
            'is_order_done' => 'Order Status',
            'is_sync' => 'Is Sync',
            'sync_date' => 'Sync Date',
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

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('sync_id', $this->sync_id, true);
        $criteria->compare('indent_date', $this->indent_date, true);
        $criteria->compare('indent_type', $this->indent_type, true);
        $criteria->compare('purchase_type', $this->purchase_type, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('supply_type', $this->supply_type, true);
        $criteria->compare('invoice_id', $this->invoice_id, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('issued_by', $this->issued_by);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('is_indenting_done', $this->is_indenting_done);
        $criteria->compare('is_order_done', $this->is_order_done);
        $criteria->compare('is_sync', $this->is_sync);
        $criteria->compare('sync_date', $this->sync_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchOutlet() {

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('sync_id', $this->sync_id, true);
        $criteria->compare('indent_date', $this->indent_date, true);
        $criteria->compare('indent_type', $this->indent_type, true);
        $criteria->compare('purchase_type', $this->purchase_type, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('supply_type', $this->supply_type, true);
        $criteria->compare('invoice_id', $this->invoice_id, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('issued_by', $this->issued_by);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('is_indenting_done', $this->is_indenting_done);
        $criteria->compare('is_order_done', $this->is_order_done);
        $criteria->compare('is_sync', $this->is_sync);
        $criteria->compare('sync_date', $this->sync_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchGpu() {

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('sync_id', $this->sync_id, true);
        $criteria->compare('indent_date', $this->indent_date, true);
        $criteria->compare('indent_type', $this->indent_type, true);
        $criteria->compare('purchase_type', $this->purchase_type, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('supply_type', $this->supply_type, true);
        $criteria->compare('invoice_id', $this->invoice_id, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('issued_by', $this->issued_by);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('is_indenting_done', $this->is_indenting_done);
        $criteria->compare('is_order_done', $this->is_order_done);
        $criteria->compare('is_sync', $this->is_sync);
        $criteria->compare('sync_date', $this->sync_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchCDS() {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        //  $criteria->compare('created_by',Yii::app()->user->id);
        $criteria->compare('id', $this->id, true);
        $criteria->compare('sync_id', $this->sync_id, true);
        $criteria->compare('indent_date', $this->indent_date, true);
        $criteria->compare('indent_type', $this->indent_type, true);

        $criteria->compare('purchase_type', 'Company');
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('supply_type', $this->supply_type, true);
        $criteria->compare('invoice_id', $this->invoice_id, true);
        $criteria->compare('invoice_date', $this->invoice_date, true);
        $criteria->compare('issued_by', $this->issued_by);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('is_indenting_done', 2);
        $criteria->compare('is_order_done', $this->is_order_done);
        $criteria->compare('is_sync', $this->is_sync);
        $criteria->compare('sync_date', $this->sync_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Indentmaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function reqaction($data) {
        if ($data->is_indenting_done == 0) {
            ?>
            <label class="badge bg-gray">Indenting</label>
            <?php
        } else if ($data->is_indenting_done == 1) {
            ?>
            <label class="badge bg-red">Review</label>
            <?php
        } else {
            ?>
            <label class="badge bg-green">Finished</label>
            <?php
        }
    }

    public static function orderStatus($data) {
        if ($data->is_order_done == 0) {
            ?>
            <label class="badge bg-gray">Pending</label>
            <?php
        } else if ($data->is_order_done == 1) {
            ?>
            <label class="badge bg-red">Review</label>
            <?php
        } else {
            ?>
            <label class="badge bg-green">Finished</label>
            <?php
        }
    }

    public static function actiongpu($data) {
        if ($data->is_indenting_done == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('indentmaster/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Indenting</button></a>
            <?php
        } else if ($data->is_indenting_done == 1) {
            ?>
            <a href="#" onclick="authreview('<?php echo $data->sync_id; ?>', '<?php echo Yii::app()->createUrl('indentmaster/review', array('sync_id' => $data->sync_id)); ?>')"><button type='button' class='btn btn-warning btn-sm'>Review</button></a>
            <?php
        } else {
            ?>
            <button type='button' class='btn btn-primary btn-sm disabled'>Finished</button>
            <a href="<?php echo Yii::app()->createUrl('indentmaster/printindent', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>View Indent</button></a>
            <?php
        }
        if ($data->is_order_done == 2) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('indentmaster/stockaccept', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>Process Dispatch Order</button></a>
            <a href="<?php echo Yii::app()->createUrl('indentitemsissue/stockissue', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>Issue Item for Production</button></a>
            <?php
        }
    }

    public static function actionoutlet($data) {
        if ($data->is_indenting_done == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('outletindent/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Indenting</button></a>
            <?php
        } else if ($data->is_indenting_done == 1) {
            ?>
            <a href="#" onclick="authreview('<?php echo $data->sync_id; ?>', '<?php echo Yii::app()->createUrl('outletindent/review', array('sync_id' => $data->sync_id)); ?>')"><button type='button' class='btn btn-warning btn-sm'>Review</button></a>
            <?php
        } else {
            ?>
            <button type='button' class='btn btn-primary btn-sm disabled'>Finished</button>
            <a href="<?php echo Yii::app()->createUrl('outletindent/printindent', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>View Indent</button></a>
            <?php
        }
        if ($data->is_order_done == 2) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('outletindent/stockaccept', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>Accept Order</button></a>
            <?php
        }
    }

    public static function actionCDS($data) {
        if ($data->is_order_done == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('supply/indentitems',array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-warning btn-sm'>View & Supply</button></a>
            <?php
        } else if ($data->is_order_done == 1) {
            ?>
            <a href="#" onclick="authreview('<?php echo $data->sync_id; ?>', '<?php echo Yii::app()->createUrl('supply/reviewindentitems', array('sync_id' => $data->sync_id)); ?>')"><button type='button' class='btn btn-warning btn-sm'>Review</button></a>
            <?php
        } else {
            ?>            
             <a href="#" onclick="authreview('<?php echo $data->sync_id; ?>', '<?php echo Yii::app()->createUrl('supply/reviewindentitems', array('sync_id' => $data->sync_id)); ?>')"><button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
            <a href="<?php echo Yii::app()->createUrl('supply/viewprint', array('sync_id' => $data->sync_id)); ?>"><button type='button' class='btn btn-green btn-sm'>Invoice/Challan</button></a>
            <?php
        }
    }

}