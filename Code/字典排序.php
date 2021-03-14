<?php

function dictionarySort($data1,$data2,$index=0){
	// 防止传递进空数组时，下面的递归陷入死循环
	if(!isset($data1[$index]) && !isset($data2[$index])){
		return 0;
	}
	!isset($data1[$index]) && $data1[$index]=0;
	!isset($data2[$index]) && $data2[$index]=0;
	if($data1[$index]==$data2[$index]){
		// 字典排序的含义：如果当前元素一致，就比较下一个元素
		return dictionarySort($data1,$data2,$index+1);
	}
	// 如果能在当前元素就比较出大小，则比较结束
	return ($data1[$index]>$data2[$index])?1:2;
}

$data1=[1,2,3];
$data2=[1,2,1];

print dictionarySort($data1,$data2);