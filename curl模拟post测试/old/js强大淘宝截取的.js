/**
  * 处理头像加载错误的
  * @param obj   联系人ID
  * @param newImgUrl  新的url地址
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
  * 修改用户的昵称，所属分组
  * WangWang:ModifyCntInfo?CntId=&GroupId=&Nick=
  * @param contactId   联系人ID
  * @param groupId     组ID
  * @param nickname    昵称
  */
 function modifyWangWangCntInfo(contactId,groupId,nickname){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
 	var command = "WangWang:ModifyCntInfo?CntId="+ contactId +"&GroupId="+ groupId +"&Nick="+ nickname;
	var checkFlag= (arguments.length==3)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * 淘宝旺旺错误消息，并跳转到淘宝的下载页面
  *
  * WangWang:ModifyCntInfo?CntId=&GroupId=&Nick=
  * @param flag   0 --> 版本过旧
  *               1 --> 没有安装阿里旺旺
  *               2 --> 你的阿里旺旺版本有问题,请下载最新版阿里旺旺！
  */
 function showWangwangErrMsg( flag ) {
	if ( flag == 0 ) {
		 alert("你的版本过旧，没有该功能，请下载最新版本!");
		 window.target = "_blank";
		 window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	} else if( flag == 1 ) {
		alert("你没有安装阿里旺旺,请下载阿里旺旺!")
		window.target = "_blank";
		window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	} else if( flag == 2 ) {
		alert("你的阿里旺旺版本有问题,请下载最新版阿里旺旺！")
		window.target = "_blank";
		window.open("http://www.taobao.com/help/wangwang/wangwang.php");
	}
 }

 /**
  * 贸易通错误消息，并跳转到贸易通的下载页面
  *
  * @param flag   0 --> 版本过旧
  *               1 --> 没有安装阿里旺旺
  *               2 --> 你的阿里旺旺版本有问题,请下载最新版阿里旺旺！
  */
 function showAlitalkErrMsg( flag ) {
	if ( flag == 0 ) {
		 alert("你的版本过旧，没有该功能，请下载最新版本!");
		 window.target = "_blank";
		 window.open("http://alitalk.alibaba.com.cn/index.html");
	} else if( flag == 1 ) {
		alert("你没有安装阿里旺旺,请下载阿里旺旺!")
		window.target = "_blank";
		window.open("http://alitalk.alibaba.com.cn/index.html");
	} else if( flag == 2 ) {
		alert("你的阿里旺旺版本有问题,请下载最新版阿里旺旺！")
		window.target = "_blank";
		window.open("http://alitalk.alibaba.com.cn/index.html");
	}
 }

 /**
  * 添加联系人
  * WangWang:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   添加对象短ID
  * @param site  ID前缀
  * @param gid   组ID
  */
 function addWangWangContact(uid,site,gid){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  *****/
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
		return;
	}

	var command = "WangWang:AddContact?uid="+uid+"&CntSiteId="+site+"&gid="+gid+"&inner=1";
	var checkFlag= (arguments.length==3)?true:false;
	execWangWangShell(command,"5.6",checkFlag);
 }

 /**
  * 添加联系人
  * WangWang:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   添加对象短ID
  * @param site  ID前缀
  * @param gid   组ID
  * @param gid   验证
  */
 function addWangWangContact(uid,site,gid,verify){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  *****/
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
  * 添加联系人
  * Alitalk:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   添加对象短ID
  * @param site  ID前缀
  * @param gid   组ID
  */
 function addAlitalkContact(uid,site,gid){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  *****/
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
	}
	
	var command = "Alitalk:AddContact?uid="+decodeURIComponent(uid)+"&CntSiteId="+site+"&gid="+gid+"&inner=1";
	var checkFlag = (arguments.length==3)?true:false;
	execAlitalkShell(command,"5.6",checkFlag);
 }

  /**
  * 添加联系人
  * Alitalk:AddContact?uid=&CntSiteId=&gid=&inner=1
  * @param uid   添加对象短ID
  * @param site  ID前缀
  * @param gid   组ID
  * @param gid   验证
  */
 function addAlitalkContact(uid,site,gid,verify){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码 *****/ 
	if(!isBeforeV6Version()){
		addContactV6('',site+uid,gid);
	}
	
	var command = "Alitalk:AddContact?uid="+decodeURIComponent(uid)+"&CntSiteId="+site+"&gid="+gid+"&inner=1&verify="+verify;
	//var checkFlag= (arguments.length==3)?true:false;
	var checkFlag=true;
	execAlitalkShell(command,"5.6",checkFlag);
 }

 /**
  * 打开淘宝版内嵌页面窗口
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  用户长ID
  * @param url  内嵌页面URL（需要encode）
  * @param openType 打开文件类型 0-> web页面  1->修改自己的资料   2->修改个人头像  3->打开个人秀页面 4-> 个人头像选择页面
  * @param singlecode 将要打开的页面的代码
  * @param closesinglecode 需要关闭的页面的代码
  * @param disabledclose 是否把打开的新页面的关闭按钮disabled掉
  */
 function openPageFromWangWang(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	var command = "WangWang:" + getOpenPageFromPageCommand(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype);
	var checkFlag = (arguments.length<=8)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * 打开贸易通版内嵌页面窗口
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  用户长ID
  * @param url  内嵌页面URL（需要encode）
  * @param openType 打开文件类型  0-> web页面  1->修改自己的资料   2->修改个人头像  3->打开个人秀页面 4-> 个人头像选择页面
  * @param singlecode 将要打开的页面的代码
  * @param closesinglecode 需要关闭的页面的代码
  * @param disabledclose 是否把打开的新页面的关闭按钮disabled掉
  */
 function openPageFromAlitalk(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
 	var command = "Alitalk:" + getOpenPageFromPageCommand(uid,url,openType,title,singlecode,closesinglecode,disabledclose,posttype);
	var checkFlag= (arguments.length<=8)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
 }

 /**
  * 打开贸易通版或者贸易通内嵌页面窗口
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  用户长ID
  * @param url  内嵌页面URL（需要encode）
  * @param openType 打开文件类型  0-> web页面  1->修改自己的资料   2->修改个人头像  3->打开个人秀页面 4-> 个人头像选择页面
  * @param singlecode 将要打开的页面的代码
  * @param closesinglecode 需要关闭的页面的代码
  * @param disabledclose 是否把打开的新页面的关闭按钮disabled掉
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
  * 打开个人卡片
  * WangWang:AddContact?uid=&CntSiteId=&inner=1
  * @param uid  用户长ID
  */
 function showInfoCard(uid,posttype){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  ****/
	 if(!isBeforeV6Version()){
		showInfoCardV6(uid);
		return;
	 }
	 var command = "wangwang:ShowInfoCard?userid="+uid+"&posttype="+posttype;
	 var checkFlag = (arguments.length<=2)?true:false;
	 execWangWangShell(command,"5.7",checkFlag);
 }

 /**
  * Alitalk打开个人卡片
  * Alitalk:ShowInfoCard?userid=&postype=1
  * @param uid  用户长ID
  */
 function showInfoCardAlitalk(uid,posttype){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  ****/
	 if(!isBeforeV6Version()){
		showInfoCardV6(uid);
		return;
	 }
	 var command = "Alitalk:ShowInfoCard?userid="+decodeURIComponent(uid)+"&posttype="+posttype;
	 var checkFlag = (arguments.length<=2)?true:false;
	 execAlitalkShell(command,"5.7",checkFlag);
 }

 /**
  * 添加联系人
  * WangWang:PortraitModified?ModifierId=&CntSiteId=&inner=1
  * @param uid   更改头像的用户ID
  */
 function portraitModifiedToWangwang(uid){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	/**** 5.7 发布时不带这块内容 start****/
	if(!isBeforeV6Version()){
		/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  *****/
		potraitchangedV6(uid,'');
		return;
	 }
	/**** 5.7 发布时不带这块内容 end****/
	 var command = "WangWang:" + getSelectUserFaceCommand(uid,'-1');
	 var checkFlag = (arguments.length==1)?true:false;
	 execWangWangShell(command,"5.7",checkFlag);
 }
 
 /**
  * 添加联系人
  * Alitalk:PortraitModified?ModifierId=&inner=1
  * @param uid   更改头像的用户ID
  */
 function portraitModifiedToAlitalk(uid){//使用时需要传执行shell命令的href对象以及需要:escape(userId)编码后的userId
	 uid = "cnalichn" + uid;
	 /**** 5.7 发布时不带这块内容 start****/
	if(!isBeforeV6Version()){
		/*****  首先判断是否有6.0以前版本,否则继续执行下面的代码  *****/
		potraitchangedV6(uid,'');
		return;
	 }
	/**** 5.7 发布时不带这块内容 end****/
	 var command = "Alitalk:" + getSelectUserFaceCommand(uid,'-1');
	 var checkFlag = (arguments.length==1)?true:false;
	 execAlitalkShell(command,"5.7",checkFlag,top.location);
 }
 
/**
 * 通知更新客户端的用户头像 
 * WangWang:WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   当前用户ID 长ID 
 *        selfUrl  自己头像的url
 *        othersideUrl  对方头像的url
 *        selfImgName   自己头像的名字
 *        otherImgName  对方头像的名字
 *        toId          对方的ID
 *        singlecode    除了指定的singlecode页面之外，全部刷新  ，默认为空--〉全部刷新 
 */
function updateLocalUserFaceByWangWang(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "WangWang:" + getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName,otherImgName,toId, singlecode);
	var checkFlag = (arguments.length==7)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
}

