
<?php

set_time_limit(0);

if (empty($_GET['bookurl']) || ( $_GET['bookurl'] == null )) {
	exit('请输入小说第一章网址');
}

if (empty($_GET['savepath']) || ( $_GET['savepath'] == null )) {
	exit('请输入保存文件名');
}

$myrul = $_GET['bookurl'];

$fp = fopen($_GET['savepath'], 'a+');

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
	
	// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
	global $index;
	// file_put_contents ( $index . '.html' ,  $content ,  FILE_APPEND  |  LOCK_EX );
	$content = file_get_contents($index . '.html', 'r');
	// var_dump($content);
	
	// 找到章节名
	$lastline = "";
	preg_match('!<strong class="reader-chapter-tit">(.*)<\/strong>!mis', $content, $title);
	if (isset($title[1]))
	{
		if ($lastline != $title[1])
		{
			fwrite($fp, $title[1] . "\r\n\r\n");
			$lastline = $title[1];
		}
	}
	else
	{
		exit('没有找到标题<br/>' . var_dump($title));
	}
	
	// 找到正文
	preg_match('!<div class="reader-article">(.*)<\/div>!', $content, $text);
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
					if ($lastline != $one_paragraph)
					{
						fwrite($fp, $one_paragraph . "\r\n");
						$lastline = $one_paragraph;
					}
				}else {
					echo $one_paragraph;
					echo '<br/>';
				}
			}
		}
	}
	else
	{
		exit('没有找到正文<br/>');
	}
	
	// 找到下一章url
	preg_match('!<a id="nextChpater" href="(.*)"><\/a>!', $content, $next_url);
	if (isset($next_url[1]))
	{
		fwrite($fp, "\r\n\r\n");
		return $next_url[1];
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