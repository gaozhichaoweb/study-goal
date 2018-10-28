java从入门到精通p250
第13章：存储类的仓库-Java常用类库
	Java类库就是Java API(应用程序接口)，是系统提供的已实现的标准类的集合
	使用Java类库可以完成涉及字符串处理、图形、网络等多方面的操作
	13.1 API概念
		API(Application Programming Interface)就是引用程序编程接口
	13.2 String类和StringBuffer类
		这两个类放在java.lang包中
		不需要用import java.lang导入就可以使用
		String类
			用于比较两个字符串，
			查找和抽取字符串中的字符或子串，
			进行字符串与其他类型之间的相互转换等
			String类对象的内容一旦被初始化就不能再改变
		StringBuffer类
			用于内容可以改变的字符串
			可以将其他各种类型的数据增加、插入到字符串中
			也可以转置字符串中原来的内容。
			一旦通过StringBuffer生成了最终想要的字符串，就应该使用StringBuffer.toString方法将其转化成String类
			随后就可以使用String类的各种方法操纵这个字符串了
		Java为字符串提供了特别的连接操作符(+)
			可以把其他各种类型的数据转换成字符串，并前后连接成新的字符串
			通过StringBuffer类和它的append方法实现的
	13.3 基本数据类型的包装类
		Java对数据既提供基本数据的简单类型，也提供了相应的包装类
		比如用Interger类来包装整数
		基本数据类型包装类
		int(Interger)char(Character)float(Float)double(Double)
		byte(Byte)long(Long)short(Short)boolean(Boolean)
		例子：
			String a="123";
			int i = Interger.parseInt(a);
			i++;  //124
		Interger类中的parseInt()将一个字符串转换成基本数据
	13.4 Systeml类与Runtime类
		13.4.1 System类型
			Java不支持全局方法和变量，Java设计者将一些系统相关的重要方法和变量收集到了一个统一的类中，这就是System类
			System类中的所有成员都是静态的，而要引用这些变量和方法，可直接使用System类名作为前缀。
			exit(int status) :提前终止虚拟机运行
			CurrentTimeMillis方法：返回1970年1月1日0点0分0秒至今的时间，Long类型的大数据
			getProperties：获取当前虚拟机的环境属性
			setProperties:
		13.4.2 Runtime类
			封装了Java命令本身的运行进程，许多方法与System中的方法重复
			不能直接创建Runtime实例，但可以通过静态方法Runtime.getRuntime获得正在运行的Runtime对象的应用
			例子：
				Runtime run = Runtime.getRuntime();
				run.exec("notepad.exx");
			通过Runtime类可以为开发者执行操作系统的可执行程序
	13.5 Data与Calendar、DateFormat类
		Date类用于表示日期和时间java.util.Date
		由于开始设计Date时没考虑到国际化，所有后来又设计了两个新的类来解决Date类中的问题
			Calendar类：抽象基类，主要完成日期字段之间相互操作
				Calendar.add:在某一日期的基础上增加若干天
				Calendar.get:取出日期对象中的年月日等日期字段值
				Clalendar.set:修改日期对象中的年月日等日期字段值
				Calendar.getInstance：方法用于返回一个Calendar类型的对象实例
			DateFormat类：
				java.text.DateFormat：将Date对象表示的日期以指定的格式输出
					或者将特定格式的日期字符串转换成一个Date对象
				java.text.SimpleDateFormat类是DateFormat子类
					把Date对象格式化为本地字符串，或者通过语义分析把日期或时间字符串转换为Date对象
	13.6 Math与Random类
		Math类包含了所有用于几何和三角的浮点运算方法，这些方法都是静态的
		Random类是一个随机数产生器、
			Random r=new Random();
			r.nextInt(100);  //产生0-100的随机数
	13.7 hashCode()方法	
		用于存取散列表的时候使用
	13.8 对象克隆
