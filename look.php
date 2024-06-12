<?php
for(;;){
usleep(200000);
$map=json_decode(file_get_contents("map.json"),true);
$txt="##########################################\n";
foreach($map as $lines){
    foreach($lines as $t){
        $txt.=$t;
    }
    $txt.="\n";
}
echo $txt;
}