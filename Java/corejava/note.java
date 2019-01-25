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
	利用继承，可以基于已存在的类构造一个新类
	继承已存在的类就是复用这些类的方法和域，在此基础上还可以添加一些新的方法和域，以满足新的要求
	5.1 类、超类和子类
		5.1.1 定义子类
			关键字extends表示继承
			public class Manager extends Employee{
				publilc double getSalary(){
					double baseSalary = super.getSalary();  //这里是调取的超类的私有属性
				}
			}
			Employee为超类、基类或父类，Manager为子类、派生类
			Java一般称为超类和子类
			在通过扩展超类定义子类的时候，仅需要指出子类与超类的不同之处
		5.1.2 覆盖方法
			超类中的方法对子类并不一定适用，为此，需要提供一个新的方法来覆盖(override)超类中的这个方法
			子类不能直接访问超类的私有属性，可以适用特定的关键字super解决
				super.getSalary();
		5.1.3 子类构造器
		5.1.4 继承层次
			继承并并仅限于一个层次，一个祖先类可以拥有多个子孙继承链
			Java不支持多继承
		5.1.5 多态
		5.1.6 理解方法调用
			编译器查看对象的声明类型和方法名
			编译器查看调用方法时提供的参数类型来匹配方法
			如果是private方法、static方法、final方法或者构造器，那么编译器将可以准确的知道该调用那个方法，这种方法叫做静态绑定
			当程序运行，并采用动态绑定调用方法时，虚拟机一定调用与所引用的实际类型最合适的那个类的方法
			每次调用方法都要进行搜索，时间开销很大
			所以虚拟机预先为每个类创建类一个方法表，其中列出类所有方法的前面和实际调用的方法
			在真正调用方法的时候，虚拟机仅查找这个表就行了
		5.1.7 阻止继承：final类和方法
			有时候不希望人们利用某个类定义子类，不允许扩展的类被称为final类
			public final class Executive extends Manager{}
			类中的特定方法也可以被声明为final,如果这样做，子类就不能覆盖这个方法
			public final String getName(){
				
			}
			将方法或类声明为final主要目的是：确保他们不会在子类中改变语义
		5.1.8 强制类型转换
			将某个类的对象引用转换成另外一个类的对象引用
				Manager boss = (Manager) staff[0];
		5.1.9 抽象类abstract
			从某种角度看，祖先类更加通用，只将它作为派生其他类的基类，而不想使用特定的实例类。
			抽象类不能被实例化，将一个类声明类abstract，就不能创建这个类的对象
			publilc abstract class Person{
				public abstract String getDescription();
			}
	5.2 Object: 所有类的超类
		Object类是Java中所有类的始祖，每个类都是由它扩展而来的
		但是不需要继承该类，如果没有明确的指出超类，Object类就被认为是这个类的超类
		在Java种只有基本类型不是对象
		5.2.1 equals方法
			用于检测一个对象是否等于另外一个对象，即判断两个对象是否有相同的引用
		5.2.2 相等测试与继承
		5.2.3 hashCode方法
			散列码是由对象导出的一个整型值，没有规律
			String s ="ok";
			System.out.println(s.hashCode);
			StringBuilder sb = new StringBuilder(s);
			System.out.println(sb.hashCode);
			如果要重新定义equals方法，就必须重新定义hashCode方法，以便用户可以将对象插入到散列表中
			hashCode()返回值是任意整数
		5.2.4 toString方法
			用于返回表示对象值的字符串
			可以作为调试数据用
	5.3 泛型数组列表
		ArrayList类使用起来有点像数组，但是在添加或删除元素时，具有自动调节数组容量的公共
		ArrayList是一个采用类型参数的泛型类，为了指定数组列表保存的元素对象类型
		需要用一对尖括号将类名括起来加在后面
			ArrayList<Employee> staff = new ArrayList<Employee>();
		使用add方法可以将元素添加到数组列表中
			staff.add(new Employee("tony",22));
		API:
			ArrayList<E>()  //构造一个空数组列表
			ArrayList<E>(100) //用指定容量构造一个空数组
			boolean add(E obj) //在数组列表的尾端添加一个元素
			int size()  //返回数组元素个数
			void trimToSize()
		5.3.1 访问数组列表元素
			ArrayList并不是Java程序设计语言的一部分，它只是由某些人编写且被放在标准库中的一个实用类
			使用get和set方法实现访问或改变数组元素的操作
			例子：
				//设置第i个元素,主要类型
				Employee harry = new Employee("harry",22);
				staff.set(i,harry);
				//获取数组列表的元素
				Employee e = staff.get(i);
				//数组中间插入元素
				int n = staff.size()/2;
				staff.add(n,e);
				//删除一个元素，返回值是被删除的元素
				Employee e = staff.remove(n); 
				//遍历数组的两种方法
				for(Employee e: staff){
					//do
				}
				for(int i=0;i<staff.size();i++){
					Employee e = staff.get(i);
					//do
				}
		5.3.2 类型化与原始数组列表的兼容性
	5.4 对象包装器与自动装箱
		有时候需要将int这样的基本类型转换为对象
		所有的基本类型都有一个与之对应的类
		Integer类对应基本类型int,
		Integer Long Float Double Short Byte Character Void Boolean
		通常这些类称为包装器(wrapper)
		对象包装器类是不可变得，也是final类，因此不能定义它们的子类
		自动装箱autoboxing
			调用list.add(3)
			将自动变换为list.add(Integer.valueOf(3))
		自动拆箱
			int n = list.get(i);
			翻译成
			int n = list.get(i).intValue();
		API:
			int intValue()--以int的形式返回Integer对象的值
			static String toString(int i)
			static int parseInt(String s)
			static Integer valueOf(String s)
	5.5 参数数量可变的方法
		System.out.printf("%d %s",n,"hello");
		后面的参数是可变的
	5.6 枚举类
		public enum Size {SMALL,MEDIUM,LARGE}
		比较两个枚举类型的值时，永远不要调用equals,而直接使用==就可以了
	5.7 反射
		反射库reflection library提供了一个分叉丰富的工具集，以便编写能够动态操纵java代码的程序
		这项功能被大量地应用于javabeans中，它是Java组件的体系结构
		特别是在设计或运行中添加新类时，能够快速地应用开发工具动态地查询新添加类的能力
		能够分析类能力的程序称为反射(reflective),功能如下：
			在运行时分析类的能力
			在运行时查看对象
			实现通用的数组操作代码
			利用Method对象，这个对象很像C++中的函数指针
		使用它的主要人员是工具构造者，而不是应用程序员
		
}

