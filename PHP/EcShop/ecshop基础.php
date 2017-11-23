<?php

/* 
 * 标题：ECSHOP二次开发
 * 作者：高志超
 * 时间：2017-10-12
 */
 
 
/*------第一节：建立自己的模板文件夹------------------------------------------------ */
/*
 * 1、在themes文件夹建立自己的主题模板文件夹，如：houdunwang
 * 2、在自己的模板文件夹下面建立style.css
 * 3、配置我们的模板信息，即编辑style.css,内容为
        template name:模板名称
        template URI:模板的链接地址
        description:模板的描述
        version:模板的版本号
        author:模板作者
        author URI:作者url
        logo filename:images目录下logo.gif文件名
        template type:type_0
 * 4、建立images目录，存放图片
 * 5、建立library目录，存放公用html模板，例如网站头部，网站底部
 * 6、在images目录存放我们的模板预览图，文件名必须为screenshot.png，大小200*150
 * 7、建立xxx.dwt文件
 * 8、在后台的模板管理--模板选择，就可以看见我们建立的主题模板
 * 
 */
/*------第一节：建立自己的模板文件夹------------------------------------------------ */

/*------第二节：建立模板文件------------------------------------------------ */
/*
 * 1、在样品项目随意打开一个页面，例如：地址栏显示localhost/ecshop/goods.php?id=6
 * 2、打开对应的页面goods.php,搜索display(),该文件调用的是goods.dwt模板
        dwt文件高亮显示设置：
            netbeans--选项--其他--文件--文件关联--文件扩展名->dwt--关联的文件类型->xhtml
        选择自己创建的默认模板
         
 * 3、在自己的项目里新建goods.dwt，复制前端页面的html、js、css和图像文件，修改html文
      件里引入文件的路径
 * 4、把网站的相同样式的头部和底部放到library目录下，如googs_head.lib
 * 5、引入头文件{include file="./library/goods_head.lib" /}
 * 6、商品页字段说明
	{foreach from=$goods key=key item=rank_price}
		{$key}---{$rank_price}
	{/foreach}
 * 7、{insert_scripts files="abc.js"}插入js文件
 */
/*------第二节：建立模板文件------------------------------------------------ */


/*------第三节：模版基础--------------------------------------------------*/
/*

网站运行时模版引擎会调用模版页面，然后把对应的标签用对应的值替换。
$page_title----------网站标题
$keyWords----------关键字
$discription----------描述
$shop_notice--------商店公告
	系统设置-商店设置-网店信息-商店公告-修改内容
$new_articles----------网站快讯
	{foreach form=$new_articles item=news}
		{$news.short_title}
	{/foreach}
	$new_articles:要循环的数组
	News:当前循环的对象
	文章管理-网站列表-添加文章-网站快讯

 */
/*------第三节：模版基础--------------------------------------------------*/


/*------第四节：模版进阶------------------------------------------------ */
/*
$best_goods: 精品商品short_style_name、url、thumb
	{foreach form=$best_goods item=best}
		{$best.short_style_name}
	{/foreach}
$new_goods：新品上市
$hot_goods: 热卖商品
$categories：分类列表
	{foreach form=$categories item=cate}
		{$cate.name}
		{foreach form=$cate.children  item=child}
			{$child.name|escape:html}
		{/foreach}
	{/foreach}

 * 
 */
/*------第四节：模版进阶------------------------------------------------ */


