<?php include("function.php"); 
	$shop="http://shop58517268.taobao.com/";//店铺地址，必须为shopXXX.taobao.com的格式
	update($shop);//更新缓存
	$file=readhtml("cache/".cut($shop,"op",".t")."/index.html");//读取缓存
	$xy=cut($file,"<span id=\"J_rateTipsR\" tb:virtual=\"0%\" tb:real=\"100%\">", "</span>");//获取信誉度
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>获取淘宝</title>
</head>

<body><?php echo $xy; //显示信誉度?>
</body>
</html>