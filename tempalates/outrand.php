<?
$x=0;
foreach($outrand as $value) {
 $date[]=$value;
 // echo $x+=1;
}
$date1 = json_encode($date, JSON_UNESCAPED_UNICODE);
echo $date1;


