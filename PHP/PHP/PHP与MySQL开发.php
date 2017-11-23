<?php
/*
一、PHP概述
	1.基本语法
		要把PHP代码添加到页面中，可以把它置于PHP标签内：
		<?php ?>
		放置在这些标签内的任何内容都会被Web服务器视作PHP代码(PHP解释器将处理这些代码)
		PHP标签外的任何文本会立即作为常规HTML发送给Web浏览器。
		字符编码：在文件中所使用的字符编码指示文件将显示什么字符(语言)。
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />		
		由于PHP脚本需要由服务器解析，所以你必须通过URL访问PHP脚本。
		http://你的域名/index.php
	2.发送数据到Web浏览器
		echo
		print
		var_dump
		在PHP中，所有语句都必须以分号结尾。
		在涉及函数名时PHP不区分大小写，及echo、ECHO和eCHO都会工作。
	3.编写注释
		在HTML中用：<!--xxx-->
		在PHP中用：#、//和斜杠星号		
	4.变量：临时存储值的容器
		8种变量：包括4种标量(单值)类型---布尔型、整型、浮点型和字符串
				两种非标量(多值)类型---数组和对象
				以及资源和NULL
		变量语法规则：
			变量的名称必须以美元符号（$）开始
			变量的名称可以包含字母、数字和下划线
			美元符号之后的第一个字母必须是字母或下划线(不能是数字)
			变量名称区分大小写。
		可以使用等于号给变量赋值
		无需引号即可打印变量，也可以在双引号内打印变量，不能在单引号内打印变量
	5.字符串：只是一块用引号括起来的字符
		创建字符串时可以用单引号或者双引号封装字符。
			单引号：括在单引号内的值将照字面意义进行处理。
				$var='test';
				echo '\$var is equal to $var';  //输出：\$var is equal to var
			双引号：括在双引号内的值将被解释(把变量和特殊字符放在双引号内将打印他们表示的值)。
				echo "\$var is equal to $var";  //输出：$var is equal to test
		使用连接运算符即句点(.)来连接字符串
********字符串函数：
			strlen()计算字符串长度
			strtolower()把字符串全部变为小写
			strtoupper()把字符串全部变为大写
			ucfirst()第一个字符大写
			ucwords()每个单词的第一个字符大写	
	6.数字：整型和浮点型
		数字永远不用引号括起来，也不能用逗号来表示千位分隔符
××××××××数字函数：
		round()把小数四舍五入为最接近的整数
			round(12.346,2);//12.35
		number_format()把一个数字转换成常见的表示形式，比如用逗号作为千位分隔符
			number_format(20943,2);//20,943.00
		处理算术运算时，会出现优先级问题，建议把子句组织在括号中来强制执行次序。
	7.常量：常量像变量一样，用于临时存储一个值，但是不同于变量。
		创建常量：define('NAME',value);
		经验：全部使用大写字母来命名常量，尽管并非必须如此。
		define('USERNAME','gao');
		使用常量时不能用引号括住常量
		echo "hello".USERNAME;
	8.基本的调试步骤：
		确保你总是通过URL来运行PHP脚本
		了解正在运行的PHP脚本
		确保display_errors启用
		检查HTML源代码
		信任错误信息
二、PHP编程
	1.创建表单
		<form action="login.php" method="post">
			<label>name:</label><input type="text" name="name" />
			<label>password:</label><input type="text" name="password" />
			<label>password:</label><textarea name="content"></textarea>
			<input type="submit" name="submit" />
		</form>
		get:用于请求信息，比如数据库中的特定记录或者搜索结果
		post:采取一个动作，比如更新数据库记录或者发送电子邮件时
	2.处理表单
		通过$_REQUEST['name']来访问；
			$name=$_REQUEST['name'];
			$password=$_REQUEST['password'];
		$_REQUEST是一个超全局变量，它存储了通过GET和POST方法发送到PHP页面的所有数据，以及在cookie中可访问的数据。
	3.事件语句和运算符
		条件语句哦3个主要术语是：if、else和elseif。
		PHP中条件为真的情况：
			$var如果$var具有非0值、空字符串、FALSE或NULL,则条件为真
			isset($var)如果$var具有不同于NULL的任何值，包括0、FALSE或空字符串，则条件为真
			TRUE、true、True等
		比较和逻辑运算符：
			==、！=、<、>、&&、||等
	4.验证表单数据
		if(isset($_REQUEST['name'])){
			$name=$_REQUEST['name'];
		}else{
			$name=NULL;
		}
		if($name=='gao'){
			echo "hello $name";
		}
	5.介绍数组:数组可以保存多分单独的信息，就像是值得的列表，一系列的键-值(key-value)对。
		索引数组；使用数字(索引)作为键,默认从0开始，除非显示指定键。
			$bk=$book[0];
			echo "book $book[0]";  //使用数字做为键，可以直接打印
		关联数组：使用字符串作为键
			$city=$cityarr['ningxia'];
			echo "book {$cityarr['ningxia']}";  ////使用字符串作为键，必须用{}包括，防止出现错误
		数组中每一个键必须是唯一的。
		创建数组：
			一次添加一个元素来创建数组：
				$book[]='book1';
				$book[]='book2';
				$book[]='book3';
			添加元素时指定键
				$book['book']='book1';
				$book['name']='name1';
				$book['email']='abc@qq.com';
			使用array()函数：
				$artists = array('book1','shins','eels');
				$states = array('book'=>'book1','name'=>'name1','email'=>'email1');
			如果你设置了第一个数字键值，那么此后添加的值将是可以递增的键
				$days=array(1=>'sun','mon','tue');
			创建连续的数字数组，使用range()函数：
				$ten = range(1,10);
			创建连续的字母数组，使用range()函数：
				$alphabet = range('a','z');
		访问每个数组元素：
			foreach($array as $key=>$value){
				echo "the value at $key is $value";
			}
			foreach循环将会迭代$array中的每个元素，并把每个元素的值赋予$value变量
		确定数组中元素的个数，使用count()函数：
			$num = count($arr);
		多维数组：
			<input type="checkbox" name="interests[]" value="music">
			<input type="checkbox" name="interests[]" value="movies">
			<input type="checkbox" name="interests[]" value="books">
			接收的PHP页面中的$_POST是多维的。$_POST['interests']是一个数组，
			并用$_POST['interests'][0]保存第一个选中的复选框
			并用$_POST['interests'][1]保存第二个选中的复选框
××××××××数组和字符串相互转换函数：
			$array = explode(separator,$string);  //把字符串转换为数组，以separator为分隔符
			$string = implode(glue,$array);  //把数组转换为字符串，把glue插入到中间
××××××××数组排序：
			$name = array('moe','larry','curly');
			sort($name);  //按值对数组排序，并丢弃原来的键。如果键值关系很重要，不能用这个函数。
			asort($name);  //按值对数组排序，同时还会维持键。
			ksort($name);	//按键对数组排序。
			
			如果以相反的顺序对数组排序，使用rsort(),arsort(),krsort().
			随机排列数组的顺序，使用shuffle();
	6.for和while循环
		while(condition){
			//当循环的次数未知时，使用while循环(从数据库中检索结果时，最常使用while循环)。
		}  
		for($i=1;$i<10;$i++){
			//如果循环次数已知时，for循环是更好的选择
		}
三、创建WEB站点
	1.包含多个文件:获取包含文件的所有内容，可以是PHP和HTML
		include()    //用于不重要文件
		include_once()
		require()    //用于重要文件
		require_once()
		两者在正确工作时完全一样，只有在失败时才会表现的不同。
		include()会向Web浏览器打印一个警告，脚本继续运行。
		require()会打印一个错误，脚本会终止运行。
	2.建立粘性表单
		<input value="<?php if(isset($_POST['name'])) echo $_POST['name']); ?>" />
	3.创建函数	
			function fname(){
				
			}
		函数名称可以是字母、数字和下划线，但是必须以字母或下划线开头。
		而且不能使用现有函数(如echo,isset等)。
		函数名不区分大小写，调用时必须一致。
		给函数设置默认的参数：
			function fname($name,$msg='hello'){
				
			}
		用户自定义的函数最后一个属性应该是返回值
			return $var;  //return语句会终止代码的执行。
四、MySQL简介
	1.命名数据库元素
		标识符规则：
			应该只含字母、数字和下划线
			不应该与现有的关键字相同
			应该区分大小写  (windows和正常的mac os上不区分大小写，在UNIX上区分大小写)
			在其区域内必须是唯一的		
	2.选择列类型
		主要有3类信息：
			文本(字符串)
			数字
			日期和时间
		MySQL数据类型
		CHAR[length]				length					定长字段，长度0-255字符，使用空格填充
		VARCHAR[length]				string长度+1字节		变长字段，长度0-65535字符
		TINYTEXT					string长度+1字节		字符串，最大长度255字符
		TEXT						string长度+2字节		字符串，最大长度65535字符
		MEDIUMTEXT					string长度+3字节		字符串，最大长度16777215字符
		LONGTEXT					string长度+4字节		字符串，最大长度4294967295字符
		TINYINT[length]				1字节					无符号范围：0-255
		SMALLINT[length]			2字节					无符号范围：0-65535
		MEDIUMINT[length]			3字节					无符号范围：0-16777215
		INT[length]					4字节					无符号范围：0-4294967295
		FLOAT[length,decimals]		4字节					具有浮动小数点的较小的数
		DOUBLE[length,decimals]		8字节					具有浮动小数点的较大的数
		DECIMAL[length,decimals]	length+1字节			存储为字符串的DOUBLE。绝对精度时用
		DATE						3字节					采用YYYY-MM-DD格式
		DATETIME					8字节					采用YYYY-MM-DD HH:MM:SS格式
		TIMESTAMP					3字节					采用YYYYMMDDHHMMSS格式
		TIME						3字节					采用HH:MM:SS格式
		如果尝试把一个长度为5个字符的字符串插入到一个CHAR(2)列中，就会截去最后3个字符
	3.选择其他的列属性
		首先，不管类型如何，每一列都可以定义为NOT NULL.
		在创建表示，可以为任意列指定一个默认值，而不管其类型是什么(TEXT列不能赋默认值)。
			gender ENUM('M','F') default 'F';
		可以把数据类型标记为UNSIGNED,这把存储的数据限制为正数或0。
		最后，在设计数据库时，需要考虑创建索引、添加键(主键PRIMARY KEY)以及使用AUTO_INCREMENT属性。
	4.访问MySQL
		访问MySQL数据库：
			mysql -hlocalhost -uroot -proot
		选择使用的数据库
			use dbname;
		退出MySQL:
			exit;
		输入C并按下return或enter键来取消当前的操作。
五.SQL简介
	1.创建数据库和表
		CREATE DATABASE dbname;
		CREATE TABLE tbname(
			column1name description,
			column2name description,
			column3name description,
			PRIMARY KEY (column1name)
		);
		SHOW TABLES;
		SHOWW COLUMNS FROM tablename;  //DESCRIBE tablename;
	2.插入记录
		INSET INTO tablename(column1,column6) VALUES (value1,value6);
		INSET INTO tablename VALUES (value1,value6);
	3.选择数据
		SELECT column1,column2 FROM tablename;
	4.使用条件语句
		SELECT name FROM tablename WHERE name='gao';
		WHERE表达式常见的运算符
		=、<、>、<=、>=、!=、IS NOT NULL、IS NULL、IS TURE、IS FALSE、IN、NOT IN、BETWEEN、NOT BETWEEN、AND、OR。
	5.使用LIKE和NOT LIKE
		SELECT * FROM users WHERE last_name LIKE 'Smith%';
	6.对查询结果排序
		SELECT * FROM tablename WHERE conditions ORDER BY column1;
		默认是升序(ASC)，可以指定降序(DESC)。
	7.限制查询结果
		SELECT * FROM tablename LIMIT x,y;
		查询从x条记录开始的y条记录
	8.更新、删除
		UPDATE tablename SET column1=value1,column2=value2;
		UPDATE tablename SET column1=value1 WHERE column2='value2' LIMIT 1;  //LILMIT 1防止更新多行。
		不要在主键列上执行UPDATE.
		DELETE FROM tablename;
		DELETE FORM tablename WHERE condition LIMIT 1;  //LILMIT 1防止更新多行;
六、使用PHP和MySQL数据库
	1.连接到MySQL
		$dbc=mysqli_connect(hostname,username,password,db_name);
		mysqli_connect_error();//返回链接错误消息
		连接到MySQL：
		DEFINE('DB_HOST','localhost');
		DEFINE('DB_USER','root');
		DEFINE('DB_PASSWORD','root');
		DEFINE('DB_NAME','sitename');
		$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
		mysqli_set_charset($dbc,'utf8');  //mysqli_query($dbc,'SET NAMES utf8');
		如果mysqli_connect()没有包含数据库选择，使用下面语句：
		mysqli_select_db($dbc,db_name);
		在函数调用前方一个错误控制运算符(@)，可以防止在Web浏览器中显示PHP错误。
	2.执行简单的查询
		用于执行查询的PHP函数是mysqli_query()
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$errors=array();  //存储错误信息
			//获取email并判断不为空
			if(empty($_POST['email'])){
				$errors[]='请输入密码';
			}else{
				$email=trim($_POST['email']);
			}
			//验证密码一致并判断不为空
			if(!empyt($_POST['pass1'])){
				if($_POST['pass1'!=$_POST['pass1']){
					$errors[]='密码不一致';
				}else{
					$p=trim($_POST['pass1']);
				}
			}else{
				$errors[]='请输入密码';
			}
			if(empty($errors)){  //所有判断都正常
				$query="INSET INTO users (email,pass,datetime) VALUES('$email',SHA1('$p'),NOW())"；
				$rusult=mysqli_query($dbc,$query);
				if($rusult){
					echo 'SQL语句成功';
				}else{
					echo 'SQL语句失败：'.mysqli_error($dbc);
				}
				mysqli_close($dbc);
			}else{
				echo "出现错误：";
				foreach($errors as $msg){
					echo "$msg<br />\n"；
				}
			}
		}
		INSET、DELETE、UPDATE语句返回TRUE或FASLE
	3.检索查询结果
		处理SELECT查询结果的主要工具是mysqli_fetch_array($result),以数组格式一次返回一个数据。
		可以设置返回的是索引数组还是关联数组
			while($row=mysqli_fetch_array($result)){
				//
			}
		一旦查询完成，即可释放这些信息：
			mysqli_free_result($resule);
	4.确保SQL安全
		1.保护MySQL访问信息
			通过确保WEB目录外面的MySQL连接脚本，这样永远都不能通过WEB浏览器访问到它
		2.不要呈现关于数据库的过多信息
			通过不允许用户查看PHP的出错消息或者你的查询
		3.在运行查询时要小心谨慎
			永远都不要相信用户提供的数据
			1.验证提交的值，或者验证它是否具有正确的类型
			2.适用女正则表达式确保提交的数据与你所期待的匹配
			3.可以强制转换某些值的类型以确保他们是数字
			4.应该为表单中所有的输入文本使用mysqli_real_escape_string()函数来处理用户提交的数据,
			该函数通过转义那些可能有问题的字符来清理数据。
			$email=mysqli_real_escape_string($dbc,trim($_POST['email']));
			如果服务器上启用Magic Quotes，那么使用该函数前要删除Magic Quotes添加的任何斜杠：
			$email=mysqli_real_escape_string($dbc,trim(stripslashes($_POST['email'])));
	5.统计返回的记录
		mysqli_num_rows($result)返回SELECT查询检索的行数
		$num=mysqli_num_rows($result)
		if($num>0){
			//数据库里有相同的数据
		}
		可以用来防止注册相同的信息，分页中也会用到。
	6.利用PHP更新记录
		使用UPDATE查询，并利用mysqli_affected_rows()函数来验证查询的成功执行。
		if($num=mysqli_affected_rows($dbc)){
			echo "更新 成功";
		}
		这个函数带的参数是数据库连接参数
		如果使用UPDATE更新数据，但是前后更改的数据一样，则会返回0；
		比是用$rusult更严格。
七、常用编程技术
	1.给脚本发送值
		第一种利用HTML的隐藏输入框类型
			<input type="hidden" name="do" value="this" />
			这行代码可以出现在Form标签中的任意位置，那么$_POST['do']将具有this这个值
		第二种是把值追加到URL上
			<a href="www.example.com/page.php?do=this" >
			这种技术模仿了Html表单的GET方法，可以传递多个值，用&连接
			$_GET['do']将具有this这个值
			<a href="www.example.com/page.php?do='.$row['user_id'].'" >
	2.使用隐藏的表单输入框
		<input type="hidden" name="do" value="'.$row['user_id'].'" />
		检查有效的用户Id值
		if((isset($_GET['id']))&&(is_numeric($_GET['id']))){
			$id=$_GET['id'];
		}else{
			exit();
		}
		隐藏的表单元素不会显示在Web浏览器中，但是仍会存在于HTML源代码中。所以不要存储任何安全内容。
	3.给查询结果表页码
		veiw_users.php
	4.建立可排序的显示结果
		修改order by 后面的参数
八、web应用程序开发
	1.发送电子邮件
		mail(to,subject,body,[headers]);
		to:邮件地址
		subject:主题行   //不能包含换行符(\n)
		body:邮件内容    //正文中每一行的长度都不能超过70个字符
			$body="这里内容超过70个字符了";
			$body=wordwrap($body,70);
		[header]头部信息：form(发件人),reply_to,cc,bcc和类似的选项。
		$headers="From:john@qq.com\r\n";
		$headers.="Cc:smith@qq.com,jane@qq.com\r\n";
		mail($to,$subject,$body,$headers);
		注意：mail()函数实际上不会发送电子邮件本身，而是告诉计算机上的邮件服务器执行该任务。
			也就是说，运行PHP的计算机上必须具有一个工作的邮件服务器。
	2.处理文件上传
		必须正确的设置PHP。
		必须有一个临时存储目录，并且有正确的权限。
		必须有一个最终存储目录，它具有正确的权限。
		1.允许文件上传
			php.ini文件中有多种设置，规定了PHP如何处理上传。
			file_uploads			布尔型		使得PHP支持文件上传
			max_input_time			整型		指示允许PHP脚本运行多长时间
			post_max_size			整型 		运行的POST数据的总大小
			upload_max_filessize	整型 		允许的尽可能最大的文件上传
			upload_tmp_dir			字符串 		指示应该临时把上传的文件存储在什么位置
			使用phpinfo()函数查看PHP配置信息。
			file_uploads=on;
			;upload_tmp_dir=
			upload_max_filesize=2M
		2.利用PHP上传文件
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="MAX_FILE_SIZE" value="8000000">
				FILE:<input type="file" name="upload">
			<form>
			如果要上传文件，必须包括enctype属性。而且必须使用POST方法。
			上传后使用$_FILES超全局变量访问上传文件,数组元素如下：
				name、type、size、tmp_name、error
			PHP脚本接受到文件后，使用下面函数从临时目录转移到永久位置。
				move_uploaded_file(temporay_filename,/path/to/destination/filename);
			例如：
				if(isset($_FILES['upload'])){
					$allowed=array('image/pjpeg','image/JPG','image/jpeg','image/X-PNG','image/PNG','image/png','image/x-png');
					if(in_array($_FILES['upload']['type']),$allowed){
						//把文件复制到它在服务器上的新位置
						if(move_uploaded_file($_FILES['upload']['tmp_name'],"../uploads/{$_FILES['upload']['name']}")){
							echo '<p>The file has been uploaded!</p>';
						}
					}else{
						echo echo '<p>please upload a JPEG or PNG image.</p>';
					}
				}
				//检查并报告错误，错误编号0-8没有5
				if($_FILES['upload']['error']>0){
					echo echo '<p>the file could not be uploaded because:</p>';
					switch($_FILES['upload']['error']){
						case 1:
							print '';
							break;
						case 2:
							print '';
							break;
						default:
							print '';
							break;
					}
				}
				//删除临时文件
				if(file_exists($_FILES['upload']['tmp_name'])&&is_file($_FILES['upload']['tmp_name'])){
					unlink($_FILES['upload']['tmp_name']);
				}
	3.PHP和JAVASCRIPT
		echo "<li><a href=\"javascript:create-window('$image_name',$image_size[0],$image_size[1])\">$image</a>\n";
	4.理解HTTP头部
		header(header string);
		header('Location:http://www.baidu.com/index.php');
		header("content-type:application/pdf\n");  //提示浏览器将接受一个PDF文件
		header('content_disposition:attachment;filename=\"somefile.pdf\"\n'); //提示浏览器下载文件
		如果一个脚本使用多个header()调用，应该用换行符(\n)终止每个Header（）调用
		必须在把任何内容发送给web浏览器之前调用它
	5.日期和时间函数
		date_default_timezone_set()函数，用于建立默认的时区
		checkdate(month,day,year) //获取月份、天和年份作为参数，并返回一个布尔值，指示日期是否实际存在
		date()以格式化的字符串返回日期或时间
			echo date('F j,Y');  //january 26，2011
			echo date('H:i'); //23：14
			echo date('D');	//sat
			$image_date=date('F d,Y H:i:s',filemtime("$dir/$image"));//获得文件的修改日期
		mktime()找到特定日期的时间戳，不带参数等同于time()函数
		getdate()用于返回日期和时间的值的数组
			$today=getdate();
			echo $today['month'];
		
		
八、cookie和会话
	1.创建登录函数login_function.inc.php
		//返回一个绝对Url,可以在一个服务器上开发代码，然后移到另一个服务器上，而无需更改这段代码。
		function redirect_user($page='index.php'){
			$url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
			$url=rtrim($url,'/\\');  	//从URL中删除任何结尾斜杠（\\是转义\）
			$url.='/'.$page;			//添加特定的页面URL
			header("Location:$url"); 	//重定向
			exit();						//结束脚本
		}
		//验证登录信息，三个参数：数据库连接、电子邮件地址、密码
		function check_login($dbc,$email='',$pass=''){
			$errors=array();
			//验证电子邮件不为空
			if(empty($email)){
				$errors[]='你忘记输入邮箱地址';
			}else{
				$e=mysqli_real_escape_srting($dbc,trim($email));
			}
			//验证密码不为空
			if(empty($pass)){
				$errors[]='你忘记输入密码';
			}else{
				$p=mysqli_real_escape_srting($dbc,trim($pass));
			}
			//如果没有错误，则从数据库中查询数据
			if(empty($errors)){
				$q="SELECT user_id ,first_name FROM users WHERE email='$e' AND pass=SHA1('$p')";
				$r=@mysqli_query($dbc,$q);
				//检查查询结果，如果返回一行，那么登录信息验证正确
				if(mysqli_num_rows($r)==1){
					$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
					return array(true,$row);  //如果验证成功，返回结果，并退出
				}else{
					$errors[]='邮箱地址和密码有误';
				}
			}
			return array(false,$errors);   /如果验证失败，返回失败信息
		}
	2.使用cookie
		cookie是服务器在用户的机器上存储信息的一种方式，站点可以在访问期间记住或跟踪用户。
		不同浏览器都在不同的位置定义了他们的cookie处理策略
		设置cookie:
			必须在任何其他信息之前把它们从服务器发送给用户，否则会出错。
			通过setcookie()函数发送cookie:
			setcookie('name','Nicole');
			
			
			if($_SERVER['REWUEST_METHOD'=='POST']){
				require('login_function.inc.php');
				list($check,$data)=check_login($dbc,$_POST['email'],$_POST['pass']);
				//把返回的第一个值(ture,false)赋予$check,把第二个值($errors)赋给$data
				if($check){
					setcookie('user_id',$data['user_id']);
					setcookie('first_name','$data['first_name']');
				}else{
					$errors=$data;
				}
			}
			mysqli_close($dbc);
		访问cookie:
			if(!isset($_COOKIE['user_id'])){  //如果用户未登录，就重定向页面
				require('login_function.inc.php');
				redirect_user();
			}
			<p>欢迎您：{$_COOKIE['first_name']}</p>
		设置cookie参数：
			setcookie(name,value,expiration,path,host,secure,httponly);
			expiration:到期时间，用于设置cookie存在的精确限定时间长度
			setcookie(name,value,time()+1800);  //到期时间为30分钟
		删除cookie:
			setcookie('first_name');  //只发送一个包含名称没有值的cookie，效果相当于删除现有的同名cookie.
			附加的预防措施是把到期日期设置为国务的某个日期
			setcookie('first_name','',time()-3600);
	3.使用会话
		会话比cookie更安全，因为所有记录存储在服务器上；允许存储更多数据；使用会话时，可以不使用cookie。
		设置会话：
			session_start();  //开启会话，或者访问现有的会话。
			第一次使用session_start()时，它会试图发送一个cookie,名称为PHPSESSID和一个会话ID（32个十六进制的id)。
			$_SESSION['key']=value;
			
			if($check){
					session_start();
					$_SESSION['user_id']=$data['user_id'];
					$_SESSION['first_name']=$data['$data['first_name']'];
				}else{
					$errors=$data;
				}
		访问会话变量：
			if(!isset($_SESSION['user_id'])){  //如果用户未登录，就重定向页面
				require('login_function.inc.php');
				redirect_user();
			}
			<p>欢迎您：{$_SESSION['first_name']}</p>
		删除会话变量：
			删除单独一个变量：
			unset($_SESSION['user_id']);
			删除所有会话变量：
			$_SESSION=array();
			从服务器中删除所有的会话数据：
			session_destroy();
			
			退出登录：
				session_start();
				if(!isset($_SESSION['user_id'])){
					require('login_function.inc.php');
					redirect_user();
				}else{
					$_SESSION=array();
					session_destroy();
					setcookie('PHPSESSID','',time()-3600);
				}
			永远不要把$_SESSION设置成等于NULL并且永远不要使用unset($_SESSION),因为他们都会在某些服务器上引发问题。
			session_name()函数可以更改会话的名称，这样更安全。
	4.提高会话安全性
		防止会话劫持的一中方法是：在会话中存储某种用户标识符，然后反复地复查这个值。
		HTTP_USER_AGENT是一个不错的选择,存储的是所有的浏览器和操作系统的组合。
				if($check){
					session_start();
					$_SESSION['user_id']=$data['user_id'];
					$_SESSION['first_name']=$data['$data['first_name']'];
					$_SESSION['agent']=md5($_SERVER['HTTP_USER_AGENT']);
					redirect_user('loggedin.php');
				}else{
					$errors=$data;
				}
			loggedin.php:
				如果没有设置agent或者验证不对，则跳转页面。
				if(!isset($_SESSION['agent']) OR ($_SESSION['agent']!=md5($_SERVER['HTTP_USER_AGENT']))){
					require('login_function.inc.php');
					redirect_user();
				}
九、安全性方法
	1.阻止垃圾邮件
	2.通过类型验证数据
		使用is_numeric()、is_array()等类型验证函数
		类型强制转换：(int) $var;
	3.按类型验证文件
		PHP5.3中加入的 FILEINFO扩展通过获取文件的“魔法字节”或“魔法数字”来判断文件的类型
		例如：GIF图片必须以ASCII码GIF89a或GIF87a开头，PDF必须以%PDF开头
		$fileinfo = finfo_open(FILEINFO_MIME_TYPE);  //建立Fileinfo资源，FILEINFO_MIME_TYPE判断文件类型的常量
		finfo_file($fileinfo,$filename); //此函数基于文件的实际“魔法字节”返回文件的MIME类型
		finfo_close($fileinfo);//关闭Fileinfo资源
		例：
			$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
			if(finfo_file($fileinfo,$_FILES['upload']['tmp_name'])=='text/rtf'){
				echo 'the file would be acceptable!';
				//unlink($_FILES['upload']['tmp_name']); //删除文件
			}else{
				echo "please upload an rtf document"；
			}
			finfo_close($fileinfo);
	4.组织XSS攻击
		用户注入恶意代码，如创建弹出窗口、窃取cookie或者把浏览器重定向到其他站点。
		PHP包含一些函数，用于处理字符串内发现的HTML和其他代码：
			htmlspecialchars(),它把&'"<>转变成HTML实体格式（&amp、&quot等） //带参数指示如何处理引号
			htmlentities()它把所有实用的字符转变成它们的HTML实体格式	//带参数指示如何处理引号
			strip_tags()它删除所有的HTML和PHP标签  //带参数可以指示不清除什么标签
	5.使用过滤器扩展
		filter_var(variable,filter[options]);  //该函数用于验证数据或清理数据
		验证过滤器：FILTER_VALIDATE_BOOLEAN、FILTER_VALIDATE_EMALL、FILTER_VALIDATE_FLOAT、
		FILTER_VALIDATE_INT、FILTER_VALIDATE_IP、FILTER_VALIDATE_REGEXP、FILTER_VALIDATE_URL、
		例如：	
			if(filter_var($var,FILTER_VALIDATE_FLOAT)){
				//确认变量有小数
			}
			if(filter_var($var,FILTER_VALIDATE_INT,array('min_range'=>1,'max_range'=>120))){
				//确认$var变量是1到120之间的整数。
			}
		清除过滤器：FILTER_SANITIZE_EMALL、FILTER_SANITIZE_ENCODED、FILTER_SANITIZE_MAGIC_QUOTES、
		FILTER_SANITIZE_NUMBER_FLOAT、FILTER_SANITIZE_NUMBER_INT、FILTER_SANITIZE_SPECIAL_CHARS、
		FILTER_SANITIZE_STRING、FILTER_SANITIZE_SRTIPPED、FILTER_SANITIZE_URL、FILTER_SANITIZE_RAW
		FILTER_SANITIZE_MAGIC_QUOTES与addslashed()作用相同
		FILTER_SANITIZE_SPECIAL_CHARS与htmlspecialchars()相同
		FILTER_SANITIZE_STRING与strp_tags()相同
		例：
			if(isset($_POST['price'])){
				$price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
			}else{
				$price=NULL;
			}
		filter_has_var()函数确认是否存在具有给定名称的变量。
		filter_input_array()函数可以一次对数组应用一组过滤器。
	6.预防SQL注入攻击:SQL注入比较容易预防
		首先、验证查询中使用的所有数据
		其次、使用函数如mysqli_real_escape_string();
		最后、不要在站点上显示错误详情
		
		使用函数如mysqli_real_escape_string()的替代选择是使用预处理语句
		(不使用预处理语句，整个查询都会作为一个长字符串发送到Mysql。然后MySQL分析并执行它)。
		(使用预处理查询，SQL语法首先被发送到MySQL解析，确保它在语法上是有效的，然后单独发送特定的值，
		MySQL使用这些值组合查询，然后执行它。)
		使用预处理语句的好处：它可以带来更高的安全性，并且可能提供更好的性能。
		例如：
			$q="SELECT user_id,first_name FROM users WHERE email=? ADN pass=SHA1(?)"
			接下来，预处理语句MySQL中的语句，将结果赋给PHP变量
			$stmt=mysqli_prepare($dbc,$q);
			现在，MySQL将解析查询，但是不会执行它
			接下来，要将PHP变量绑定到查询的占位符上。
			mysqli_stmt_bind_param($stmt,'ss',$e,$p);
			这里不用引号括住他们，这是预处理语句与标准查询之间的一个区别
			$e='email@qq.comm';
			$p='mypass';
			mysqli_stmt_execute($stmt);
		例子：
			$q='INSERT INTO messages(forum_id,parent_id,user_id,subject,body,date_entered)
				VALUES(?,?,?,?,?,NOW())';
			$stmt=mysqli_prepare($dbc,$q);
			mysqli_stmt_bind_param($stmt,'iiss',$forum_id,$parent_id,$user_id,$subject,$body);
			$forum_id=(int)$_POST['forum_id'];
			$user_id=3;
			$subject=strip_tags($_POST['subject']);
			$body=strip_tags($_POST['body']);
			mysqli_stmt_execute($stmt);  //执行语句
			if(mysqli_stmt_affected_rows($stmt)==1){
				echo '<p>your message has been posted</p>';
			}else{
				echo '<p>your message could not be posted</p>';
				echo '<p>'.mysqli_stmt_error($stmt).'</p>';
			}
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
		7、安全建议
			尽量减少从用户清酒的和站点存储的信息
			不要使用用户为上传的文件提供的名称
			观察如何使用数据库引用
			不要显示详细的错误信息
			使用加密技术
			不要存储信用卡卡号等信息
			如果可以使用SSL
			可靠、一致地保护需要保护的所有页面和目录		
十、正则表达式
	1.创建测试脚本
		preg_match(patten,subject); //函数返回0或1
		建议使用单引号定义模式，在引号内需要对定界符内对模式转义，通常是正斜杠
		preg_match('/a/','cat');  //查看单词cat是否包含字母a
		如果你的服务器上启用了MagicQuotes，脚本将会为特定的字符添加斜杠，很有可能让正则表达式失败
		这时需要使用stripslashes()函数
		$pattern=stripslashes(trim($_POST['pattern']));
	2.定义简单的模式
		元字符是特殊的符号，其含义超出了它们的字面量值
		\转义符
		^$指示字符串的开始	指示字符串的结束
		.除换行符之外的任意单个字符
		|二中择一
		[]类的开始结束
		()子模式的开始结尾
		{}量词的开始结尾
		^a匹配以a开头的任何字符串
		a$匹配以a结尾的任何字符串
		a|b匹配包含a或b的字符串
		(abc)匹配abc
	3.使用量词
		?0次或1次
		*0次或多次
		+1次或多次
		{x}正好出现x次
		{x,y}在x次和y次之间含x和y
		{x,}至少出现x次
		a{3,}将匹配aaa,aaaa,aaaaa等
		a{3,5}则值匹配aaa,aaaa,aaaaa
		^(0|1|2|3|4|5|6|7|8|9){5}$匹配5位数字
	4.使用字符类别
		[0-9]		      \d		任意数字
		[\f\r\t\n\v]	\s			任意空白
		[A-Za-z0-9]		\w			任意单词字符
		[^0-9]			\D			非数字
		[^\f\r\t\n\v]	\S			非空白
		[^A-Za-z0-9]		\W		非单词字符
		^[0-9]{5}$匹配5位数字
		^\d{5}$匹配5位数字
		^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$电子邮件
		[\w.-]匹配abc,abc11,abc.ef,abc-ef		
	5.查找所有匹配
		preg_match_all()查找所有匹配
	6.使用修饰符
		A将模式定位到字符串的开头
		i启用不区分大小写的模式
		m启用多行匹配
		s是句点匹配每个字符，包括换行符
		x忽略大多数空白
		U执行不贪婪的匹配
	7.匹配和替换模式
		preg_replace()执行查找和替换
		$str=preg_replace('/cat/','dog','I like my cat.');//用dog替换cat，最好使用str_replace()函数
十一、面向对象编程oop
	OOP与面向过程：
		过程式编程可以更快的学习和使用，特别是对于较小的项目，但是难以维护和扩展，出现错误的可能性多。
		OOP更容易维护，适合大型项目和团队开发，但OOP难以掌握。
	1.基础知识和语法
		1.1、面向对象的基础
			面向对象编程是以类定义开始的，他是一种特定类型的数据模板。
			类的定义包含变量和函数，在语法上变量称为熟悉，函数称为方法。属性和方法的组合就是类的成员。
			类的名字通常以大写字母卡头Car ,Login
			需要掌握设计过程：了解需要定义什么成员；而更重要的是，如何实现复杂的面向对象的概念，如：
				继承、访问控制、方法重载、作用域、抽象
		1.2、PHP中的OOP语法
			class Car{
				public $make;
				public $mode;
				public $year;
				public $odometer;
				function start(){
					
				}
				function drive(){
					
				}
			}
			在PHP中使用new关键字创建实例：
				$mine=new Car();  //Car定义的每个部分，每个属性和方法现在已经嵌入到$mine中。
			在类定义中，在创建该类型的新对象时会自动调用一种称为构造函数的特殊方法。
			构造函数提供了对象的后续使用需要的初始化设置。可以向任何其他函数那样接受参数
				$mine=new Car('Honda','Fit',2008);
			调用属性和方法：
				$mine->color='Purple';  //将Purple值赋给对象的color属性
				$mine->start();//调用对象的strat()方法
				$mine->drive('Forward');//带参数
				$mine->odometer+=20;
				echo "My car currently has $mine->odometer miles on it."
				如果有返回值,可以赋给一个变量
				$tank=$mine->fill(8.5);
			ClassName::METHOD_NAME()这是指定类方法的一种方式。
			命名空间提供了一种将多个类定义组织在同一个标题下的方法。对组织代码和防止冲突非常有用。
			类也可以有常量，类常量通常不使用该类的实例，如：echo ClassName::CONSTANT_NAME;
	2.使用MySQL类
		MySQL，主要类，提供了数据库连接、查询方法等
		MySQL_Result，用于处理SELECT查询的结果
		MySQL_STMT用于执行预处理语句
		2.1、创建连接
			DEFINE('DB_HOST','localhost');
			DEFINE('DB_USER','root');
			DEFINE('DB_PASSWORD','root');
			DEFINE('DB_NAME','wordpress');
			$mysqli = new MySQLi(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); //创建连接对象
			if($mysqli->connect_error){  //PHP版本高于5.2.9
				echo $mysqli->connect_error;
				unset($mysqli);//删除对象
			}else{
				$mysqli->set_charset('utf8');//确定字符集
			}
		2.2、执行简单的查询
			$mysqli->query(query);
			$q='SELECT * FROM wp_posts';
			$mysqli->query($q);
			如果执行的是INSERT查询
				$id-$mysqli->insert_id;  //获取自动生成的主键的值
			如果执行的是UPDATE、INSERT或DELETE，则可以从affected_row属性中检索受影响的行数。
				echo "$mysqli->affected_rows rows were affected by the query"；
			规范化查询相当于使用mysqli_real_escape_string()函数
				$var=$mysqli->real_escape_string($var);
			例子：
			$fn=$mysqli->real_escape_string(trim($_POST['first_name']));
			$ln=$mysqli->real_escape_string(trim($_POST['last_name']));
			$q="INSERT INTO users(first_name,last_name) VALUES ('$fn','$ln')";
			$mysqli->query($q);
			if($mysqli->affected_rows==1){
				echo 'thank you!';
			}else{
				echo '<p>'.$mysqli->error.'<br /><br />Query:'.$q.'</p>';
			}
			$msyqli->close();
			unset($mysqli);
		2.3、获取结果
			$q='SELECT * FROM tablename';
			$result=$mysqli->query($q); //$result将会是一个MySQL_Result类型的对象
			MySQL::query()将返回MySQL_Result对象，它的num_rows属性将反映查询结果中的记录数
			if($result->num_rows>0){} //num_rows属性将反映查询结果中的记录数
			$row=$result->fetch_array(); //如果查询只返回一行，可以调用fetch_array()方法获取
			例如：
				$q="SELECT CONCAT(last_name) FROM users ORDER BY registration_date ASC";
				$r=$mysqli->query($q); //执行查询
				$num=$r->num_rows; //返回的行数
				if($num>0){
					echo "there are $num registered users.";
					//循环输出读取的结果
					while($row=$r->fetch_object()){ 
						echo $row->name.' '.$row->dr; //$row现在是一个对象，所以只能有对象表示法
					}
					$r->free(); //释放返回结果占用的内存
					unset($r);
				}else{
					echo "no registered users";
				}
				$mysqli->close();  //关闭数据库
				unset($mysqli);
		2.4、预处理语句
			$q='INSERT INTO message(forum_id,parent_id) VALUES (?,?)';
			$stmt=$mysqli->prepare($q); //改变查询预处理方式
			$stmt->bind_param('ii',$forum_id,$parent_id); //绑定参数
			$forum_id=(int)$_POST['forum_id'];
			$parent_id=(int)$_POST['parent_id'];
			$stmt->execute(); //语句执行
			if($stmt->affected_rows==1){ //测试执行是否成功
				echo 'ok';
			}else{
				echo '<p>'.$stmt->error.'</p>'; //输出错误
			}
			$stmt->close();
			unset($stmt);
			$mysqli->close();
			unset($mysqli);
	3.DateTime类
		首先，创建一个新的DateTime对象
		$dt=new DateTime(); //如果没有为构造函数提供参数，生成的将会是当前的日期和时间
		$dt=new DateTime('2017-02-16 14:15');
		$dt=new DateTime();
		$dt->setDate(2001,4,20);//建立日期
		$dt->setTime(11,15);//建立时间
		使用modify()来操作时间值：
			$dt->modify('+1 day');  //添加一天
			$dt->modify('-1 month');
			$dt->modify('next Thursday');
		$dt->format(m/d/Y)
十二、错误调试
	1.显示PHP错误,在PHP配置文件中打开display_errors，或者在当前页面如下：
		ini_set('display_errors',1);
	2.调整PHP中的错误报告
		error_reporting(0);  //0是错误报告等级，完全关闭错误报告。
		trigger_error()是一种通过编程在PHP脚本中生成一个错误的方法，默认是E_USER。
		利用@运算符来抑制单个错误
	3.创建自定义的错误处理程序
		DEFINE('LIVE',FALSE);
		function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){
			$message="An error occurred in script '$e_file' on line $e_line:$e_message\n";
			$message.=print_r($e_vars,1);
			if(!LIVE){
				echo '<pre>'.$message.'\n';
				debug_print_backtrace();
				echo '</pre><br />';
			}else{
				echo 'A system erroe occurred.We apologize for the inconvenience.'
			}
		}
		set_error_handler('my_error_handler');
		set_error_handler()用于指定在出现错误时要调用的函数
		set_error_handler()5个参数依次是：错误编号、文本错误信息、错误的文件名、发生错误的行号以及发生错误的变量。

技巧：
	1.用isset给变量设置默认值：
		if(isset($_REQUEST['name'])){
			$name=$_REQUEST['name'];
		}else{
			$name=NULL;
		}
	2.应该总是用双引号括住HTML属性，特别是表单输入框的value属性
		<input value="<?php if(isset($_POST['name'])) echo $_POST['name']); ?>" />
	3.要让一个函数返回多个值，可以使用array()函数返回一个数组
		return array($var1,$var2);
	4.在调用返回一个数组的函数时，可以使用list()函数将数组元素赋予各个变量；
		list($v1,$v2)=some_function();
	5.变量作用域：
		在一个函数内使用的变量不能在其外部使用，在一个函数外部定义的变量不能在其内部使用。
		要改变函数内变量的作用域，可以使用global语句
			function fname(){
				global $var;
			}
			$var = 20;
		上面实例中，函数内部的$var现在与函数外部的$var相同。
		最好不要在函数内使用全局变量，应该使它们根据需要接受每个值作为参数。
	6.SQL查询中的引号
		数值不应该用引号括住
		字符串值必须总是用引号括住
		日期和时间值必须总是用引号括住
		函数不能用引号括住
		NULL不能用引号括住
	7.MySQL函数
		SHA1()单向加密技术，不能被解密。长度40个字符。
		AES_ENCRYPT()被认为是最安全的加密函数
		AES_DECRYPT()解密
		MD5()加密技术，长度32个字符	。
		NOW()插入服务器上的日期时间和时间戳。
		UPPER(t)大写t中所有字符串
		LOWER(t)小写t中所有字符
		CONCAT(t1,t2,_)创建形如t1t2的 新字符串
			SELECT CONCAT(first_name,' ',last_name) AS name FORM users;
			格式化为first_name<space>last_name
		CONCAT(S,t1,t2,_)创建形如t1St2S的新字符串(S是分隔符)
		LENGTH(t)返回t中的字符数,可以判断某一列中字符最多的一行
			SELECT LENGTH(last_name) AS L,last_name FROM users ORDER BY L DESC LIMIT 1;
		LEFT(t,y)从t中返回最左边的y个字符
		RIGHT(t,y)从t中返回最右边的y个字符
		TRIM(t)从t的开头和末尾删除多余的空格
		REPLACE(t1,t2,t3)把t1字符串中的t2替换成t3
		SUBSTRING(t,x,y)从t中返回开始于x的y个字符(索引从1开始)
		ROUND()四舍五入
		RAND()随机数
			SELECT name FROM users ORDER BY RAND() LIMIT 1;//随机获得一个用户名
		DATE(dt)返回dt的日期值
		YEAR()
		MONTH()
		DAYNAME()
		DATE_FORMAT()
		TIME_FORMAT()
	8.清空删除数据表
		清空一个表的首选方式
			TRUNCATE TABLE tablename;
		删除表中的所有数据以及本身
			DROP TABLE tablename;
		删除整个数据库
			DROP DATABASE datebasename;
	9.重定向
		header("location:http://www.example.com/page.php");
		exit();
		header()调用中断位置值应该是绝对的Url(www.example.com/page.php,而不仅仅是page.php)。
	10.验证图像的扩展名
		$ext=strtolower(substr($_GET['image'],-4));  //从图像名中返回最后4个字符
		if(($ext=='.jpg') OR $ext=='jpeg') OR $ext=='.png')){
			//do something
		}
	11.检查图像是否已经在服务器目录文件里
		$image="../upload/{$_GET['image']}";
		if(file_exists($image)&&(is_file($image))){
			
		}
*/
?>