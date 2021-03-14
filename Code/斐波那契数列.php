<?php

function getNumber($month){
    if($month==1){
        return [1=>1,2=>0];
    }
    $lastMonth=getNumber($month-1);
    return [1=>$lastMonth[2],2=>($lastMonth[2]+$lastMonth[1])];
}

$result=getNumber(6);

print_r($result);