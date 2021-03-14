<?php

$p=[
    1=>0,
    2=>0,
    3=>1,
    4=>0,
    5=>0,
    6=>2,
    7=>4
];

$sites=[
    1=>10,
    2=>20,
    3=>20,
    4=>30,
    5=>100,
    6=>20,
    7=>10
];
$cache=[];

function opt($n){
    global $sites,$p,$cache;
    if(isset($cache[$n])){
        return $cache[$n];
    }
    if($n<=0){
        return 0;
    }
    $cache[$n]=max(opt($n-1),opt($p[$n])+$sites[$n]);
    return $cache[$n];
}

print opt(7);
print PHP_EOL;
print_r($cache);