/**
 * 通知更新客户端的用户头像 
 * WangWang:WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   当前用户ID 长ID 
 *        selfUrl  自己头像的url
 *        othersideUrl  对方头像的url
 *        selfImgName   自己头像的名字
 *        otherImgName  对方头像的名字
 *        toId          对方的ID
 *        singlecode    除了指定的singlecode页面之外，全部刷新  ，默认为空--〉全部刷新 
 */
function updateLocalUserFaceByAlitalk(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "Alitalk:" + getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode);
	var checkFlag = (arguments.length==7)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
}

/**
 * 生成通知更新客户端的用户头像 
 * WebPageResult?ResultType=4&ResultContent=&CurUserId=
 * @param curUid   当前用户ID 长ID 
 *        selfUrl  自己头像的url
 *        othersideUrl  对方头像的url
 *        selfImgName   自己头像的名字
 *        otherImgName  对方头像的名字
 *        toId          对方的ID
 *        singlecode    除了指定的singlecode页面之外，全部刷新  ，默认为空--〉全部刷新 
 */
function getLocalUserFaceCommand(curUid,selfUrl,othersideUrl,selfImgName , otherImgName, toId, singlecode) {
	var command = "";
	//如果需要更新自己的头像
	if (selfUrl) {
		command += "self:" + selfUrl + ";";
	}
	//如果需要更新对方的头像
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
 *	生成查看群资料的shell命令
 *  @param methodVer   执行方法的版本,例如'Alitalk','WangWang'
 *  @param uid   用户长ID
 *	@param url 内嵌页面URL（需要encode）
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
 * 自定义表情下载
 * @param httpRootPath 路径
 * @param filesInfo 自定义表情字符串
 *     格式：img1name:img1path.gif||img2name:img2path.jpg||img3name:img3path.jpg
 * @param uid 用户ID
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
 * 通知客户端用户选择了某个图片，然后刷新用户的头像选择页面[是显示网站图片还是显示个人秀]
 * 这个方法只是提供给客户端内嵌页面使用,因为当前ID的参数都是设置为空
 * @param uid 用户ID
 * @param picMdName 自定义图片的md5名称
 * 
 */
 function selectUserFace( uid , picMdName ) {
	uid = uid.replace(/^\s+|\s+$/g,"");
	//如果是贸易通用户
	if(uid.indexOf("cnalichn")>=0){
		//selectUserFaceByAlitalk(uid , picMdName);
		selectUserFaceByAlitalk("" , picMdName);
	//如果是taobao用户
	}else if(uid.indexOf("cntaobao")>=0){
		//selectUserFaceByWangWang(uid , picMdName);
		selectUserFaceByWangWang("" , picMdName);
	}

 }

 /**
 * 通知客户端用户选择了某个页面，然后刷新用户的头像选择页面[是显示网站图片还是显示个人秀]
 * @param uid 用户ID
 * @param picMdName 自定义图片的md5名称
 * 
 */
 function selectUserFaceByWangWang( uid , picMdName ) {
	var command = "WangWang:" + getSelectUserFaceCommand(uid , picMdName);
	var checkFlag = (arguments.length==2)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

/**
 * 通知客户端用户选择了某个页面，然后刷新用户的头像选择页面[是显示网站图片还是显示个人秀]
 * @param uid 用户ID
 * @param picMdName 自定义图片的md5名称
 * 
 */
 function selectUserFaceByAlitalk( uid , picMdName ) {
	var command = "Alitalk:" + getSelectUserFaceCommand(uid , picMdName);
	var checkFlag = (arguments.length==2)?true:false;
	execAlitalkShell(command,"5.7",checkFlag,top.location);
 }

/**
 * 生成有如下功能的shell
 * 通知客户端用户选择了某个页面，然后刷新用户的头像选择页面[是显示网站图片还是显示个人秀]
 * @param uid 用户ID
 * @param picMdName 自定义图片的md5名称
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
 * 通知客户端已经选中的头像类型，如果是天下秀的，则把图片的url也传递过去
 * @param uid 用户ID
 * @param imageType 选中的头像类型
 * @param imageUrl 图片的url
 */
 function noteClientUpdateImageByWangWang(uid, imageType, imageUrl, imgName) {
	var command = "WangWang:" + getNoteClientUpdateImageCommand(uid, imageType, imageUrl, imgName);
	var checkFlag = (arguments.length==4)?true:false;
	execWangWangShell(command,"5.7",checkFlag);
 }

/**
 * 通知客户端已经选中的头像类型，如果是天下秀的，则把图片的url也传递过去
 * @param uid 用户ID
 * @param imageType 选中的头像类型
 * @param imageUrl 图片的url
 */
 function noteClientUpdateImageByAlitalk(uid, imageType, imageUrl, imgName) {
	var command = "Alitalk:" + getNoteClientUpdateImageCommand(uid, imageType, imageUrl, imgName);
	var checkFlag = (arguments.length==4)?true:false;
	execAlitalkShell(command,"5.7",checkFlag);
 }

/**
 * 生成有如下功能的shell
 * 通知客户端已经选中的头像类型，如果是天下秀的，则把图片的url也传递过去
 * @param uid 用户ID
 * @param imageType 选中的头像类型
 * @param imageUrl 图片的url
 * @param imgName  图片的名称= imgHashCode + . + suffixName
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
 * 关闭指定singlecode的页面
 * @param uid 用户ID
 * @param singlecode 页面的singlecode
 */
 function closeWangWangWindow(uid, singlecode) {
 	
	uid = uid.replace(/^\s+|\s+$/g,"");
	//如果是贸易通用户
	if(uid.indexOf("cnalichn")>=0){
		closeWindowByAlitalk(uid , singlecode);
	//如果是taobao用户
	}else if(uid.indexOf("cntaobao")>=0){
		closeWindowByWangWang(uid , singlecode);
	}
 }
 
 /**
 * 关闭指定singlecode的页面
 * @param uid 用户ID
 * @param closesinglecode 页面的singlecode
 */
 function closeWindowByWangWang(uid, closesinglecode) {
	var command = "WangWang:" + getCloseWindowCommand(uid, closesinglecode);
	var checkFlag = (arguments.length==2)?true:false;
	execWangWangShell(command,"5.7",checkFlag,top.location);
 }

/**
 * 关闭指定singlecode的页面
 * @param uid 用户ID
 * @param singlecode 页面的singlecode
 */
 function closeWindowByAlitalk(uid, closesinglecode) {
	var command = "Alitalk:" + getCloseWindowCommand(uid, closesinglecode);
	var checkFlag = (arguments.length==2)?true:false;
	execAlitalkShell(command,"5.7",checkFlag,top.location);
 }
 
/**
 * 取得关闭指定singlecode的页面的shell
 * WebPageResult?CurUserId=当前用户ID&singlecode=要关闭的页面的代码
 * @param uid 用户ID
 * @param closesinglecode 页面的singlecode
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
  *	执行旺旺的shell命令
  * @param command   shell命令
  * @param versionNo   版本
  * @param checkFlag   版本校验:true,不校验;flase,校验
  * @param selectLocation 指定的位置(默认:window.location),隐参，调用时候可以不写;如果需要，该参数必须位于参数的第四个
  *						例如:execWangWangShell('WangWang:','5.7',true)-----调用默认的window.location
  *							 execWangWangShell('WangWang:','5.7',flase,top.location)-----使用top.location调用shell命令
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
 * 执行贸易通的shell命令
 * @param command   shell命令
 * @param versionNo   版本
 * @param checkFlag   版本校验:true,不校验;flase,校验
 * @param selectLocation 指定的位置(默认:window.location),隐参，调用时候可以不写;如果需要，该参数必须位于参数的第四个
 *						例如:execAlitalkShell('Alitalk:','5.7',true)-----调用默认的window.location
 *							 execAlitalkShell('Alitalk:','5.7',flase,top.location)-----使用top.location调用shell命令
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
  *	执行旺旺的shell命令
  * @param command   shell命令
  * @param versionNo   版本
  * @param selectLocation 指定的位置
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
 * 执行贸易通的shell命令
 * @param command   shell命令
 * @param versionNo   版本
 * @param selectLocation 指定的位置
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

/****************************5.7+ 头像 ********************************/
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
 * 客户端上传文件给匿名旺旺
 * @param fromSite 发起方用户站点
 * @param fromUid 发起方用户站点
 * @param toSite 发起方用户站点
 * @param toUid 发起方用户站点
 * @param url 发起方用户站点
 * @param moreProperties 发起方用户站点
 **/
function clientUpload( fromSite, fromUid, toSite, toUid, url, moreProperties ) {
    var selectLocation = window.location;
	if(arguments.length == 7){
		selectLocation=arguments[6];
	}
	var shell;
	// 如果是淘宝帐号
	if ( fromSite == "cntaobao" ) {
        shell = "wangwang:upload?userid=" + toSite + toUid + "&url=" + url;
    } else {
        shell = "alitalk:upload?userid=" + toSite + toUid + "&url=" + url;
    }
    selectLocation.href = shell;
}

/***************************************6.0 start*****************************************/

/*****
*	v 6.0规范
*	所有用户id都是长id；
*	所有字符串都是utf-8编码
*	通用参数：
*	uid：当前登录用户的id，自己的id；
*	touid：对方用户的id；
*/


/***
* 取得短ID
***/
function getSiteLoginId(masterId){
	masterId = masterId.replace(/^\s+|\s+$/g,"");
	if(masterId.length>8){
		masterId = masterId.substr(8);
	}
	return "";
}

/****
* 取得旺旺版本 6.0以后操作
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
**  执行旺旺的shell命令  v6以上
*****/
function execAliimShellV6(command){
	window.location.href = command;
}


/***** 添加联系人 
 * 命令格式：aliim:addcontact? uid=***&touid=***&gid=***
 ***/
 function addContactV6(uid,touid,gid,version){
	 try{
			var command = "aliim:addcontact?uid="+uid+"&touid="+touid+"&gid="+gid+"&version="+version;
			execAliimShellV6(command);
			return;
	 }catch(e){
		//alert('调用6.0shell出错!');
	 }
 }

 /***** 添加联系人 
 * 命令格式：aliim:addcontact? uid=***&touid=***&gid=***&
 ***/
 function addContactV6(uid,touid,gid,verify,version){
	 try{
			var command = "aliim:addcontact?uid="+uid+"&touid="+touid+"&gid="+gid+"&verify="+verify+"&version="+version;
			execAliimShellV6(command);
			return;
	 }catch(e){
		//alert('调用6.0shell出错!');
	 }
 }

/***** 消息窗口
 *** 命令格式：aliim:sendmsg? uid=***&touid=***&gid=***&url1=***&url2=***&siteid=****&status=1
 ***/
function sendMsgV6(uid,touid,gid,siteid,status,version){
	try{
			var command = "aliim:sendmsg?uid="+uid+"&touid="+touid+"&gid="+gid+"&siteid"+siteid+"&status="+status+"&version="+version;
			execAliimShellV6(command);
			//wwx.ExecCmd(command);
			return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/***** 头像刷新
*aliim:potraitchanged? uid=***&stamp=****
***/
function potraitchangedV6(uid,stamp,version){
	try{
			var command = "aliim:potraitchanged?uid="+uid+"&stamp="+stamp+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/***** 用户名修改
*aliim:namechanged? uid=***&name=***
***/
function namechangedV6(uid,name,version){
	try{
			var command = "aliim:namechanged?uid="+uid+"&name="+name+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/***** 头像修改
* aliim:editpotrait?uid=
***/
function editPotraitV6(uid,version){
	try{
			var command = "aliim:editpotrait?uid="+uid+"&version="+version;
			execAliimShellV6(command);
			return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/***** 弹出名片
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
		//alert('调用6.0shell出错!');
	}
}


/*******
** 修改组名
** 命令格式：aliim:changegroup? uid=***&fid=***&gid=***&dispname=***
******/
function changeGroupV6(uid,fid,gid,dispname,version){
	try{
		var command = "aliim:changegroup?uid="+uid+"&fid="+fid+"&gid="+gid+"&dispname="+dispname+"&version="+version;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/*******
** 个人资料
** 命令格式：aliim:openmyinfo? uid=***
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
		//alert('调用6.0shell出错!');
	}
}

/**
 * what 's new 命令格式：aliim:whatsnew?uid=***&tabid=***
 **/
function whatsnew(uid,tabid){
	try{
		var command = "aliim:whatsnew?uid="+uid+"&tabid="+tabid;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}

/**
**插件安装
**aliim:pluginmanager_install? pluginid=***&loadurl=***
**/
function  installPlugin(uid,pluginId,pluginName,version){
	try{
		var command = "aliim:pluginmanager_install?uid="+uid+"pluginid="+pluginId+"&pluginname="+pluginName+"&version="+version;
		execAliimShellV6(command);
		return;
	}catch(e){
		//alert('调用6.0shell出错!');
	}
}


/**
*  判断是否安装过6.0以前版本
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
*  判断是否安装过6.0以前版本
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


//20071218 modify  根据头像图片比例自动调整头像大小
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
		//alert('调用6.0shell出错!');
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


function getCookie(objName){//获取指定名称的cookie的值
    var arrStr = document.cookie.split("; ");
    for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == objName) return unescape(temp[1]);
    } 
}

 function allCookie(){//读取所有保存的cookie字符串
    var str = document.cookie;
    if(str == ""){
     str = "没有保存任何cookie";
    }
    //alert(str);
 }

 function addCookie(objName,objValue,objHours){//添加cookie
    var str = objName + "=" + escape(objValue);
    if(objHours > 0){//为0时不设定过期时间，浏览器关闭时cookie自动消失
     var date = new Date();
     var ms = objHours*3600*1000;
     date.setTime(date.getTime() + ms);
     str += "; expires=" + date.toGMTString();
	 str += "; path=/";
	 str += "; domain=alisoft.com";
    }
    document.cookie = str;
    //alert("添加cookie成功");
}

/**
*  设置showtype
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
*  打开设置形象秀窗口
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
*  刷新MyShow
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
*  刷新个人资料页面
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
*  打开更多魔法表情窗口
*/
function magicFaceSetV6(uid){
	try{
		myShowSetV6(uid,"","magicface");
	}catch(e){
	}
	
}

/**
*  收藏魔法表情
*/
function collectionMagicFace(info){
	try{
		var command = "transferinfo:func=setCollection&form=myShow&info="+encodeURIComponent(info);
		execAliimShellV6(command);
	}catch(e){
	}
	
}

/**
*  打开指定URL
*  param
*    url:将要打开的URL，url中原本若有&的，用*替换  UTF-8 encodeURIComponent
*    title:窗口title  UTF-8 encodeURIComponent
*    showmax:是否允许最大化 0 or 1
*    showmin:是否允许最大化 0 or 1
*    canchangesize:是否允许改变窗口大小 0 or 1
*    width：窗口宽
*    height：窗口高
*    pos:窗口打开位置
          SHOW_WIN_CENTER = 1,
          SHOW_WIN_LEFTTOP = 2,
          SHOW_WIN_RIGHTTOP = 3,
          SHOW_WIN_LEFTDOWN = 4,
          SHOW_WIN_RIGHTDOWN = 5
*    openoneonly:只打开一个窗口 0 or 1
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
 * 打开短信充值页面 20080610
 * @param moreProperties 备注信息
 **/
function chargeAlitalkMobile( moreProperties ){
	var selectLocation = window.location;
	if(arguments.length==2){
		selectLocation=arguments[1];
	}
	var shell = "alitalk:ChargeMobile";
	selectLocation.href = shell;
}