<HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>post签名测试</title>
<style type="text/css">
<!--
html,body,a,div,form,dl,dt,dd,ul,li,ol,span,img,input,button,form,select,textarea{ margin:0; padding:0; border:0;font-family:"\5FAE\8F6F\96C5\9ED1","Microsoft Yahei";font-size: 13px;color:#333;}
body {height:auto;max-width:1280px;margin:0 auto;background:#FFF;}
a{text-decoration:none;}

.left {display: block; width:45%; float: left; overflow:hidden;border-right:0px solid #eee;margin:5px;}
.right {display: block; width:45%; float: left;overflow:hidden;}
.iframe {width:500px;height:250px;scrolling:yes;padding:5px;border: 1px #999 solid;border-bottom:1px solid #eee;border-right:1px solid #eee;margin:5px;}


.form {margin:50px 0px;}
.textarea {width:400px;height:300px;padding:5px;border: 1px #999 solid;border-bottom:1px solid #eee;border-right:1px solid #eee;margin:5px;}
.input-left {display: inline-block;width:100px;height:30px;line-height:30px;text-align:right;}
.input {width:400px;height:30px;line-height:30px;padding-left:5px;border: 1px #999 solid;border-bottom:1px solid #eee;border-right:1px solid #eee;margin:5px;}
.input-right {display: inline-block;height:26px;line-height:26px;color: red;padding-left:5px;}
.button  {background-color: #0093B9;text-align:center;width:120px;height: 35px;line-height: 35px;color:#FFF;border:0px;margin:10px;}
.button:hover {background-color:#00B4EA;}
-->
</style>
</head>
<BODY>

<script type="text/javascript">
function GetTextFromBack() {
//alert("测试");

var xmlHttp;
if(window.ActiveXObject){ 
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); 
	} else {  xmlHttp=new XMLHttpRequest(); }

var url = "https://katongweb.alipay.com/express/expressTrade.htm?payAmount=333.00&useUnityLimit=true&supportEbank=true&orderDetailUrl=http%3A%2F%2Fcashier-pool%2Ftile%2Fservice%2Fpreprocess%3AtradeOrderDetail.tile&channelType=DEBIT_EXPRESS&instId=ABC&isCreditCard=false&scSignType=YZ&isDeposit=false&enctraceid=flJK1meJExUtLAJag1aoc7T0h_FK1GLOEe75RI7Mb0s%2C&signKey=97a30a6de4cf0a421c443508ac928b34&sign=97a30a6de4cf0a421c443508ac928b34&isExpress=true&bizProcessId=8c682c7a59a5b2bb97bb79234ce6ad06&signingType=mobile&outBizNo=2015101321001001700073615720&bizIdentity=trade10001&orderId=101378cba4c7fb0282d168erclou5703&formula=%5B%7B%22entry%22%3A%22%D2%F8%D0%D0%BF%A8%D4%AD%D6%A7%B8%B6%BD%F0%B6%EE%22%2C%22amount%22%3A%22336.00%22%2C%22red%22%3Afalse%7D%2C%7B%22entry%22%3A%22%BF%EC%BD%DD%D6%B1%BC%F5%BB%EE%B6%AF%C2%FA5%D4%AA%BC%F53%D4%AA%22%2C%22amount%22%3A%22-3.00%22%2C%22red%22%3Atrue%7D%2C%7B%22total%22%3A%22%D0%A1%BC%C6%22%2C%22amount%22%3A%22333.00%22%2C%22red%22%3Afalse%7D%5D&newUser=true";
xmlHttp.onreadystatechange=DoResponse; //回调函数
xmlHttp.open("GET",url,true);
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
xmlHttp.setRequestHeader("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8");
xmlHttp.setRequestHeader("Accept-Encoding", "gzip, deflate, sdch");
xmlHttp.setRequestHeader("Accept-Language", "zh-CN,zh;q=0.8");
xmlHttp.setRequestHeader("Upgrade-Insecure-Requests", "1");
xmlHttp.setRequestHeader("User-Agent", "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36");
xmlHttp.setRequestHeader("Referer", "https://cashiersu18.alipay.com/standard/fastpay/payRecommend.htm?_xbox=true&orderId=101378cba4c7fb0282d168erclou5703&cardType=DC&isB2BEbank=&instId=ABC");
xmlHttp.setRequestHeader("Host", "katongweb.alipay.com");
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.send("");

function DoResponse() {  //从服务器带回xmlHttp.responseText;
   if(xmlHttp.readyState==4 && xmlHttp.status==200) {
    //button.innerHTML = xmlHttp.responseText;
	//button.removeAttribute('disabled');
	}
	//alert("测试");
	document.write(xmlHttp.responseText);
  }

}
</script>
<button class='button' type='button' onclick="GetTextFromBack()" >发送GET数据到支付宝</button>
<iframe src="https://katongweb.alipay.com/express/expressTrade.htm?payAmount=333.00&useUnityLimit=true&supportEbank=true&orderDetailUrl=http%3A%2F%2Fcashier-pool%2Ftile%2Fservice%2Fpreprocess%3AtradeOrderDetail.tile&channelType=DEBIT_EXPRESS&instId=ABC&isCreditCard=false&scSignType=YZ&isDeposit=false&enctraceid=flJK1meJExUtLAJag1aoc7T0h_FK1GLOEe75RI7Mb0s%2C&signKey=97a30a6de4cf0a421c443508ac928b34&sign=97a30a6de4cf0a421c443508ac928b34&isExpress=true&bizProcessId=8c682c7a59a5b2bb97bb79234ce6ad06&signingType=mobile&outBizNo=2015101321001001700073615720&bizIdentity=trade10001&orderId=101378cba4c7fb0282d168erclou5703&formula=%5B%7B%22entry%22%3A%22%D2%F8%D0%D0%BF%A8%D4%AD%D6%A7%B8%B6%BD%F0%B6%EE%22%2C%22amount%22%3A%22336.00%22%2C%22red%22%3Afalse%7D%2C%7B%22entry%22%3A%22%BF%EC%BD%DD%D6%B1%BC%F5%BB%EE%B6%AF%C2%FA5%D4%AA%BC%F53%D4%AA%22%2C%22amount%22%3A%22-3.00%22%2C%22red%22%3Atrue%7D%2C%7B%22total%22%3A%22%D0%A1%BC%C6%22%2C%22amount%22%3A%22333.00%22%2C%22red%22%3Afalse%7D%5D&newUser=true" width="400" height="200" scrolling="yes" />

</BODY>
</html>