<?php

function withoutDoubleZero($length){
    if($length==2){
        return ['01','11','10'];
    }
    $lastword=withoutDoubleZero($length-1);
    $returnData=[];
    foreach($lastword as $word){
        if(substr($word,-1,1)=='0'){
            $returnData[]=$word."1";
        }else{
            $returnData[]=$word."0";
            $returnData[]=$word."1";
        }
    }
    return $returnData;
}

print_r(withoutDoubleZero(5));