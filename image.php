<?php  
// set up variable  
$url = $_REQUEST['url'];  
// echo "<p> 8 ".$url."<br /></p>";  
$ext = substr($url, strrpos($url, '.')+1);  
// echo '<p> 9 '.$ext.'<br /></p>';  
$filename = substr($url, strrpos($url, '/')+1, -(strlen($ext) + 1));  
// echo '<p> 10 '.$filename.'<br /></p>';  
  
  
echo '<img src="' . $url . '">';  
  
// if ($ext == 'jpg') {  
    // $im = imagecreatefromjpeg($url);  
    // if ($im) {  
// //      echo '<p>created image handle<br /></p>';  
        // $width = imagesx($im);  
        // $height = imagesy($im);  
        // $x = $width/2;  
        // $y = $height/2;  
  
  
        // $dst = imagecreatetruecolor($x, $y);  
        // imagecopyresampled($dst, $im, 0, 0, 0, 0, $x, $y, $width, $height); 
        // header("Content-Type:image/jpeg");  
		// imagejpeg($dst, 'imgdst.jpg');  
        // // imagejpeg($dst);  
        // imagedestroy($dst);  
        // imagedestroy($im);  
		// echo '<img src="imgdst.jpg" width="300">';  
    // }else
	// {
		// exit('获取图片失败！！');
	// }
// }  
  
  
?> 