第六章 接口、lambda表达式与内部类

{
	6.1 接口
		6.1.1 接口的概念
			接口interface技术主要用来描述类具有什么功能，而并不给出每个功能的具体实现
			一个类可以实现implement一个或多个接口
			在Java程序设计语言中，接口不是类，而是对类的一组需求描述，这些类需要遵从接口描述的统一格式进行定义
			接口可能包含多个方法，还可以定义常量
			但接口决不能含有实例域
			在Java SE 8 之前，也不能在接口中实现方法
			提供实例域和方法实现的任务应该由实现接口的那个类来完成
		6.1.2 接口的特性
			接口不是类，尤其不能使用new运算符实例化一个接口
			尽管不能构造接口的对象，却能声明接口的变量
				private UserMapper userMapper;
			接口可以被继承
			接口里可以包含常量
		6.1.3 接口与抽象类
		6.1.4 静态方法
			Java SE8允许在接口中增加静态方法
			这样做合法，但是有违接口作为抽象规范的初衷
			通常都是将静态方法放在伴随类中
		6.1.5 默认方法
			可以为接口提供一个默认实现，必须用default修饰符标记
			public interface A{
				default int b(){
					//dosometing
				}
			}
			默认方法的一个重要用法是"接口演化"
		6.1.6 解决默认方法冲突
	6.2 接口示例
		6.2.1 接口与回调
			回调(callback)是一种常见的程序设计模式
			实例参见v1ch06/timer/TimerTest.java
		6.2.2 Comparator接口
		6.2.3 对象克隆
			了解
	6.3 lambda表达式
		6.3.1 为什么引入lambda表达式
			lambda表达式是一个可传递的代码块，可以在以后执行一次或多次
			将一个代码块传递到某个对象，在Java中并不容易，不能直接传递代码块
			Java是一种面向对象语音，所以必须构造一个对象，这个对象的类需要有一个方法能包含所需代码。
		6.3.2 lambda语法
			lambda表达式就是一个代码块，以及必须传入代码的变量规范
			(String first, String second)->{
				if(first.length() < second.length()){
					return -1;
				}else{
					return 0;
				}
			}
			表达式形式：参数，箭头(->)以及一个表达式
		6.3.3 函数式接口
	6.4 内部类
		内部类是定义在另一个类中的类
			内部类方法可以访问该类定义所在的作用域中的数据，包括私有数据
			内部类可以对同一个包中的其他类隐藏起来
			当想要定义一个回调函数且不想编写大量代码时，使用匿名(anonymous)内部类比较便捷
			
	6.5 代理
		利用代理可以在运行时创建一个实现了一组给定接口的新类
		这种功能只有在编译时无法确定需要实现那个接口时才有必要使用
		对于应用程序设计人员来说，遇到的情况很少
}

