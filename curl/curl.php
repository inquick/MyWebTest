<?php

$myrul = 'http://game.yomo.cn/3GQQ1/?uid=kwkU-irwEH0pL4aua-RAJeJMASHzflW_uWwljBow44pW2V7oGosqEiPs3s7JRvlz&sid2=CEBFE48066&t=1513158372';
$namearray = array(
0 => '/&#x957f;&#x621f;&#x5175;&#x4fd1;/', 
1 => '/攻击/', 
2 => '/返回/', 
);

$cur_index = 0;

while ($myrul = find_and_exec($cur_index++, $myrul))
{
	usleep(rand(1000000, 2000000));
}

function get($url) {
   //初使化curl
   $ch = curl_init();
   //请求的url，由形参传入
   curl_setopt($ch, CURLOPT_URL, $url);
   //将得到的数据返回
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //不处理头信息
   curl_setopt($ch, CURLOPT_HEADER, 0);
   //连接超过10秒超时
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   //执行curl
   $output = curl_exec($ch);
   //关闭资源
   curl_close($ch);
   //返回内容
   return $output;
}

function find_and_exec($index, $url) {
	
	global $namearray;
	
	$index %= 3;
	
	echo $url . '<br />';
	
	echo '当前index=' . $index . '<br />';
	
	$content = get($url);

	$fp = fopen(time() . '.game.html', 'w+');

	// 进行排它型锁定
	if (flock($fp, LOCK_EX)) { 

	   fwrite($fp, $content);

	  // 释放锁定
	   flock($fp, LOCK_UN);    
	} else {
	   echo "锁失败，可能有人在操作，这个时候不能将文件上锁";
	}

	fclose($fp);

	preg_match('/<body class="index">(.*?)<\/body>/mis', $content, $match);

	//将正则匹配到的内容赋值给$area

	if ($match[1] != null)
	{
		$area = $match[1];

		preg_match_all('/<a href="(.*?)<\/a>/', $area, $find);

		// var_dump($find[0]);
		
		while (list($key, $value) = each($find[0]))
		{
			echo $value . '          ' . $find[1][$key] . '<br />';
			
			preg_match($namearray[$index], $find[1][$key], $jibing);
			
			if ($jibing != null)
			{
				preg_match('/(.*?)"/', $find[1][$key], $newurl);
				
				echo $newurl[1] . '<br />';
				
				if (strlen($newurl[1]) > 0){
					return substr($newurl,0,strlen($newurl)-1);
				}
			}
		}
		
		return null;
	}
	else
	{
		echo '没有找到网页body！';
		return null;
	}
}

?>