/*------第五节：includes目录下的文件-------------------------------------*/
/*
init.php：前台公用文件
	define('ROOT_PATH', str_replace('includes/init.php', '', str_replace('\\', '/', __FILE__)));
	require(ROOT_PATH . 'data/config.php');
	require(ROOT_PATH . 'includes/inc_constant.php');
	require(ROOT_PATH . 'includes/cls_ecshop.php');
	require(ROOT_PATH . 'includes/cls_error.php');
	require(ROOT_PATH . 'includes/lib_time.php');
	require(ROOT_PATH . 'includes/lib_base.php');
	require(ROOT_PATH . 'includes/lib_common.php');
	require(ROOT_PATH . 'includes/lib_main.php');
	require(ROOT_PATH . 'includes/lib_insert.php');
	require(ROOT_PATH . 'includes/lib_goods.php');
	require(ROOT_PATH . 'includes/lib_article.php');
	require(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/common.php');	 
	$ecs = new ECS($db_name, $prefix);创建 ECSHOP 对象
	require(ROOT_PATH . 'includes/cls_mysql.php');
	$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
	$err = new ecs_error('message.dwt');创建错误处理对象
	$_CFG = load_config();载入系统参数
	
inc_constant.php：系统相关常量

cls_ecshop.php：基础类
	define('APPNAME', 'ECSHOP');
	define('VERSION', 'v2.7.3');
	define('RELEASE', '20121106');
	class ECS{
	compile_password()------md5密码编译方法
	get_domain()=======---取得当前的域名
	url()--------------------------获得当前环境的URL地址
	http()------------------------获得当前环境的HTTP协议方式
	data_dir($sid = 0)------------------获得数据目录的路径
	image_dir($sid = 0)-------获得图片目录的路径

cls_error.php：用户级错误处理类
	class ecs_error{
		add($msg, $errno=1)--------添加一条错误信息
		clean()--------------------------清空错误信息
		get_all()------------------------返回所有错误信息的数组
		last_message()---------------返回最后一条错误信息
		show($link,$href)------------显示错误信息
	}
lib_time.php:时间函数
	gmtime()--------------获得当前格林威治时间的时间戳
	server_timezone()------获得服务器的时区
	local_mktime($hour,$minute,$second,$month,$day,$year)--生成一个用户自定义日期的													  GMT时间戳
	local_date($format,$time)----将gmt时间戳格式化为用户自定义时区日期
	gmstr2time($str)-----转换字符串形式的时间表达式为GMT时间戳
	local_strtotime($str)-----讲一个用户自定义时区的日期转为GMT时间戳
	local_gettime($timestamp)-----获得用户所在时区的时间戳
	local_getdate($timestamp)------获得用户所在时区制定的日期和时间信息
lib_base.php:基础函数库
	sub_str($str,$length,$append)---截取UTF8编码下字符串的函数
	real_ip()--------------------获得用户的真是ip地址
	str_len($str)--------------计算字符串的长度(汉字按照两个字符计算)
	get_crlf()--------------获得用户操作系统的换行符
	send_mail($name,$email,$subject,$content,$type,$notification)--邮件发送
	gd_version()----------获得服务器上的GD库版本
	file_get_contents()file_put_contents()floatval()--系统如果不存在则声明该函数
	file_mode_info($file_path)----文件或目录权限检查函数
	log_write($arg,$file,$line)-----写日志
	make_dir($folder)------------检查目标文件夹是否存在，如果不存在则自动创建
	gzip_enabled()-----------------获得系统是否启用了gzip
	compile_str($str)-------------过滤用户输入的基本数据，，防止script攻击
	check_file_type($filename,$realname,$limit_ext_types)-检查文件类型
	mysql_like_quote($str)------对MYSQL LIKE的内容进行转义
	real_server_ip()-----------获取服务器的ip
	ecs_header($str,$replace,$http_response_code)-----自定义header函数,用于过滤可能出现											   的安全隐患
	ecs_iconv()
	ecs_geoip()
	move_upload_file($file_name,$target_name)--将上传文件转移到制定位置
	json_str_iconv($str)---------将json传递的参数转码
	to_utf8_iconv($str)----------循环转码成utf8内容
	get_file_suffix($file_name,$allow_type)--获取文件后缀名，并判断是否合法
	read_statice_cache($cache_name)-----读结果缓存文件
	write_statice_cache($cache_name,$caches)--写结果缓存文件
lib_common.php:公用函数库
	db_create_in($item_list,$field_name)---创建像这样的查询：“IN(‘a’,’b’)”
	is_email($user_email)------判断邮件地址是否合法
	is_time($time)---------------判断是否是一个合法的时间格式
	get_regions($type,$parent)-----获得指定国家的所有省份
	get_shipping_config($area_id)---获得配送区域中指定的配送方式的配送费用计算参数
	cat_list($cat_id,$selected,$re_type,$level,$is_show_all)--获得制定分类下的子分类的数组
	cat_options($spec_cat_id,$arr)----过滤和排序所有分类，返回一个数组
	load_config()--------载入配置信息
	get_brand_list()-------取得品牌列表
	get_brands($cat,$app)----获得某个分类下的数据(默认是brand)
	get_promotion_info($googs_id)----所有的促销活动信息
	get_children($cat = 0)-----------获得指定分类下所有底层分类的ID
	get_article_children ($cat = 0)------获得指定文章分类下所有底层分类的ID
	get_mail_template($tpl_name)---获取邮件模板
	order_action()------记录订单操作记录
	price_format($price, $change_price = true)-----格式化商品价格
	get_virtual_goods($order_id, $shipping = false)----返回订单中的虚拟商品
	clear_cache_files($ext = '')-----------清除缓存文件
	clear_all_files($ext = '')--------清除模版编译和缓存文件
	smarty_insert_scripts($args)-------页面上调用的js文件
	smarty_create_pages($params)------------创建分页的列表
	build_uri($app, $params, $append = '', $page = 0, $keywords = '', $size = 0)--重写URL地址
	function formated_weight($weight)-----格式化重量：小于1千克用克表示，否则用千克
	log_account_change($user_id....)-----记录帐户变动
	article_cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0)
		获得指定分类下的子分类的数组
	article_cat_options($spec_cat_id, $arr)-----过滤和排序所有文章分类，返回一个数组
	uc_call($func, $params=null)---------调用UCenter的函数
	get_image_path($goods_id, $image='', $thumb=false, $call='goods', $del=false)
		重新获得商品图片与商品相册的地址
	user_uc_call($func, $params = null)--调用使用UCenter插件时的函数
	get_volume_price_list($goods_id, $price_type = '1')----取得商品优惠价格列表
	get_final_price($goods_id, $goods_num = '1', $is_spec_price = false, $spec = array())
		取得商品最终使用价格
	sort_goods_attr_id_array($goods_attr_id_array, $sort = 'asc')
		将 goods_attr_id 的序列按照 attr_id 重新排序
lib_main.php:前台公用函数库
	update_user_info()-----------更新用户SESSION,COOKIE及登录时间、登录次数。
	get_user_info($id=0)------获取用户信息数组
	assign_ur_here($cat = 0, $str = '')----取得当前位置和页面标题
	get_parent_cats($cat)------获得指定分类的所有上级分类
	build_pagetitle($arr, $type = 'category')---根据提供的数组编译成页面标题
	build_urhere($arr, $type = 'category')-----根据提供的数组编译成当前位置
	assign_dynamic($tmp)--------获得指定页面的动态内容
	assign_articles($id, $num)-----分配文章列表给smarty
	get_shop_help()-----分配帮助信息
	assign_pager($app....)----------创建分页信息
	get_pager($url, $param, $record_count, $page = 1, $size = 10)--生成给pager.lbi赋值的数组
	get_user_browser()----获得浏览器名称和版本
	is_spider($record = true)---判断是否为搜索引擎蜘蛛
	get_os()---------获得客户端的操作系统
	visit_stats()-------统计访问信息
	get_tags($goods_id = 0, $user_id = 0)----------获得指定用户、商品的所有标记
	upload_file($upload, $type)-----处理上传文件，并返回上传图片名
	show_message($content, $links = '', $hrefs = '', $type = 'info', $auto_redirect = true)
		显示一个提示信息
	parse_rate_value($str, &$operate)----
		将一个形如+10, 10, -10, 10%的字串转换为相应数字，并返回操作符号
	recalculate_price()-----重新计算购物车中的商品价格,如果商品有促销，价格不变
	assign_comment($id, $type, $page = 1)----查询评论内容
	assign_template($ctype = '', $catlist = array())
	time2gmt($time)------将一个本地时间戳转成GMT时间戳
	get_user_bonus($user_id = 0)-------查询会员的红包金额
	article_categories_tree($cat_id = 0)
		获得指定分类同级的所有分类以及该分类下的子分类
	get_article_parent_cats($cat)----获得指定文章分类的所有上级分类
	get_navigator($ctype = '', $catlist = array())---取得自定义导航栏列表
	license_info()--------授权信息内容
	url_domain()
lib_insert.php:动态内容函数库
	insert_query_info()------获得查询次数以及查询时间
	insert_history()------调用浏览历史
	insert_cart_info()------调用购物车信息
	insert_ads($arr)-------调用指定的广告位的广告
	insert_member_info()------调用会员信息
	insert_comments($arr)-------调用评论信息
	insert_bought_notes($arr)--------调用商品购买记录
	insert_vote()---------调用在线调查信息
lib_goods.php:商品相关函数库
	goods_sort($goods_a, $goods_b)-------商品推荐usort用自定义排序行数
	get_categories_tree($cat_id = 0)---获得指定分类同级的所有分类以及该分类下的子分类
	get_child_tree($tree_id = 0)------上一个函数需要
	get_top10($cats = '')-----------调用当前分类的销售排行榜
	get_recommend_goods($type = '', $cats = '')------获得推荐商品
	get_promote_goods($cats = '')------获得促销商品
	get_category_recommend_goods($type, $cats , $brand = 0, $min =0, $max = 0, $ext='')
	获得指定分类下的推荐商品
	get_goods_info($goods_id)---------获得商品的详细信息
	get_goods_properties($goods_id)------获得商品的属性和规格
	get_same_attribute_goods($attr)------获得属性相同的商品
	get_goods_gallery($goods_id)-----获得指定商品的相册
	assign_cat_goods($cat_id, $num = 0, $from = 'web', $order_rule)--获得指定分类下的商品
	assign_brand_goods($brand_id, $num, $cat_id,$order_rule)-获得指定的品牌下的商品
	get_extension_goods($cats)------获得所有扩展分类属于指定分类的所有商品ID
	bargain_price($price, $start, $end)------判断某个商品是否正在特价促销期
	spec_price($spec)------获得指定的规格的价格
	group_buy_info($group_buy_id, $current_num = 0)---取得团购活动信息
	group_buy_stat($group_buy_id, $deposit)----取得某团购活动统计信息
	group_buy_status($group_buy)------获得团购的状态
	goods_info($goods_id)-----取得商品信息
	favourable_info($act_id)-----取得优惠活动信息
	wholesale_info($act_id)------批发信息
	get_goods_attr($goods_id)-------取得商品属性
	get_goods_fittings($goods_list = array())------获得购物车中商品的配件
	get_products_info($goods_id, $spec_goods_attr_id)---取指定规格的货品信息
	require(ROOT_PATH . 'includes/lib_article.php');文章及文章分类相关函数库
	get_cat_articles($cat_id, $page = 1, $size = 20 ,$requirement)-获得文章分类下的文章列表
	get_article_count($cat_id ,$requirement='')---获得指定分类下的文章总数
cls_mysql.php:MYSQL公用类库
	connect($dbhost, $dbuser, $dbpw, $dbname = '', $charset = 'utf8',..)
	cls_mysql($dbhost, $dbuser, $dbpw, $dbname = '', $charset = 'gbk',..)
	select_database($dbname)
	set_mysql_charset($charset)
	fetch_array($query, $result_type)-mysql_fetch_array($query, $result_type);
	query($sql, $type = '')
	affected_rows() ------mysql_affected_rows($this->link_id);
	error()
	result($query, $row)-----@mysql_result($query, $row);
	num_rows($query)------mysql_num_rows($query);
	num_fields($query)-----mysql_num_fields($query);
	free_result($query)-----mysql_free_result($query);
	fetchRow($query)-----------mysql_fetch_assoc($query);
	fetch_fields($query)-----mysql_fetch_field($query);
	version()------------version
	escape_string($unescaped_string)---mysql_real_escape_string($unescaped_string);
	close()---------mysql_close($this->link_id);
	selectLimit($sql, $num, $start = 0)
	getOne($sql, $limited = false)
	getOneCached($sql, $cached = 'FILEFIRST')
	getAll($sql)
	getAllCached($sql, $cached = 'FILEFIRST')
	getRow($sql, $limited = false)
	getRowCached($sql, $cached = 'FILEFIRST')
	getCol($sql)
	autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
	autoReplace($table, $field_values, $update_values, $where = '', $querymode = '')
	setMaxCacheTime($second)----max_cache_time = $second;
	getMaxCacheTime()
	getSqlCacheData($sql, $cached = '')
	get_table_name($query_item)
	set_disable_cache_tables($tables)
cls_session.php：
	gen_session_id()
	gen_session_key($session_id)
	insert_session()
	load_session()
	update_session()
	close_session()
	get_users_count()
cls_template.php：仿smarty模版类
	assign($tpl_var, $value = '')-------注册变量
	display($filename, $cache_id = '')-------显示页面函数
	fetch($filename, $cache_id = '')------处理模板文件display用
	is_cached($filename, $cache_id = '')--------判断是否缓存
	smarty_insert_scripts($args)-------参见手册
	html_options($arr)
	html_select_date($arr)
	html_radios($arr)
	html_select_time($arr)
	cycle($arr)
	smarty_create_pages($params)
cls_iconv.php:字符集转换类

cls_captcha.php:验证码图片类

cls_image.php:后台对上传文件的处理类(实现图片上传，图片缩小， 增加水印)

cls_josn:JSON类
	class JSON{
		encode($arg, $force = true)
		decode($text,$type=0) 
		error($m)
		next()
		str()
		arr()
		obj()
		assoc()
		word()
		val()
		object_to_array($obj)
	}
cls_rss.php:RSS 类RSS是站点用来和其他站点之间共享内容的简易方式(也叫聚合内容)。
	RSS使用XML作为彼此共享内容的标准方式。
	RSS(Really Simple Syndication)是一种描述和同步网站内容的格式，是使用最广泛的XML应用
	
cls_sms.php:短信模块 之 模型（类库）
	class sms{
		send($phones,$msg....)--------发送短消息
		check_enable_info($email, $password)-------检测启用短信服务需要的信息
		has_registered()-------查询是否已有通行证
		get_site_info()
		get_site_url()
		get_admin_email()------------获得当前处于会话状态的管理员的邮箱
		getSmsInfo($certi_app='sms.info',$version='1.0', $format='json')-----用户短信账户信息获取
		get_contents($phones,$msg)-----检查手机号和发送的内容并生成生成短信队列
		getTime()-----获得服务器时间
		is_moblie($moblie)-----检测手机号码是否正确
		make_shopex_ac($temp_arr,$token)-----加密算法
	}
	
cls_smtp.php:邮件类
	class smtp{
		smtp($params = array())----参数为一个数组,stmp服务器配置
		connect($params = array())
		send($params = array())
		mail($from)
		auth()
		send_data($data)
	}

cls_transport.php:服务器之间数据传输器。采集到的信息包括HTTP头和HTTP体，
	class transport{
			request($url, $params = '', $method = 'POST', $my_header = '')----请求远程服务器
			use_socket($url, $params, $method, $my_header)------使用fsockopen进行连接
			use_curl($url, $params, $method, $my_header)------使用curl进行连接
			parse_raw_url($raw_url)
	}
	
lib_clips.php:用户相关函数库
	get_collection_goods($user_id, $num = 10, $start = 0)-----获取指定用户的收藏商品列表
	get_booking_rec($user_id, $goods_id)-------查看此商品是否已进行过缺货登记
	get_message_list($user_id, $user_name, $num, $start, $order_id = 0)----获取指定用户的留言
	add_message($message)-------添加留言函数
	get_user_tags($user_id = 0)--------获取用户的tags
	delete_tag($tag_words, $user_id)----验证性的删除某个tag
	get_booking_list($user_id, $num, $start)----获取某用户的缺货登记列表
	delete_booking($booking_id, $user_id)------验证删除某个收藏商品
	add_booking($booking)-----添加缺货登记记录到数据表
	insert_user_account($surplus, $amount)------插入会员账目明细
	update_user_account($surplus)-----更新会员账目明细
	insert_pay_log($id, $amount, $type = PAY_SURPLUS, $is_paid = 0)-----将支付LOG插入数据表
	get_paylog_id($surplus_id, $pay_type = PAY_SURPLUS)---取得上次未支付的pay_lig_id
	get_surplus_info($surplus_id)-----根据ID获取当前余额操作信息
	get_online_payment_list($include_balance = true)------取得已安装的支付方式(其中不包括线下支付的)
	get_account_log($user_id, $num, $start)------查询会员余额的操作记录
	del_user_account($rec_id, $user_id)-----删除未确认的会员帐目信息
	get_user_surplus($user_id)---查询会员余额的数量
	get_user_default($user_id)------获取用户中心默认页面所需的数据
	add_tag($id, $tag)-------添加商品标签
	color_tag(&$tags)------标签着色
	get_rank_info()---------取得用户等级信息
	get_user_prompt ($user_id)-----获取用户参与活动信息
	get_comment_list($user_id, $page_size, $start)----获取用户评论
	
lib_code.php:加密解密库
	encrypt($str, $key = AUTH_KEY)-----加密函数base64_encode
	decrypt($str, $key = AUTH_KEY)------解密函数
	
lib_compositor.php: 支付插件排序文件

lib_license.php:LICENSE 相关函数库
	get_shop_license()-------获得网店 license 信息
	make_shopex_ac($post_params, $token)--------生成certi_ac验证字段
	exchange_shop_license($certi, $license, $use_lib = 0)------与 ECShop 交换数据
	process_login_license($cert_auth)-----处理登录返回结果
	license_login($certi_added = '')------license 登录
	license_reg($certi_added = '')--------license 注册
	
lib_order.php:购物流程函数库
	unserialize_config($cfg)------处理序列化的支付、配送的配置参数
	shipping_list()----------取得已安装的配送方式
	shipping_info($shipping_id)-------取得配送方式信息
	available_shipping_list($region_id_list)------取得可用的配送方式列表
	shipping_area_info($shipping_id, $region_id_list)-----取得某配送方式对应于某收货地址的区域信息
	shipping_fee($shipping_code, $shipping_config, $goods_weight, $goods_amount, $goods_number='')-----计算运费
	shipping_insure_fee($shipping_code, $goods_amount, $insure)-----获取指定配送的保价费用
	payment_list()------取得已安装的支付方式列表
	payment_info($pay_id)-----取得支付方式信息
	pay_fee($payment_id, $order_amount, $cod_fee=null)----------获得订单需要支付的支付费用
	available_payment_list($support_cod, $cod_fee = 0, $is_online = false)-----取得可用的支付方式列表
	pack_list()------取得包装列表
	order_info($order_id, $order_sn = '')----取得订单信息
	order_finished($order)----判断订单是否已完成
	order_goods($order_id)-----取得订单商品
	order_amount($order_id, $include_gift = true)------取得订单总金额
	order_weight_price($order_id)-----取得某订单商品总重量和总金额（对应 cart_weight_price）
	order_fee($order, $goods, $consignee)---获得订单中的费用信息
	update_order($order_id, $order)------修改订单
	get_order_sn()-----得到新订单号
	cart_goods($type = CART_GENERAL_GOODS)------取得购物车商品
	cart_amount($include_gift = true, $type = CART_GENERAL_GOODS)-----取得购物车总金额
	cart_goods_exists($id, $spec, $type = CART_GENERAL_GOODS)------检查某商品是否已经存在于购物车
	cart_weight_price($type = CART_GENERAL_GOODS)------获得购物车中商品的总重量、总价格、总数量
	addto_cart($goods_id, $num = 1, $spec = array(), $parent = 0)-----添加商品到购物车
	clear_cart($type = CART_GENERAL_GOODS)------清空购物车
	get_goods_attr_info($arr, $type = 'pice')=-----获得指定的商品属性
	user_info($user_id)-----取得用户信息
	update_user($user_id, $user)-----修改用户
	address_list($user_id)-----取得用户地址列表
	address_info($address_id)----取得用户地址信息
	user_bonus($user_id, $goods_amount = 0)------取得用户当前可用红包
	bonus_info($bonus_id, $bonus_sn = '')----取得红包信息
	bonus_used($bonus_id)----检查红包是否已使用
	use_bonus($bonus_id, $order_id)-------设置红包为已使用
	unuse_bonus($bonus_id)------设置红包为未使用
	value_of_integral($integral)----计算积分的价值（能抵多少钱
	integral_of_value($value)----计算指定的金额需要多少积分
	order_refund($order, $refund_type, $refund_note, $refund_amount = 0)-----订单退款
	get_cart_goods()-------获得购物车中的商品
	get_consignee($user_id)------取得收货人信息
	exist_real_goods($order_id = 0, $flow_type = CART_GENERAL_GOODS)------查询购物车（订单id为0）或订单中是否有实体商品
	check_consignee_info($consignee, $flow_type)----检查收货人信息是否完整
	last_shipping_and_payment()------获得上一次用户采用的支付和配送方式
	get_total_bonus()-------取得当前用户应该得到的红包总额
	change_user_bonus($bonus_id, $order_id, $is_used = true)------处理红包
	flow_order_info()-------获得订单信息
	merge_order($from_order_sn, $to_order_sn)------合并订单
	get_agency_by_regions($regions)-------查询配送区域属于哪个办事处管辖
	change_order_goods_storage($order_id, $is_dec = true, $storage = 0)-----改变订单中商品库存
	change_goods_storage($good_id, $product_id, $number = 0)-----商品库存增与减 货品库存增与减
	payment_id_list($is_cod)------取得支付方式id列表
	order_query_sql($type = 'finished', $alias = '')-----生成查询订单的sql
	get_delivery_sn()------得到新发货单号

lib_passport.php:用户帐号相关函数库
	register($username, $password, $email, $other = array())-----用户注册，登录函数
	edit_password($user_id, $old_password, $new_password='', $code ='')-----将指定user_id的密码修改为new_password
	check_userinfo($user_name, $email)-----会员找回密码时，对输入的用户名和邮件地址匹配
	send_pwd_email($uid, $user_name, $email, $code)-------用户进行密码找回操作时，发送一封确认邮件
	send_regiter_hash ($user_id)-----发送激活验证邮件
	register_hash ($operation, $key)-----生成邮件验证hash
	admin_registered( $adminname )-----判断超级管理员用户名是否存在
	
lib_payment.php:支付接口函数库
	return_url($code)------取得返回信息地址
	get_payment($code)-----取得某支付方式信息
	get_order_id_by_sn($order_sn, $voucher = 'false')----通过订单sn取得订单ID
	get_goods_name_by_id($order_id)-----通过订单ID取得订单商品名称
	check_money($log_id, $money)-----检查支付的金额是否与订单相符
	order_paid($log_id, $pay_status = PS_PAYED, $note = '')----修改订单的支付状态
	
lib_transaction.php:用户交易相关函数库
	edit_profile($profile)----修改个人资料（Email, 性别，生日)
	get_profile($user_id)-----获取用户帐号信息
	get_consignee_list($user_id)-----取得收货人地址列表
	add_bonus($user_id, $bouns_sn)-----给指定用户添加一个指定红包
	get_user_orders($user_id, $num = 10, $start = 0)-----获取用户指定范围的订单列表
	cancel_order($order_id, $user_id = 0)-----取消一个用户订单
	affirm_received($order_id, $user_id = 0)------确认一个用户订单
	save_consignee($consignee, $default=false)-----保存用户的收货人信息
	drop_consignee($id)------删除一个收货地址
	update_address($address)-----添加或更新指定用户收货地址
	get_order_detail($order_id, $user_id = 0)----获取指订单的详情
	get_user_merge($user_id)-----获取用户可以和并的订单数组
	merge_user_order($from_order, $to_order, $user_id = 0)------合并指定用户订单
	return_to_cart($order_id)-----将指定订单中的商品添加到购物车
	save_order_address($address, $user_id)-----保存用户收货地址
	
lib_uc.php:UCenter 函数库
	add_feed($id, $feed_type)------通过判断is_feed 向UCenter提交Feed
	get_linked_tags($tag_data)------获得商品tag所关联的其他应用的列表
	exchange_points($uid, $fromcredits, $tocredits, $toappid, $netamount---兑换积分
	
	
 */
/*------第五节:includes目录下的文件----------------------------------------------*/






?>