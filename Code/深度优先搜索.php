<?php
class Leaf{
    public $label;
    public $nextLeave=[];
    public function __construct($label)
    {
        $this->label=$label;
    }
}

class Side{
    public $leftNodeLabel;
    public $rightNodeLabel;
    public function __construct($leftNodeLabel,$rightNodeLabel)
    {
        $this->leftNodeLabel=$leftNodeLabel;
        $this->rightNodeLabel=$rightNodeLabel;
    }
}

function createMap(){
    $map=[];
    $map[]=new Side('a','c');
    $map[]=new Side('b','c');
    $map[]=new Side('c','e');
    $map[]=new Side('e','d');
    $map[]=new Side('e','f');
    $map[]=new Side('d','f');
    $map[]=new Side('f','g');
    $map[]=new Side('g','h');
    $map[]=new Side('f','h');
    $map[]=new Side('h','i');
    $map[]=new Side('h','k');
    $map[]=new Side('h','j');
    return $map;
}

/**
 * @param $map array
 * @param $leaf Leaf
 * @param $leaveArray array
 */
function DFS($map,$leaf,&$leaveArray){
    foreach ($map as $side){
        /**
         * @var $side Side
         */
        if ($side->rightNodeLabel==$leaf->label && !isset($leaveArray[$side->leftNodeLabel])){
            $newLeaf=new Leaf($side->leftNodeLabel);
            $leaf->nextLeave[]=$newLeaf;
            $leaveArray[$side->leftNodeLabel]=1;
            DFS($map,$newLeaf,$leaveArray);
        }
        if ($side->leftNodeLabel==$leaf->label && !isset($leaveArray[$side->rightNodeLabel])){
            $newLeaf=new Leaf($side->rightNodeLabel);
            $leaf->nextLeave[]=$newLeaf;
            $leaveArray[$side->rightNodeLabel]=1;
            DFS($map,$newLeaf,$leaveArray);
        }
    }
}

/**
 * @param $indexLeaf Leaf
 * @return bool
 */
function showResult($indexLeaf){
    if (!$indexLeaf){
        return false;
    }
    print "当前节点为：".$indexLeaf->label."。对应的子节点为：";
    foreach ($indexLeaf->nextLeave as $nextLeaf){
        /**
         * @var Leaf $nextLeaf
         */
        print $nextLeaf->label.DIRECTORY_SEPARATOR;
    }
    print PHP_EOL;
    foreach ($indexLeaf->nextLeave as $nextLeaf){
        showResult($nextLeaf);
    }
}

//$indexLeaf=new Leaf('f');
//$map=createMap();
//$cache=['f'=>1];
//DFS($map,$indexLeaf,$cache);
//showResult($indexLeaf);

