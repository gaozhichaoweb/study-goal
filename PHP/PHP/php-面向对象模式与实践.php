<?php

深入PHP面向对象、模式与实践(第2版)
从学习角度来说，PHP程序员沿这样的学习路线前进：
  ->PHP基础入门(语法、常用函数和扩展等)
  ->面向对象的PHP(本书)
  ->网站软件架构设计(设计模式、框架等)
  ->网站物理层次架构设计(分布式计算、存储、负载均衡、高可用性等) 



第一部分 介绍
  /*
  第一章 PHP：设计与管理
    2004年初PHP5发布，新特性中最重要的是加强了对面向对象编程(OOP)支持
    1.1问题
	  维护难
	  缺少文档
	  缺少测试
	1.2 PHP和其他语言
	  设计模式(Design Pattern)：一种描述和解决问题的方案
  */

第二部分 对象
  /*
  第二章 PHP与对象
    2.1 PHP对象的成功
	  Zend引擎开始为PHP提供强大动力，是PHP的主要组成部分之一。
	  Zend引擎管理内存，控制其他组件，并将我们所熟知的PHP语法转换为可执行的字节码
	  类也是由zend引擎引入PHP的核心特性。
  */
  
  /*
  第三章 对象基础
    3.1 类和对象
	  对象(object)和类(class)是本书的核心.
	  3.1.1 编写第一个类
	    类是用于生成对象的代码模板，我们使用class关键字和一个任意的类名来声明类。
		类名可以是任意数字和字母的组合，但是不能以数字开头。
		创建一个类：
		class ShopProduct{
			//类体
		}
	  3.1.2 第一个对象
	    如果类是生成对象的模板，那么对象是根据类中定义的模板所构造的数据。
		对象可以说成是类的"实例"，它是由类定义的数据类型。
		$pruduct1 = new ShopProduct();
		new操作符和作为它唯一操作数的类名一起被调用，并生成类的实例。
	3.2 设置类中的属性
	  类的属性和标准的变量很相似，除了必须在声明和赋值前加一个代表可见性的关键字。
	  这个关键字可以使public、protected或private,它决定了属性的作用域。
	  class ShopProduct{
		public $title = "default product";
	  }
	  实例化ShopProduct类得到的任何对象都将加载默认数据。
	  每个属性声明中的Public关键字确保我们可以从对象之外访问属性。
	  我们可以使用->字符连接对象变量和属性名来访问属性变量。
	    $pruduct1 = new ShopProduct();
		print $product1->title;
		$product1->title="my product";
	3.3 使用方法
	  属性可以让对象存储数据，类方法则可以让对象执行任务。
	  方法是在类中声明的特殊函数。
	  public function myMethod($argument,$another){
		return $this->title;
	  }
	  方法可以被声明为public、protected或private。
	  我们可以使用->连接对象变量和方法名来调用方法
	  调用方法时必须使用一对圆括号(即使没有传递参数);
	  $pruduct1 = new ShopProduct();
      $product1->myMethod();  
	  $this伪变量把类指向一个对象实例，也可以理解为"当前实例"
	创建构造方法：
	  创建对象是，构造方法[constructor method]会被自动调用。
	  构造方法可以用来确保必要的属性被设置，并完成任何需要准备的工作。
	  PHP5之前的版本中，构造方法使用和所在类相同的名字。
	  在PHP5种，则应该将构造方法命名为__construct()。
	  注意方法名以两个下划线字符开头。
	  function __construct($title,$name){
		$this->title = $title;
        $this->name  = $name;		
	  }
	3.4 参数和类型
	  3.4.1 基本类型
	    PHP是一种弱类型语言,即变量不需要声明为特定的数据类型.
		每个赋给变量的值都有一种类型,可以使用类型检查函数来确定变量的值的类型 .
		is_bool(),is_integer(),is_double(),is_string(),is_object(),is_array(),is_resource(),is_null().
		类型处理，必须考虑到，非常重要
	  3.4.2 获得提示：对象类型
	    public function write(ShopProduct $shopProduct){
			//...
		}
		现在write()方法只接受包含ShopProduct对象的$shopProduct参数。
	3.5 继承
	  3.5.1 继承的问题
	    继承是从一个基类得到一个或多个类的机制。
	    子类将继承父类的特性，这些特性由属性和方法组成。
	    子类可以增加父类之外的新功能。
	  3.5.2 使用继承
	    创建继承树的第一步是找到现有类元素中不适合放在一起的类方法。
		要创建一个子类，必须在类声明中使用Extends关键字。
		子类默认继承父类所有的public和protected方法(没有继承private方法或属性)。
		构造方法和继承
			在子类中定义构造方法时，需要传递参数给父类的构造方法。
			要调用父类的方法，首先要找到一个引用类本身的途径：句柄(handle)
			php为此提供了Parent关键字。
			要引用一个类而不是对象的方法，可以使用::而不是->
			  parent::__construct();  //调用父类的__construct()方法
		调用覆写的方法
			parent关键字可以在任何覆写父类方法的方法中使用。
	  3.5.3 public private protected：管理类的访问
	    在任何地方都可以访问public属性和方法
		只能在当前类中才能访问Private方法或属性，即使在子类中也不能访问
		可以在当前类或子类中访问protected方法或属性，其他外部代码无权访问。		
  */
  
  /*
  第四章 高级特性
    4.1 静态方法和属性
	  通过类来访问静态元素,而不是实例
	  所以访问静态元素时不需要引用对象的变量,而是使用::来连接类名和属性或类名和方法.
	  echo StaticExample::$num;
	  StaticExample::sayhello();
	  当前类中访问静态方法或属性，可以使用self关键字。
	  slef指向当前类，就像伪变量$this指向当前对象一样。
	  class StaticExample{
		  static public $aNum=0;
		  static public function sayHello(){
			  self::$aNum++;
			  print "hello ".self::$aNum.
		  }
	  }
	  所以，我们不能在对象中调用静态方法，因此不能在静态方法中使用伪变量$this;
	  PDO代表PHP Data Object，PDO类为不同的数据库应用程序提供了统一的接口。
	4.2 常量属性
	  PHP5可以在类中定义常量属性，用const关键字来声明。
	  class ShopProduct{
	    const AVAILABLE =0；
	  }
	  访问：
	    ShopProduct::AVAILABLE;
	4.3 抽象类abstract class
	  抽象类不能被直接实例化，抽象类中只定义子类需要的方法。
	  子类可以继承它
	4.4 接口
	  接口是纯粹的模板，只能定义功能，而不包含实现的内容。
	  使用interface来声明
	  接口可以包含属性和方法声明，但是方法体为空。
	4.5 错误处理
	  异常； 是从PHP5内置的Exception类实例化得到的特殊对象,Exception类型的对象用于存放和报告错误信息。
	    Exception类的构造方法接受两个可选的参数：消息字符串和错误代码
		抛出异常：可以使用throw关键字和Exception对象来抛出异常。
		  这会停止执行当前方法，并负责将错误返回给调用代码。
		  function __construct($file){
			$this->file = $file;
			if(!file_exists($file)){
				throw new Exception("file does not exist");
			}
			$this->xml = simplexml_load_file($file);
		  }
	    处理异常
	      try{
			//
		  }catch{
			//抛出异常时调用
		  }  
	    异常的子类化：创建用户自定义的异常类，可以从exception类继承
	4.6 Final类和方法	
	  Final关键字可以终止类的继承，Final类不能有子类，Final方法不能被覆写。
	4.7 使用拦截器
	  PHP提供了内置的拦截器(interceptor)方法,他可以拦截发送到未定义方法和属性的消息。
	  也被称为重载，当遇到合适的条件时就会被调用。
	    __get()    访问未定义的属性时被调用
		__set()     给未定义的属性赋值时被调用
		__isset()   对未定义的属性调用isset()时被调用
		__unset()   对未定义的属性调用unset()时被调用
		__call()     调用未定义的方法时被调用
	4.8 析构方法__destruct()
	  只在对象被垃圾收集器收集前自动调用。
	4.9 使用__clone()复制对象
	4.10 定义对象的字符串值 
	  __toString()方法，你可以控制输出字符串的格式，应当返回一个字符串值。
	  当把对象传递给print或echo时，会自动调用这个方法，并用方法的返回值来替代默认的输出内容 。
  */
  
  /*
  第五章 对象工具
  */
  
  /*
  第刘章 对象与设计
  */

第三部分 模式



第四部分 实践
