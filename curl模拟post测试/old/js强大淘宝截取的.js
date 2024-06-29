/**
  * ����ͷ����ش����
  * @param obj   ��ϵ��ID
  * @param newImgUrl  �µ�url��ַ
  */
function dealImgError(obj,newImgUrl) {
	try{
		if (obj.showcnt != "2") {
			obj.showcnt ="2";
			obj.src=newImgUrl;
		}
	} catch (e) {
	}
}

/**
  * �޸��û����ǳƣ���������
  * WangWang:ModifyCntInfo?CntId=&GroupId=&Nick=
  * @param contactId   ��ϵ��ID
  * @param groupId     ��ID
  * @param nickname    �ǳ�
  */
 function modifyWangWangCntInfo(contactId,groupId,nickname){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
 	var command = "WangWang:ModifyCntInfo?CntId="+ contactId +"&GroupId="+ groupId +"&Nick="+ nickname;
	var checkFlag= (arguments.length==3)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * �Ա�����������Ϣ������ת���Ա�������ҳ��
  *
  * WangWang:ModifyCntInfo?CntId=&GroupId=&Nick=
  * @param flag   0 --> �汾����
  *               1 --> û�а�װ��������
  *               2 --> ��İ��������汾������,���������°氢��������
  */
 function showWangwangErrMsg( flag ) {
	if ( flag == 0 ) {
		 alert("��İ汾���ɣ�û�иù��ܣ����������°汾!");
		 window.target = "_blank";
		 window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	} else if( flag == 1 ) {
		alert("��û�а�װ��������,�����ذ�������!")
		window.target = "_blank";
		window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	} else if( flag == 2 ) {
		alert("��İ��������汾������,���������°氢��������")
		window.target = "_blank";
		window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	}
 }

 /**
  * ó��ͨ������Ϣ������ת��ó��ͨ������ҳ��
  *
  * @param flag   0 --> �汾����
  *               1 --> û�а�װ��������
  *               2 --> ��İ��������汾������,���������°氢��������
  */
 function showAlitalkErrMsg( flag ) {
	if ( flag == 0 ) {
		 alert("��İ汾���ɣ�û�иù��ܣ����������°汾!");
		 window.target = "_blank";
		 window.open("http://alitalk.alibaba.com.cn/index.html");
	} else if( flag == 1 ) {
		alert("��û�а�װ��������,�����ذ�������!")
		window.target = "_blank";
		window.open("http://alitalk.alibaba.com.cn/index.html");
	} else if( flag == 2 ) {
		alert("��İ��������汾������,���������°氢��������")
		window.target = "_blank";
		window.open("http://alitalk.alibaba.com.cn/index.html");
	}
 }

 /**
  * �����ϵ��
  * WangWang:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   ��Ӷ����ID
  * @param site  IDǰ׺
  * @param gid   ��ID
  */
 function addWangWangContact(uid,site,gid){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  *****/
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
		return;
	}

	var command = "WangWang:AddContact?uid="+uid+"&CntSiteId="+site+"&gid="+gid+"&inner=1";
	var checkFlag= (arguments.length==3)?true:false;
	execWangWangShell(command,"5.6",checkFlag);
 }

 /**
  * �����ϵ��
  * WangWang:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   ��Ӷ����ID
  * @param site  IDǰ׺
  * @param gid   ��ID
  * @param gid   ��֤
  */
 function addWangWangContact(uid,site,gid,verify){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  *****/
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
		return;
	}
	
	var command = "WangWang:AddContact?uid="+uid+"&CntSiteId="+site+"&gid="+gid+"&inner=1&verify="+verify;
	//var checkFlag= (arguments.length==3)?true:false;
	var checkFlag=true;
	execWangWangShell(command,"5.6",checkFlag);
 }


 /**
  * �����ϵ��
  * Alitalk:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   ��Ӷ����ID
  * @param site  IDǰ׺
  * @param gid   ��ID
  */
 function addAlitalkContact(uid,site,gid){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  *****/
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
	}
	
	var command = "Alitalk:AddContact?uid="+decodeURIComponent(uid)+"&CntSiteId="+site+"&gid="+gid+"&inner=1";
	var checkFlag = (arguments.length==3)?true:false;
	execAlitalkShell(command,"5.6",checkFlag);
 }

  /**
  * �����ϵ��
  * Alitalk:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   ��Ӷ����ID
  * @param site  IDǰ׺
  * @param gid   ��ID
  * @param gid   ��֤
  */
 function addAlitalkContact(uid,site,gid,verify){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ��� *****/ 
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
	}
	
	var command = "Alitalk:AddContact?uid="+decodeURIComponent(uid)+"&CntSiteId="+site+"&gid="+gid+"&inner=1&verify="+verify;
	//var checkFlag= (arguments.length==3)?true:false;
	var checkFlag=true;
	execAlitalkShell(command,"5.6",checkFlag);
 }

 /**
  * ���Ա�����Ƕҳ�洰��
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  �û���ID
  * @param url  ��Ƕҳ��URL����Ҫencode��
  * @param openType ���ļ����� 0-> webҳ��  1->�޸��Լ�������   2->�޸ĸ���ͷ��  3->�򿪸�����ҳ�� 4-> ����ͷ��ѡ��ҳ��
  * @param singlecode ��Ҫ�򿪵�ҳ��Ĵ���
  * @param closesinglecode ��Ҫ�رյ�ҳ��Ĵ���
  * @param disabledclose �Ƿ�Ѵ򿪵���ҳ��Ĺرհ�ťdisabled��
  */
 function openPageFromWangWang(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	var command = "WangWang:" + getOpenPageFromPageCommand(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype);
	var checkFlag = (arguments.length<=8)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * ��ó��ͨ����Ƕҳ�洰��
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  �û���ID
  * @param url  ��Ƕҳ��URL����Ҫencode��
  * @param openType ���ļ�����  0-> webҳ��  1->�޸��Լ�������   2->�޸ĸ���ͷ��  3->�򿪸�����ҳ�� 4-> ����ͷ��ѡ��ҳ��
  * @param singlecode ��Ҫ�򿪵�ҳ��Ĵ���
  * @param closesinglecode ��Ҫ�رյ�ҳ��Ĵ���
  * @param disabledclose �Ƿ�Ѵ򿪵���ҳ��Ĺرհ�ťdisabled��
  */
 function openPageFromAlitalk(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
 	var command = "Alitalk:" + getOpenPageFromPageCommand(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype);
	var checkFlag= (arguments.length<=8)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
 }

 /**
  * ��ó��ͨ�����ó��ͨ��Ƕҳ�洰��
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  �û���ID
  * @param url  ��Ƕҳ��URL����Ҫencode��
  * @param openType ���ļ�����  0-> webҳ��  1->�޸��Լ�������   2->�޸ĸ���ͷ��  3->�򿪸�����ҳ�� 4-> ����ͷ��ѡ��ҳ��
  * @param singlecode ��Ҫ�򿪵�ҳ��Ĵ���
  * @param closesinglecode ��Ҫ�رյ�ҳ��Ĵ���
  * @param disabledclose �Ƿ�Ѵ򿪵���ҳ��Ĺرհ�ťdisabled��
  */
 function getOpenPageFromPageCommand(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype) {
	var command = "OpenPageFromPage?inner=1&CurUserId="+uid+"&Url="+url+"&OpenType="+openType+"&title="+title+"&singlecode="+singlecode+"&posttype="+posttype;
	
	command = command + "&closesinglecode=" ;
	if (closesinglecode ) {
		command = command + closesinglecode;
	}
	command = command + "&disableclose=";
	if (disabledclose) {
		command = command + disabledclose;
	}
	return command;
 }

   /**
  * �򿪸��˿�Ƭ
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  �û���ID
  */
 function showInfoCard(uid,posttype){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  ****/
	 if(!isBeforeV6Version()){
		showInfoCardV6(uid);
		return;
	 }
	 var command = "wangwang:ShowInfoCard?userid="+uid+"&posttype="+posttype;
	 var checkFlag = (arguments.length<=2)?true:false;
	 execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * Alitalk�򿪸��˿�Ƭ
  * Alitalk:ShowInfoCard?userid=&postype=1
  * @param uid  �û���ID
  */
 function showInfoCardAlitalk(uid,posttype){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  ****/
	 if(!isBeforeV6Version()){
		showInfoCardV6(uid);
		return;
	 }
	 var command = "Alitalk:ShowInfoCard?userid="+decodeURIComponent(uid)+"&posttype="+posttype;
	 var checkFlag = (arguments.length<=2)?true:false;
	 execAlitalkShell(command,"5.7",checkFlag);
 }

 /**
  * �����ϵ��
  * WangWang:PortraitModified?ModifierId=&CntSiteId=&inner=1
  * @param uid   ����ͷ����û�ID
  */
 function portraitModifiedToWangwang(uid){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	/**** 5.7 ����ʱ����������� start****/
	if(!isBeforeV6Version()){
		/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  *****/
		potraitchangedV6(uid,'');
		return;
	 }
	/**** 5.7 ����ʱ����������� end****/
	 var command = "WangWang:" + getSelectUserFaceCommand(uid,'-1');
	 var checkFlag = (arguments.length==1)?true:false;
	 execWangWangShell(command,"5.7",checkFlag);
 }
 
 /**
  * �����ϵ��
  * Alitalk:PortraitModified?ModifierId=&inner=1
  * @param uid   ����ͷ����û�ID
  */
 function portraitModifiedToAlitalk(uid){//ʹ��ʱ��Ҫ��ִ��shell�����href�����Լ���Ҫ:escape(userId)������userId
	 uid = "cnalichn" + uid;
	 /**** 5.7 ����ʱ����������� start****/
	if(!isBeforeV6Version()){
		/*****  �����ж��Ƿ���6.0��ǰ�汾,�������ִ������Ĵ���  *****/
		potraitchangedV6(uid,'');
		return;
	 }
	/**** 5.7 ����ʱ����������� end****/
	 var command = "Alitalk:" + getSelectUserFaceCommand(uid,'-1');
	 var checkFlag = (arguments.length==1)?true:false;
	 execAlitalkShell(command,"5.7",checkFlag,top.location);
 }
 
/**
 * ֪ͨ���¿ͻ��˵��û�ͷ�� 
 * WangWang:WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   ��ǰ�û�ID ��ID 
 *        selfUrl  �Լ�ͷ���url
 *        othersideUrl  �Է�ͷ���url
 *        selfImgName   �Լ�ͷ�������
 *        otherImgName  �Է�ͷ�������
 *        toId          �Է���ID
 *        singlecode    ����ָ����singlecodeҳ��֮�⣬ȫ��ˢ��  ��Ĭ��Ϊ��--��ȫ��ˢ�� 
 */
function updateLocalUserFaceByWangWang(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "WangWang:" + getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName,otherImgName,toId, singlecode);
	var checkFlag = (arguments.length==7)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
}

/**
 * ֪ͨ���¿ͻ��˵��û�ͷ�� 
 * WangWang:WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   ��ǰ�û�ID ��ID 
 *        selfUrl  �Լ�ͷ���url
 *        othersideUrl  �Է�ͷ���url
 *        selfImgName   �Լ�ͷ�������
 *        otherImgName  �Է�ͷ�������
 *        toId          �Է���ID
 *        singlecode    ����ָ����singlecodeҳ��֮�⣬ȫ��ˢ��  ��Ĭ��Ϊ��--��ȫ��ˢ�� 
 */
function updateLocalUserFaceByAlitalk(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "Alitalk:" + getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode);
	var checkFlag = (arguments.length==7)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
}

