<!doctype html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content=<?php echo $G['web']['keywords']; ?> />
<meta name='description' content=<?php echo $G['web']['description']; ?>/>
<link rel='dns-prefetch' href='//www.***.com' />
<title><?php echo $G['web']['title']; ?></title>

</head>

<body>
  <div class='header'>
  </br>
  <?php
  echo '<br><br><br><br>----------' . basename( __FILE__) . '-----------<br>';
  ?>
</br></br></br></br>
    <?php
echo '<a href=' . BASE_URL . ' >真首页</a>&nbsp;&nbsp;';
    foreach ($G['menu'] as $key => $value) {

                //echo $value['name'] . $value['url'] . '</br>';
        if ($value['show'] == 1) {
            echo '<a href='. $value['url'] . '>' . $value['name'] . '</a> &nbsp;&nbsp;';
        }
    }
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user >用户首页</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/info >用户信息</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/update >完善资料</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/modifyPassword >修改密码</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/forgot >忘记密码</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/mailVerify >验证邮箱</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/login >登录</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/register >注册</a>&nbsp;&nbsp;';
                echo '<a href=' . BASE_URL . '/user/logout >退出</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<a href=' . BASE_URL . '/admin/index/index >后台管理</a>&nbsp;&nbsp;&nbsp;&nbsp;';
    ?>
  </br></br>

  </div>
<?php
        echo '</br></br>';

        // 面包屑导航
        foreach ($G['navi'] as $key => $value) {
            echo '<a href=' . $value['url'] . '>' . $value['name'] . '</a> &nbsp;&nbsp; - &nbsp;&nbsp;';
        }

        echo '</br></br>';

        // 是否为空
        if (empty($G['list'])) {
            echo '400,粗错啦！列表为空。</br>'; //应该用msg
        } else {

            // 标题列表
            foreach ($G['list'] as $key => $value) {
                if ($key != 'pages') {
                    echo '<a href=' . $value['url'] . '>' . $value['title'] . '</a> </br>';
                }
            }

            echo '</br></br>';

            // 分页列表
            foreach ($G['list']['pages'] as $key1 => $value1) {
                //echo $value1['pageNum'] . ':::' . $value1['pageUrl'] . ' </br>';
                // 判断...
                if ($value1['pageNum'] == '...') {
                    echo '&nbsp;' . $value1['pageNum'] . '&nbsp;';
                } else {
                    echo '&nbsp;<a href=' . $value1['pageUrl'] . '>' . $value1['pageNum'] . '</a>&nbsp;';
                }
            }
        }

echo '<br><br><br><br>----------' . basename(__FILE__) . '-----------<br>';
?>
<?php
echo '</br></br>';

echo '<br><br><br><br>----------' . basename( __FILE__) . '-----------<br>';
?>

</div>
</BODY>
</HTML>
