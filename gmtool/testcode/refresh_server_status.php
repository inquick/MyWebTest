<?php
session_start();

set_time_limit(0);//让程序一直执行下去
$interval=5;//每隔一定时间运行
do{
	
	sleep($interval);//等待时间，进行下一次操作。
}while(true);

?>
