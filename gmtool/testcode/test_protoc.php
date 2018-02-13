<?php
include_once '../http-curl.php';

include_once 'Person.php';
include_once 'GPBMetadata/Simple.php';


echo '一会要new一个class！！';

$data = new Person();
$data->setName("我的名字");

echo $data->serializeToString();
// $data2->setServerName('WORLDSERVER_001');
//
// echo '一会要serializeToString！！';
//
// echo $data2->serializeToString();
//
// echo '完成';

?>