/**
 * ����֪ͨ���¿ͻ��˵��û�ͷ�� 
 * WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   ��ǰ�û�ID ��ID 
 *        selfUrl  �Լ�ͷ���url
 *        othersideUrl  �Է�ͷ���url
 *        selfImgName   �Լ�ͷ�������
 *        otherImgName  �Է�ͷ�������
 *        toId          �Է���ID
 *        singlecode    ����ָ����singlecodeҳ��֮�⣬ȫ��ˢ��  ��Ĭ��Ϊ��--��ȫ��ˢ�� 
 */
function getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "";
	//�����Ҫ�����Լ���ͷ��
	if (selfUrl) {
		command += "self:" + selfUrl + ";";
	}
	//�����Ҫ���¶Է���ͷ��
	if (othersideUrl) {
		command += "otherside:" + othersideUrl + ";";
	}
	if(selfImgName) {
		command += "selfimgname:" + selfImgName + ";";
	}
	if (otherImgName) {
		command += "otherimgname:" + otherImgName + ";";
	}
	if (toId) {
		command += "toid:" + toId + ";";
	}
	if (singlecode)
	{
		command += "singlecode:" + singlecode + ";";
	}
	var length = command.length;
	if (command != "") {
		command = command.substr(0,  length -1);
	}
	command = "WebPageResult?ResultType=4&ResultContent=" + command + "&CurUserId="+curUid;
	return command;
}

