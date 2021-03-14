<?php

class Town{
    public function totoalStepsNumber($dishNumber){
        if($dishNumber==1){
            return 1;
        }
        return 1+2*$this->totoalStepsNumber($dishNumber-1);
    }
}

$town=new Town();
print $town->totoalStepsNumber(4);