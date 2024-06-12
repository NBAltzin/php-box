<?php
$map=json_decode(file_get_contents("map.json"),true);
$local=json_decode(file_get_contents("local.json"),true);
$find=0;
$stlie=null;
$sthang=null;
foreach($map as $rownum => $rowline){
    foreach($rowline as $colnum => $m){
        if($m=="你"){
            $sthang=$rownum;
            $stlie=$colnum;
            $find=1;
            break 2;
        }
    } 
}
if($find==0){
    echo"错误:没有起点<br/>";
    exit;
}
$local=[$sthang,$stlie];
$json=json_encode($local);
file_put_contents("local.json",$json);