<?php

/* 
 * 标题：ECSHOP去除版权
 * 作者：高志超
 * 时间：2017-10-13
 */
/*------第一节：前台------------------------------------------------ */
/*
1、去掉头部TITLE部分的ECSHOP演示站 Powered by ecshop
	前者”ECSHOP演示站”在后台【商店设置】 – 【商店标题】修改
	后者” Powered by ecshop”打开includes/lib_main.php
		156行：$page_title = $GLOBALS['_CFG']['shop_title'] . ‘ – ‘ . ‘Powered by ECShop’;
2、去掉友情链接部分
	在后台的【系统设置】-【友情链接】里修改
3、掉底部的Powered by Ecshop  v 2.7.3
	打开 js/common.js    也是版权乱飞的去除方法
		删除第261行:onload = function()到353行
	再打开模板文件夹的 library/page_footer.lbi
		删除 {foreach from=$lang.p_y item=pv}{$pv}{/foreach}{$licensed}
4、修改文件代码头部的Generator标记，可防止其他程序识别为ECSHOP，从而影响你网站的权重，两种方法
	修改 includes\cls_ecshop.php.php     大概 15行 起
		define(‘APPNAME’, ‘ECSHOP’);
		define(‘VERSION’, ‘v2.7.1′);
		define(‘RELEASE’, ’20091228′);    修改掉。。。
	修改在头部加入版本信息，修改文件Includes/cls_template.php
		查找$source = preg_replace()，1103行注释这段代码
		
*/
/*------第一节：前台------------------------------------------------ */


/*------第二节：后台------------------------------------------------ */
/*
1、去除两张图片(也可以用同名的图片进行替换)
	后台登陆时的ecshop图标            admin/images/ecshop_logo.gif
	登录成功后左上角的ecshop图标；    admin/images/login.png
2、后台成功登录后，右上角的【关于ECSHOP】【帮助】【开店向导】
	打开admin/templates/top.htm
		删除194行： <li><a href=”index.php?act=about_us” target=”main-frame”>{$lang.about}</a></li>
		删除195行： <li><a href="javascript:web_address();">{$lang.help}</a></li>
		删除201行：<li style="border-left:none;"><a href="index.php?act=first" target="main-frame">{$lang.shop_guide}</a></li>
		删除108行的onload=function()主要是调用index.php?act=license
3、中部 ECSHOP-管理中心和底部的版权所有
	打开language/zh_cn/admin/common.php
		$_LANG['cp_home'] = ‘ECSHOP 管理中心’;
		$_LANG['copyright'] = ‘版权所有 &copy; 2005-2009 上海。。。’;
4、删除管理起始页中的系统信息中的 ECSHOP相关信息
	修改 languages\zh_cn\admin\index.php 中 删除相关的
		18行：$_LANG['about'] = '关于 ECSHOP';
		98行：$_LANG['ecs_version'] = 'MYSHOP 版本:';
		133行：$_LANG['team_member'] = 'ECSHOP 团队成员';
		134行：$_LANG['before_team_member'] = 'ECSHOP 贡献者';
	修改 includes\cls_ecshop.php.php     大概 15行 起
		define(‘APPNAME’, ‘ECSHOP’);
		define(‘VERSION’, ‘v2.7.1′);
		define(‘RELEASE’, ’20091228′);    修改掉。。。
5、修改后台提醒最新版本信息打开
	打开admin/templates/start.htm文件
		删除4-35行
6、去掉官方的后门检测程序
	修改admin/shop_config.php
		查找$spt.=""，直接注释或删除掉，也可以在最后添加一行$spt=""；
	修改文件admin/templates/index.htm
		<frameset rows="0, 0" framespacing="0" border="0">
			<frame src="http://api.ecshop.com/record.php?mod=login&url={$shop_url}" id="hidd-frame" name="hidd-frame" frameborder="no" scrolling="no">
		</frameset>
		直接删除或注释
	在MYSQL数据库的表shop_config中查找字段code值为certi的记录
		http://service.shopex.cn/....，修改值为空或一个错误的网址。
	修改admin/templates/top.htm
		108行查找Ajax.call('index.php?is_ajax=1$act=license','',start_sendmail_Response...)
		直接删除或注释
	修改文件admin/templates/menu.htm
		143行：<script src="http://api.ecshop.com/menu_ext.php?charset="></script>
			直接删除或注释
		409行???：Ajax.call('cloud.php?is_ajax=1&act=menu_api','', start_menu_api, 'GET', 'JSON');
			直接删除或注释
		81行：color:#335b64后面少个";"号
	修改文件admin/templates/start.htm
		<ul><!--<script src="http://bbs.ecshop.com"></script>--></ul>
	修改文件：admin/index.php
		$t=new transport;
		$api_comment = $t->request('http://api.ecshop.com/checkver.php', $apiget);
        $api_str = $api_comment["body"];
        echo $api_str;
		直接删除或注释
	删除后台所有默认的友情链接以及默认LOGO
7、删除【云服务中心】	
	删除/admin/cloud.php，(直接删除)或者修改
		$api_arr['content']='';
	删除/admin/templates/menu.htm中以下代码
		Ajax.call('cloud.php?is_ajax=1>act=menu_api','', start_menu_api, 'GET', 'JSON');
		直接删除或注释
	删除/admin/templates/start.htm中以下代码
		204行：Ajax.call('cloud.php?is_ajax=1>act=cloud_remind','', cloud_api, 'GET', 'JSON');
		function cloud_close(id)
		{
		Ajax.call('cloud.php?is_ajax=1>act=close_remind>remind_id='+id,'', cloud_api, 'GET', 'JSON');
		}
	删除/languages/zh_cn/admin/cloud.php
8、删除【数据库管理】-【转换数据】
	删除/admin/convert.php
	删除/admin/templates/convert_main.htm
	删除/languages/zh_cn/convert目录及目录下的所有文件
	删除/languages/zh_cn/admin/convert.php
	/admin/includes/inc_menu.php中删除以下代码
		132行；$modules['13_backup']['convert'] = 'convert.php?act=main';
	/admin/includes/inc_priv.php中删除以下代码
		134行：$purview['convert'] = 'convert';
	/languages/zh_cn/admin/priv_action.php中删除以下代码
		145行：$_LANG['convert'] = '转换数据';
9、删除【系统设置】-【授权证书】
	删除/admin/license.php
	删除admin/templates/license.htm
	删除/admin/includes/inc_menu.php中以下代码
		101行：$modules['11_system']['shop_authorized'] = 'license.php?act=list_edit';
	删除/languages/zh_cn/admin/priv_action.php中以下代码
		78行：$_LANG['shop_authorized'] = '授权证书';
10、license版权许可(自己加的)
	打开admin/index.php
		1210行elseif($_REQUEST['act'] == 'license')-1302行结束
	admin/license.php
	includes/lib_license.php
	includes/lib_main.php
*/
/*------第二节：后台------------------------------------------------ */

?>