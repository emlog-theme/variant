<?php 
/**
 * 新建页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="wrapper">
	<article id="post-1108" class="post-1108 post type-post status-publish format-status has-post-thumbnail hentry category-uncategorized tag-520 js-gallery">
	<h1 class="post-title"><?php echo $log_title; ?></h1>
	<div class="post-body js-gallery mb">
			<?php echo $log_content; ?>
		</div>
	<div class="meta split split--responsive cf">
		<div class="split__title">
			<time datetime="<?php echo gmdate('Y-n-j', $date);?>"><?php echo gmdate('Y-n-j', $date);?></time>
			<span class="">&nbsp;&nbsp;<?php echo $views; ?> 次阅读&nbsp;&nbsp;&nbsp;<?php editflg($logid,$author); ?></span>
		</div>
		<div id="social-share">
			<span class="entypo-share"><i class="iconfont"></i>分享</span>
		</div>
		<div class="slide">
			<a class="btn-slide" title="Comments"><i class="iconfont"></i>展开评论</a>
		</div>
	</div>
	</article>
</div>
<svg id="bigTriangleColor" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L50 100 L100 0 Z"></path></svg>
<div style="display: none;" class="" id="social">
	<ul>
		<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo Url::log($logid);?>&amp;title=<?php echo $log_title; ?>" data-tooltip="qzone" data-placement="top" target="_blank"><i class="iconfont"></i></a></li>
		<li><a href="http://service.weibo.com/share/share.php?title=<?php echo $log_title; ?>&amp;url=<?php echo Url::log($logid);?>" data-tooltip="weibo" data-placement="top" target="_blank"><i class="iconfont"></i></a></li>
		<li><a href="http://share.renren.com/share/buttonshare?link=<?php echo Url::log($logid);?>&amp;title=<?php echo $log_title; ?>" data-tooltip="renren" data-placement="top" target="_blank"><i class="iconfont"></i></a></li>
		<li><a href="http://www.douban.com/recommend/?url=<?php echo Url::log($logid);?>&amp;title=<?php echo $log_title; ?>" data-tooltip="douban" data-placement="top" target="_blank"><i class="iconfont"></i></a></li>
		<li><a href="http://twitter.com/share?url=<?php echo Url::log($logid);?>&amp;text=<?php echo $log_title; ?>" data-tooltip="twitter" data-placement="top" target="_blank"><i class="iconfont"></i></a></li>
	</ul>
</div>
<div style="display: none;" id="panel">
	<!-- You can start editing here. -->
<div class="comment-area comments clearfix">
<div class="comments clearfix">
<div class="wrapper">
<div id="comments-title"><span><?php echo $comnum; ?></span>条留言</div>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
    </div>
	</div>
	</div>  
  <script type="text/javascript">
  function ajacpload(){
$('#comment_pager a').click(function(){
    var wpurl=$(this).attr("href").split(/(\?|&)action=AjaxCommentsPage.*$/)[0];
    var commentPage = 1;
    if (/comment-page-/i.test(wpurl)) {
    commentPage = wpurl.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0];
    } else if (/cpage=/i.test(wpurl)) {
    commentPage = wpurl.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0];
    };
    //alert(commentPage);//获取页数
    var postId =$('#cp_post_id').text();
	//alert(postId);//获取postid
    var url = wpurl.split(/#.*$/)[0];
    url += /\?/i.test(wpurl) ? '&' : '?';
    url += 'action=AjaxCommentsPage&post=' + postId + '&page=' + commentPage;        
    //alert(url);//看看传入参数是否正确
    $.ajax({
    url:url,
    type: 'GET',
    beforeSend: function() {
    document.body.style.cursor = 'wait';
    var C=0.7;//修改下面的选择器，评论列表div的id，分页部分的id
    $('#thecomments,#comment_pager').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
    var loading='Loading';
    $('#comment_pager').html(loading);
    },
    error: function(request) {
        alert(request.responseText);
    },
    success:function(data){
    var responses=data.split('');
    $('#thecomments').html(responses[0]);
    $('#comment_pager').html(responses[1]);
    var C=1; //修改下面的选择器，评论列表div的id，分页部分的id
    $('#thecomments,#comment_pager').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
    $('#cmploading').remove();
    document.body.style.cursor = 'auto';
    ajacpload();//自身重载一次
	//single_js();//需要重载的js，注意
	$body.animate( { scrollTop: $('#comment_header').offset().top - 200}, 1000);
        }//返回评论列表顶部
    });    
    return false;
    });
}
  </script>
  </div>
<?php include View::getView('footer');?>