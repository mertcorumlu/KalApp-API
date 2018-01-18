<?php
$b=array(1,4,3,4);



function check($a){
    $i1=0;
    $i2=0;
    $check=false;

    foreach($a as $aa){
        foreach($a as $den) {
            if($i1!==$i2){
                $sum=$a[$i1]+$a[$i2];
                if($sum==8){
                    $check=true;
                }
            }
            $i2++;
            if ($i2 == count($a))
                $i2 = 0;
        }
        $i1++;
    }

    if($check==true)return true;
    else
        if($check==false)return false;
}

var_dump(check($b));



?>