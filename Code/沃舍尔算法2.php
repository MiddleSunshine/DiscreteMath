<?php

// 沃舍尔算法
function WasherAlgorithm($map){
    $count=count($map);
    for($n=0;$n<$count;$n++){
        addNode($map,$n);
    }   
    return $map; 
}

// 辅助函数
function addNode(&$map,$n){
    $returnColumnNumber=$returnLineNumber=[];
    foreach($map as $lineNumber=>$line){
        foreach($line as $columnNumber=>$data){
            if($lineNumber==$n && $data){
                $returnColumnNumber[]=$columnNumber;
            }
            if($columnNumber==$n && $data){
                $returnLineNumber[]=$lineNumber;
            }
        }
    }
    foreach($returnLineNumber as $lineNumber){
        foreach($returnColumnNumber as $columnNumber){
            $map[$lineNumber][$columnNumber]=1;
        }
    }
}

$map=[
    0=>[1,0,1],
    1=>[0,1,0],
    2=>[1,1,0]
];

$newMap=WasherAlgorithm($map);

print_r($newMap);
