<?php

class Node{
    public $nodeValue;
    public $nextNodes=[];
    public function __construct($nodeValue)
    {
        $this->nodeValue=$nodeValue;
    }
    public function setNextNodes(Node $node){
        $this->nextNodes[]=$node;
    }
}

function setMap($map,$end,$node,&$checkedMap=[]){
    foreach($node->nextNodes as $node){
        foreach($map[$node->nodeValue] as $city){
            if(isset($checkedMap[$city])){
                continue;
            }
            $checkedMap[$city]=1;
            $thisNode=new Node($city);
            $node->setNextNodes($thisNode);
            if($city==$end){
                return true;
            }
        }
        setMap($map,$end,$node,$checkedMap);
    }
}

function BFS($node,$end){
    foreach($node->nextNodes as $nextNode){
        /**
         * @var $nextNode Node
         */
        if($nextNode->nodeValue==$end){
            return true;
        }
    }
}

$map=[
    '上海'=>['南京','深圳'],
    '南京'=>['上海','北京','武汉'],
    '深圳'=>['上海','广州'],
    '武汉'=>['南京','北京','广州'],
    '北京'=>['南京','武汉','广州'],
    '广州'=>['深圳','武汉','北京']
];

$startNode=new Node('上海');
$cache=[];
setMap($map,'北京',$startNode,$cache);

