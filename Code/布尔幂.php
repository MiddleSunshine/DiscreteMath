<?php
// 布尔积计算代码
function booleanProduct($data1,$data2){
    $returnData=[];
    $columnLength=count($data2[0]);
    $heightLength=count($data1);
    for($height=0;$height<$heightLength;$height++){
        for($column=0;$column<$columnLength;$column++){
            $data=0;
            for($calculate=0;$calculate<$columnLength;$calculate++){
                $data=$data || ($data1[$height][$calculate] && $data2[$calculate][$column]);
            }
            !$data && $data=0;
            $returnData[$height][$column]=$data;
        }
    }
    return $returnData;   
}
// 布尔幂的计算代码
function booleanPower($data,$n){
    if($n==1){
        return $data;
    }
    return booleanPower(booleanProduct($data,$data),$n-1);
}

$data=[
    0=>[1,0,1],
    1=>[0,1,0],
    2=>[1,1,0]
];

print_r(booleanPower($data,3));
