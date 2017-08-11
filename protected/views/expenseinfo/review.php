<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Expense Head Reconciliation List'=>array('admin'),
    'Review Expense Head Reconciliation'
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Review Expense Head Reconciliation No: <?php echo $model->id;?></h3>
                </div>
                <div class="panel-body">
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Expense Head</th>                                
                                <th>Record - Voucher No</th>
                                <th>Voucher Amount</th>
                                <th>Voucher Date</th>            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="15%"><?php echo $model->name; ?></td> 
                                <td width="15%"><?php echo $model->voucher_no; ?></td>
                                <td width="15%"><?php echo $model->amount; ?></td>
                                <td width="15%"><?php echo $model->voucher_date; ?></td>
                            </tr>    
                        </tbody>
                    </table>
                    <?php if(empty($model->updated_by)) { ?>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'enableAjaxValidation' => false,
                        'action' => $this->createUrl('expenseinfo/natureupdate'),
                    ));
                    ?>
                    <input type="hidden" id="id" name="id" value="<?php echo $model->id?>"/>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <label>Reg No. / Bill No.</label><br/>
                           <?php echo $form->textField($model, 'reg_no', array('maxlength' => 50)); ?>
                        </div>
                         <div class="col-lg-4 col-sm-4 col-xs-12">
                            <label>Expense Nature</label><br/>
                           <?php echo $form->dropDownList($model, 'expense_nature_id', CHtml::listData(Expensenature::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>  
                        </div>
                   </div>  <br/>   
                    <div class="row">
                     <div class='col-md-12'>
                            <?php echo $form->textAreaControlGroup($model, 'particular', array('maxlength' => 50)); ?>         
                      </div>   
                    </div> 
                    <br/>                  
                        <div class='row'>
                            <div class='col-md-6'>
                               <input type="submit" name="generateorder" value="Save" class="btn btn-primary" />         
                            </div>
                        </div>
                    <?php $this->endWidget(); ?>
               <?php } ?>
                </div>
            </div>     
        </div>  
    </div> 
</div>