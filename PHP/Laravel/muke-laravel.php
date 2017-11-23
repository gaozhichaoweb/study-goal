<?php
阿里云: 
	PHP版本:PHP5.2/5.3/5.4/5.5
	数据库:MYSQL5.1.73
	操作系统:CentOS 6.5 64位
在线视频网站:
	http://www.imooc.com/video/12504
开发环境推荐
	win XAMPP
	LINUX 自己编译
下载laravel
	http://laravelacademy.org/resources-download
	下载服务器支持的一键安装包，解压后复制到环境根目录
	laravel5.1---->=php5.5.9
	laravel5.2---->=php5.5.9
	laravel5.5---->=php7.0
	运行:Localhost/laravel/public,屏幕中央会输出laravel5英文字母
	出错：Call to undefined function Illuminate\Encryption\openssl_cipher_iv_length()
	解决：开始php_openssl扩展
目录
	app        	    包含了应用的核心代码
		Console     目录包含了所有的Artisan命令
		Http        目录包含了控制器、中间件和请求等
		Jobs        目录是放置队列任务的地方
		Events      目录是放置事件类的地方
		Listeners   目录包含事件的处理器类
		Exceptions  目录包含应用的异常处理器
	bootstrap       包含了少许文件用于框架的启动和自动载入配置，还有一个cache文件夹用于包含框架生成的启动文件以提高性能；
	config          包含了应用所有的配置文件
	database        包含了数据迁移及填充文件
	public          包含了前端控制器和资源文件（图片、JavaScript、CSS等）
	resources       包含了视图文件及原生资源文件（LESS、SASS、CoffeeScript），以及本地化文件；
		views       视图文件welcome.blade.php
	storage         包含了编译过的Blade模板、基于文件的session、文件缓存，以及其它由框架生成的文件
		app         目录用于存放应用要使用的文件
		framework   目录用于存放框架生成的文件和缓存
		logs        目录包含应用的日志文件
	tests           包含自动化测试，其中已经提供了一个开箱即用的PHPUnit示例
	vendor          包含Composer依赖
路由
    简单的说就是将用户的请求转发给相应的程序进行处理
    作用就是建立url和程序之间的映射
    请求类型：get\post\put\patch\delete
    app/Http/routes.php
    Route::get('/',function () {
	  return view('welcome');
    });
    Route::get('basic1',function() {
	  return "basic1";
    });
    Route::post('basic2',function() {
	  return "basic2";
    });
    //多请求路由
    Route::match(['get','post'],'multy1',function () {
	  return "multy1";
    });
    Route::any('multy2',function() {
		return "multy2";
    });
  
    //路由参数
    Route::get('user/{id}',function($id) {
		return 'User-'.$id;
    });
  
    //路由别名  有点是生成Url方便
    Route::get('user/member-center',['as'=>'center',function() {
		return route('center');  
    }]);
    //路由群组
    Route::group(['prefix'=>'member'],function(){
		Route::get('basic1',function() {
			return "basic1";
		});
		Route::post('basic2',function() {
			return "basic2";
		});	
	})
	//输出视图
	Route::get('view',function(){
		return view('welcome');
	});
    路由只用来接收请求
控制器：app/Http/controllers
  1、怎么新建一个控制器
    在controllers目录下新建一个文件MemberController.php
	<?php
	namespace App\Http\Controllers;
	class MemberController extends Controller
	{
		public function info()
		{
		  return 'member-info';
		}
	}
	?>
  2、控制器和路由怎么进行关联
  web.php
  Route::get('member/info','MemberController@info');
  3、关联控制器后，路由的特性怎么用
  Route::get('member/{id}','MemberController@info')->where('id','[0-9]+');
  public function info($id)
    {
      return 'member-info'.$id;
    }
