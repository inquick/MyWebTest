<?php
session_start();
$username = $_SESSION['username'];
?>
<html>
<head>

</head>
<body>
   welcome,<?php echo $username;?>
</body>
</html>