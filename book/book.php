<?php

set_time_limit(0);

$myrul = 'https://m.xiashu.cc/56196/read_1.html';

$fp = fopen('pgdxjdlp.txt', 'a+');

$index = 1;

while ($myrul = find_and_exec($myrul)){
	echo '第' . $index++ . '章<br/>';
}

fclose($fp);

echo '已经下载到最新章节';

// -------------------------------------------------------------
// 网页解析和抓去需要的内容
function find_and_exec($url) {
	global $fp;
	$content = http_get($url);
	
	// 找到章节名
	preg_match('/<div class="titlename">(.*?)<\/div>/mis', $content, $title);
	if (isset($title[1]))
	{
		fwrite($fp, $title[1] . "\r\n\r\n");
	}
	else
	{
		echo '没有找到标题<br/>';
	}
	
	// 找到正文
	preg_match('/<div class="articlecon font-normal">(.*?)<\/div>/mis', $content, $text);
	if (isset($text[1]))
	{
		preg_match_all('/<p>(.*?)<\/p>/', $text[1], $alltexts);
		// var_dump($alltexts);
		while (list(, $one_paragraph) = each($alltexts[1]))
		{
			// var_dump(gettype($one_paragraph));
			if (is_string($one_paragraph))
			{
				if(!strpos($one_paragraph, '&#'))
				{
					fwrite($fp, $one_paragraph . "\r\n");
				}else {
					echo $one_paragraph;
					echo '<br/>';
				}
			}
		}
	}
	else
	{
		echo '没有找到正文<br/>';
	}
	
	// 找到下一章url
	preg_match('/<div class="articlebtn">(.*?)<\/div>/mis', $content, $urls);
	if (isset($urls[1]))
	{
		preg_match_all('/<a class=(.*?)<\/a>/', $urls[1], $allurls);
		while (list (, $one_url) = each($allurls[1]))
		{
			if (preg_match('/href="(.*?)" rel="nofollow">下一章/', $one_url, $next_url))
			{
				fwrite($fp, "\r\n\r\n");
				return 'https://m.xiashu.cc' . $next_url[1];
			}
		}
		var_dump($urls[1]);
	}else{
		echo $url;
		echo '<br/>';
		var_dump($content);
		echo '<br/>';
	}
	echo '没有下一章了';
	return null;
}

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