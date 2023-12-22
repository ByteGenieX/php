<?php
require_once('database.php');

$obj = new myQuery();
$conditionArr=array('name'=>'Rakesh','age'=>10);
$result = $obj->getData('curd','age',$conditionArr,'age','','1');

$resultInsert = $obj->inserttData('curd',$conditionArr);
echo "<pre>";
print_r ($resultInsert);

$resultdelete = $obj->deleteData('curd',$conditionArr);
$resultdelete = $obj->updateData('curd',$conditionArr,'id',3);
?>
