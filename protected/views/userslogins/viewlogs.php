<?php
/* @var $this UsersController */
/* @var $model Users */


$this->breadcrumbs=array(
    'Home'=>array('site/dashboard'),
    'View Application Logs',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Users', 'url' => array('create')),
);

?>
<div class='form-css'>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="panel-title">View Application Logs</h3>
    </div>
    <div class="panel-body">
   <div style="overflow-y:scroll;height:400px;">     
       <?php
       $lines = array();
       foreach (file('protected/runtime/application_site.log') as $line) {
           $parts = explode('in D:\xampp\htdocs\toc\index.php (9)', $line);
           $lines[] = array(
               'details' => $parts[0]
               );
       }
       //printf('<table><tr><td>%s</td></tr></table>', print_r($lines, true));
       echo "<table class='table table-bordered' width='100%'>";
       echo "<tr><th>Details</th></tr>";
       //sort($lines,  SORT_STRING | SORT_FLAG_CASE);
       foreach($lines as $k){
           echo "<tr>";
           echo "<td style='font-size:14px;'>".$k['details']."</td>";
           echo "</tr>";
       }
       echo "</table>";
       ?>
    </div>
    </div>
</div>
</div>