java从入门到精通p263
第14章：包及访问权限
	14.1 包的概念以及使用
		14.1.1 包(package)的基本概念
			package 是在使用多个类或接口是，为了避免名称重复而采用的一种措施
			在类或接口的最上面加上 package 的声明就可以了
			package demo.java;
			class Test{}
			经过 package 的声明后，同一个文件内的接口或类就都会被纳入相同的 package 中
			编译:javac -d . Test.java
				编译后会在当前目录下生成一个demo文件夹
				在demo文件夹下又会生成一个java文件夹
				在此文件夹下会有编译好的Test.class文件
			执行:java demo.java.Test
		14.1.2 import语句的使用
			import package名称.类名称
			import demo.java.Test
			import demo.java.*
			java中有这样的规定：导入全部类或是导入指定的类，对与程序的性能是没有影响的
		14.1.3 JDK中常见的包
			SUN公司在开发JDK中为程序开发者提供了各种实用类
				java.lang--包含java语义核心类，如String、Math、Interger等
					java.lang.reflect--用于实现Java类的反射机制
				java.awt--包含构成抽象窗口工具集，用来构建和管理应用程序的图像用户界面(GUI)
				avax.swing--用于建立图形用户界面，对于java.awt是轻量级的
				java.applet--包含applet运行所需的一些类
				java.net--包含执行与网络相关的操作类
				java.io--包含能提供多种输入/输出功能的类
				java.util--包含一些实用工具类，如定义系统特性、与日期日历相关的方法
			java.lang类在Java1.2以后的版本中会被自动导入
	14.2 类成员的访问控制权限
		Java中有4种访问控制权限：private default protected public
		private: 私有，只能在这个类的内部使用
		default:如果成员方法或成员变量没有使用任何访问控制符，就称这个成员所拥有的是默认的 访问控制符
				可以被这个包中的其他类访问
		protected:可以被同一个包中的其他类访问，也可以被不同包中的子类访问
		public:可以被所有类访问，不管是不是在同一个包中
	14.3 Java的命名习惯
		包名中的字母一律小写
		类名、接口名应当使用名词，每个单词的首个字母大写
		变量名第一个单词小写，后面的每个单词首字母大写
		方法名的第一个单词小写，后面的每个单词首字母大写
		常量中的每个字母一律大写
	14.4 打包工具--jar命令的使用
		开发者使用的JDK中的包和类主要位于JDK的安装目录下jre/lib/rt.jar文件中
		Java虚拟机会自动找到这个jar包
		jar文件就是java archive file，一种压缩文件，与常见的ZIP文件格式兼容，习惯上称为jar包
		jar命令是随JDK一起安装的，存放在JDK安装目录下的bin目录中jar.exe,linux下为jar
		jar命令是Java提供用来对大量的类(.class文件)进行压缩，然后存为.jar文件
		打包命令:
			jar -cvf create.jar demo
			-c:创建新的存档
			-v:生成详细输出到标准输出上
			-f:指定存档文件名
			create.jar:生成Jar文件的名称
			demo:要打成jar文件的包
			
		
		