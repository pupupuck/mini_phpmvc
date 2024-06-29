<!doctype html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content=<?php echo $G['web']['keywords']; ?> />
<meta name='description' content=<?php echo $G['web']['description']; ?>/>
<link rel='dns-prefetch' href='//www.***.com' />
<title><?=  $this->title  ; ?></title>

</head>

<body>
  <div class='header'>
  </br>
  <?=$this->title;?>
  <?php
  //echo $this->title2;
  echo '<br><br><br><br>----------' . basename( __FILE__) . '-----------<br>';
  ?>
</br></br></br></br>
    <?php
				echo '<a href=' . BASE_URL . '>首页BASE_URL</a> &nbsp;&nbsp;';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/ >用户首页</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/info >用户信息</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/update >完善资料</a>&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/modifyPassword >修改密码</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/forgot >忘记密码</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/mailVerify >验证邮箱</a>&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/login >登录</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/register >注册</a>&nbsp;&nbsp;';
				echo '<a href=' . BASE_URL . '/user/logout >退出</a>&nbsp;&nbsp;&nbsp;&nbsp;';
    ?>
  </br></br>

  </div>


</br></br>
<?php

	echo '用户登录';
	echo '</br></br>';


	//异常消息

?>
</br></br>

<form method='post' action='<?php echo BASE_URL . 'index.php?p=user&c=user&a=login'; ?>'>
<span class='form-title'> 用户登录： </span></br>
<input type='text'  name='username'  placeholder='用户名' /></br>
<input type='password' name='password' maxlength='16' placeholder='密码' /></br>
<input type='submit' value='点击登陆'></br>
</form>

</br></br>
<?php
echo '<br><br><br><br>----------' . basename( __FILE__) . '-----------<br>';
?>
<?php

?>
</br></br></br>
<?php
echo '<br><br><br><br>----------' . basename( __FILE__) . '-----------<br>';
?>
</div>
</BODY>
</HTML>
