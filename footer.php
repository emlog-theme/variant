<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="fat-footer">
	<div class="wrapper">
		<div class="layout layout--center">
			<div class="layout__item palm-mb">
				<div class="media">
					<img class="media__img avatar" src="<?php echo _g("tximg");?>" alt="" height="50" width="50">
					<div class="media__body">
						<h4><?php echo $blogname; ?></h4>
						<p>
							<?php echo _g("home_strong_1");?>
						</p>
					</div>
				</div>
			</div>
			
			<div class="layout__item yc">
				<div class="fat-footer__social">
					<ul class="list-bare list-inline">
				        <li><a href="<?php echo _g("wb");?>" target="_blank" rel="nofollow"><i class="iconfont" aria-hidden="true"></i></a></li>
 					    <li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo _g("qq");?>&amp;site=qq&amp;menu=yes" target="_blank" rel="nofollow"><img class="qq" src="<?php echo TEMPLATE_URL; ?>images/qq.png"></a></li>
						<li><a href="javascript:void(0)" onMouseOut="hideImg()"  onmouseover="showImg()"><i class="iconfont" aria-hidden="true"></i></a><div id="wxImg" style="height: 50px; position: absolute; margin-top: -143px; margin-left: -20px; display: none;width: 90px;"><img src="<?php echo _g("wx");?>"></div></li>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
</div>
<footer class="footer" role="contentinfo">
<div class="wrapper wrapper--wide split split--responsive">
	<div class="split__title">
			© 2016 by <a href="<?php echo BLOG_URL; ?>" target="_blank"><?php echo $blogname; ?></a>
	</div>
		Theme:		
	<a href="https://www.ianiu.cn/" target="_blank" rel="nofollow">Variant</a> copy by
	<a href="https://www.ianiu.cn/" target="_blank">瑾忆</a>
</div>
</footer>
<?php echo widget_search($title); ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/module.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/script.js"></script>
<script>
		var infinite_scroll = {
			loading: {
				img: '<?php echo TEMPLATE_URL; ?>images/ajax-loader.gif',
				msgText: '',
				finishedMsg: ''
			},
			nextSelector: '.js-next a',
			navSelector: '.js-pagination',
			itemSelector: '.post',
			contentSelector: '.js-posts'
		};
	</script>
<script type="text/javascript">
function  showImg(){
document.getElementById("wxImg").style.display='block';
}
function hideImg(){
document.getElementById("wxImg").style.display='none';
}
</script>
<div id="fb-root">
</div>
<?php doAction('index_footer'); ?>
<?php doAction('index_bodys'); ?>
</body>
</html>