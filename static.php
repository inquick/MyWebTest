<?php
function demo()
{
   $a = 0;
   echo $a . '<br />';
   $a++;
}

function test()
{
   static $a = 0;
   echo $a . '<br />';
   $a++;
}

demo();
demo();
demo();
demo();
demo();
demo();
demo();
demo();
demo();
demo();


for($i = 0 ;$i < 10 ; $i++){
   test();
}

?>