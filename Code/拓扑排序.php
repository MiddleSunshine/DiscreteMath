<?php

require_once __DIR__.DIRECTORY_SEPARATOR."FileCache.php";

function relationShip($a,$b){
    return $a>$b;
}

function getBaseMap($map,$index,&$returnData){
    foreach($map as $node){
        if(relationShip($map[$index],$node)){
            !isset($returnData[$map[$index]]) && $returnData[$map[$index]]=[];
            $returnData[$map[$index]][$node]=1;
        }
    }
    if(isset($map[$index+1])){
        getBaseMap($map,$index+1,$returnData);
    }
}

$set=[1,2,4,5,12,20];
$set=[20,12,5,4,2,1];
$map=[];
getBaseMap($set,0,$map);
$hasiMapKey='result3';
Cache::instance()->set($hasiMapKey,json_encode($map));
hasaiMap($hasiMapKey,4,3);

function hasaiMap($mapCacheName,$a,$b){
    $map=Cache::instance()->get($mapCacheName);
    $map=json_decode($map,1);
    $nextB='';
    if(isset($map[$b])){
        foreach($map[$b] as $c=>$useless){
            !$nextB && $nextB=$c;
            unset($map[$a][$c]);
        }
    }
    Cache::instance()->set($mapCacheName,json_encode($map));
    if(isset($map[$nextB])){
        hasaiMap($mapCacheName,$b,$nextB);
    }
}

function compare(){

}