/**
 *	���ɲ鿴Ⱥ���ϵ�shell����
 *  @param methodVer   ִ�з����İ汾,����'Alitalk','WangWang'
 *  @param uid   �û���ID
 *	@param url ��Ƕҳ��URL����Ҫencode��
 **/
 function execViewTribeCmd(methodVer,uid,url){
	var checkFlag = (arguments.length==3)?true:false;
	if(methodVer=='Alitalk'){
		var command ="Alitalk:OpenPageFromPage?CurUserId="+uid+"&OpenType=5&singlecode=webim_tribe_search_result&title=%E7%BE%A4%E8%B5%84%E6%96%99"+"&Url="+url;
		execWangWangShell(command,"5.7",checkFlag);
	}else if(methodVer=='WangWang'){
		var command ="WangWang:OpenPageFromPage?CurUserId="+uid+"&OpenType=5&singlecode=webim_tribe_search_result&title=%E7%BE%A4%E8%B5%84%E6%96%99"+"&Url="+url;
		execWangWangShell(command,"5.7",checkFlag);
	}
	return true;
 }
 /*********************************************************************************************************************/

 /**
 * �Զ����������
 * @param httpRootPath ·��
 * @param filesInfo �Զ�������ַ���
 *     ��ʽ��img1name:img1path.gif||img2name:img2path.jpg||img3name:img3path.jpg
 * @param uid �û�ID
 */
 function downEmotions(httpRootPath,filesInfo,uid){
	try
	{
		var sendValue = 'download:"'+httpRootPath+'"';
		var paramArray = new Array();
		if(filesInfo!=null && filesInfo!=""){
			paramArray = filesInfo.split("||");
			for(var i=0; i<paramArray.length; i++){
				var param = paramArray[i];
				if(param!=null && param!=""){
					sendValue += '"'+param+'"';
				}
			}
		}
		document.getElementById("tianxiaSendIframe").src=sendValue;
	}
	catch (e)
	{

	}

 }

