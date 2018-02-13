<?php
include_once 'http-curl.php';

include_once 'tsprotoc/MSG_Tool_Freezn_Request.php';
include_once 'tsprotoc/GPBMetadata/TSProtocol.php';


echo '一会要new一个class！！';

$req = new MSG_Tool_Freezn_Request();
$req->setUnfreezn(0);
// $data2->setServerName('WORLDSERVER_001');
//
// echo '一会要serializeToString！！';
//
// echo $data2->serializeToString();
//
// echo '完成';

?>
