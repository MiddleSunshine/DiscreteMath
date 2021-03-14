<?php

/**
 * n皇后问题的核心代码
 * @param $queens array 存储每次递归后的结果
 * @param $mapLength int n的大小
 * @param int $rowIndex 本地递归的行数
 * @param int $offset 回溯时使用，用来跳过前一次设置的值
 * @return false
 */
function setQueen(&$queens,$mapLength,$rowIndex=0,$offset=0){
    // 设置递归停止条件
    if ($rowIndex<0 || $rowIndex>=$mapLength){
        return false;
    }
    // 获取下一个皇后的下标
    $columnIndex=getAvaliableNode($queens,$mapLength,$offset);
    // 递归到最后一行时，发现没有结果就停止，防止陷入死循环
    if (($rowIndex+1)==$mapLength && is_bool($columnIndex)){
        return false;
    }
    // 正常获取到皇后的位置，则继续下一次递归
    if (!is_bool($columnIndex)){
        $queens[$rowIndex]=$columnIndex;
        setQueen($queens,$mapLength,$rowIndex+1);
    }else{
        // 没有获取到正确的皇后位置，回溯 & 重新开始获取值
        array_pop($queens);
        setQueen($queens,$mapLength,$rowIndex-1,$offset+1);
    }
}

/**
 * 计算下一个可以使用的空格下标
 * @param $queens array 已设定的点
 * @param $mapLength int n的值
 * @param int $offset 回溯时，跳过之前采用的点
 * @return false|int
 */
function getAvaliableNode($queens,$mapLength,$offset=0){
    $nextRow=count($queens);
    $unavaliableColumnNumber=[];
    foreach ($queens as $rowNumber=>$columnNumber){
        // 计算该列不能使用
        $unavaliableColumnNumber[$columnNumber]=1;
        // 对角线不能使用
        $unavaliableColumnNumber[$columnNumber+($nextRow-$rowNumber)]=1;
        $unavaliableColumnNumber[$columnNumber-($nextRow-$rowNumber)]=1;
    }
    for ($i=0;$i<$mapLength;$i++){
        if (!isset($unavaliableColumnNumber[$i])){
            $offset--;
            if ($offset<0){
                return $i;
            }
        }
    }
    return false;
}

$queens=[];
setQueen($queens,5);
print_r($queens);