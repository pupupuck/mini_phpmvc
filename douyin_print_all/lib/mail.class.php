<?php
defined('BASE_PATH') || exit('ERROR,禁止单独访问此文件!');

class mailClass
{
    public static function sendTo($mail_to = '',$code='')
    {
        //随机码
        $mail_subject          = "邮箱验证码"; //邮件主题
        $mail_body             = "
			<h3> 亲爱的会员：</h3>
			<p><h3>您的邮箱验证码为：" . $code . "</h3></p>
			<p>---------------------------------------------------------------- </p>
			<p>如果您没有进行操作，请忽略此邮件！</p>
			<p>本邮件由系统自动发送，请勿回复、转发！</p>
			<p>如果有任何问题，欢迎联系我们！</p>
			";
        // 发送邮件
       //self::sendStart($mail_to, $mail_subject, $mail_body) == 1 ? print '验证码发送成功' : print '验证码发送失败';
        self::sendStart($mail_to, $mail_subject, $mail_body);
    }
    
    
    public static function sendStart($mail_to, $mail_subject, $mail_message)
    {
        $mailName   = "admin" . mt_rand(0, 19) . "@liuliangke.cn";
        $mail       = Array(
            'sitename' => "官方网站", // 发件人名字
            'state' => 1,
            'server' => 'smtp.mxhichina.com', //SMTP服务器 ， ssl链接前面要加ssl://
            'port' => 25, //SMTP服务器端口
            'auth' => 1,
            'mailfrom' => $mailName, //SMTP服务器的用户邮箱
            'username' => $mailName, //SMTP服务器的用户名
            'password' => 'Chenxi521', //SMTP服务器的用户密码
            'charset' => 'UTF-8'
        );
        $mail_debug = 0; //调试
        date_default_timezone_set('PRC');
        
        $mail_subject = '=?' . $mail['charset'] . '?B?' . base64_encode($mail_subject) . '?=';
        $mail_message = chunk_split(base64_encode(preg_replace("/(^|(\r\n))(\.)/", "\1.\3", $mail_message)));
        
        $headers = "";
        $headers .= "MIME-Version:1.0\r\n";
        $headers .= "Content-type:text/html\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";
        $headers .= "From: " . $mail['sitename'] . "<" . $mail['mailfrom'] . ">\r\n";
        $headers .= "Date: " . date("r") . "\r\n";
        list($msec, $sec) = explode(" ", microtime());
        $headers .= "Message-ID: <" . date("YmdHis", $sec) . "." . ($msec * 1000000) . "." . $mail['mailfrom'] . ">\r\n";
        
        if (!$fp = fsockopen($mail['server'], $mail['port'], $errno, $errstr, 30)) { //连接服务器
            if ($mail_debug == 1) {
                return "CONNECT - Unable to connect to the SMTP server";
            }
        }
        
        stream_set_blocking($fp, true);
        
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != '220') {
            if ($mail_debug == 1) {
                return "CONNECT - " . $lastmessage;
            }
        }
        
        fputs($fp, ($mail['auth'] ? 'EHLO' : 'HELO') . " befen\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
            if ($mail_debug == 1) {
                return "HELO/EHLO - " . $lastmessage;
            }
        }
        
        while (1) {
            if (substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
                break;
            }
            $lastmessage = fgets($fp, 512);
        }
        
        if ($mail['auth']) {
            fputs($fp, "AUTH LOGIN\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 334) {
                if ($mail_debug == 1) {
                    return $lastmessage;
                }
            }
            
            fputs($fp, base64_encode($mail['username']) . "\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 334) {
                if ($mail_debug == 1) {
                    return "AUTH LOGIN - " . $lastmessage;
                }
            }
            
            fputs($fp, base64_encode($mail['password']) . "\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 235) {
                if ($mail_debug == 1) {
                    return "AUTH LOGIN - " . $lastmessage;
                }
            }
            
            $email_from = $mail['mailfrom'];
        }
        
        fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 250) {
            fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 250) {
                if ($mail_debug == 1) {
                    return "MAIL FROM - " . $lastmessage;
                }
            }
        }
        
        foreach (explode(',', $mail_to) as $touser) {
            $touser = trim($touser);
            if ($touser) {
                fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser) . ">\r\n");
                $lastmessage = fgets($fp, 512);
                if (substr($lastmessage, 0, 3) != 250) {
                    fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser) . ">\r\n");
                    $lastmessage = fgets($fp, 512);
                    if ($mail_debug == 1) {
                        return "RCPT TO - " . $lastmessage;
                    }
                }
            }
        }
        
        fputs($fp, "DATA\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 354) {
            if ($mail_debug == 1) {
                return "DATA - " . $lastmessage;
            }
        }
        
        fputs($fp, $headers);
        fputs($fp, "To: " . $mail_to . "\r\n");
        fputs($fp, "Subject: $mail_subject\r\n");
        fputs($fp, "\r\n\r\n");
        fputs($fp, "$mail_message\r\n.\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 250) {
            if ($mail_debug == 1) {
                return "END - " . $lastmessage;
            }
        }
        
        fputs($fp, "QUIT\r\n");
        return 1;
    }
}