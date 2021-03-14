<?php

require_once __DIR__.DIRECTORY_SEPARATOR."树的遍历.php";

function createLeaf($x,$y){
    $indexLeaf=new Leaf('+');
    $indexLeaf->leftLeaf=new Leaf('*');
    $indexLeaf->rightLeaf=new Leaf('+');
    $indexLeaf->leftLeaf->leftLeaf=new Leaf('+');
    $indexLeaf->leftLeaf->leftLeaf->leftLeaf=new Leaf($x);
    $indexLeaf->leftLeaf->leftLeaf->rightLeaf=new Leaf($y);
    $indexLeaf->leftLeaf->rightLeaf=new Leaf(2);
    $indexLeaf->rightLeaf->leftLeaf=new Leaf('-');
    $indexLeaf->rightLeaf->rightLeaf=new Leaf(3);
    $indexLeaf->rightLeaf->leftLeaf->leftLeaf=new Leaf($x);
    $indexLeaf->rightLeaf->leftLeaf->rightLeaf=new Leaf(4);
    return $indexLeaf;
}

$x=2;
$y=4;
$result=13;

$indexLeaf=createLeaf($x,$y);
$string='';
VLR($indexLeaf,$string);
print $string.PHP_EOL;
print ParseStringVLR($string).PHP_EOL;
$string='';
LRD($indexLeaf,$string);
print $string.PHP_EOL;
print ParseStringLRD($string).PHP_EOL;
$string='';
LDR($indexLeaf,$string);
print $string.PHP_EOL;
print ParseStringLDR($string);



