<?php 
	@header('Content-type: text/html;charset=utf-8');
	$username = 'soutu';  //С��id
	 $url='http://ie.icoa.cn';
    
	 
	 //������
	 $opts = array(
    'http'=>array(
    'method'=>"GET",
	'timeout'=>60,
	'ignore_errors' => true,
    'header'=>"Accept-language: zh-cn\r\n" .
              "Cookie: foo=bar\r\n" .
			  "status: 404 Not Found\r\n" .
			  "Content-type: application/x-gzip" .
			  "Cache-Control: no-cache\r\n" .
			  "Pragma: no-cache\r\n" .
			  "Accept-Encoding: gzip, deflate\r\n" .
			  "User-Agent: Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; 4399Box.560; .NET4.0C; .NET4.0E)" .
              "Accept: */*"
			  
                 )
   );
   $context = stream_context_create($opts);  //�ύ���Ա����cookie�����һ����ַ����Ӧ����
	 $html = file_get_contents($url,false,$context);
	 //iconv('UTF-8', 'gbk//TRANSLIT', $html);
     //$html = json_encode('hhhhhhhh��')
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta name="data-spm" content="937" />

<title>�Ա��� - �ԣ���ϲ��</title>
</head>

<body>
<?php 
echo header();
echo $html; //��ʾ������?>


</body>
</html>