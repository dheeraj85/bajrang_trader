<?php

/**
 * This is the model class for table "shape_design".
 *
 * The followings are the available columns in table 'shape_design':
 * @property integer $id
 * @property integer $shape_id
 * @property string $design_name
 * @property string $design_img
 * @property string $design_description
 * @property string $design_added_by
 * @property integer $added_by_id
 *
 * The followings are the available model relations:
 * @property CakeOrder[] $cakeOrders
 * @property DesignWeights[] $designWeights
 * @property CakeShape $shape
 */
class Shapedesign extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Shapedesign the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shape_design';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('design_name,design_img', 'required'),
            array('design_name', 'unique', 'message' => 'Design Name should be unique.'),
            array('shape_id, added_by_id', 'numerical', 'integerOnly' => true),
            array('design_name', 'length', 'max' => 150),
            array('design_img', 'length', 'max' => 50),
            array('design_description', 'length', 'max' => 250),
            array('design_added_by', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, shape_id, design_name, design_img, design_description, design_added_by, added_by_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cakeOrders' => array(self::HAS_MANY, 'CakeOrder', 'design_id'),
            'designWeights' => array(self::HAS_MANY, 'DesignWeights', 'design_id'),
            'shape' => array(self::BELONGS_TO, 'CakeShape', 'shape_id'),
            'design_complexity' => array(self::BELONGS_TO, 'Designcomplexity', 'design_complexity_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'shape_id' => 'Shape',
            'design_name' => 'Design Name',
            'design_img' => 'Design Img',
            'design_description' => 'Design Description',
            'design_added_by' => 'Design Added By',
            'added_by_id' => 'Added By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('shape_id', $this->shape_id);
        $criteria->compare('design_name', $this->design_name, true);
        $criteria->compare('design_img', $this->design_img, true);
        $criteria->compare('design_description', $this->design_description, true);
        $criteria->compare('design_added_by', $this->design_added_by, true);
        $criteria->compare('added_by_id', $this->added_by_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function Getimg($data) {
        ?>
        <img src="<?php echo Yii::app()->request->baseUrl . '/uploads/Shapeimage/design/' . $data->design_img ?>" alt="<?php echo $data->design_img ?>" width="50px" height="50px">
        <?php
    }

    public static function Shapedesignweight($data) {
        ?>
        <a class="btn btn-success" href="#<?php // echo Yii::app()->createUrl('designweights/create', array('did' => $data->id));     ?>" onclick="Getdesignweight(<?php echo $data->id; ?>)">Design Weight</a>
        
<div id="myItemModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Available Shape Design Weights</h4>
            </div>
            <div class="modal-body">
                <form id="design_form">
                    <div id="show_design"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="save" onclick="Savedesignweight()"><i class="glyphicon glyphicon-save"></i> Submit & Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function Savedesignweight() {
        var dataset = $('#design_form').serialize();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('shapedesign/savedesignweight'); ?>',
            data: dataset,
            success: function(response) {
                $("#myItemModal").modal('hide');
            }
        });
    }
    function Getdesignweight(id) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('shapedesign/designweight'); ?>',
            data: {'id': id},
            success: function(response) {
                $("#show_design").html(response);
                $("#myItemModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>
    <?php
    }

}