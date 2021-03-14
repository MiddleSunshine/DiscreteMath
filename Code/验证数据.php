<?php

function createDefaultArray($count){
    $indexes=range('A','Z');
    $indexes=array_slice($indexes,0,$count);
    $returnData=[];
    $count=pow(2,$count);
    for ($line=0;$line<$count;$line++){
        $returnData[$line]=[];
        $int=decbin($line);
        $int=strrev($int);
        foreach ($indexes as $key=>$index){
            $returnData[$line][$index]=$int[$key] ?? 0;
        }
    }
    return $returnData;
}

function F($map){
    $returnData=[];
    foreach ($map as $setting){
        $result=$setting['A']*$setting['B']*$setting['C']+$setting['A']*neg($setting['B'])*$setting['C']+neg($setting['A'])*$setting['B']*$setting['C']+neg($setting['A'])*$setting['B']*$setting['C']+neg($setting['A'])*neg($setting['B'])*neg($setting['C']);
        $result<0 && $result=0;
        $result>1 && $result=1;
        $returnData[implode(",",$setting)]=$result;
    }
    return $returnData;
}

print_r(F(createDefaultArray(3)));

function neg($return){
    switch ($return){
        case 1:
            return 0;
        default:
            return 1;
    }
}


