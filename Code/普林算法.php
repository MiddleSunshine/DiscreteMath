<?php

class Side{
    public $leftNode;
    public $rightNode;
    public $weight;
    public function __construct($leftNode,$rightNode,$weight)
    {
        $this->leftNode=$leftNode;
        $this->rightNode=$rightNode;
        $this->weight=$weight;
    }
}

function createMap(){
    $map=[];
    $map[]=new Side('a','g',40);
    $map[]=new Side('a','f',8);
    $map[]=new Side('a','b',45);
    $map[]=new Side('f','g',35);
    $map[]=new Side('b','g',20);
    $map[]=new Side('f','e',27);
    $map[]=new Side('b','c',12);
    $map[]=new Side('e','g',24);
    $map[]=new Side('g','c',60);
    $map[]=new Side('e','d',6);
    $map[]=new Side('d','c',33);
    $map[]=new Side('d','g',2);
    return $map;
}

/**
 * 普林算法
 * @param $map array 地图
 * @param $tree array 保存最终的结果
 * @param bool $sort 防止递归的时候需要对之前排序好的地图再排序一次
 */
function Prims($map,&$tree,$sort=true){
    $sort && sortMap($map);
    $whiteList=[];
    foreach ($tree as $sideLabel=>$side){
        $side[]=$sideLabel;
        $whiteList=array_merge($whiteList,$side);
    }
    $nextSide=getNextNode($map,$whiteList);
    if (!empty($nextSide)){
        !isset($tree[$nextSide[0]]) && $tree[$nextSide[0]]=[];
        $tree[$nextSide[0]][]=$nextSide[1];
        Prims($map,$tree,false);
    }
}

/**
 * 克鲁斯卡尔算法
 * @param $map array
 * @param $tree array
 */
function Kruskal($map,&$tree){
    sortMap($map);
    $whiteList=[];
    foreach ($map as $side){
        /**
         * @var $side Side
         */
        // todo 这里的代码有问题，这样会跳过一些点，比如选择 e-d 和 a-f 之后，会跳过 f-e
        if (isset($whiteList[$side->leftNode]) && isset($whiteList[$side->rightNode])){
            continue;
        }
        $whiteList[$side->leftNode]=1;
        $whiteList[$side->rightNode]=1;
        !isset($tree[$side->leftNode]) && $tree[$side->leftNode]=[];
        $tree[$side->leftNode][]=$side->rightNode;
    }
}

/**
 * 获取下一条边
 * @param $map
 * @param $whiteList
 * @return array
 */
function getNextNode($map,&$whiteList){
    $returnData=[];
    foreach ($map as $side){
        /**
         * @var $side Side
         */
        if ((in_array($side->leftNode,$whiteList) && !in_array($side->rightNode,$whiteList))){
            $returnData=[$side->leftNode,$side->rightNode];
            break;
        }elseif (in_array($side->rightNode,$whiteList) && !in_array($side->leftNode,$whiteList)){
            $returnData=[$side->rightNode,$side->leftNode];
            break;
        }
    }
    return $returnData;
}

/**
 * 排序一下，因为这样后续可以直接获取数据
 * @param $map
 */
function sortMap(&$map){
    $mapLength=count($map);
    for ($outsideIndex=0;$outsideIndex<$mapLength;$outsideIndex++){
        for ($insideIndex=$outsideIndex;$insideIndex<$mapLength;$insideIndex++){
            /**
             * @var $outsideSide Side
             */
            $outsideSide=$map[$outsideIndex];
            /**
             * @var $insideSide Side
             */
            $insideSide=$map[$insideIndex];
            if ($outsideSide->weight>$insideSide->weight){
                $map[$outsideIndex]=$insideSide;
                $map[$insideIndex]=$outsideSide;
            }
        }
    }
}

//$tree=['g'=>[]];
//Prims(createMap(),$tree);
//print_r($tree);
$tree=[];
Kruskal(createMap(),$tree);
print_r($tree);