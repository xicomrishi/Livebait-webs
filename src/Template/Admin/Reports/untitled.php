<?php 
header('Content-disposition: filename="Reportbydriver('.date('Y-m-d').').csv"');
$headers = ['S.no','Name','Email','Phone','Total Orders','Total Amount'];
echo implode(',',$headers);
echo "\r\n";
$i = 1;
foreach($list as $list) {
echo $i.',';
echo $list['name'].',';
echo $list['email'].',';
echo $list['phone'].',';
echo $list['total_orders'].',';
echo $list['total_amount']."\r\n";
$i++;
 } ?>