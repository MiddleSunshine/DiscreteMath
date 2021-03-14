<?php

class Leaf{
    public $leftLeaf;
    public $rightLeaf;
    public $label;
    public function __construct($label)
    {
        $this->label=$label;
    }
}

/**
 * 前序遍历
 * @param $leaf Leaf
 * @param string $result
 * @return bool
 */
function VLR($leaf,&$result){
    if (!$leaf){
        return false;
    }
    $result.=$leaf->label;
    VLR($leaf->leftLeaf,$result);
    VLR($leaf->rightLeaf,$result);
}

/**
 * 中序遍历
 * @param $leaf Leaf
 * @param $result string
 * @return bool
 */
function LDR($leaf,&$result){
    if (!$leaf){
        return false;
    }
    if ($leaf->leftLeaf){
        LDR($leaf->leftLeaf,$result);
    }
    $result.=$leaf->label;
    LDR($leaf->rightLeaf,$result);
}

/**
 * 后续遍历
 * @param $leaf Leaf
 * @param $result string
 * @return bool
 */
function LRD($leaf,&$result){
    if (!$leaf){
        return false;
    }
    LRD($leaf->leftLeaf,$result);
    LRD($leaf->rightLeaf,$result);
    $result.=$leaf->label;
    return false;
}

// 相关记法部分

/**
 * 解析前缀记法
 * @param $string
 * @return mixed
 */
function ParseStringVLR($string){
    global $supportOperation;
    $stringIndex=strlen($string);
    $string=str_split($string);
    while ($stringIndex>0){
        $stringIndex--;
        if (in_array($string[$stringIndex],$supportOperation)){
            $string[$stringIndex]=calculate($string[$stringIndex],$string[$stringIndex+1],$string[$stringIndex+2]);
            unset($string[$stringIndex+1]);
            unset($string[$stringIndex+2]);
            $string=array_values($string);
            $stringIndex=count($string);
        }
    }
    return $string[0];
}

/**
 * 解析后缀记法
 * @param $string
 * @return mixed
 */
function ParseStringLRD($string){
    global $supportOperation;
    $length=strlen($string)-1;
    $string=str_split($string);
    $stringIndex=-1;
    while ($stringIndex<$length){
        $stringIndex++;
        if (in_array($string[$stringIndex],$supportOperation)){
            $string[$stringIndex]=calculate($string[$stringIndex],$string[$stringIndex-2],$string[$stringIndex-1]);
            unset($string[$stringIndex-1]);
            unset($string[$stringIndex-2]);
            $string=array_values($string);
            $length=count($string)-1;
            $stringIndex=0;
        }
    }
    return $string[0];
}

/**
 * 解析中缀记法
 * @param $string
 * @return mixed
 */
function ParseStringLDR($string){
    global $supportOperation;
    $length=strlen($string)-1;
    $string=str_split($string);
    $stringIndex=-1;
    while ($stringIndex<$length){
        $stringIndex++;
        if (in_array($string[$stringIndex],$supportOperation)){
            $string[$stringIndex]=calculate($string[$stringIndex],$string[$stringIndex-1],$string[$stringIndex+1]);
            unset($string[$stringIndex-1]);
            unset($string[$stringIndex+1]);
            $string=array_values($string);
            $length=count($string)-1;
            $stringIndex=0;
        }
    }
    return $string[0];
}

$supportOperation=['+','-','*','/'];
function calculate($operation,$data1,$data2){
    $result=0;
    switch ($operation){
        case "+":
            $result=$data1+$data2;
            break;
        case "-":
            $result=$data1-$data2;
            break;
        case "*":
            $result=$data1*$data2;
            break;
        case "/":
            if ($data2!=0){
                $result=round($data1/$data2,2);
            }
            break;
        default:
            $result=0;
    }
    return $result;
}