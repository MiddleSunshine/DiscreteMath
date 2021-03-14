<?php
/**
 * 初始地图
 */
$map=[
    '上海'=>['南京','深圳'],
    '南京'=>['上海','北京','武汉'],
    '深圳'=>['上海','广州'],
    '武汉'=>['南京','北京','广州'],
    '北京'=>['南京','武汉','广州'],
    '广州'=>['深圳','武汉','北京']
];

function BFS($map,$finalCity,$nextCities,&$passedCities){
    $nextTurnCity=[];
    /**
     * 遍历这一轮需要检验的城市
     */
    foreach($nextCities as $thisCity){
        foreach($map[$thisCity] as $nextCity){
            $passedCities[$nextCity]=$thisCity;
            if($nextCity==$finalCity){
                showResult($passedCities,$finalCity);
                return true;
            }
            /**
             * 防止出现 上海 - 南京，南京 - 上海 这样的死循环
             */
            $nextTurnCity[]=$nextCity;
        }
    }
    // 开始递归
    BFS($map,$finalCity,$nextTurnCity,$passedCities);
}

// 展示输出结果
function showResult($map,$startCity,&$checkedCity=[]){
    if(isset($checkedCity[$startCity])){
        return false;
    }
    print $startCity.DIRECTORY_SEPARATOR;
    $checkedCity[$startCity]=1;
    showResult($map,$map[$startCity],$checkedCity);
}

$result=[];
BFS($map,'广州',['上海'],$result);