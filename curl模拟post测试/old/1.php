<?php 

/*

$url = 'www.baidu.com';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_exec($ch);
curl_close($ch);

*/

?>

<script type="text/javascript">
        window.g_config = {
            _tb_token_: "DsyNdtOm71o",
            "waterfall": "http://my.taobao.com/homepage/ajax/get_user_source_json.json?user_id=2062136310&big_page=1&cat_id=&type=1&actionType=2&offset=",
            "deleteP": "http://guang.taobao.com/action/delete_source_json.json",
            "likeP": "http://guang.taobao.com/action/like.json",
            "followAlbum": "http://guang.taobao.com/album/ajax/follow_switch.json",
            "deleteAlbum": "http://my.taobao.com/album/ajax/delete_album.json",
            "deleteMsg": "http://my.taobao.com/action/delete_comment_message.json",
            "cursor": "",
            "commentCallback": "http://guang.taobao.com/action/comment_callback.json",
            "followUser": "http://guang.taobao.com/action/follow_fans_json.json",
			            "isSelf":true,
			"isFlat":1,
			"setPrivate":"http://my.taobao.com/homepage/ajax/set_user_privacy.json"
        };
        window._alimm_spmact_on_ = 1
    </script>

<script id="tb-beacon-aplus" src="//a.tbcdn.cn/s/aplus_v2.js" exparams="category=&amp;userid=2062136310&amp;aplus&amp;yunid=&amp;DsyNdtOm71o&amp;asid=AAE4OKxUQ1M01t602gw="></script>
<script src="http://g.tbcdn.cn/tb/my/1.0.1/likelist/init.js" id="J_InitScript"
            data-requires="likelist/tag-nav/,likelist/content-list/"            
			data-path="http://g.tbcdn.cn/tb/my/1.0.1/likelist/"
            data-tag="20150106">
    	</script>
<link rel="stylesheet" href="http://g.tbcdn.cn/tb/global/3.3.16/global-min.css">
<!-- S GLOBAL CSS -->
	<!-- S GLOBAL JS -->
<script src="http://g.tbcdn.cn/??kissy/k/1.3.0/kissy-min.js,tb/global/3.3.16/global-min.js"></script>
<!-- E GLOBAL JS -->
    <script src="http://g.alicdn.com/secdev/pointman/js/index.js" app="phenix"></script>
	<script src="http://a.tbcdn.cn//apps/phenix/my/build/20130731/myutils/guide/index.js?t=20150106"></script>











hhhhhhhh

<script>
	document.writeln({{userIdCode}});
	document.writeln({{value.userId}});
	document.writeln('<br> isSelf:');
	document.writeln(window.g_config);
	document.writeln({{encryptUserId}});
  </script>
  
  <script type="text/tpl" id="J_TplShop">
		  <a class="shop-wrap J_VisCont" href="http://store.taobao.com?shop_id={{shopId}}" target="_blank" title="{{shopName}}">
   <div class="shop-name">
       <img class="owner-pic" src="http://wwc.taobaocdn.com/avatar/getAvatar.do?userId={{uid}}&width=40&height=40&type=sns"/>
       <em>{{shopName}}</em>
   </div>

    <div class="item-wrap">
        {{#each imageUrl as url}}<img class="item-pic" src="{{url}}_120x120xz.jpg"/>{{/each}}
    </div>
</a><div class="cont">
    {{#if favContDate}}
    <div class="cont-hd">
        <div class="cont-item">
            <p class="fav">
                <a class="like-btn J_Like l-right limited {{#if hasFavor}}liked{{/if}}" href="#"
                   data-param='{"srcId":{{rid}},"uid":{{uid}},"favCount":{{favCount}}}' title="喜欢"><em>{{favCount}}</em></a>

                {{favContDate}}{{favContAction}}{{#if favContAlbum}}到&nbsp;
                    <a href="http://my.taobao.com/{{userIdCode}}/album_detail.htm?album_id={{favContAlbumId}}" class="highlight">{{favContAlbum}}</a>
                {{/if}}
            </p>
        </div>
    </div>
    {{/if}}
</div>
</script>



<script type="text/tpl" id="J_TplItem">
     <a class="pic J_VisCont" href="http://item.taobao.com/item.htm?id={{itemId}}" target="_blank" title="{{title}}">
    <img src="{{imageUrl}}{{#if !isGif}}_310x310xz.jpg{{/if}}" class="adjust"/>

    {{#if price}}
        <span class="item-price"> &yen;{{price}} </span>
     {{/if}}
</a><div class="cus-act-flat">
    <div class="btns-area">
        <a class="btn like-btn J_Like {{#if hasFavor}}liked{{/if}}" href="#"
           data-param='{"srcId":{{rid}},"uid":{{uid}},"favCount":{{favCount}}}'><i class="ico"></i>喜欢 <em>{{favCount}}</em></a>
        <a class="btn comment-btn J_Comment" href="#"
           data-param='{"srcId":{{rid}},"oid":"{{oid}}","uid":{{uid}},"appId":{{commentAppId}},"title":"{{title}}","subType": "{{commentSubType}}","commentCount":{{commentCount}}}'><i class="ico"></i>评论 <em>{{commentCount}}</em></a>
    </div>
</div><div class="cont">
    {{#if favContDate}}
    <div class="cont-hd"> 
        <div class="cont-item">
            <p class="fav">{{#if bought}}<span class="bought"></span>{{/if}}{{favContDate}}{{favContAction}}{{#if  favContAlbum}}到&nbsp;<a href="http://my.taobao.com/{{userIdCode}}/album_detail.htm?album_id={{favContAlbumId}}"  class="highlight">{{favContAlbum}}</a>{{/if}}
            </p>
            {{#if favContTitle}}
            <p class="msg"><a href="#">{{favContTitle}}</a></p>
            {{/if}}
        </div>
    </div>
    {{/if}}
    <div class="cont-bd" style="{{#if commentCount == 0}}display: none;{{/if}}">
        {{#each commentCont as value}}
        <div class="cont-item clearfix">
            <a class="avatar" href="http://my.taobao.com/{{value.userIdCode}}">
                <img src="http://wwc.taobaocdn.com/avatar/getAvatar.do?userId={{value.userId}}&width=40&height=40&type=sns"      alt=""/>
            </a>

            <p><a class="light" href="http://my.taobao.com/{{value.userIdCode}}" title="{{value.name}}">{{value.name}}</a>&nbsp;<a
                    href="http://guang.taobao.com/detail/index.htm?uid={{uid}}&sid={{rid}}">{{value.comment}}</a><span
                    class="time">&nbsp;-&nbsp;{{value.date}}</span></p>
        </div>
        {{/each}}
    </div>

    <div class="cont-ft" style="{{#if commentCount < 4}}display: none;{{/if}}">
       <a href="http://guang.taobao.com/detail/index.htm?uid={{uid}}&sid={{rid}}" class="highlight pinglun" target="_blank">查看更多</a>
    </div>

</div>

<div class="act-area-flat">
    <div class="J_CommentHd">

    </div>
</div>
</script>





