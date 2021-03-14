<?php

function debug($string){
    $length=strlen($string);
    $result=[];
    for ($i=0;$i<$length;$i++){
        $data=$string[$i];
        !isset($result[$data]) && $result[$data]=0;
        $result[$data]++;
    }
    foreach ($result as $word=>$count){
        $result[$word]=round($count/$length,2);
    }
    $temp=0;
    foreach ($result as $word=>$show){
        $temp+=$show;
    }
    print $temp.PHP_EOL;
    return $result;
}

$string='To be,or not to be:that is the question';
$result=debug($string);
//print_r($result);