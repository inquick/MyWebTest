<html>
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
<?php
   //开启session
   session_start();

   // 清空购物车
   unset($_SESSION['goods']);
   $_SESSION['goods'] = array();
   $_SESSION['totalPrice'] = 0;
   
   // 购买处理完毕后跳转到商品列表
   header('location: shoppingCart.php');
?>
</body>
</html>