<?php
/*
一、PHP行为扩展
  1.错误处理
    error_get_last:获取最后一个发生的错误信息，返回一个关联数组。
	  print_r(error_get_last());
	error_log:把错误信息发送到web服务器的错误日志，或者到一个文件里。
	  error_log(string $message[,int $message_type = 0[,string $destination[,string $extra_headers]]]);
	  error_log('变量不存在',3,'E:\phpStudy\WWW\test\tt.log');
	error_reporting:设置在脚本运行时的级别
	  error_reporting([int $level]);
	  参数：0，-1，E_ERROR,E_WARNING,E_PARSE,E_NOTICE,E_ALL
	  //ini_set('error_reporting',E_ALL)也可以实现
  2.PHP选项/信息
    get_defined_constants:返回当前所有已定义的常量名和值，包含define()函数创建的，也包含所有扩展所创建的。
	  print_r(get_defined_constants(true));
	ini_get:获取一个配置选项的值
	  ini_get('display_errors');
	ini_get_all:获取所有配置选项
	  print_r(ini_get_all());
	ini_set:为一个配置选项设置值，不是所有选项都能够用此函数改变，参见手册
	  ini_set('display_errors','1');
	phpinfo:输出关于PHP的配置信息
	  phpinfo(INFO_MODULES);//已加载的模块和模块相应的设置
	php_uname:返回运行PHP的操作系统的有关信息，
	  echo php_uname('s');  //打印操作系统的名称，也可以用PHP_OS获取操作系统的名称
二、加密扩展
  1.hash函数:
    hash_algos:返回已注册的哈希算法列表
    hash_init:初始化增量哈希运算上下文
	hash_update:向活跃的哈希运算上下文中填充数据
	hash_final:结束增量哈希，并返回摘要结果
      $ctx = hash_init('sha1');
      hash_update($ctx, 'The quick brown fox jumped over the lazy dog.');
      echo hash_final($ctx);
	hash:生成哈希值。
	  hash('算法','字符串'[,true/false]);
三、数据库(mysql)
  1.mysql(原始)
    从php5.5开始被废弃，Php7.0开始被移除，建议使用mysqli
	mysql_affected_rows:
	  mysql_affected_rows($link);
	  取得最近一次与$link关联的Insert,update或delete查询所影响的纪录行数
	  $link是mysql连接，如不指定则使用最近打开的连接
	  成功返回受影响的行的数目，失败返回-1。
	mysql_client_encoding:从Mysql中取得character_set变量的值。
	  $link    = mysql_connect('localhost', 'mysql_user', 'mysql_password');
      $charset = mysql_client_encoding($link);
	  如不指定$link则使用最近打开的连接
	mysql_close:关闭Mysql连接
	  mysql_close($link);
	mysql_connect:打开一个到Mysql服务器的连接
	  $link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
	mysql_fetch_array:从结果集中取得一行作为关联数组或数字数组(第二个参数)
	  while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        printf ("ID: %s  Name: %s", $row[0], $row[1]);
      }
	mysql_fetch_assoc:从结果集中取得一行作为关联数组
	  while ($row = mysql_fetch_assoc($result)) {
        echo $row["userid"];
        echo $row["fullname"];
        echo $row["userstatus"];
      }
	mysql_fetch_object:从结果集中取得一行作为一个对象
	  while ($row = mysql_fetch_object($result)) {
        echo $row->user_id;
        echo $row->fullname;
      }
	mysql_fetch_row：从结果集中取得一行作为枚举数组,每个结果的列储存在一个数组的单元中，偏移量从 0 开始。依次调用 mysql_fetch_row() 将返回结果集中的下一行，如果没有更多行则返回 FALSE。
	  $row = mysql_fetch_row($result);
	mysql_free_result:释放结果内存,用于返回很大结果集的时候，在脚本结束后关联的内存都会自动释放。
	  mysql_free_result($result);
	mysql_get_client_info:获取Mysql客户端的版本，返回的是一个字符串
	  $str = mysql_get_client_info();
	mysql_get_host_info:获取Mysql主机信息，返回的是一个字符串
	  $str = mysql_get_host_info();
	mysql_info:最近一条查询的信息
	  mysql_info($link);
	mysql_insert_id:取得上一步INSERT操作产生的ID
	mysql_num_fields:取得结果集中字段的数目
	mysql_num_rows:取得结果集中行的数目，仅对SELECT查询有效
	  $result = mysql_query("SELECT * FROM table1", $link);
	  $num_rows = mysql_num_rows($result);
	mysql_pconnect:打开一个到Mysql服务器的持久连接
	mysql_query:向指定的服务器中当前数据库发送一条Mysql查询(不支持多条查询)
	  mysql_query($query[,$link]);
	  对SELECT,SHOW,DESCRIBE,EXPLAIN语句返回一个resource。
	  对INSERT,UPDATE,DELETE,DROP语句返回true或false。
	  返回的结果应该传递给mysql_fetch_array()来处理结果，可以调用mysql_num_rows()来查看SELECT语句返回了多少行，或者调用mysql_affected_rows()来查看DELETE,INSERT,REPLACE或UPDATE语句影响到了多少行。
	  // 构造查询
      // 这是执行 SQL 最好的方式
      // 更多例子参见 mysql_real_escape_string()
      $query = sprintf("SELECT firstname, lastname, address, age FROM friends 
        WHERE firstname='%s' AND lastname='%s'",
        mysql_real_escape_string($firstname),
        mysql_real_escape_string($lastname));

      // 执行查询
      $result = mysql_query($query);
	mysql_real_escape_string:转义SQL语句中使用的字符串中的特殊字符，并考虑到连接的当前字符集。
	  在字符\x00,\n,\r,\,',"和\x1a前添加反斜杠。
	  mysql_real_escape_string($lastname);
	mysql_result:取得结果数据，不推荐使用，效率低。
	mysql_select_db:选择Mysql数据库
	  mysql_select_db($datebase_name[,$link]);
	mysql_set_charset:设置当前连接的默认字符集
	  mysql_set_charset($charset[,$link]);
	  这是改变字符集的最佳方式，不推荐使用mysql_query('set names utf8')来设置。
  2.mysqli
    从PHP5.0.0中被引入，Mysql Native驱动在PHP5.3.0版本中被引入
	参见Mysqli扩展功能概述
四、日期与时间
  checkdate:验证一个格里高里日期
    bool checkdate(int $month,int $day,int $year);
    checkdate(2,30,2016);  //结果 bool(false)
  date_default_timezone_set:设置脚本中所有日期时间函数的默认时区
    bool date_default_timezone_set(string $timezone);
    date_default_timezone_set('ShangHai');
  date:格式化一个本地时间/日期
    string date(string $format[,int $timestamp]);
    $format参见手册列表，$timestamp是可选的，默认值为time()
    date("Y-m-d H:i:s")  //2017-05-12(Mysql datetime格式)
  getdate：取得日期/时间信息,返回一个根据参数得出的关联数组。
    array getdate([int $timestamp = time()]);
    如果没有参数，则认为是当前本地时间
      $today = getdate();
      print_f($today);
  mktime:取得一个日期的unix时间戳
    int mktime(date('H'),date('i'),date('s'),date('n'),date('j'));
    参数可以从右向左省略，任何省略的参数都会被设置成本地日期和时间的当前值。
    mktime()在做日期计算和验证方面很有用。
    date("l",mktime(0,0,0,7,1,2000));//输出当前时间戳的星期
    $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
    $lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
    $nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
  strtotime:将任何字符串的日期时间转换成unix时间戳
    int strtotime(string $time[,int $now = time()]);
    strtotime("now");
    strtotime("10 september 2000");
    strtotime("+1 day");
    strtotime("+1 week");
    strtotime("+1 week 2 days 4 hours 2 seconds");
    strtotime("next thursday");
    strtotime("last Monday");
  time:
    返回当前的Unix时间戳
    $nextweek = time()+(7*24*60*60);
    echo date('Y-m-d');
    echo date('Y-m-d',$nextweek);
    echo date('Y-m-d',strtotime('+1 week'));
五、文件系统
  1.目录函数
    chdir():改变目录
	chroot():改变根目录
    getcwd():取得当前工作目录
	  echo getcwd(); //E:\phpStudy\WWW\test
	scandir():列出指定路径的文件和目录
	  $dir    = 'E:\phpStudy\WWW\MyWeb';
      $files1 = scandir($dir);
      var_dump($files1);
	opendir():打开目录句柄
	readdir():从目录句柄中读取条目
	closedir():关闭目录句柄
	  $dir    = 'E:\phpStudy\WWW\test';
      if ($handle = opendir($dir)) {
        echo "Directory handle: $handle\n";
        echo "Files:\n";
        这是正确地遍历目录方法
        while (false !== ($file = readdir($handle))) {
          echo "$file\n";
        }
      closedir($handle);
      }
  2.fileinfo文件信息
    mime_content_type():检测文件的MIME类型
	  string mime_content_type(string $filename)
  3.文件系统
    basename():返回路径中的文件名部分
	chgrp():改变文件所属的组
	chmod():改变文件模式
	  bool chmod ( string $filename , int $mode )
	  chmod("/somedir/somefile", 755);   // 十进制数，可能不对
      chmod("/somedir/somefile", "u+rwx,go+rx"); // 字符串，不对
	  chmod("/somedir/somefile", 0755);  // 八进制数，正确的 mode 值
	chown(): 改变文件的所有者
	  bool chown ( string $filename , mixed $user )
	  尝试将文件 filename 的所有者改成用户 user（由用户名或用户 ID 指定）
	clearstatcache():清除文件状态缓存
	  当使用 stat()，lstat() 或者任何列在受影响函数表（见下面）中的函数时，PHP 将缓存这些函数的返回信息以提供更快的性能。
	copy():拷贝文件
	  bool copy ( string $source , string $dest [, resource $context ] )
	  将文件从 source 拷贝到 dest。
	  $file = 'example.txt';
      $newfile = 'example.txt.bak';
      copy($file, $newfile);
	dirname():返回路径中的目录部分 
	  dirname("/etc/passwd");   //结果：/etc
	fclose():关闭一个已打开的文件指针
	  通过 fopen() 或 fsockopen() 成功打开的。 
	feof()：测试文件指针是否到了文件结束的位置
	fflush():将缓冲内容输出到文件
	fgetc():从文件指针中读取字符
	fgets():从文件指针中读取一行
	file_exists():检查文件或目录是否存在
	file_get_contents(): 将整个文件读入一个字符串，和file()类似
	file_put_contents():将一个字符串写入文件，和一次调用fopen(),fwrite()以及fclose()功能一样。
	file():把整个文件读入一个数组中
	fileatime():取得文件的上次访问时间
	filegroup():取得文件的组
	filemtime():取得文件修改时间
	fileowner():取得文件的所有者
	fileperms():取得文件的权限
	filesize():取得文件大小
	  int filesize ( string $filename )
	filetype():取得文件类型
	  string filetype ( string $filename )
	fopen(): 打开文件或者 URL
	  $handle = fopen("/home/rasmus/file.txt", "r");
	fread():读取文件（可安全用于二进制文件）
	  string fread ( resource $handle , int $length )
	  fread() 从文件指针 handle 读取最多 length 个字节
	ftruncate():将文件截断到给定的长度
	  bool ftruncate ( resource $handle , int $size )
	  接受文件指针 handle 作为参数，并将文件大小截取为 size
	fwrite():写入文件（可安全用于二进制文件）
	  int fwrite ( resource $handle , string $string [, int $length ] )
	  fwrite() 把 string 的内容写入文件指针 handle 处。 
	is_dir():判断给定文件名是否是一个目录
	  bool is_dir ( string $filename )
	is_executable():判断给定文件名是否可执行
	  bool is_executable ( string $filename )
	is_file():判断给定文件名是否为一个正常的文件
	  bool is_file ( string $filename )
	is_link(): 判断给定文件名是否为一个符号连接
	is_readable():判断给定文件名是否可读
	is_uploaded_file(): 判断文件是否是通过 HTTP POST 上传的
	is_writable():判断给定的文件名是否可写
	link():建立一个硬连接
	linkinfo():获取一个连接的信息
	mkdir():新建目录
	move_uploaded_file():将上传的文件移动到新位置
	parse_ini_file():解析一个配置文件
	  parse_ini_file() 载入一个由 filename 指定的 ini 文件，并将其中的设置作为一个联合数组返回。 
	fathinfo():返回文件路径的信息
	  将会返回包括以下单元的数组array：dirname，basename 和 extension（如果有），以及filename。 
	  $path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
      echo $path_parts['dirname'], "\n";
	readfile():读取文件并写入到输出缓冲。 
	realpath_cacge_get():获取真实目录缓存的详情
	realpath():返回规范化的绝对路径名
	rename():重命名一个文件或目录
	  bool rename ( string $oldname , string $newname);
	  尝试把 oldname 重命名为 newname。 
	  rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");
	rmdir():删除目录
	stat(): 给出文件的信息
	tempnam():建立一个具有唯一文件名的文件
	tmpfile():建立一个临时文件
	unlink():删除文件
六、字符编码
七、图像生成和处理
八、邮件
九、数学扩展
  abs:绝对值
  base_convert:在任意进制之间转换数字
    string base_convert(string $number,int $frombase,int $tobase);
	把$frombase进制的字符串$number转换为$tobase进制。
  ceil:进一法取整
    float ceil(float $value);
	echo ceil(4.3);  //5
	echo ceil(9.99); //10
	echo ceil(-3.5); //-3
  floor:舍去法取整,返回不大于$value的最接近整数，舍去小数部分取整。
    float floor(float $value);
    echo ceil(4.3);  //4
	echo ceil(9.99); //9
	echo ceil(-3.5); //-4
  max:找出最大值
    mixed max(array $value); //返回数组中最大的值。
	mixed max($value1,$value2...);
  count():计算数组中的单元数目，或对象中的属性个数。
  min:找出最小值
    mixed min(array $value); //返回数组中最大的值。
	mixed min($value1,$value2...);
  mt_rand:生成更好的随机数，比rand快四倍。
    int mt_rand(); //获得0到mt_getranmax()2147483647的随机数
	int mt_rand(int $min,int $max);  //获得$min到$max的随机数
  rand:产生一个随机数
    int rand(); //获得0到getranmax()32767的随机数
	int rand(int $min,int $max);  //获得$min到$max的随机数
  round:对浮点数进行四舍五入
    float round($val[,$precision=0]);
    echo round(3.4);         // 3
    echo round(3.5);         // 4
    echo round(3.6);         // 4
    echo round(3.6, 0);      // 4
    echo round(1.95583, 2);  // 1.96
    echo round(1241757, -3); // 1242000
    echo round(5.045, 2);    // 5.05
    echo round(5.055, 2);    // 5.06
十、Misc.杂项函数
  constant:返回一个常量的值
    echo constant("MAXSIZE");
  define:定义一个常量
    define("CONSTANT", "Hello world.");
  defined:检查某个常量是否存在
    bool defined(string $name);
  die:等同于exit
  eval:把字符串作为Php代码执行
  exit:输出一个消息并且推出当前脚本
  sleep:以指定的秒数延缓执行
    sleep(int $seconds); //延缓执行多少秒
  uniqie:生成一个唯一Id(获取一个带前缀、基于当前时间微秒数的唯一Id)
    uniqid(); //不带前缀的id
	uniqid("php_) //带前缀php_的id
	不保证返回值的唯一性
  usleep:以指定的微秒数延迟执行
    usleep(int $micro_seconds);
	1微秒（micro second）是百万分之一秒
十一、FTP
  如果只是从服务器读取或写入文件，使用文件系统会更加简单。
十三、Session
  通过为每个独立用户分配唯一的会话 ID，可以实现针对不同用户分别存储数据的功能。
  会话Id通过cookie的方式发送到浏览器，并且在服务器端也是通过会话ID来取回会话中的数据。
  session_cache_expire():缓存到期时间，不设置默认为180分钟
  session_destroy():销毁一个会话中的全部数据
    销毁当前会话中的全部数据，但是不回冲至当前会话所关联的全局变量，也不会重置会话cookie。
	为了彻底销毁会话，必须同时重置会话id，setcookie()来删除客户端的会话cookie。
	实例见手册。
  session_id:获取/设置当前会话的id，也可以使用常量SID。
  session_start:启动会话。
  session_unset:释放当前会话注册的所有会话变量。如果使用$_SESSION，请使用unset()注销会话变量。
十四、文本处理(字符串)
  echo:输出一个或多个字符串，不会换行。echo不是一个函数(语言结构)，因此不一定要用括号，单双引号都可以。
    和print唯一不同之处是，echo接受参数列表。
  explode():此函数返回由字符串组成的数组，每个元素都是string的一个子串，他们被delimiter作为边界点分隔出来。
    array explode(string $delimiter,string $string);
	$data = "foo:*:1023:1000::/home/foo:/bin/sh";
	list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
	echo $user; // foo
  htmlspecialchars():将特殊的字符转换回HTML实体。
    htmlspecialchars($str,ENT_QUOTES);
    $   &amp
	"   &quot
	'   &apos/&#039
	<>  &lt&gt
  htmlspecialchars_decode():将特殊的HTML实体转换回普通字符。
    被转换的有&amp &quot &apos/&#039 &lt &gt
  implode():将一个一维数组转换为字符串。
    string implode($glue,$array); //内容为由glue分割开的数组的值。
	$array = array('lastname', 'email', 'phone');
    $comma_separated = implode(",", $array);
  join():是implode函数的别名。
  lcfirst(): 使一个字符串的第一个字符小写
  ltrim(): 删除字符串开头的空白字符（或其他字符）
    string ltrim ( string $str [, string $character_mask ] )
  md5():计算字符串的 MD5 散列值,以 32 字符十六进制数字形式返回散列值。
    md5($str);
  ml2br():在字符串所有新行之前插入 HTML 换行标记
  number_format():以千位分隔符方式格式化一个数字
  print(): 输出字符串,print实际上不是函数(而是语言结构)，可以不用圆括号。
    print和echo唯一区别是，print仅支持一个参数
	int print(string $arg);
  printf():输出格式化字符串
  rtrim():删除字符串末端的空白字符（或者其他字符）
  sha1():计算字符串的sha1散列值，返回值是一个 40 字符长度的十六进制数字。 
  similar_text():计算两个字符串的相似度。
  str_repeat():重复一个字符串N次
  str_replace()/str_ireplace():子字符串替换
    $str = "adjoiaijfaiajfaoijfajeioajkdjfoiaejl";
	$replace = str_replace('a','1',$str);
    该函数返回一个字符串或者数组。该字符串是将$str中全部的a都被1替换之后的结果.
	$str = str_replace("ll", "", "good golly miss molly!", $count);
    echo $count; //2
	$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
    $onlyconsonants = str_replace($vowels, "", "Hello World of PHP");
    echo $onlyconsonants;  //Hll Wrld f PHP
  str_shuffle():随即打乱一个字符串
    str_shuffle($str);
  str_split():将字符串转换为数组
    $str = "Hello Friend";
    $arr1 = str_split($str);  
    $arr2 = str_split($str, 3);
  strip_tags():从字符串中去除Html和PHP标记
    $text = '<p>Test paragraph.</p><!-- Comment -->';
    echo strip_tags($text); //Test paragraph.
	echo strip_tags($text, '<p>');  //允许<p>，结果是<p>Test paragraph.</p> 
  strlen():获取字符串长度
  strpos()/stripos():查找字符串首次出现的位置,后者不区分大小写
    $mystring = 'abc';
    $findme   = 'a';
    $pos = strpos($mystring, $findme);  //结果0
  strrchr():查找指定字符在字符串中的最后一次出现
    $text = "Line 1\nLine 2\nLine 3";
    $last = strrchr($text, 'L');  //Line 3
  strrev():反转字符串
    echo strrev("Hello world!"); // 输出 "!dlrow olleH"
  strrpos():计算指定字符串在目标字符串中最后一次出现的位置
    $foo = "0123456789a123456789b123456789c";
	var_dump(strrpos($foo, '7', 20));  //int(27)
  strstr()/strchr():查找字符串的首次出现
    $email  = 'name@example.com';
    $domain = strstr($email, '@'); //@example.com
  strtolower():将字符串转化为小写
  strtoupper():将字符串转化为大写
  substr():返回字符串的子串
    string substr(string $string,int $start[,int $length])
	返回字符串string由start和length参数指定的子字符串。
	echo substr('abcdef', 1, 3);  // bcd
	//中文字符串截取
    $china = "北京欢迎你";
	$city = mb_substr($china,0,2,'utf8');
	echo $city;
  trim():去除字符串首尾处的空白字符（或者其他字符）
  ucfirst():字符串的首字母大写
  ucwords():将字符串中每个单词的首字母转换为大写 
十五、变量与类型相关扩展
  1.数组
    asort()对数组进行排序并保持索引关系
	arsort():对数组进行逆向排序并保持索引关系
	array_push():将一个或多个单元压入数组的末尾(入栈)
	  $stack = array("orange", "banana");
      array_push($stack, "apple", "raspberry");
	array_pop():弹出数组最后一个单元(出栈)
	  $stack = array("orange", "banana", "apple", "raspberry");
      $fruit = array_pop($stack);
	array_shift():将数组开头的单元移出数组 
	  $stack = array("orange", "banana", "apple", "raspberry");
      $fruit = array_shift($stack);
	array_unshift():在数组开头插入一个或多个单元 
	  $queue = array("orange", "banana");
      array_unshift($queue, "apple", "raspberry");
	array_slice():从数组中取出一段
	  $input = array("a", "b", "c", "d", "e");
      $output = array_slice($input, 2); //c d e
	array_key_exists():检查数组里是否有指定的键名或索引
	count():计算数组中的单元数目，或对象中的属性个数。
	krsort():对数组按照键名逆向排序
	ksort():对数组按照键名排序
	list():把数组中的值赋给一组变量
	in_array():检查数组中是否存在某个值,数组元素区分大小写
	  bool in_array($needle,array $haystack);
	  $os = array("Mac", "NT", "Irix", "Linux");
	  if (in_array("Irix", $os)) {
        echo "Got Irix";
      }
	rsort():对数组逆向排序
	sort():对数组排序
	shuffle():对数组随机排序
  2.Ctype函数
    ctype_alnum():字母和数字字符检测
	ctype_alpha():纯字符检测
	cytpe_cntrl():控制字符检测
	ctype_digit():纯数字检测
  3.变量处理
    empty():检查一个变量是否为空，当变量存在，并且是一个非空非零的值时返回false否则true。
	  empty($var); 
	  一些东西被认为是空的：""(空字符串)、0、0.0、"0"、NULL、FALSE、array()(空数组)、$var(一个声明了但是没有值的变量)
    gettype():获取变量的类型，不推荐使用，推荐用is_*来代替
    intval():获取变量的整数值
	is_array():检测变量是否是数组
	is_bool(): 检测变量是否是布尔型 
	is_float():检测变量是否是浮点型
	is_int(): 检测变量是否是整数
	is_null(): 检测变量是否为 NULL 
	is_string():检测变量是否是字符串
	isset():检测变量是否设置,并且不是NULL，语言结构不是函数
	print_r():打印关于变量的易于理解的信息。 
	unset():释放给定的变量，如果在函数中unset()一个全局变量，则只是局部变量被销毁
	var_dump():打印变量的相关信息
*/
?>