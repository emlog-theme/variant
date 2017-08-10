<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	'topimg' => array(
		'type' => 'image',
		'name' => '顶部背景图',
		'values' => array(
            TEMPLATE_URL . 'images/1.jpg',
        ),
            ),	
	'tximg' => array(
		'type' => 'image',
		'name' => '头像',
		'values' => array(
            TEMPLATE_URL . 'images/zztx.jpg',
        ),
            ),
	'wx' =>array(
		'type' => 'image',
		'name' => '微信二维码',
		'values' => array(
			TEMPLATE_URL . 'images/zzwx.jpg',
		),
	),
	'logo' =>array(
		'type' => 'text',
		'name' => 'logo',
		'values' => array(
			TEMPLATE_URL . 'images/logo.png',
		),
	),
	'home_strong_1' => array(
		'type' => 'text',
		'name' => '页脚文章',
		'description' => '',
		'default' => '突如其来的装逼让我无法呼吸',
    ),
	'wb' => array(
		'type' => 'text',
		'name' => '微博链接',
		'description' => '',
		'default' => 'http://www.drlog.pw/',
    ),
	'qq' => array(
		'type' => 'text',
		'name' => 'QQ账号',
		'description' => '',
		'default' => '837233287',
    ),
);