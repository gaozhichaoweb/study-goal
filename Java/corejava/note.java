Java核心技术卷I
第一章 Java程序设计概述

{
	简单性、面向对象、分布式、健壮性、安全性、体系结构中立、可移植性、解释型、高性能、多线程、动态性
}

第二章 Java程序设计环境

{
	2.1 安装Java开发工具包
		2.1.1 下载JDK
			JDK: java Development Kit--编写Java程序的程序员使用的软件
			JRE: Java Runtime Environment--运行Java程序的用户使用的软件
			Java SE: Standard Edition--用于桌面或简单服务器应用的Java平台
			Java EE: Enterprise Edition--用于复杂服务器应用的Java平台
			OpenJDK: JavaSE的一个免费开源实现
			SDK: Software Development Kit--一个过时的术语，用于描述1998到2006年之间的JDK
			JavaSE 8u31是JavaSE 8的第31次更新
			小结：
				你需要的是JDK而不是JRE
				32位选择X86,64位选择x64
				Linux选择.tar.gz版本
		2.1.2 设置JDK
			在Windows或Linux上安装JDK时，需要将jdk安装路径/bin目录增加到执行路径中
			执行路径是操作系统查找可执行文件时所遍历的目录列表
			在Windows上，控制面板-系统与安全-系统-高级系统设置-高级-环境
			找到Path的变量，编辑，将jdk安装路径/bin目录增加到路径最前面，并用一个分号分隔新增加的这一项
			测试设置：
				javac -version
	2.2 使用命令行工具
		例子：
			javac Welcome.java
			java Welcome
		javac程序是一个Java编译器，它将.java文件编译成.class文件
		java程序启动Java虚拟机，虚拟机执行编译器放在class文件中的字节码
	2.3 使用集成开发环境
		Eclipse、NetBeans、intelliJ IDEA
	2.4 运行图形化应用程序
		javac ImageViewer.java
		java ImageViewer
	2.5 构建并运行applet
}

第三章 Java的基本程序设计结构

