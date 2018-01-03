<?php

$fp = fopen("demo.txt", "r+");

// 进行排它型锁定
if (flock($fp, LOCK_EX)) { 

   fwrite($fp, "文件这个时候被我独占了哟\n");

  // 释放锁定
   flock($fp, LOCK_UN);    
} else {
   echo "锁失败，可能有人在操作，这个时候不能将文件上锁";
}

fclose($fp);

?>