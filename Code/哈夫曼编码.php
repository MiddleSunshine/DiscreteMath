<?php

/**
 * Class Leaf
 * 记录下各种数据结构的类
 */
class Leaf{
    public $value;
    public $label;
    // 用来构建哈夫曼树
    public $leftLeaf;
    public $rightLeaf;
    // 用来保存最终的编码值
    public $code;
    /**
     * 模拟链表操作，跟树操作无关
     * @var $nextLeaf Leaf
     */
    public $nextLeaf;
    public function __construct($value='',$label='')
    {
        $this->value=$value;
        $this->label=$label;
    }
}

/**
 * 将字符串转化成上面的类
 * @param $string
 * @return Leaf
 */
function prepareLeaves($string){
    $length=strlen($string);
    $result=[];
    for ($i=0;$i<$length;$i++){
        $data=$string[$i];
        !isset($result[$data]) && $result[$data]=0;
        $result[$data]++;
    }
    $prepare=false;
    $leaf=new Leaf();
    foreach ($result as $word=>$count){
        $value=round($count/$length,2);
        if (!$prepare){
            $prepare=true;
            $leaf->value=$value;
            $leaf->label=$word;
            continue;
        }
        $newLeaf=new Leaf($value,$word);
        $leaf=sortLeaf($leaf,$newLeaf);
    }
    return $leaf;
}

/**
 * 构建哈夫曼树
 * @param $leaf Leaf
 */
function createHuffmanTree($leaf){
    if (!$leaf->nextLeaf->nextLeaf){
        $indexLeaf=new Leaf($leaf->value+$leaf->nextLeaf->value);
        $indexLeaf->leftLeaf=$leaf;
        $indexLeaf->rightLeaf=$leaf->nextLeaf;
        return $indexLeaf;
    }
    $newLeaf=new Leaf($leaf->value+$leaf->nextLeaf->value);
    $newLeaf->leftLeaf=$leaf;
    $newLeaf->rightLeaf=$leaf->nextLeaf;
    // 插入新的顶点并排序，保证最前面的2个一定是值最小的2个顶点
    $leaf=sortLeaf($leaf->nextLeaf->nextLeaf,$newLeaf);
    // 递归，并且之前用过的2个顶点不再继续使用
    return createHuffmanTree($leaf);
}

/**
 * 根据哈夫曼树在其中加上编码值
 * @param $leaf Leaf
 * @param string $preCode
 * @return bool
 */
function getWordCode($leaf,$preCode=''){
    if (!$leaf){
        return false;
    }
    if ($leaf->leftLeaf){
        $leaf->leftLeaf->code=$preCode."0";
        getWordCode($leaf->leftLeaf,$leaf->leftLeaf->code);
    }
    if ($leaf->rightLeaf){
        $leaf->rightLeaf->code=$preCode."1";
        getWordCode($leaf->rightLeaf,$leaf->rightLeaf->code);
    }
}

/**
 * 读取最终的编码值，保存在 result 数组中
 * @param $leaf Leaf
 * @param $result array
 * @return array
 */
function storeResult($leaf,&$result){
    if (!$leaf){
        return $result;
    }
    print $leaf->label.DIRECTORY_SEPARATOR.$leaf->value.DIRECTORY_SEPARATOR."LeftLabel:".@$leaf->leftLeaf->label.DIRECTORY_SEPARATOR.@$leaf->leftLeaf->value.DIRECTORY_SEPARATOR."RightLabel:".@$leaf->rightLeaf->label.DIRECTORY_SEPARATOR.@$leaf->rightLeaf->value.PHP_EOL;
    if ($leaf->label){
        $result[$leaf->label]=$leaf->code;
    }
    storeResult($leaf->leftLeaf,$result);
    storeResult($leaf->rightLeaf,$result);
}

/**
 * 按照从小到大排序叶子节点
 * @param $leaf Leaf
 * @param $newLeaf Leaf
 * @return Leaf
 */
function sortLeaf($leaf,$newLeaf):Leaf{
    if ($leaf->value>$newLeaf->value){
        $newLeaf->nextLeaf=$leaf;
        return $newLeaf;
    }
    $thisLeaf=$leaf->nextLeaf;
    $lastLeaf=$leaf;
    if (!$thisLeaf){
        $leaf->nextLeaf=$newLeaf;
        return $leaf;
    }
    while ($thisLeaf->nextLeaf && $thisLeaf->value<$newLeaf->value){
        $lastLeaf=$thisLeaf;
        $thisLeaf=$thisLeaf->nextLeaf;
    }
    $lastLeaf->nextLeaf=$newLeaf;
    $newLeaf->nextLeaf=$thisLeaf;
    return $leaf;
}

/**
 * 代码调用部分
 */

$string='To be,or not to be:that is the question';
$indexLeaf=prepareLeaves($string);
$indexLeaf=createHuffmanTree($indexLeaf);
getWordCode($indexLeaf);
$storeResult=[];
storeResult($indexLeaf,$storeResult);
print_r($storeResult);


