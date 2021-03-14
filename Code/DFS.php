<?php
/**
 * 因为要存储的数据有点多，所以采用了类的形式来存储
 */
class Node{
    public $label='';
    public $value=null;
    public $isChecked=false;
    public $previousNodeLabel='';
    public function __construct($label)
    {
        $this->label=$label;
    }
}
/**
 * $nodes 就是模拟前面讲解时采用的表
 * $map 对应的图
 * $thisNode 递归时采用的点
 * $resultNodeLabel 终点
 */
function DFS(&$nodes,$map,&$thisNode,$resultNodeLabel){
    $nextTurnLabel='';
    $minValue=null;
    foreach($map[$thisNode->label] as $nextLabel=>$value){
        $node=$nodes[$nextLabel];
        if($node->isChecked){
            continue;
        }
        if(is_null($node->value) || ($thisNode->value+$value)<$node->value){
            $node->value=$thisNode->value+$value;
            $node->previousNodeLabel=$thisNode->label;
            if(is_null($minValue) || $node->value<$minValue){
                $minValue=$node->value;
                $nextTurnLabel=$node->label;
            }
        }
    }
    $thisNode->isChecked=true;
    if($thisNode->label==$resultNodeLabel){
        return true;
    }
    if($nextTurnLabel){
        DFS($nodes,$map,$nodes[$nextTurnLabel],$resultNodeLabel);
    }
}

function showResult($nodes,$label){
    if(!$label){
        return false;
    }
    print $label.DIRECTORY_SEPARATOR;
    $preNode=$nodes[$label];
    showResult($nodes,$preNode->previousNodeLabel);
}

$map=[
    'A'=>['D'=>1,'B'=>6],
    'D'=>['A'=>1,'B'=>2,'E'=>1],
    'B'=>['A'=>6,'D'=>2,'E'=>2,'C'=>5],
    'E'=>['D'=>1,'B'=>2,'C'=>5],
    'C'=>['B'=>5,'E'=>5]
];

$startNode=new Node('A');
$resultLable='C';
// 可以试试看不走到最后一步，走到中间过程
// $resultLable='E';
$nodes=[
    'A'=>$startNode,
    'B'=>new Node('B'),
    'C'=>new Node('C'),
    'D'=>new Node('D'),
    'E'=>new Node('E')
];

DFS($nodes,$map,$startNode,$resultLable);

showResult($nodes,$resultLable);
