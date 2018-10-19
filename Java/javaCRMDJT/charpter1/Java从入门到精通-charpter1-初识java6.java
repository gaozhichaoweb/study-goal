java从入门到精通
第一章：
	1.1 java历史
	1.2 java现状
		1.2.1 java技术分支
			java se: java 2 platform standard edition
			java ee: java 2 platform enterprise edition
			java me: java 2 platform micro edition
			java语言主要应用在网络上，JAVA ME则主要用于完成手机开发
			以上三个分支都是已JAVA SE为核心，所以JAVA SE最为重要
		1.2.2 java语言的跨平台性
	1.3 java的特点
		简单的、面向对象的、分布式的、解释型的、健壮的、安全的、结构中立的、可移植的、性能很优异、多线程的、动态的语言
		1.3.1 java 语言的优点
			java语言最大的优点就是与平台无关"一次编写，到处运行"
			特性：
				提供了对内存的自动管理
				去除了C++语言中的"指针"
				避免了赋值语句(a=3)与逻辑运算语句(a==3)的混淆
				取消了多重继承这一复杂的概念
		1.3.2 关键特性：
			简介有效
			可移植性
			面向对象
			解释型：JAVA语言是一种解释型语言，相对于C/C++来说效率低、执行速度慢
				但它正是通过在不同的平台上运行JAVA解释器，对JAVA代码进行解释，来实现"一次编写，到处运行"
				hello.java--(编译javac hello.java)--hello.class--(解释java hello)--输出结果
			适合分布式计算：
				java语言具有强大的、易于使用的联网能力，非常适合开发分布式计算的程序
				Java应用程序可以向访问本地文件系统那样通过URL访问远程对象
				使用java语言编写socket通信程序十分简单，比使用任何其他语言都简单
				十分适用于公共网关接口(CGI)脚步的开发
				使用java小应用程序(Applet)、java服务器页面(Java Server Page,JSP)和servlet等手段来构建更丰富的网页
	1.4 安装java开发工具箱--JDK
	1.5 配置开发环境
		要开发java程序，首先要配置好环境变量
		在编译java程序时需要用到javac这个命令，执行java程序需要java这个命令
		配置好环境变量，就可以在任何目录下使用这两个命令
		我的电脑--属性--系统属性--高级--环境变量
		环境变量对话框--系统变量--path--编辑
		编辑系统变量对话框--变量值文本框中输入JDK的安装路径"D:\java\bin;"
	1.6 编写1个java程序
		java程序分为两种形式：
			网页上使用的applet程序(java小程序)
			Application程序(java应用程序)
		本书主要讲解的是java Application程序
		在命令行中输入:
			>javac Hello.java
			>java Hello
		在所有的java Application中，所有的程序都是从public static void main()开始运行的
	1.7 classpath的指定
		在java中可以使用"set classpath"命令指定java类的执行路径
		将类的查找路径指向目录，所以在运行时，会从指定目录开始查找。
		最好将classpath指向当前目录，即所有的class文件都从当前文件夹中查找
		"set classpath=."
	1.8 java虚拟机(JVM)
		在java中引入了虚拟机的概念，即在机器和编译程序之间加入了一层抽象的虚拟的机器。
		这台虚拟的机器在任何平台上都是提供给编译程序一个共同的接口。
		编译程序之需要面向虚拟机，生产虚拟机能够理解的代码，然后由解释器来将虚拟机代码转换为特定系统的机器码执行。
		在java中，这种供虚拟机理解的代码叫做字节码(ByteCode),它不面向任何特定的处理器，只面向虚拟机
		每一种平台的解释器是不同的，但是实现的虚拟机确实相同的。
		java源程序结果编译器编译后变成字节码，字节码由虚拟机解释执行，虚拟机将每一天要执行的字节码送给解释器，解释器将其编译成特定机器上的机器码，然后在特定的机器上运行。
		java虚拟机是java语言的基础，和实际计算机一样，它具有一个指令集，并使用不同的存储区域
		它负责执行指令，还有治理数据、内存和寄存器
		java解释器负责将字节码翻译成特定机器的机器码
		Java虚拟机是可运行Java代码的假象计算机
		*.java--(javac)--*.class--(java)--java虚拟机--操作系统(windows,linux)
		
	
	
	
	
	
	
	
	
	
	
	
	
	


















		