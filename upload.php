<html>
   <head>
       <meta charset="utf-8" />
       <title>单文件上传</title>
   </head>
   <body>
       <form action="file.php" method="post" enctype="multipart/form-data">
           <input type="file" name="file">
           <input type="submit" value="上传">
       </form>
   </body>
</html>

<?php
if($_FILES['file']['error'] > 0){
   switch ($_FILES['file']['error']) {    //错误码不为0，即文件上传过程中出现了错误
       case '1':
           echo '文件过大';
           break;
       case '2':
           echo '文件超出指定大小';
           break;
       case '3':
           echo '只有部分文件被上传';
           break;
       case '4':
           echo '文件没有被上传';
           break;
       case '6':
           echo '找不到指定文件夹';
           break;
       case '7':
           echo '文件写入失败';
           break;
       default:
           echo "上传出错<br/>";
   }
}else{
   //错误码为0，即上传成功，可以进行后续处理，处理流程见下文
}
?>

<?php
//var_dump()或print_r()
//打印变量的相关信息,将变量的信息详细的展示出来
var_dump($_FILES);             
?>