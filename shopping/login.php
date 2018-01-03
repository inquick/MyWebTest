<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
   $userName = $_POST['username'];
   $passWord = $_POST['password'];

   //从db获取用户信息   数据库信息改成自己的
   $conn = mysqli_connect('localhost','root','root','login');
   $res = mysqli_query($conn,"select * from user where `username` =  '$userName' ");
   $row = mysqli_fetch_assoc($res);
   if ($row['passwd'] == $passWord) {
       //密码验证通过，设置session，把用户名和密码保存在服务端
       $_SESSION['username'] = $userName;
       $_SESSION['password'] = $passWord;

       //最后跳转到登录后的欢迎页面 //注意：这里我们没有像cookie一样带参数过去
       header('Location: welcome.php');
   }
}

?>
<html>
<head>
<!-- 这里指明页面编码 -->
<meta charset="utf-8">
</head>
<body>
   <form action="" method="POST">
       <div>
           用户名：<input type="text" name="username" />
           密  码：<input type="text" name="password" />
           <input type="submit" value="登录">        
       </div>
   </form>
</body>
</html>