function getSite(masterId){
	var site ="";
	masterId = masterId.replace(/^\s+|\s+$/g,"");
	if(masterId.indexOf("cnalichn")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("cntaobao")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("chnyahoo")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("cnkoubei")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("cnwujing")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("chnaigou")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("cntbbtoc")>=0){
		site =  masterId.substr(0,8);
	}else if(masterId.indexOf("wangwang")>=0){
		site =  masterId.substr(0,8);
	}
	return site;
}



 /**
 * ֪ͨ�ͻ����û�ѡ����ĳ��ͼƬ��Ȼ��ˢ���û���ͷ��ѡ��ҳ��[����ʾ��վͼƬ������ʾ������]
 * �������ֻ���ṩ���ͻ�����Ƕҳ��ʹ��,��Ϊ��ǰID�Ĳ�����������Ϊ��
 * @param uid �û�ID
 * @param picMdName �Զ���ͼƬ��md5����
 * 
 */
 function selectUserFace( uid , picMdName ) {
	uid = uid.replace(/^\s+|\s+$/g,"");
	//�����ó��ͨ�û�
	if(uid.indexOf("cnalichn")>=0){
		//selectUserFaceByAlitalk(uid , picMdName);
		selectUserFaceByAlitalk("" , picMdName);
	//�����taobao�û�
	}else if(uid.indexOf("cntaobao")>=0){
		//selectUserFaceByWangWang(uid , picMdName);
		selectUserFaceByWangWang("" , picMdName);
	}

 }

 /**
 * ֪ͨ�ͻ����û�ѡ����ĳ��ҳ�棬Ȼ��ˢ���û���ͷ��ѡ��ҳ��[����ʾ��վͼƬ������ʾ������]
 * @param uid �û�ID
 * @param picMdName �Զ���ͼƬ��md5����
 * 
 */
 function selectUserFaceByWangWang( uid , picMdName ) {
	var command = "WangWang:" + getSelectUserFaceCommand(uid , picMdName);
	var checkFlag = (arguments.length==2)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

/**
 * ֪ͨ�ͻ����û�ѡ����ĳ��ҳ�棬Ȼ��ˢ���û���ͷ��ѡ��ҳ��[����ʾ��վͼƬ������ʾ������]
 * @param uid �û�ID
 * @param picMdName �Զ���ͼƬ��md5����
 * 
 */
 function selectUserFaceByAlitalk( uid , picMdName ) {
	var command = "Alitalk:" + getSelectUserFaceCommand(uid , picMdName);
	var checkFlag = (arguments.length==2)?true:false;
	execAlitalkShell(command,"5.7",checkFlag,top.location);
 }

/**
 * ���������¹��ܵ�shell
 * ֪ͨ�ͻ����û�ѡ����ĳ��ҳ�棬Ȼ��ˢ���û���ͷ��ѡ��ҳ��[����ʾ��վͼƬ������ʾ������]
 * @param uid �û�ID
 * @param picMdName �Զ���ͼƬ��md5����
 * 
 */
 function getSelectUserFaceCommand( uid , picMdName ) {
	//WangWang:WebPageResult?ResultType=5&ResultContent=close:1;openurl:http://ww.sina.com&CurUserId=&singlecode=&title=

	var targetUrl ="http%3A%2F%2Fwww2.im.alisoft.com%2Fwebim%2Fperson%2FselectUserFace.htm%3Fimghashcode%3D"
	
	if (picMdName){
		targetUrl += picMdName;
	}
	targetUrl = targetUrl + "%26random%3D" + Math.floor(Math.random()*100000);
	targetUrl +="%26height%3D290%26width%3D411";
	var targetTitle='';
	
	var command = getOpenPageFromPageCommand(uid,targetUrl,5,targetTitle,'ChooseImage','webim_person_face_select','1');
	return command;
}

/**
 * ֪ͨ�ͻ����Ѿ�ѡ�е�ͷ�����ͣ������������ģ����ͼƬ��urlҲ���ݹ�ȥ
 * @param uid �û�ID
 * @param imageType ѡ�е�ͷ������
 * @param imageUrl ͼƬ��url
 */
 function noteClientUpdateImageByWangWang(uid, imageType, imageUrl, imgName) {
	var command = "WangWang:" + getNoteClientUpdateImageCommand(uid, imageType, imageUrl, imgName);
	var checkFlag = (arguments.length==4)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

/**
 * ֪ͨ�ͻ����Ѿ�ѡ�е�ͷ�����ͣ������������ģ����ͼƬ��urlҲ���ݹ�ȥ
 * @param uid �û�ID
 * @param imageType ѡ�е�ͷ������
 * @param imageUrl ͼƬ��url
 */
 function noteClientUpdateImageByAlitalk(uid, imageType, imageUrl, imgName) {
	var command = "Alitalk:" + getNoteClientUpdateImageCommand(uid, imageType, imageUrl, imgName);
	var checkFlag = (arguments.length==4)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
 }

/**
 * ���������¹��ܵ�shell
 * ֪ͨ�ͻ����Ѿ�ѡ�е�ͷ�����ͣ������������ģ����ͼƬ��urlҲ���ݹ�ȥ
 * @param uid �û�ID
 * @param imageType ѡ�е�ͷ������
 * @param imageUrl ͼƬ��url
 * @param imgName  ͼƬ������= imgHashCode + . + suffixName
 */
 function getNoteClientUpdateImageCommand( uid, imageType, imageUrl, imgName ) {
	
	//WangWang:WebPageResult?ResultType=5&ResultContent=close:1;select:1;imgName:123456789445679.swf;imgUrl:http://www.im.alisoft.com/12345.swf &CurUserId= singlecode=&title=
	var command = "WebPageResult?ResultType=5&ResultContent=select:";
	if ( imageType ) {
		command += imageType;
	}
	command += ";imgName:";
	if(imgName) {
		command += imgName;
	}
	command += ";imgUrl:";
	if (imageUrl) {
		command += imageUrl;
	}
	command += "&CurUserId=";
	if ( uid ) {
		command += uid;
	}
	
	command += "&closesinglecode=ChooseImage";
	return command;
 }
 
 /**
 * �ر�ָ��singlecode��ҳ��
 * @param uid �û�ID
 * @param singlecode ҳ���singlecode
 */
 function closeWangWangWindow(uid, singlecode) {
 	
	uid = uid.replace(/^\s+|\s+$/g,"");
	//�����ó��ͨ�û�
	if(uid.indexOf("cnalichn")>=0){
		closeWindowByAlitalk(uid , singlecode);
	//�����taobao�û�
	}else if(uid.indexOf("cntaobao")>=0){
		closeWindowByWangWang(uid , singlecode);
	}
 }
 
 /**
 * �ر�ָ��singlecode��ҳ��
 * @param uid �û�ID
 * @param closesinglecode ҳ���singlecode
 */
 function closeWindowByWangWang(uid, closesinglecode) {
	var command = "WangWang:" + getCloseWindowCommand(uid, closesinglecode);
	var checkFlag = (arguments.length==2)?true:false;
	execWangWangShell(command,"5.7",checkFlag,top.location);
 }

/**
 * �ر�ָ��singlecode��ҳ��
 * @param uid �û�ID
 * @param singlecode ҳ���singlecode
 */
 function closeWindowByAlitalk(uid, closesinglecode) {
	var command = "Alitalk:" + getCloseWindowCommand(uid, closesinglecode);
	var checkFlag = (arguments.length==2)?true:false;
	execAlitalkShell(command,"5.7",checkFlag,top.location);
 }
 
/**
 * ȡ�ùر�ָ��singlecode��ҳ���shell
 * WebPageResult?CurUserId=��ǰ�û�ID&singlecode=Ҫ�رյ�ҳ��Ĵ���
 * @param uid �û�ID
 * @param closesinglecode ҳ���singlecode
 */
 function getCloseWindowCommand(uid, closesinglecode) {
 	var command = "WebPageResult?ResultType=0&CurUserId=";
 	if (uid) {
 		command += uid;
 	}
 	command += "&closesinglecode=";
 	if (closesinglecode) {
 		command += closesinglecode;
 	}
 	return command;
 }
 
 /**
  *	ִ��������shell����
  * @param command   shell����
  * @param versionNo   �汾
  * @param checkFlag   �汾У��:true,��У��;flase,У��
  * @param selectLocation ָ����λ��(Ĭ��:window.location),���Σ�����ʱ����Բ�д;�����Ҫ���ò�������λ�ڲ����ĵ��ĸ�
  *						����:execWangWangShell('WangWang:','5.7',true)-----����Ĭ�ϵ�window.location
  *							 execWangWangShell('WangWang:','5.7',flase,top.location)-----ʹ��top.location����shell����
  **/
 function execWangWangShell(command,versionNo,checkFlag){
		var selectLocation = window.location;
		if(arguments.length==4){
			selectLocation=arguments[3];
		}
		if(checkFlag){
			selectLocation.href=command;
		}else{
			execWangWangShellInLocation(command,versionNo,selectLocation);
		}
 }

/**
 * ִ��ó��ͨ��shell����
 * @param command   shell����
 * @param versionNo   �汾
 * @param checkFlag   �汾У��:true,��У��;flase,У��
 * @param selectLocation ָ����λ��(Ĭ��:window.location),���Σ�����ʱ����Բ�д;�����Ҫ���ò�������λ�ڲ����ĵ��ĸ�
 *						����:execAlitalkShell('Alitalk:','5.7',true)-----����Ĭ�ϵ�window.location
 *							 execAlitalkShell('Alitalk:','5.7',flase,top.location)-----ʹ��top.location����shell����
 **/
 function execAlitalkShell(command,versionNo,checkFlag) {
	var selectLocation = window.location;
	if(arguments.length==4){
		selectLocation=arguments[3];
	}
	if(checkFlag){
		selectLocation.href=command;
	}else{
		execAlitalkShellInLocation(command,versionNo,selectLocation);
	}
 }

 /**
  *	ִ��������shell����
  * @param command   shell����
  * @param versionNo   �汾
  * @param selectLocation ָ����λ��
  **/
 function execWangWangShellInLocation(command,versionNo,selectLocation){
	 try{
		var obj = new ActiveXObject("WangWangX.WangWangObj");
			  if(obj != null){
				  var version = obj.GetVersionStr();
				  var fstChar = version.charAt(0);
                  if(fstChar != "R" && version >= versionNo) {
						 selectLocation.href = command;
                  }else {
				  		 showWangwangErrMsg(0);
                  }			
			  }else{
				  showWangwangErrMsg(1);
			  }
		}catch(e){
			showWangwangErrMsg(2);
		}
 }

/**
 * ִ��ó��ͨ��shell����
 * @param command   shell����
 * @param versionNo   �汾
 * @param selectLocation ָ����λ��
 **/
 function execAlitalkShellInLocation(command,versionNo,selectLocation) {
	 try{
			var obj=new ActiveXObject("Ali_Check.InfoCheck");
			if(obj != null){
				var mver=obj.GetValueBykey("AliTalkVersion");
				if(mver >=versionNo){
					selectLocation.href = command;
				}else{
					 showAlitalkErrMsg(0);
				}			
			 }else{
				  showAlitalkErrMsg(1);
			 }
	}catch(e){
		showAlitalkErrMsg(2);
	}
 }

/****************************5.7+ ͷ�� ********************************/
function getShowTypeCommand(uid, showType) {
	
	var command = "WebPageResult?ResultType=5&ResultContent=select:1";
	command += ";status:";
	if(showType) {
		command += showType;
	}
	command += "&CurUserId=";
	if ( uid ) {
		command += uid;
	}
	command += "&closesinglecode=";
	return command;
}

function noteShowTypeWangWang(uid, showType) {
	var command = "WangWang:" + getShowTypeCommand(uid, showType);
	var checkFlag = (arguments.length==2)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
}

function noteShowTypeAlitalk(uid, showType) {
	var command = "Alitalk:" + getShowTypeCommand(uid, showType);
	var checkFlag = (arguments.length==2)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
}

/**
 * �ͻ����ϴ��ļ�����������
 * @param fromSite �����û�վ��
 * @param fromUid �����û�վ��
 * @param toSite �����û�վ��
 * @param toUid �����û�վ��
 * @param url �����û�վ��
 * @param moreProperties �����û�վ��
 **/
function clientUpload( fromSite, fromUid, toSite, toUid, url, moreProperties ) {
    var selectLocation = window.location;
	if(arguments.length == 7){
		selectLocation=arguments[6];
	}
	var shell;
	// ������Ա��ʺ�
	if ( fromSite == "cntaobao" ) {
        shell = "wangwang:upload?userid=" + toSite + toUid + "&url=" + url;
    } else {
        shell = "alitalk:upload?userid=" + toSite + toUid + "&url=" + url;
    }
    selectLocation.href = shell;
}

/***************************************6.0 start*****************************************/

/*****
*	v 6.0�淶
*	�����û�id���ǳ�id��
*	�����ַ�������utf-8����
*	ͨ�ò�����
*	uid����ǰ��¼�û���id���Լ���id��
*	touid���Է��û���id��
*/


/***
* ȡ�ö�ID
***/
function getSiteLoginId(masterId){
	masterId = masterId.replace(/^\s+|\s+$/g,"");
	if(masterId.length>8){
		masterId = masterId.substr(8);
	}
	return "";
}

/****
* ȡ�������汾 6.0�Ժ����
****/
function getAliimVersionV6(){
	try{
		var wwx = new ActiveXObject("aliimx.wangwangx");
		if(wwx != null){
			var version = wwx.GetWangWangVersion();
			return version;		
		 }else{
			return -1
		 }
	}catch(e){
		return -1;
	}
}

/****
**  ִ��������shell����  v6����
*****/
function execAliimShellV6(command){
	window.location.href = command;
}


/***** �����ϵ�� 
 * �����ʽ��aliim:addcontact? uid=***&touid=***&gid=***
 ***/
 function addContactV6(uid,touid,gid,version){
	 try{
			var command = "aliim:addcontact?uid="+uid+"&touid="+touid+"&gid="+gid+"&version="+version;
			execAliimShellV6(command);
			return;
	 }catch(e){
		//alert('����6.0shell����!');
	 }
 }

 /***** �����ϵ�� 
 * �����ʽ��aliim:addcontact? uid=***&touid=***&gid=***&
 ***/
 function addContactV6(uid,touid,gid,verify,version){
	 try{
			var command = "aliim:addcontact?uid="+uid+"&touid="+touid+"&gid="+gid+"&verify="+verify+"&version="+version;
			execAliimShellV6(command);
			return;
	 }catch(e){
		//alert('����6.0shell����!');
	 }
 }

/***** ��Ϣ����
 *** �����ʽ��aliim:sendmsg? uid=***&touid=***&gid=***&url1=***&url2=***&siteid=****&status=1
 ***/
function sendMsgV6(uid,touid,gid,siteid,status,version){
	try{
			var command = "aliim:sendmsg?uid="+uid+"&touid="+touid+"&gid="+gid+"&siteid"+siteid+"&status="+status+"&version="+version;
			execAliimShellV6(command);
			//wwx.ExecCmd(command);
			return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/***** ͷ��ˢ��
*aliim:potraitchanged? uid=***&stamp=****
***/
function potraitchangedV6(uid,stamp,version){
	try{
			var command = "aliim:potraitchanged?uid="+uid+"&stamp="+stamp+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/***** �û����޸�
*aliim:namechanged? uid=***&name=***
***/
function namechangedV6(uid,name,version){
	try{
			var command = "aliim:namechanged?uid="+uid+"&name="+name+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/***** ͷ���޸�
* aliim:editpotrait?uid=
***/
function editPotraitV6(uid,version){
	try{
			var command = "aliim:editpotrait?uid="+uid+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/***** ������Ƭ
* aliim:showinfocard? uid=***
****/
function showInfoCardV6(uid,version){
	try{
		var command = "aliim:showinfocard?uid="+uid+"&version="+version;
		if(arguments.length==3){
			command += "&place="+arguments[2];
		}
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}


/*******
** �޸�����
** �����ʽ��aliim:changegroup? uid=***&fid=***&gid=***&dispname=***
******/
function changeGroupV6(uid,fid,gid,dispname,version){
	try{
		var command = "aliim:changegroup?uid="+uid+"&fid="+fid+"&gid="+gid+"&dispname="+dispname+"&version="+version;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/*******
** ��������
** �����ʽ��aliim:openmyinfo? uid=***
******/
function editPersonInfoV6(uid,version){
	try{
		var command = "aliim:openmyinfo?uid="+uid+"&version="+version;
		if(arguments.length==3){
			command += "&pageflag="+arguments[2];
		}
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/**
 * what 's new �����ʽ��aliim:whatsnew?uid=***&tabid=***
 **/
function whatsnew(uid,tabid){
	try{
		var command = "aliim:whatsnew?uid="+uid+"&tabid="+tabid;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

/**
**�����װ
**aliim:pluginmanager_install? pluginid=***&loadurl=***
**/
function  installPlugin(uid,pluginId,pluginName,version){
	try{
		var command = "aliim:pluginmanager_install?uid="+uid+"pluginid="+pluginId+"&pluginname="+pluginName+"&version="+version;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}


/**
*  �ж��Ƿ�װ��6.0��ǰ�汾
****/
function isBeforeV6Version(){
	var ver = "";
	try{
		ver = getCookie("ShellVersion");
	}catch(e){
	}
	if(ver==null || ver=="" || ver=="undefined"){
		return true;
	}else{
		return false;
	}
	return false;
}

/**
*  �ж��Ƿ�װ��6.0��ǰ�汾
****/
function isInstallV6Version(){
	try{
		var obj=new ActiveXObject("Ali_Check.InfoCheck");
		if(obj != null){
			var mver=obj.GetValueBykey("AliTalkVersion");
			if(mver <"6.0"){
				return true;
			}			
		 }
	}catch(e){
	}
	try{
		var obj = new ActiveXObject("WangWangX.WangWangObj");
		  if(obj != null){
			  var version = obj.GetVersionStr();
			  var fstChar = version.charAt(0);
			  if(fstChar != "R" && version < "6.0") {
					 return true;
			  }			
		  }
		}catch(e){
		}

	return false;
}


//20071218 modify  ����ͷ��ͼƬ�����Զ�����ͷ���С
function formatImg(imgId,width,height){
	var obj = document.getElementById(imgId);
	var imgObj=new Image();
	var n = false;
	imgObj.onload= function(){
		if(n){
			return ;
		}
		n = true;
		var h = imgObj.height;
		var w = imgObj.width;
		if(h<=5 && w<=5){
			obj.src="http://www.im.alisoft.com/webim/person/images/120.gif";
		}
		if(h*width<=w*height){
			obj.width = width;
			obj.height = h * height / w ;
		}
		else if(h*width>w*height){
			obj.height = height;
			obj.width = width * w / h;
		}
		imgObj = null;
	}
	imgObj.onerror=function(){
		obj.src="http://www.im.alisoft.com/webim/person/images/120.gif";
	}
	imgObj.src = obj.src;
}

function formatImg2(imgId,width,height,errorImg){
	var obj = document.getElementById(imgId);
	var imgObj=new Image();
	var n = false;
	imgObj.onload= function(){
		if(n){
			return ;
		}
		n = true;
		var h = imgObj.height;
		var w = imgObj.width;
		if(h<=5 && w<=5){
			obj.src=errorImg;
		}
		if(h*width<=w*height){
			obj.width = width;
			obj.height = h * height / w ;
		}
		else if(h*width>w*height){
			obj.height = height;
			obj.width = width * w / h;
		}
		imgObj = null;
	}

	imgObj.onerror=function(){
		obj.src=errorImg;
	}
	imgObj.src = obj.src;	
}

function formatImg3(imgId,width,height,errorImg){
	var obj = document.getElementById(imgId);
	var imgObj3=new Image();
	var n = false;
	imgObj3.onload= function(){
		if(n){
			return ;
		}
		n = true;
		var h = imgObj3.height;
		var w = imgObj3.width;
		if(h>w){
			if(h>height){
				obj.height = height;
			}else{
				obj.height = h;
			}
		}
		else{
			if(w>width){
				obj.width = width;
			}
			else{
				obj.width = w;
			}
		}
		imgObj3 = null;
	}

	imgObj3.onerror=function(){
		if(errorImg){
			obj.src=errorImg;
		}
	}
	var d=new Date();
	imgObj3.src = obj.src+"?t="+d.getTime();	
}

//aliim:login?uid=***&token=***&autologin=1/0&weblogin=1/0
function aliimLoginV6(uid,token){
	try{
			var command = "aliim:login?uid="+uid+"&token="+token+"&autologin=1&weblogin=0";
			execAliimShellV6(command);
		return;
	}catch(e){
		//alert('����6.0shell����!');
	}
}

//aliim:bindwangid
function aliimBindWangid(){
	try{
		var command = "aliim:bindwangid";
		execAliimShellV6(command);
		return;
	}catch(e){
	}
}

//aliim:smsinternalsendmsg
function aliimSendSms(content){
	self.location.href = 'aliim:smscharset?info='+content;
}

//aliim:smsinternalsendmsg
function aliimSendInternalSms(uid){
	self.location.href = 'aliim:smsinternalsendmsg?touid='+uid;
}


function getCookie(objName){//��ȡָ�����Ƶ�cookie��ֵ
    var arrStr = document.cookie.split("; ");
    for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == objName) return unescape(temp[1]);
    } 
}

 function allCookie(){//��ȡ���б����cookie�ַ���
    var str = document.cookie;
    if(str == ""){
     str = "û�б����κ�cookie";
    }
    //alert(str);
 }

 function addCookie(objName,objValue,objHours){//���cookie
    var str = objName + "=" + escape(objValue);
    if(objHours > 0){//Ϊ0ʱ���趨����ʱ�䣬������ر�ʱcookie�Զ���ʧ
     var date = new Date();
     var ms = objHours*3600*1000;
     date.setTime(date.getTime() + ms);
     str += "; expires=" + date.toGMTString();
	 str += "; path=/";
	 str += "; domain=alisoft.com";
    }
    document.cookie = str;
    //alert("���cookie�ɹ�");
}

/**
*  ����showtype
*/
function setShowTypeV6(uid,showtype){
	try{
		var command = "Aliim:imageshow_showtype?uid="+uid+"&showtype="+showtype;
		execAliimShellV6(command);
		return;
	}catch(e){
	}
	
}

/**
*  �����������㴰��
*/
function myShowSetV6(uid,param,flag){
	try{
		var url = '';
		if(flag=="myshow"){
			url = "http://www2.im.alisoft.com/webim/personv6/setMyShow.htm?type=myshow";
			if(param){
				if(param.substring(0,1)=="&"){
					url += param;
				}
				else{
					url = url + "&" +param;
				}
			}
		}
		else if(flag=="magicface"){
			url = "http://www2.im.alisoft.com/webim/personv6/setMyShow.htm?type=magicface";
		}
		var command = "Aliim:imageshow_setpage?uid="+uid+"&url="+encodeURIComponent(url);
		execAliimShellV6(command);
		return;
	}catch(e){
	}
	
}

/**
*  ˢ��MyShow
*/
function updateMyShowV6(uid,filePath,fileName){
	try{
		var command = "Aliim:imageshow_download?uid="+uid+"&url="+filePath+"&filename="+fileName;
		execAliimShellV6(command);
		return;
	}catch(e){
	}
	
}

/**
*  ˢ�¸�������ҳ��
*/
function refreshMyInfoV6(uid,filehashcode){
	try{
		var command = "Aliim:imageshow_updateshow?uid=&filehashcode="+filehashcode;
		execAliimShellV6(command);
		return;
	}catch(e){
	}
	
}

/**
*  �򿪸���ħ�����鴰��
*/
function magicFaceSetV6(uid){
	try{
		myShowSetV6(uid,"","magicface");
	}catch(e){
	}
	
}

/**
*  �ղ�ħ������
*/
function collectionMagicFace(info){
	try{
		var command = "transferinfo:func=setCollection&form=myShow&info="+encodeURIComponent(info);
		execAliimShellV6(command);
	}catch(e){
	}
	
}

/**
*  ��ָ��URL
*  param
*    url:��Ҫ�򿪵�URL��url��ԭ������&�ģ���*�滻  UTF-8 encodeURIComponent
*    title:����title  UTF-8 encodeURIComponent
*    showmax:�Ƿ�������� 0 or 1
*    showmin:�Ƿ�������� 0 or 1
*    canchangesize:�Ƿ�����ı䴰�ڴ�С 0 or 1
*    width�����ڿ�
*    height�����ڸ�
*    pos:���ڴ�λ��
          SHOW_WIN_CENTER = 1,
          SHOW_WIN_LEFTTOP = 2,
          SHOW_WIN_RIGHTTOP = 3,
          SHOW_WIN_LEFTDOWN = 4,
          SHOW_WIN_RIGHTDOWN = 5
*    openoneonly:ֻ��һ������ 0 or 1
*/
function showInnerIeV6(url,title,showmax,showmin,canchangesize,width,height,pos,openoneonly){
	try{
		if(showmax==null || showmax==""){
			showmax = "0";
		}
		if(showmin==null || showmin==""){
			showmin = "0";
		}
		if(canchangesize==null || canchangesize==""){
			canchangesize = "0";
		}
		if(openoneonly==null || openoneonly==""){
			openoneonly = "0";
		}
		if(pos==null || pos==""){
			pos = "1";
		}

		var command = "Aliim:showinnerie?";
		command += "title="+title;
		command += "&showmax="+showmax;
		command += "&showmin="+showmin;
		command += "&canchangesize="+canchangesize;
		command += "&url="+url;
		command += "&width="+width;
		command += "&height="+height;
		command += "&pos="+pos;
		command += "&openoneonly="+openoneonly;
		execAliimShellV6(command);
		return;
	}catch(e){
	}
	
}

/****************************************6.0 end******************************************/

/**
 * �򿪶��ų�ֵҳ�� 20080610
 * @param moreProperties ��ע��Ϣ
 **/
function chargeAlitalkMobile( moreProperties ){
	var selectLocation = window.location;
	if(arguments.length==2){
		selectLocation=arguments[1];
	}
	var shell = "alitalk:ChargeMobile";
	selectLocation.href = shell;
}