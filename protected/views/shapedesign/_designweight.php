<div class="row">
    <input type="hidden" id="did" name="did" value="<?php echo $did; ?>" >
    <?php
    if (!empty($weight)) {
        foreach ($weight as $value) {
            if (!empty($model)) {
                $cake_weight = Designweights::model()->findByAttributes(array('design_id' => $did,'weight_for_design' => $value->id));
                ?>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                    <div class="checkbox">
                        <label style="font-size: 20px;">
                            <input type="checkbox" value="<?php echo $value->id; ?>" name="weight[]" id="weight<?php echo $value->id; ?>" <?php if ($cake_weight->weight_for_design==$value->id) {
                echo 'checked';
            } else {
             echo '';   
            } ?>>
                            <span class="text"><?php echo $value->weight; ?></span>
                        </label>
                    </div>  
                </div>
        <?php } else {
            ?>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                    <div class="checkbox">
                        <label style="font-size: 20px;">
                            <input type="checkbox" value="<?php echo $value->id; ?>" name="weight[]" id="weight<?php echo $value->id; ?>" checked>
                            <span class="text"><?php echo $value->weight; ?></span>
                        </label>
                    </div>  
                </div>
            <?php
        }
    }
}
?>   
</div>