第七章 异常、断言和日志

{
	7.1 处理错误
		如果出现错误而使得某些操作没有完成，程序应该：
			返回到一种安全状态，并能够让用户执行一些其他的命令
			或者允许用户保存所有操作的结果，并以妥善的方式终止程序
		需要关注的问题
			用户输入错误
			设备错误
			物理限制
			代码错误
		7.1.1 异常分类
			在Java中异常对象都是派生于Throwable类的一个实例，用户可以创建自己的异常类
			所有异常都是Throwable继承而来，但在下一层立即分解为两个分支
				Error
					Error类层次结构描述了Java运行时系统的内部错误和资源耗尽错误
					应用程序不应该抛出这种类型的对象
				Exception
					该层次结构又分为两大分支
						RuntimeException
							错误的类型转换
							数组访问越界
							访问Null指针
						其他异常
							试图在文件尾部后面读取数据
							试图打开一个不存在的文件
					由程序错误导致的异常属于RuntimeException，如果程序本身没有问题，但由于像I/O错误这类问题导致的异常，属于其他异常
					如果出现RuntimeException异常，就是程序员的程序问题了
					应该通过检测数组下标是否越界来避免ArrayIndxOutOfBoundsException异常
					应该通过在使用变量之前检测是否为null来杜绝NullPointerException异常
			Error类或RuntimeException类的所有异常称为非受查(unchecked)异常
			所有其他的异常称为受查(checked)异常
		7.1.2 声明受查异常
			一个方法不仅需要告诉编译器将要返回什么值，还要告诉编译器有可能发生什么错误
				public FileInputStream(String name) throws FileNotFoundException
				该声明表示这个构造器将根据给定的String参数产生一个FileInputStream对象，
				但也可能抛出一个 FileNotFoundException 异常
				如果出现这种情况，构造器不会初始化一个新的 FileInputStream对象
				而是抛出一个 FileNotFoundException 类对象
				如果抛出这样的一个异常对象，运行时系统会开始搜索异常处理器来处理该对象
				何时需要抛出异常
					调用一个抛出受查异常的方法，例如 FileInputStream
					程序运行过程中发现错误，并利用throw语句抛出受查异常
					程序出现错误
					java虚拟机和运行时库出现内部错误
				对应那些可能被他人使用的Java方法，应该根据异常规范，在方法的首部声明这个方法可能抛出的异常
					public Image loadImg(String s) throw IOException{}
					public Image loadImg(String s) throw FileNotFoundException,IOException{}
				不需要声明Java的内部错误，即从Error继承的错误
			除了声明异常之外，还可以捕获异常
			这样会使异常不被抛到方法之外，也不需要throws规范
		7.1.3 如果抛出异常
			throw new EOFException();
			找到一个合适的异常类
			创建这个类的额一个对象
			将对象抛出
		7.1.4 创建异常类
			定义一个派生于Exception的类，或者派生于Exception子类的的类
			习惯上，定义类应该包含两个构造器，一个是默认的构造器，另一个是带有详细描述信息
			class FileFormatException extends IOException{
				public FileFormatException(){}
				public FileFormatException(String gripe){
					super(gripe);
				}
			}
	7.2 捕获异常
		如果某个异常发生的时候没有在任何地方进行捕获，那程序就会终止执行，并在控制台上打印出异常信息
		其中包括异常的类型和堆栈的内容
		7.2.1 捕获异常
			要想捕获异常，必须设置try/catch语句块
				try{
					
				}catch(Exception e){
					e.getMessage();
				}
			如果在try语句块中的任何代码抛出类一个在catch子句中说明的异常类，那么
				程序将跳过try语句块的其余代码
				程序将执行catch子句中的处理器代码
			如果方法中的任何代码抛出类一个在catch子句中没有声明的异常类型，那么这个方法就会立刻退出
		7.2.2 捕获多个异常
			在一个try语句中可以捕获多个异常类型，并作出不同处理
			try{
				
			}catch(FileNotFoundException e){
				e.getMessage();
			}catch(IOException e){
				e.getMessage();
			}
		7.2.3 再次抛出异常与异常链
			在catch子句中可以抛出一个异常，这样做得目的是改变异常的类型
		7.2.4 finally子句
			不管是否有异常被捕获，finally子句中的代码都被执行
			InputStream in = new FileInputStream(...);
			try{
				
			}catch(Exception e){
				e.getMessage();
			}finally{
				in.close();
			}
		7.2.6 分析堆栈轨迹元素
	7.3 使用异常机制的技巧
		异常处理不能代替简单的测试
		不要过分的细化异常
		利用异常层次结构
		不要压制异常
		在检测错误时，苛刻要比放任好
	7.4 使用断言
		在一个具有自我保护能力的程序中，断言很常用
		断言机制运行在测试期间向代码中插入一下检测语句，当代码发布时，这些插入的检测语句将会被自动移走，减少资源消耗
			assert x>=0 : x;
		默认情况下，断言被禁用，可以在运行程序时启用
			java -enableassertions MyApp
	7.5 记录日志
		7.5.1 基本日志
			要生成简单的日志记录，可以使用全局日志记录器并调用其info方法
				Logger.getGlobal().info("hello");
			如果在适当的地方调用
				Logger.getGlobal().setLevel(Level.OFF)
				将会取消所有的日志
		7.5.2 高级日志
			可以调用getLogger方法创建或获取记录器
				private static final Logger myLogger = Logger.getLogger("com.mycompany.myapp");
			日志记录器级别
				SEVERE WARNING INFO CONFIG FINE FINER FINEST
			默认情况下只记录前三个级别
			也可以设置其他的级别
				logger.setLevel(Level.FINE);
			可以使用level.ALL开启所有级别的记录，也可以使用Level.OFF关闭所有级别
			对于所有的级别有下面几种记录方法
				logger.warning(message)
				logger.fine(message)
			也可以指定级别
				logger.log(Level.FINE,message);
			默认的日志配置记录了INFO或更高级别的所有记录
			如果将记录级别设计为INFO或者更低，则需要修改日志处理器的配置
		7.5.3 修改日志管理器配置
			可以通过编辑配置文件来修改日志系统的各种属性，配置文件存在于
				jre/lib/logging.properties
	7.6 调试技巧
		可以使用下面的方法打印或记录任意变量
			System.out.println("x=" + x);
			或
			Logger.getGlobal().info("x" + x);
		日志代理
		利用Throwable类提供的printStackTrace方法，可以从任何一个异常对象中获得堆栈情况
			try{
				
			}catch(Throwable t){
				t.printStackTrace();
				throw t;
			}
		错误信息被发送到System.err中，而不是System.out中
			java MyProgram 2>errors.txt
		要想观察类的加载过程，可以用-verbose标志启动java虚拟机
		Java虚拟机增加类对Java应用程序进行监控和管理的支持
			JDK加载类了一个称为jconsole的图形工具，可以用于显示虚拟机性能的统计结果
				找出运行虚拟机的操作系统进程ID
				在UNIX/LINUX环境下运行ps，
				在windows环境下使用任务管理器，然后运行jconsole程序
					jconsole processID
}

