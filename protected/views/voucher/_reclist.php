<?php
echo $receiver_id;
if ($pay_rec_type == "employee") {
    echo '<option value="">--Select--</option>';  
    foreach(Employee::model()->findAll() as $emp){
     if($receiver_id==$emp->id){
         echo '<option value="'.$emp->id.'" selected>'.$emp->empname.'</option>';  
     }else{
         echo '<option value="'.$emp->id.'">'.$emp->empname.'</option>';  
     } 
    }    
} else if ($pay_rec_type == "vendor") {
    echo '<option value="">--Select--</option>';  
    foreach(Vendor::model()->findAll() as $vend){
     if($receiver_id==$vend->id){   
     echo '<option value="'.$vend->id.'" selected>'.$vend->name.'&nbsp;('.$vend->firm_name.')</option>';      
     }else{
     echo '<option value="'.$vend->id.'">'.$vend->name.'&nbsp;('.$vend->firm_name.')</option>';          
     }
    }  
} else if ($pay_rec_type == "expense_head") {
    echo '<option value="">--Select--</option>';  
    foreach(Expenseheads::model()->findAll() as $exp){
     if($receiver_id==$exp->id){      
     echo '<option value="'.$exp->id.'" selected>'.$exp->name.'</option>';     
     }else{
     echo '<option value="'.$exp->id.'">'.$exp->name.'</option>';         
     }
    }
} 
?>