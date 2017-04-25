<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册---邮箱验证</title>
</head>
<body>
    <h1>注册</h1>
    <form action="<?php echo U('Emailtest/index');?>" method="post" accept-charset="utf-8">
        <span style="white-space:pre">    </span><p> 用户名：<input type="text " name='username' value="" required/></p>
        <span style="white-space:pre">    </span><p>密码：<input type="password" name="passwd" value="" required/></p>
        <span style="white-space:pre"> </span> <p>确认密码：<input type="password" name="repasswd" value="" required/></p>
        <span style="white-space:pre">    </span><p>邮箱：<input type="email" name="email" value="" required/></p>
        <span style="white-space:pre">    </span><p><input type="submit" name="submit" value="注册" /></p>
    </form>

</body>
</html>