第八章 泛型程序设计

{
	8.1 为什么使用泛型程序设计
		泛型程序设计意味着编写的额代码可以被很多不同类型的对象所重用
		ArrayList<String> files = new ArrayList<String>();
		这个数组列表中包含的是String对象
		不需要强制类型转换，避免插入错误类型的对象
	8.2 定义简单的泛型类
		一个泛型类就是具有一个或多个类型变量的的类
		public class Pair<T>{
			private T first;
			private T second;
			public Pair(T first,T second){
				this.first =first;
				this.second = second;
			}
			public T getFirst(){
				return first;
			}
		}
		如果第一个域和第二个域使用不同类型
			public class Pair<T,U>{}
	8.3 泛型方法
	8.4 类型变量的限定
	8.5 泛型代码和虚拟机
	8.6 约束与局限性
	8.7 泛型类型的继承规则
	8.8 通配符类型
	8.9 反射和泛型
}

第九章 集合

{
	在实现方法时，选择不同的数据结构会导致其实现风格以及性能存在很大差异
	9.1 Java集合框架
		9.1.1 将集合的接口与实现分离
		9.1.2 Collection接口
			在Java中，集合类的基本接口时Collection接口，这个接口有两个基本方法
				public interface Collection<E>{
					boolean add(E element);
					Iterator<E> iterator();
				}
				add用于向集合添加元素，如果添加元素确实改变类集合就返回true,否则返回false
				iterator方法用于返回一个实现类Iterator接口的对象，可以使用这个迭代器依次访问集合中的元素
		9.1.3 迭代器
			Iterator接口包含4个方法
				public interface Iterator<E>{
					E next;
					boolean hasNext();
					void remove();
					default void forEachremaining(Consumer<? super E> action)
				}
			例如：
				Collection<String> c="...";
				Iterator<String> iter = c.iterator();
				while(iter.hasNext()){
					String element = iter.next();
					//dosomething
				}
				使用for each循环更加简练
				for(String element: c){
					//do something
				}
			remove方法将会删除上次调用next方法时返回的元素
		API:java.util.Collection<E>
			iterator(),size(),isEmpty(),contains(Object obj),add(Object element),addAll(Collection<?> other)
			remove(Object obj),removeAll(Collection<?> other),clear()retainAll()toArray()...
		API:java.util.iterator<E>
			hasNext(),next(),remove()
		集合有两个基本接口：Collection和Map
			Map使用put添加元素使用get获取元素
	9.2 具体的集合
		除了以Map结尾的类之外，其他类都实现类Collection接口
		而以Map结尾的类实现类Map接口
			ArrayList --一种可以动态增长和缩减的索引序列
			LinkerdList--一种可以在任何位置进行高效地插入和删除操作的有序序列
			ArrayDeque--一种用循环数组实现的双端队列
			HashSet--一种没有重复元素的无序集合
			TreeSet--一种有序集
			EnumSet--一种保护枚举类型值的集
			LinkedHashSet--一种可以记住元素插入次序的集合
			PriorityQueuq
			HashMap--一种存储键值关联的数据结构
			TreeMap--一种键值有序排列的映射表
			EnumMap
			LinkedHashMap
			WeakHashMap
			IdentityHashMap
	9.3 映射
		Map<String,Employee> staff = new HashMap<>();
		Employee harry = new Employee("harry hacker");
		staff.put("987-98",harry);
		staff.get("987-98");
		staff.remove("987-98");
		staff.forEach()
	9.4 视图与包装器
		9.4.1 轻量级集合包装器
			Arrays类的静态方法asList将返回一个包装类普通Java数组的List包装器
				Card[] card = new Card[52];
				List<Card> cardList = Arrays.asList(card);
	9.5 算法
		9.5.1 排序与混排
			Collection类中的sort方法可以对实现类List接口的集合进行排序
				List<String> staff = new LinkedList<>();
				Collection.sort(staff);
		9.5.2 二分查找
			Coll类的binarySearch方法实现类这个算法
			注意，集合必须是排好序的，否则答案可能会错
		9.5.3 简单算法
			Collection.replaceAll("c++","java");
			Collection.removeIf(w->w.length() <=3);
	9.6 遗留的集合
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
	操作系统中的多任务(multitasking):在同一时刻运行多个程序的能力
	多线程程序在较低的层次上扩展类多任务的概念：一个程序同时执行多个任务。
	通常每一个任务称为一个线程(thread),它是线程控制的简称。
	多进程与多线程区别：
		每个进程拥有自己的一整套变量，而线程则共享数据。
	例如：一个浏览器可以同时下载多个图片，一个web服务器需要同时处理多个并发的请求
	14.1 什么是线程
		Thread t = new Thread();
		t.start();
	14.2 中断线程
		Java早起版本中，有stop方法，其他线程和以调用它终止线程，但是这个方法被弃用了
		没有可以强制线程终止的方法，然而interrupt方法可以用来请求终止线程
		Thread.currentThread.isInterrupted
		如果线程被阻塞，就无法检测中断状态
	14.3 线程状态
		New(新建),Runnable(可运行),blocked(被阻塞),Waiting(等待),Timed waiting(计时等待),Terminated(终止)
		14.3.1 新创建线程
			new Thread();
			该线程还没有开始运行，它的状态是new
		14.3.2 可运行线程
			一旦调用start方法，线程处于runnable状态
			一个可运行的线程可能正在运行也可能没有运行，取决于操作系统给线程提供运行的时间
		14.3.3 被阻塞线程和等待线程
			当线程处于被阻塞和等待状态时，它暂时不活动，它不运行任何代码且消耗最少的资源
				当一个线程试图获取一个内部的对象锁(不是java.util.concurrent库中的锁)，而该锁被其他线程持有，则该 线程进入阻塞状态
				当线程等待另一个线程通知调度器一个条件时，它进入等待状态
				有几个方法有一个超时参数，调用他们导致线程进入计时等待状态
		14.3.4 被终止的线程
			因为run方法正常退出而自然死亡
			因为一个没有捕获的异常终止类run方法而意外死亡
	14.4 线程属性
		14.4.1 线程优先级
			一个线程继承它的父类线程的优先级，可以使用setPriority方法提高或降低一个线程的优先级
			每当线程调度器有机会选择新线程时，它首先选择具有较高优先级的线程
			如果有几个高级优先级的线程没有进入非活动状态，低优先级的线程可能永远也不能执行
		14.4.2 守护线程
			t.setDaemon(true);
			唯一用途是为其他线程提供服务
	14.5 同步
		为了避免多线程引起的对共享数据的讹误，必须学习如何同步存取。
		14.5.3 锁对象
			有两种机制防止代码块收并发访问的干扰
				Java语言提供类一个synchronized关键字达到这一目的
				Java SE5.0引入了 ReentrantLock类
			lock(),unlock()
	14.6 阻塞队列
	14.7 线程安全的集合
		ConcurrentHashMap,ConcurrentSkipListMap
	14.8 Callable与future
	14.9 执行器
	14.10 同步器
	14.11 线程与Swing
}