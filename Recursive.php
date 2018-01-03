<?php

echo '看看这句话打印出来没？<br />';

$n = 2;

function dg( $n ){

   echo $n.'<br />';

   $n = $n - 1;

   if($n > 0){
       //在函数体内调用了dg自己哟
       dg($n);

   }else{

       echo '--------------<br />';
   }

   echo '俺是狗蛋，俺还没执行' . $n . '<br />';

}

dg(10);

?>