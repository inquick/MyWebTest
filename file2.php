<?php
   $data = "在PHP中文网学好PHP，妹子票子不再话下！";

   $numbytes = file_put_contents('binggege.txt', $data);

   if($numbytes){

       echo '写入成功，我们读取看看结果试试：';

       echo file_get_contents('binggege.txt');

   }else{
       echo '写入失败或者没有权限，注意检查';
   }
   echo '<br />';
?>

<?php
   $filename = 'test.txt';
   $fp= fopen($filename, "w");
   $len = fwrite($fp, '我是一只来自北方的狼，却在南方冻成了狗');
   fclose($fp);
   print $len ."字节被写入了\r\n";
   echo '<br />';
?>

<?php
   $filename = 'test.txt';
   $fp= fopen($filename, "a+");
   $len = fwrite($fp, '我是一只来自南方的狼，一直在寻找心中的花姑娘');
   fclose($fp);
   print $len ."字节被写入了\r\n";
   
   echo '<br />';
   echo file_get_contents($filename);
?>