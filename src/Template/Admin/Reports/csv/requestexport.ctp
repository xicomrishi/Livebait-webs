<?php 
header('Content-disposition: filename="CallsReport('.date('Y-m-d').').csv"');
$headers = ['S.no','Request id','From','To','Request Status','Date'];
echo implode(',',$headers);
echo "\r\n";
$i = 1;
foreach($requests as $list) {
echo $i.',';
echo $list->id.',';
echo $list->users_from->name.',';
echo $list->users_to->name.',';
if($list->status == REQUEST_STATUS_ACCEPT){
    echo "Accept";
}
elseif($list->status == REQUEST_STATUS_REJECT){
    echo "Reject";
}
elseif($list->status == REQUEST_STATUS_PENDING){
    echo "Pending";
}
else{
    echo "Not Interseted";
}
echo ",";
echo $list['created']->nice()."\r\n";

$i++;
 } ?>