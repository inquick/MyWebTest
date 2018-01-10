<?php

function http_post($url, $data) {
   //初使化init方法
   $ch = curl_init();
   //指定URL
   curl_setopt($ch, CURLOPT_URL, $url);
   //设定请求后返回结果
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //声明使用POST方式来进行发送
   curl_setopt($ch, CURLOPT_POST, 1);
   //发送什么数据呢
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   //忽略证书
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   //忽略header头信息
   curl_setopt($ch, CURLOPT_HEADER, 0);
   //设置超时时间5秒
   curl_setopt($ch, CURLOPT_TIMEOUT, 15);
   //发送请求
   $output = curl_exec($ch);
   //关闭curl
   curl_close($ch);
   //返回数据
   return $output;
}

function http_get($url) {
	//初使化curl
	$ch = curl_init();
	//请求的url，由形参传入
	curl_setopt($ch, CURLOPT_URL, $url);
	//将得到的数据返回
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//声明使用POST方式来进行发送
	curl_setopt($ch, CURLOPT_POST, 0);
	//忽略证书
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	//不处理头信息
	curl_setopt($ch, CURLOPT_HEADER, 0);
	//连接超过5秒超时
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	//执行curl
	$output = curl_exec($ch);
	//关闭资源
	curl_close($ch);
	//返回内容
	return $output;
}

?>