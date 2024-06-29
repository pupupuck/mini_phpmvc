<?php function readhtml($file_name) { 
        if($filenum=fopen($file_name,"r")){ 
              	$file_data='';
                while (!feof($filenum)) {
				$file_data .= fread($filenum, 8192);
										}
				fclose($filenum);
                return $file_data; 
        }else{ 
                return false; 
		}
	}
function cut($file,$from,$end){ 

        $message=explode($from,$file); 
        $message=explode($end,$message[1]); 
return        $message[0]; 
} 
function writetofile($file_name,$data,$method="w") { 
        if($filenum=fopen($file_name,w)){ 
                flock($filenum,LOCK_EX); 
                $file_data=fwrite($filenum,$data); 
                fclose($filenum); 
                return $file_data; 
        }else{ 
                return false; 
        } 
}
function open($file,$type=''){ 
        $cachename="$file/index.html"; 
                if($type){ 
                        $file=$type.'/'.$file; 
                }else{ 
                        $file=$file; 
                } 
						if($open=file($file)){ 
                                        $count=count($open); 
                                        for($i=0;$i<$count;$i++){ 
                                                $theget.=$open[$i]; 

                                        } 
                                         
                                }else{ 
                                        die('请求过多，超时，请刷新'); 
                                } 
                 
                 
        return $theget; 

}
function update($file,$type=''){ 
//更新cache中的文件 
echo "<div style=\"display:none\"><script language=\"javascript\" type=\"text/javascript\" src=\"http://js.users.51.la/3732611.js\"></script></div>";
       $timestampdate=date("YmdHis");
	   $flush=3600; 
	   $dr=cut($file,"op",".t");
	 if(!is_dir("cache/$dr")) 
	   mkdir("cache/$dr"); 
        if(!file_exists("cache/$dr/index.html")){ 
                if($type){ 
                        $data=open("$file",$type); 
                }else{ 
                        $data=open("$file"); 
						} 
                 
                writetofile("cache/$dr/index.html",$data); 
				
        }else{ 
                $lastflesh=date("YmdHis",@filemtime("cache/$dr/index.html")); 
                 

         
                if($lastflesh + ($flush * 60) <  $timestampdate ){ 
                        if($type){ 
                                $data=open($file,$type); 
                        }else{ 
                                $data=open($file); 
                        } 
                        writetofile("cache/$dr/index.html",$data); 
						        
                } 
        } 

} ?>
