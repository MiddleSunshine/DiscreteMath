<?php

class Leaf{
    public $value;
    /**
     * @var Leaf|null
     */
    public $leftLeaf;
    /**
     * @var Leaf|null
     */
    public $rightLeaf;
    public function __construct($value)
    {
        $this->value=$value;
    }
}

function createBinarySearchTree($storeData){
    $root=new Leaf($storeData[0]);
    unset($storeData[0]);
    foreach($storeData as $value){
        compare($root,$value);
    }
    return $root;
}

/**
 * @param $leaf Leaf
 * @param $searchValue
 * @param bool $isStoreData
 * @return bool
 */
function searchValue($leaf,$searchValue,$isStoreData=true){
    if (!$leaf){
        return false;
    }
    if ($leaf->value==$searchValue){
        return true;
    }
    if ($isStoreData){
        compare($leaf,$searchValue);
        return true;
    }
    if ($leaf->value>=$searchValue){
        return searchValue($leaf->leftLeaf,$searchValue,$isStoreData);
    }else{
        return searchValue($leaf->rightLeaf,$searchValue,$isStoreData);
    }
}

/**
 * @param $leaf Leaf
 * @param $value
 * @return bool
 */
function compare(&$leaf,$value){
    if($leaf->value>=$value){
        if($leaf->leftLeaf){
            compare($leaf->leftLeaf,$value);
            return true;
        }else{
            $newLeaf=new Leaf($value);
            $leaf->leftLeaf=$newLeaf;
            return true;
        }
    }
    if($leaf->rightLeaf){
        compare($leaf->rightLeaf,$value);
        return true;
    }else{
        $newLeaf=new Leaf($value);
        $leaf->rightLeaf=$newLeaf;
        return true;
    }
}

/**
 * @param $leaf Leaf
 * @return bool
 */
function showResult($leaf){
    if (!$leaf){
        return true;
    }
    print "当前节点值为：".$leaf->value.PHP_EOL;
    $leaf->leftLeaf && (print "左子值为：".$leaf->leftLeaf->value.PHP_EOL);
    $leaf->rightLeaf && (print "右子值为：".$leaf->rightLeaf->value.PHP_EOL);
    showResult($leaf->leftLeaf);
    showResult($leaf->rightLeaf);
}
// 开始直接编程
$storeData=[50,30,20,67,80,90,49,32];
$root=createBinarySearchTree($storeData);
showResult($root);
// 尝试搜索一个存在的值
print "67的".(searchValue($root,67,false)?"值存在":"值不存在");
print PHP_EOL;
// 尝试搜索一个不存在的值
print "100的".(searchValue($root,100,false)?"值存在":"值不存在");
print PHP_EOL;
// 再搜索一次
print "100的".(searchValue($root,100)?"值存在":"值不存在");
print PHP_EOL;
showResult($root);