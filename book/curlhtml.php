
<?php

$content = http_get('http://www.php.cn/course/74.html');

file_put_contents('result.html', $content, FILE_APPEND | LOCK_EX);

echo '抓取结束';

// 拉取网页内容
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
	//连接超过10秒超时
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	//执行curl
	$output = curl_exec($ch);
	//关闭资源
	curl_close($ch);
	//返回内容
	return $output;
}
?>