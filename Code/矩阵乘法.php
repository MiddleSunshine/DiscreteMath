<?php
/**
 * 矩阵乘法
 */
function arrayMultiplication($data1,$data2){
    $columnLength=count($data1[0]);
    $heightLength=count($data2);
    $returnData=[];
    for($height=0;$height<$heightLength;$height++){
        $returnData[$height]=[];
        for($column=0;$column<$columnLength;$column++){
            $length=count($data1[$height]);
            $data=0;
            for($index=0;$index<$length;$index++){
                $data+=$data1[$height][$index]*$data2[$index][$column];
            }
            $returnData[$height][$column]=$data;
        }
    }
    return $returnData;
}
/**
 * 矩阵乘法的幂阶
 */
function arrayMultiplicationPower($map,$n){
    $temp=$map;
    for($i=1;$i<$n;$i++){
        $temp=arrayMultiplication($temp,$map);
    }
    return $temp;
}

$map=[
    [0,1,1,0],
    [1,0,0,1],
    [1,0,0,1],
    [0,1,1,0]
];

$data=arrayMultiplicationPower($map,4);

print_r($data);