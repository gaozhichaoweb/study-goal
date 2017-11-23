<?php

/* 
 * 标题：ECSHOP二次开发
 * 作者：高志超
 * 时间：2017-10-13
 */
/*------第一节：给catagory列表子类添加缩略图------------------------------------------------ */
/*
1、分类表category添加thumb字段，目的是在前台页面显示分类时，前面有图片
	thumb			varchar(255)
2、在后台添加分类页面catogory_info.htm添加一个输入框
	<tr>
        <td class="label">分类图片</td>
        <td><input type="file" name="thumb" value='' size="50">
        </td>
    </tr>
3、在分类处理文件catogory.php文件中引入图片处理类的
		include_once(ROOT_PATH . 'includes/cls_image.php'); 
		实例化$image = new cls_image($_CFG['bgcolor']); 
	在if ($_REQUEST['act'] == 'insert')语句里添加
		上传图片，并把上传图片的信息保存到$cat数组中，之后录入数据库
		$img_name = basename($image->upload_image($_FILES['thumb'],'catthumb'));
		if($img_name){
			$cat['thumb'] = $img_name;
		} 
	在if ($_REQUEST['act'] == 'update')语句里添加
		$img_name = basename($image->upload_image($_FILES['thumb'],'catthumb'));
		if($img_name){
			$cat['thumb'] = $img_name;
		} 
4、前台文件显示分类的thumb图片
	打开lib_goods.php
	查找get_categories_tree()中
		第60行的sql语句中添加thumb字段
		$sql = 'SELECT cat_id,cat_name ,parent_id,thumb,is_show ' .
                'FROM ' . $GLOBALS['ecs']->table('category') .
                "WHERE parent_id = '$parent_id' AND is_show = 1 ORDER BY sort_order ASC, cat_id ASC";
		74行修改：获得分类图片
		$cat_arr[$row['cat_id']]['thumb'] = $row['thumb'];
	查找function get_child_tree($tree_id = 0)，
		sql语句中添加字段thumb
		$child_sql = 'SELECT cat_id, cat_name, parent_id,thumb, is_show ' .
                'FROM ' . $GLOBALS['ecs']->table('category') .
                "WHERE parent_id = '$tree_id' AND is_show = 1 ORDER BY sort_order ASC, cat_id ASC";
		106行修改：获得子分类图片
		$three_arr[$row['cat_id']]['thumb'] = $row['thumb'];
*/
/*------第一节：给catagory列表子类添加缩略图------------------------------------------------ */





/*------第二节：后台添加商品时，品牌按照拼音排序------------------------------------------------ */
/*
1、查找添加商品的动作
	admin/goods.php?act=add
2、查找获得品牌列表的方法
	includes/lib_common.php中的get_brand_list()
3、更改sql语句中的排序方法,默认是sort_order
	gbk编码：
		修改为：ORDER BY brand_name
	utf8编码：
		修改为：ORDER BY CONVERT(trim(brand_name) USING gbk)
4、这里的原理是字符编码的问题。
*/
/*------第二节：品牌按照拼音排序------------------------------------------------ */




/*------第三节：后台商品列表中显示分类和品牌------------------------------------------------ */
/*
1、查找商品列表的动作
	admin/goods.php?act=list
2、查找获得商品列表的方法
	includes/lib_goods.php中的goods_list()
3、更改911行sql语句，增加左连接，查找分类和品牌:
	$sql = "SELECT goods_id,g.cat_id,g.brand_id,g.sort_order brand_name".
	"FROM".$GLOBALS['ecs]->table['goods']."AS g left join".
			$GLOBALS['ecs]->table['category']."AS c ON g.cat_id = c.cat_id LEFT JOIN ".
			$GLOBALS['ecs]->table['brand']."AS b ON g.brand_id = b.brand_id WHERE   "
4、修改模版文件goods_list.htm
	标题插入列<td>分类</td>
	行插入列<td><a href="goods.php?act=list$cat_id={$goods.cat_id}">{$goods.cat_name|escape:html}</a></td>
	标题插入列<td>品牌</td>
	行插入列<td><a href="goods.php?act=list$brand_id={$goods.cat_id}">{$goods.brand_name|escape:html}</a></td>
5、修改品牌时，应该注意在where语句中，增加对brand_id字段的标识g.brand_id
	if($filter['brand_id']){
		$where.="AND g.brand_id ="
	}
	不然在商品列表点击分类或品牌搜索时会出错
6、连表查询时注意字段冲突：
	Column 'sort_order' in field list is ambiguous	
	字段sort_order模糊不清，也就是连表查询中的两个或多个表中同时有sort_order
*/
/*------第三节：后台商品列表中显示分类和品牌------------------------------------------------ */




