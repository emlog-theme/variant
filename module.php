<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 

?>

<?php 
/**
 * 设置页面
 */

//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}

//获取文章图片数量
function pic($content){
	if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
		echo $imgNum = count($img[1]);
	}else{
		echo "0";
	}
}

//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
    while($row = $db->fetch_array($imgs)){
         $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
    }
    return $img_path;
}

//格式化內容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('繼續閱讀&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
// 分页函数
function pjax_page($count,$perlogs,$page,$url,$anchor=''){
	$pnums = @ceil($count / $perlogs);
	$page = @min($pnums,$page);
	$prepg=$page-1;
	$nextpg=($page==$pnums ? 0 : $page+1);
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
	if($pnums<=1){
		return false;
	}
	if($prepg){
		$re .="<a title=\"上一頁\" href=\"$url$prepg$anchor\"><span><i class=\"iconfont\"></i></span></a>";
	}
	if($nextpg){
		$re .="<a title=\"下一頁\" href=\"$url$nextpg$anchor\"><i class=\"iconfont\"></i></a>";
	}
	return $re;
}
?>

<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" rel="category"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else:?>
	<a href="" rel="category">未分类</a>
	<?php endif;?>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>

<form class="js-search search-form search-form--modal" method="get" name="keyform" action="<?php echo BLOG_URL; ?>index.php" role="search">
	<div class="search-form__inner">
		<div>
			<i class="iconfont"></i>
			<input class="text-input" name="keyword" placeholder="Enter keyword ..." type="search" required>
		</div>
	</div>
</form>
<?php } ?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<div class="previous">&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></div>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		
	<?php endif;?>
	<?php if($nextLog):?>
		 <div class="next"><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;</div>
	<?php endif;?>

<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>
	<?php endforeach; ?>
<?php }?>

<?php
//首页微语调用
function index_t($num){
	$t = MySql::getInstance();
	?>
	<?php
	$sql = "SELECT id,content,img,author,date,replynum FROM ".DB_PREFIX."twitter ORDER BY `date` DESC LIMIT $num";
	$list = $t->query($sql);
	while($row = $t->fetch_array($list)){
	?>
	 	<div class="notice">
	   <i class="iconfont icon-write"></i> : 
		<div class="notice-content">
		<?php echo $row['content'];?></div>
	</div>
	<?php }?>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	shuffle($link_cache);$link_cache = array_slice($link_cache,0,6);
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
    <ul>
	<?php foreach($link_cache as $value): ?>
	<li><i class="icon-close" style="padding-left: 10px;"></i>
	<a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>

<?php }?> 
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<i class="iconfont icon-tags"></i>';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>

	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<div class="comment-info">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<b><?php echo $comment['poster']; ?> | <span class="comment-time"><?php echo $comment['date']; ?></span><a class="comment-reply" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></b>
		
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			
		</div>
		<div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<?php blog_comments_children($comments, $comment['children']); ?>
		</div>
	</div>
	<?php endforeach; ?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	
		<div class="comment-info" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<b><?php echo $comment['poster']; ?> | <span class="comment-time"><?php echo $comment['date']; ?></span><?php if($comment['level'] < 4): ?><a class="comment-reply" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a><?php endif; ?></b>

			<div class="comment-content"><?php echo $comment['content']; ?></div>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
		<div class="comment-title"><span>Leave your comment</span></div>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<p>
				<input type="text" id="author" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1" placeholder="昵称">
				
			</p>
			<p>
				<input type="text" id="email" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2" placeholder="邮件地址 (选填)">
				
			</p>
			<p>
				<input type="text" id="url" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="个人主页 (选填)">
				
			</p>
			<?php endif; ?>
			<p><textarea name="comment" rows="10" tabindex="4" class="text_area"></textarea></p>
			<p><?php echo $verifyCode; ?> <input style="background: rgb(102, 102, 102) none repeat scroll 0% 0%;" name="submit" class="button" id="submit" tabindex="5" value="BiuBiuBiu" type="submit"></p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>