视图：resources/views
  1、怎么新建视图
    一个控制器对应一个目录
	  resources/views/member
	新建控制器方法默认模板文件
	  resources/views/member/info.blade.php
  2、怎么输出视图
    public function info()
    {
      return view('member/info');
    }
  3、传递参数
    public function info()
    {
      return view('member/info',[
        'name'=>'gao',
        'age'=>18
      ]);
    }
  4、视图上输出变量
    <h2>{{$name}}</h2>
    <h2>{{$age}}</h2>
模型？：app/Member.php  (参考User.php)
  1、怎样新建模型
    namespace App;
	use Illuminate\Database\Eloquent\Model;
	class Member extends Model
	{
	  public static function getMember()
	  {
		return 'member name is sean';
	  }
	}
  2、怎样使用模型
   Member::getMember();
数据库：
	laravel中提供DB facade(原始查找)，查询构造器和eloquent ORM三种操作数据库方式
  DB facade：
    1、新建数据表与连接数据库
	  学生表
	  CREATE TABLE IF NOT EXISTS student(
	    'id' INT AUTO_INCREMENT PRIMARY KEY,
		'name' VARCHAR(255) NOT NULL DEFAULT '' COMMETN '姓名',
		'age' TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMETN '年龄',
		'sex' TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMETN '性别',
		'created_at' INT NOT NULL DEFAULT 0 COMMETN '新增时间',
		'updated_at' INT NOT NULL DEFAULT 0 COMMETN '修改时间'
	  )ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1001 COMMENT='学生表'
	  连接数据库
	  config/database.php  //数据库配置
	  .env
	    DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=laravel
		DB_USERNAME=root
		DB_PASSWORD=root
	2、使用DB facade实现CURD
	测试是否连接成功：
		$student = DB::select('select * from student');
		var_dump($student);
    新增：
		$bool = DB::insert('insert into student(name, age) values (?,?)',['gao',18]);
		var_dump($bool);
	修改：
		$bool = DB::update('update student set age = ? where name =?',[20,'gao']);
	查询：
	    $student = DB::select('select * from student');
		dd($student);
    删除：
	    $student = DB::delete('delete from student where id>1');
		dd($student);
数据库操作之-查询构造器(重要)
    1、查询构造器简介以及新增数据
		laravel查询构造器(query builder)提供方便、流畅的借口，用来建立及执行数据库查找语法
		使用pdo参数邦定，以保护应用程序免于sql注入，因此传入的参数不需要额外转义特殊字符
		基本满足所有的数据库操作，而且在所有支持数据库系统上都可以执行
		新增数据：
			$bool = DB::table('student')->insert([
				'name'=>'wang',
				'age'=>20
			]);
		新增并获得新增id
			$id = DB::table('student')->insertGetId([
				'name'=>'wang',
				'age'=>20
			]);
		新增多条数据：
			$bool = DB::table('student')->insert([
				['name'=>'wang1','age'=>21],
				['name'=>'wang2','age'=>22]
			]);
	2、使用查询构造器修改数据
		更新为制定内容
			DB::table('student')
				->where('id',12)
				->update(['age'=>20]);
		自增和自减
			DB::table('student')->increment('age'); 加1
			DB::table('student')->increment('age'，3); 加3
			DB::table('student')->decrement('age'); 减1
			DB::table('student')->decrement('age'，3); 减3
			DB::table('student')
				->where('id',12)
				->decrement('age'，3); id=12减3
			DB::table('student')
				->where('id',12)
				->decrement('age'，3,['name'=>'zhang']); id=12减3	
	3、使用查询构造器删除数据
		delete:
			DB::table('student')
				->where('id',12)
				->delete();
			DB::table('student')
				->where('id','>=',12)
				->delete();	
		truncate:全部删除,谨慎使用
			DB::table('student')->truncate();
	4、使用查询构造器查询数据
		get()
			
		first()
		where()
		pluck()
		lists()
		select()
		chunk()
	5、查询构造器中的聚合函数
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
?>