/*------第四节：给goods表添加最小购买数量min_buynum------------------------------------------------ */
/*
1、goods表添加字段min_buynum
	alter table ecs_goods add column min_buynum int not null default 1 after warn_number;
2、找到goods_info.htm模版文件
	在相应位置添加最小购买数量的输入框<input type="text" name="min_buynum">
3、打开goods.php
	在act=insert语句里，添加
		$min_buynum = isset($_POST['min_buynum'])?$_POST['min_buynum']:1；
	修改sql语句，
	INSERT增加字段min_buynum,VALUES 增加$_POST['min_buynum']
	UPDATE  $min_buynum=$_POST['min_buynum']
4、如果需要设置默认商品购买数量最小是min_buynum个，只需要在模版里找到min_buynum，把value值变为{$goods.min_buynum}
5、检查商品数量是否小于最小购买数量,商品提交是ajax提交
	flow.php  127行
	$sql = sprintf("select min_buynum from %s where goods_id='%s'",
			$GLOBALS['ecs']->table('goods'),$goods->goods_id);
	$min_buynum = $GLOBALS['db]->getOne($sql);
	if($min_buynum>$goods->number){
		$result['error'] =1;
		$result['message']='最少购买'.$min_buynum.'个';
	}
*/
/*------第四节：给goods表添加最小购买数量min_buynum------------------------------------------------ */



/*------第五节：在每个页面显示友情连接------------------------------------------------ */
/*
1、获得友情连接的函数是index_get_link(),被写在了index.php中，所以只有首页有友情连接
2、把该函数移植到lib_custom.php(自定义函数文件)中，并在init.php中引入该文件。
3、在相应页面的php文件中给模版传递参数，修改模版文件，添加友情连接模块
*/
/*------第五节：在每个页面显示友情连接------------------------------------------------- */



/*------第六节：第三方支付------------------------------------------------ */
/*
1、把第三方支付平台需要的数据传递给第三方支付平台，然后第三方支付平台把支付结果返回给商城网站	
2、商家和第三方支付平台签订合作协议，即拥有第三方平台的帐号。
3、查看支付接口参数说明
4、验证签名的建立
	首先，将所有的请求数据连接起来，但是不包括空数据、签名和签名类型
	其次，将数据按照键值排序，将排序好的数组中的建和值组合成一个字符串
	再次，将生成好的字符串和当前商户的安全校验码连接，以MD5的方式生成签名。
5、购物流程：
	---商品添加到购物车
	---结算
	---订单确认，选择支付方式和快递，检查用户是否登录
		flow.php?step=checkout
	---完成所有订单操作，提交到数据库
		flow.php?step=done
	---载入相应支付方式：
		include_once('includes/modules/payment/' . $payment['pay_code'] . '.php');
	---调用get_code方法生成支付平台所需参数，跳转到第三方支付平台，
		$pay_online = $pay_obj->get_code($order, unserialize_config($payment['pay_config']));
	----支付结果返回到respond.php
		载入支付插件
			$plugin_file = 'includes/modules/payment/' . $pay_code . '.php';
			include_once($plugin_file);
		调用respond()验证支付状态 
			$payment = new $pay_code();
			$msg     = (@$payment->respond()) ? $_LANG['pay_success'] : $_LANG['pay_fail'];
*/
/*------第六节：第三方支付---------------------------------------------------------------- */



/*------第七节：Ucenter------------------------------------------------ */
/*
1、用户中心，是Comsenz旗下各个产品之间信息直接传递的一个桥梁，可以无缝整合Comsenz旗下产品。
2、三个网站之间数据通信ecshop、ucenter、discuz
3、下载UCenter和discuz，注意下载的版本
	安装discuz---全新安装discuz x(包含ucenter server)
4、登录ecshop后台----会员整合	
	把discuz目录下面的客户端程序uc_client复制到ecshop目录下
	ucenter--安装
	输入ucenter url(..../uc_server)和密码
	安装成功后，系统设置里会多出Ucenter设置
	进入Ucenter，会发现应用管理里有Ecshop通信成功
	这时ecshop注册的用户在 discuz也能登录
5、进入ucenter后台，应用管理开启同步登录
	---ucenter配置信息复制到Ecshop的Config.php
	
*/
/*------第七节：Ucenter------------------------------------------------ */


