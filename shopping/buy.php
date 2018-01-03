<html>
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<?php
   //开启session
   session_start();

   //获取传过来的商品名和价格
   $name = $_GET['name'];
   $price = $_GET['price'];

   //把session中的商品信息和传过来的(刚买的)商品信息对比
   $goods = $_SESSION['goods'];
   if (empty($goods[$name]))
   {
	   $goods[$name] = array();
       $goods[$name]['name'] = $name;
       $goods[$name]['price'] = 0;
       $goods[$name]['number'] = 0;
   }
   $goods[$name]['price'] = $price;
   $goods[$name]['number'] = 1;
   $_SESSION['totalPrice'] += $price;

   $_SESSION['goods'] = $goods;
   //购买处理完毕后跳转到商品列表
   header('location: goodsList.php');
?>
</body>
</html>