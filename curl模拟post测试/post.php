<?php
header("Content-type: text/html; charset=utf-8");
echo "<br><br><br><br><br>";
echo $_SERVER['HTTP_USER_AGENT']."	UA��<br>";
echo "<br><br><br><br><br>";
echo $_SERVER['REQUEST_METHOD']."	���ط���ҳ��ʹ�õ����󷽷������� POST����<br>"; 
echo $_SERVER['REQUEST_TIME']."	��������ʼʱ��ʱ��������� 1577687494����<br>"; 
echo $_SERVER['QUERY_STRING']."	���ز�ѯ�ַ����������ͨ����ѯ�ַ������ʴ�ҳ�档<br>"; 
echo $_SERVER['HTTP_ACCEPT']."	�������Ե�ǰ���������ͷ��<br>"; 
echo $_SERVER['HTTP_ACCEPT_CHARSET']."	�������Ե�ǰ����� Accept_Charset ͷ�� ���� utf-8,ISO-8859-1��";
echo $_SERVER['HTTP_HOST']."	�������Ե�ǰ����� Host ͷ��<br>"; 
echo $_SERVER['HTTP_REFERER']."	���ص�ǰҳ������� URL�����ɿ�����Ϊ���������û�����֧�֣���<br>"; 