{
	3.1 一个简单的Java应用程序
		public class FirstSample{
			public static void main(String[] args){
				System.out.println("Hello world!");
			}
		}
		Java区分大小写
		public: 访问修饰符，用于控制程序的其他部分对这段代码的访问级别
		类是构建所有Java应用程序的构建快
		类名是以大写字母开头
		源代码的文件名必须与公共类的名字相同，以.java作为扩展名
		Java虚拟机将从指定类中的main方法开始执行，所以类的源文件中必须包含一个Main方法
	3.2 注释
		第一种//
		第二种/* */
		第三种/** */,该注释可以生成文档
	3.3 数据类型
		java是一种强类型语言，意味着必须为每一个变量声明一种类型。
		Java中一共有8中基本类型，包括：
			4种整型、2种浮点型、1种用于表示Unicode编码的字符单元的字符类型char和1种表示真值的额boolean类型
		3.3.1 整型
			用于表示没有小数的数值，允许负数
			int short long byte
			在Java中，整型的范围与运行Java代码的机器无关，所以移植性好
			而c/c++则需要针对不同的处理器选择最为高效的整型，可能在32位处理器上运行的很好在16位系统上却发生整数溢出
		3.3.2 浮点型
			用于表示有小数部分的数值
			float double
			float类型的数值后有一个后缀F或f,如果没有后缀F的浮点数值(如3.14)默认为double类型,也可以添加后缀D或d
			绝大部分应用程序都采用double类型
			溢出和出错的情况：
				正无穷大、负无穷大、NaN
			数值计算中不允许有任何舍入误差就应该使用BigDecimal类
		3.3.3 char类型
			char类型原本用于表示单个字符，现在有些Unicode字符可以用一个char值描述
			char类型的字面量值要有单引号括起来
			例如：
				'A'是编码值为65所对应的字符常量
				"A"是包含一个字符A的字符串
			强烈建议不要在程序中使用char类型，除非确实需要处理UTF-16代码单元
			最后将字符串作为抽象数据类型处理
		3.3.4 boolean类型
			boolean类型有两个值：false和true,用来判断逻辑条件
			整型值和布尔值之间不能进行相互转换
				意味着：其他语言中值0相当于布尔值false,而非0值相当于布尔值true,在Java中不是这样
			例子：
				int a = 1;
				if(a){
					System.out.println("1 is true");
				}else{
					System.out.println("1 is false");
				}
			错误提示：不兼容的类型，int无法转换为boolean
	3.4 变量
		在Java中，每个变量都有一个类型，变量的类型位于变量名之前
			double salary;
			int vacationDays;
		变量必须是一个以字母开头并由字母或数字构成的序列
		大小写敏感，长度没有限制
		尽管$是一个合法的 Java字符，但不要在你的代码中使用，它只用在Java编译器或其他工具生成的名字中
		可以在一行中声明多个变量
			int i,j;
		不提倡上述风格，逐一声明每一个变量可以提高程序的可读性
		3.4.1 变量初始化
			声明一个变量后，必须用赋值语句对变量进行显示初始化，千万不要使用未初始化的变量
			int num;
			num=100;
			int num = 100;
		3.4.2 常量
			在Java中，利用关键字final指示常量，该变量只能被复制一次，一旦赋值后，就不能够再更改。
			习惯上，常量名使用全大写
				final double CM_PER_INCH = 2.54;
			在Java中，经常希望某个常量可以在一个类中的多个方法中使用，通常将这些常量称为类常量
			可以使用static final设置一个类常量
				public class Test{
					public static final double  CM_PER_INCH = 2.54;
					public static void main(String[] args){
						System.out.print(CM_PER_INCH);
					}
				}
			类常量定义位于Main方法的外部，如果一个常量被声明为public,那么其他类的方法也可以使用这个常量
	3.5 运算符
		+ - * / %
		3.5.1 数学函数与常量
			在Math类中，包含类各种各样的数学函数
			Math.round();Math.sqrt(x);Math.sin();Math.log()
			Java还提供类两个用于表示π和e常量的近似值：Math.PI和Math.E
		3.5.2 数值类型之间的转换
			两个不同类型的数值进行二元操作时，先将两个操作数转换为同一种类型，然后再进行计算
			转换规则：
		3.5.3 强制类型转换
			语法格式：在圆括号中给出想要转换的目标类型，后面紧跟待转换的变量名
				double x = 9.997;
				init ix = (int) x; //ix的值为9
		3.5.4 结合赋值和运算符
			x+=4;
		3.5.5 自增与自减
			n++;y--;
		3.5.6 关系和boolean运算符
			检测相等性可以使用等号==
				3==7的值为false
				3!=7的值为true
			> < <= >=
			&& ||
			三元操作符?:
			x<y?x:y
		3.5.7 位运算符
			& | ^ ~
		3.5.8 括号与运算符级别
			同一个级别的运算符按照从左到右进行计算
		3.5.9 枚举类型
			变量的取值只在一个有限的集合内
			enum Size{samll,medium,large,extra_large};
			Size s = Size.medium;
			Size类型的变量只能存储这个类型声明中给定的某个枚举值。
	3.6 字符串
		从概念上讲，Java字符串就是Unicode字符序列
		Java没有内置的字符串类型，而是在标准Java类库中提供了一个预定义类，很自然地叫做String
		每个用双引号括起来的字符串都是String类的一个实例
			String e = "";
			String h = "hello";
		3.6.1 子串
			String类的substring方法可以从一个较大的字符串提取出一个子串
				String s = "hello";
				String h = s.substring(0,3);  //hel
		3.6.2 拼接
			String a = "aa";
			String b = "bb";
			String c = a+b;
		3.6.3 不可变字符串
			String类没有提供用于修改字符串的方法
			而需要替换，首先提取需要的字符串，然后再拼接上替换的字符串
			String s = "helloworld";
			s= s.substring(0,3)+"p!";
			System.out.print(s); //help
			由于Java不能修改Java字符串中的字符，所以Java文档中将String类对象称为不可变字符串
			然而可以修改字符串变量s,让它引用另外一个字符串
		3.6.4 检测字符串是否相等
			使用equals方法检测两个字符串是否相等
				s.equals(t);
				相等返回true,否则返回false
			检测两个字符串是否相等，而不区分大小写，可以使用equalsIgnoreCase方法
			一定不要使用==运算符检测两个字符串是否相等，==只能够确定两个字符串是否放在同一个位置上，地址码
		3.6.5 空串与Null串
			空串""是长度为0的字符串,检测一个字符串是否为空：
				str.length() == 0
				str.equals("")
			空串是一个对象，有自己的长度(0)和内容(空)
			String变量还可以存放一个特殊的值，名为null,这表示没有任何对象与该变量关联
			要检查一个字符串是否为null,使用如下条件
				if(str == null)
			要检查一个字符串既不是null也不为空串，使用以下条件
				if(str != null && str.length() !=0)
		3.6.6 码点与代码单元
			Java字符串由char值序列组成
			length方法返回采用UTF-16编码表示的给定字符串所需要的代码单元数量
				String s = "hello";
				int n = s.length();  //5
			调用s.charAt(n)将返回位置n的代码单元
				char first = s.charAt(0);  //h
				char last = s.charAt(4);  //o
		3.6.7 String API
			Java中的String类包含了50多个方法
				char charAt(int index);
				int codePointAt(int index);
				new String(int[] codePoints,int offset,int count)
				boolean equals(Object other);
				boolean startsWith(String prefix)
				boolean endsWith(String suffix)
				int indexof(String str)
				int lastindexof(String str)
				int length()
				String replace()
				String substring()
				String toLowerCase()
				String trim()
				String join()
		3.6.8 阅读联机API文档
			API文档是JDK的一部分，在docs/api/index.html
		3.6.9 构建字符串
			用许多小段的字符串构建一个字符串，首先构建一个空的字符串构建器
				StringBuilder builder = new StringBuilder();
			添加内容
				builder.append(ch);
				builder.append(str);
			构建字符串
				String s = builder.toString();
			在JDK5.0 中引入StringBuilder类，这个类的前身是StringBuffer。
			方法：
				StringBuilder()
				int length()
				StringBuilder append(String str)
				StringBuilder append(char ch)
				void setCharAt(int i ,char c)
				StringBuilder insert(int offset,String str)
				StringBuilder insert(int offset,Char c)
				StringBuilder delete(int startIndex,int endIndex)
				String toString()
	3.7 输入输出
		3.7.1 读取输入
			标准输出流只需调用System.out.println()
			标准输入流System.in使用
				首先需要构造一个Scanner对象，并与标准输入流System.in关联
					Scanner in =new Scanner(System.in);
				使用Scanner类的各种方法实现输入操作
					//nextLine方法将读取一行
					System.out.print("what is your name?");
					String name = in.nextLine();
					
					//next方法将读取一个单词(以空白符作为分隔符)
					System.out.print("what is your firstName?");
					String firstName = in.next();
					
					//读取一个整数
					System.out.print("how old are you?");
					int age = in.nextInt();
					
					System.out.println(name + firstName + age)
			Scanner类的输入是可见的，不适用于从控制台读取密码，可以用Console类实现读取一个密码
				Console cons = System.console();
				String username = cons.readLine("User name:");
				char[] passwd = cons.readPassword("Password:");
		3.7.2 格式化输出
			可以使用System.out.print(x)将数值x输出到控制台
			格式化数值
				System.out.printf("%8.2f",x);  //8个字符宽度和小数点后两个字符
				转换符自行查找
			可以使用静态的String.format方法创建一个格式化的额字符串
				String message = String.format("Hello,%s.Next year,you will be %d",name,age);
			printf方法中日期与时间的格式化，新代码中，应该使用java.time包的方法
				System.out.printf("%tc",new Date());
		3.7.3 文件输入与输出
			要想对文件进行读取，就需要一个用File对象构造一个Scanner对象
			例子：
				Scanner in = new Scanner(Paths.get("myfile.txt"),"UTF-8");
				如果文件名中包含反斜杠，则在每个反斜杠之前再加一个额外的反斜杠
				c:\\mydirectory\\myfile.txt
			要想写入文件，就要构造一个PrintWriter对象
			例子:
				PrintWriter out = new PrintWriter("myfile.txt","UTF-8");
				如果文件不存在，创建该文件
	3.8 控制流程
		3.8.1 块作用域
			块(block)是指由一对大括号括起来的若干条简单的Java语句
			块确定了变量的作用域，不能在嵌套的两个块中声明同名的变量
		3.8.2 条件语句
			if(condition) {
				//
			}else{
				//
			}
		3.8.3 循环
			while(condition){
				//执行前先检查
			}
			do{
				//先执行后检查
			}while()
		3.8.4 确定循环
			for循环语句是支持迭代的一种通用结构
				for(int i=1;i<=10;i++){
					//i的作用域就为for循环的整个循环体，不能再外部使用
				}
		3.8.5 多重选择：switch语句
			switch(choice){
				case 1:
					//
					break;
				case 2:
					//
					break;
				default:
					break;
			}
			case标签可以是char byte short int 枚举常量，从JavaSE7开始，可以是字符串字面量
		3.8.6 中断控制流程语句
			break continue
	3.9 大数值
		java.math包中的BigInteger和BigDecimal两个类可以处理包含任意长度数字序列的数值
		不能使用算数运算符(+和*)处理大数值，使用add和multiply
	3.10 数组
		数组是一种数据结构，用来存储同一类型值的集合
		声明：
			int[] a;
			int[] a = new int[100];
		赋值
			a[9] = 10;
		a.length()获取数组元素个数
		3.10.1 for each循环
			用来依次处理数组中的每个元素而不必为指定下标值而分心
			for(int element : a){
				System.out.println(element);  //打印数组a的每一个元素
			}
			Arrays.toString(a); //打印数组
		3.10.2 数组初始化以及匿名数组
			int[] age = {2,4,5,3,2};
		3.10.3 数组拷贝
			Arrays.copyOf
		3.10.4 命令行参数
			main(String[] args)
		3.10.5 数组排序
			int[] a = new int[100];
			...
			Arrays.sort(a);
}

