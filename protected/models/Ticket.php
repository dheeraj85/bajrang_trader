<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $id
 * @property string $ticket_type
 * @property string $subject
 * @property string $description
 * @property integer $submitted_by
 * @property string $submit_date
 * @property integer $assigned_to
 * @property string $assigned_date
 * @property string $status
 * @property string $close_reason
 *
 * The followings are the available model relations:
 * @property Users $submittedBy
 * @property TicketReply[] $ticketReplies
 */
class Ticket extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ticket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ticket_type, subject, description, submit_date', 'required'),
            array('submitted_by, assigned_to', 'numerical', 'integerOnly' => true),
            array('ticket_type', 'length', 'max' => 15),
            array('subject', 'length', 'max' => 250),
            array('status', 'length', 'max' => 8),
            array('close_reason', 'length', 'max' => 255),
            array('description, submit_date, assigned_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ticket_type, subject, description, submitted_by, submit_date, assigned_to, assigned_date, status, close_reason', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'submittedBy' => array(self::BELONGS_TO, 'Users', 'submitted_by'),
            'ticketReplies' => array(self::HAS_MANY, 'TicketReply', 'ticket_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'ticket_type' => 'Ticket Type',
            'subject' => 'Subject',
            'description' => 'Description',
            'submitted_by' => 'Submitted By',
            'submit_date' => 'Submit Date',
            'assigned_to' => 'Assigned To',
            'assigned_date' => 'Assigned Date',
            'status' => 'Status',
            'close_reason' => 'Close Reason',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchadmin() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ticket_type', $this->ticket_type, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('submitted_by', $this->submitted_by);
        $criteria->compare('submit_date', $this->submit_date, true);
        $criteria->compare('assigned_to', $this->assigned_to);
        $criteria->compare('assigned_date', $this->assigned_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('close_reason', $this->close_reason, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchtickets() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ticket_type', $this->ticket_type, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('submitted_by', $this->submitted_by);
        $criteria->compare('submit_date', $this->submit_date, true);
        $criteria->compare('assigned_to', Yii::app()->user->id);
        $criteria->compare('assigned_date', $this->assigned_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('close_reason', $this->close_reason, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ticket_type', $this->ticket_type, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('submitted_by', Yii::app()->user->id);
        $criteria->compare('submit_date', $this->submit_date, true);
        $criteria->compare('assigned_to', $this->assigned_to);
        $criteria->compare('assigned_date', $this->assigned_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('close_reason', $this->close_reason, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function viewticket($data) {
        if (Yii::app()->user->isTicketManager() == 'ticket_mgr') {
            ?>
            <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('site/ticketmanagerview', array('id' => $data->id)); ?>"><i class="fa fa-eye"></i>  View Ticket</a>
            <?php
        } else {
            ?>
            <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('ticket/view', array('id' => $data->id)); ?>"><i class="fa fa-eye"></i>  View Ticket</a>
            <?php
        }
    }

    public static function tickets($data) {
            ?>
            <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('ticket/assignedview', array('id' => $data->id)); ?>"><i class="fa fa-eye"></i>  View Ticket</a>
            <?php
    }

    public static function tickettype($val) {
        if(!empty($val)){
        return Tickettype::model()->findByPk($val)->name;
        }
    }

    public static function user($val) {
        if(!empty($val)){
        return Users::model()->findByPk($val)->name;
        }
    }
    
    public static function status($val) {
        if($val=='pending'){
            echo '<button type="button" class="btn btn-warning">Pending</button>';   
        }else if($val=='assigned'){
            echo '<button type="button" class="btn btn-success">Assigned</button>';   
        }else if($val=='close'){
            echo '<button type="button" class="btn btn-danger">Closed</button>';   
        }
    }

}