/*------第七节：修改默认的支付方式和后台订单显示商品总数量------------------------------------------------ */
/*
1、打开flow.php查找checkout
	505行：获取订单信息
		$order=flow_order_info()
		$order['pay_id']=1;
		$order['shipping_id']=7;
2、打开order.php查找info
	321行：$goods_num = 0;初始化一个变量用于存储订单商品总数
	352行：$goods_num +=$row['goods_num'];
			$smarty->assign('goods_num',$goods_num);
	修改模版文件goods_info，添加商品总数列
*/
/*------第七节：修改默认的支付方式和后台订单显示商品总数量------------------------------------------------ */




/*------第八节：放大镜效果------------------------------------------------ */
/*
1、下载放大镜效果的Js，常用的有magic zoom
2、原理并不是放大，而是查看大图。
3、后台goods.php的insert&update
	1100处理相册图片handle_gallery_image()
	打开lib_goods.php,320行生成缩略图，
	342行$img_url = $img_original;相册图片和原图大小一直
	修改生成230*230的img_url
	$img_url = $GLOBALS['image']->make_thumb('../'.$img_original,
				$GLOBALS['cfg']['image_width'],$GLOBALS['cfg']['image_height']);
	$img_url = is_string($img_url)?$img_url:$img_original;
	TODO:

*/
/*------第八节：放大镜效果------------------------------------------------ */


/*------第八节：购物流程------------------------------------------------ */
/*
1、加入购物车，触发addToCart函数，ajax请求到flow.php?step=add_to_cart
2、flow.php?step=add_to_cart
	1、检查商品id是否合法
	2、检查商品数据的完整性
	3、如果是一步购物，直接到订单确认页面，只能购买一个商品
	4、如果商品购买数量合法，则添加商品到购物车cart

*/
/*------第八节：购物流程------------------------------------------------ */


/*------第八节：验证码------------------------------------------------ */
/*
系统设置---验证码管理
登录开启验证码，$captcha=47,不开启验证码验证，则$captcha=12，而CAPTCHA_LOGIN=2
$captcha&CAPTCHA_LOGIN运算的值为0，在验证码判断时值为0，就不会显示验证码输入框，而且也不会验证验证码是否正确。
十进制转二进制：进行二因式分解，除2求余数
	2|12    余数0
	2| 6	余数0
	2| 3    余数1
	2| 1	余数1
	则12的二进制为1100
&操作：相同位上都为1则为1
	12:   1100
	2:    0010
	结果：0000
*/
/*------第八节：验证码------------------------------------------------ */



/*------第八节：修改ur_here------------------------------------------------ */
/*
1、修改ur_here.lbi文件的样式
  <div class="container">
    <ol class="breadcrumb">
    {$ur_here}
    </ol>
  </div>
2、修改lib_main.php文件中的assign_ur_here函数
	开始的首页处理
		$ur_here    = '<li><a href=".">' . $GLOBALS['_LANG']['home'] . '</a></li>';
	中间循环部分的处理
		$ur_here   .= '<li><a href="' . build_uri($type, $args, $val['cat_name']) . '">' .
                                    htmlspecialchars($val['cat_name']) . '</a></li>';
	最后一部分的处理
		if (!empty($str))
		{
			$page_title  = $str . '_' . $page_title;
			$ur_here    .= ' <li>' . $str.' </li>';
		}
*/
/*------第八节：验证码------------------------------------------------ */


/*------第八节：transport.js------------------------------------------------ */
/*
1、transport.js用于支持AJAX的传输类，如果页面加载jquery则会出现冲突的问题
2、解决办法：
	重新建立一个文件，名为transport_jquery.js
	把497-737行注释掉，前端需要调用ajax的时候加载该文件替换ecshop的transport.js文件。

*/
/*------第八节：验证码------------------------------------------------ */



/*------第八节：common.js------------------------------------------------ */
/*
1、addToCart失败，提示goods.toJSONString()不是一个函数
2、解决办法：
	<script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery.json.js"></script>
	Ajax.call('flow.php?step=add_to_cart', 'goods=' + $.toJSON(goods), addToCartResponse, 'POST', 'JSON');

*/
/*------第八节：验证码------------------------------------------------ */




/*------第八节：foreach------------------------------------------------ */
/*
1、foreach只显示第一个
	<!-- {foreach from=$consignee_list item=consignee key=sn name=cons} -->
    <!--{if $smarty.foreach.cons.first}-->
*/
/*------第八节：验证码------------------------------------------------ */