第四章 对象与类

{
	4.1 面向对象程序设计概述
		简称OOP
		面向对象的程序是由对象组成的，每个对象包含对用户公开的特定功能部分和隐藏的实现部分。
		算法+数据结构=程序
		OOP将数据放在第一位，然后再考虑操作数据的算法
		4.1.1 类
			类是构造对象的 模板或蓝图，用Java编写的所有代码都位于某个类的内部
			封装、继承
		4.1.2 对象
			三个特性：
				对象的行为--可以对对象施加那些方法
				对象的状态--施加方法时对象如何响应
				对象标识--如何辨别具有相同行为与状态的不同对象
		4.1.3 识别类
			识别类的简单规则是在分析问题的过程中寻找名词，而方法对应着动词
		4.1.4 类之间的关系
			依赖、聚合、继承
	4.2 使用预定义类
		4.2.1 对象与对象变量
			要想使用对象，就必须首先构造对象，并指定其初始状态，然后对对象应用方法。
			构造器是一种特殊的方法，用来构造并初始化对象，构造器的名字应该与类名相同
				System.out.println(new Date());
				String s = new Date().toString();
				Date birthday = new Date();
			一个对象变量并没有实际包含一个对象，而仅仅引用一个对象
			在Java中，任何对象变量的值都是对存储在另外一个地方的一个对象的引用
			new 操作符的返回值也是一个引用
		4.2.2 Java类库中的localDate类
			标准Java类库包含两个类：
				表示时间点的Date类
				表示大家熟悉的日历表示法的localDate类
		4.2.3 更改器方法与访问器方法
	4.3 用户自定义类
		要想创建一个完整的程序，应该讲若干类组合在一起，其中只有一个类有main方法
		4.3.1 Employee类
			class Employee{
				private String name;
				public Employee(String n){
					//不要在构造器中定义与实例域重名的局部变量
					name = n;
				}
				public String getName(){
					return name;
				}
			}
		4.3.2 多个源文件的使用
			javac Employee*.java
			如果包含main方法的主类中使用了其他类，编译器会查找其他类，如果没有找到这个文件，就自动搜索，然后编译。
			javac EmployeeTest.java
		4.3.3 剖析Employee类
		4.3.4 从构造器开始
			构造器与类同名，在构造Employee类的对象时，构造器会运行，初始化类的属性
			new Employee("james")
			则Employee类的name就为james
			不要在构造器中定义与实例域重名的局部变量
		4.3.5 隐式参数与显式参数
			在每一个方法中，关键字this表示隐式参数
			this.name = "json";
		4.3.6 封装的优点
			set和get方法
		4.3.7 基于类的访问权限
		4.3.8 私有方法
			private,它不会被外部的其他类操作调用
		4.3.9 final实例域
			class Employee{
				private final String name; //不能再被修改
			}
	4.4 静态域与静态方法
		4.4.1 静态域
			如果将域定义为static,每个类中只有一个这样的域
		4.4.2 静态常量
			public static final double PI = 3.14159265358979
		4.4.3 静态方法
			不能操作对象，但是可以访问自身类中的静态属性
		4.4.4 工厂方法
		4.4.5 main方法
			main方法也是一个静态方法
	4.5 方法参数
		按值调用--方法接收的是调用者提供的值
		按引用调用--方法接收的是调用者提供的变量地址
		Java程序设计语言总是采用按值调用，即方法得到的是所有参数值的一个拷贝
	4.6 对象构造
		4.6.1 重载
			有些类有多个构造器，这种特征叫做重载。
			如果多个方法名字相同，但是有不同的参数，便产生类重载
			编译器通过用各个方法给出的从参数类型和值类型匹配来挑选执行那个方法
		4.6.2 默认域初始化
			如果构造器中没有显示地给域赋初值，那么就会被自动地赋为默认值
			数值为0布尔值为false对象引用为null
		4.6.3 无参数构造器
			如果在编写一个类时没有编写构造器，那么系统就会提供一个无参数构造器
			这个构造器将所有的实例域设置为默认值
		4.6.4 显式域初始化
		4.6.5 参数名
			在编写很想的构造器时，通常，参数用单个字符命名
				public Employee(String n){
					//不要在构造器中定义与实例域重名的局部变量
					name = n;
				}
			或者在属性前统一加个字符，如aName,aAge
		4.6.6 调用另一个构造器
		4.6.7 初始化块
			可以给属性赋初值
		4.6.8 对象析构与finalize方法
			对象不再使用时需要执行的清理代码
	4.7 包
		Java允许使用包将类组织起来，方便的组织自己的代码，并将自己的代码与别人提供的代码库分开管理
		使用包的主要原因是确保类名的唯一性
		4.7.1 类的导入
			一个类可以使用所属波中的所有类，以及其他包的共有类
			访问另一个包中的共有类的两种方式
				在每个类名之前添加完整的包名
					java.time.LocalDate today = java.time.LocalDate.now();
				使用import语句，import是一种引入包含在包中的类的简明描述，使用了import语句，在使用类时，就不许新IE初包的全名了
					import java.util.*;
					localDate today = localDate.now();
		4.7.2 静态导入
			import static java.lang.System.*;
			使用System类的静态方法和静态域时，不必加类名的前缀
				out.pringln("hello");
		4.7.3 将类放入包中
			必须将包的名字放在源文件的开头，包中定义类的代码之前
			package com.horstname.corejava;
			public class Emp{
				
			}
			如果没有在源文件中放置package语句，这个源文件中的类就放置在一个默认包中。
			将保重的文件放到与完整的包名匹配的自目录中
			例如：
				com.horstmann.corejava包中的所有源文件应该放置在子目录com/horstmann/corejava中
		4.7.4 包的作用域
	4.8 类路径
		类的路径必须与包名匹配
	4.9 文档注释
		JDK包含一个很有用的工具，叫做javadoc，它可以由源文件生成一个HTML文档
	4.10 类设计技巧
		一定要保证数据私有，这是最重要的，绝对不要破坏封装性
		一定要对 数据初始化
		不要在类中使用过多的基本类型
		不是所有的属性都需要独立的set\get方法
		将职责过多的类进行分解
		类名和方法名要能提现他们的职责
		优先使用不可变的类
}

第五章 继承

{
	
}

第六章 接口、lambda表达式与内部类

{
	
}

第七章 异常、断言和日志

{
	
}

第八章 泛型程序设计

{
	
}

第九章 集合

{
	
}

第十章 图形程序设计

{
	
}

第十一章 事件处理
{
	
}

第十二章 Swing用户界面组件

{
	
}

第十三章 部署Java应用程序

{
	
}

第十四章 并发

{
	
}