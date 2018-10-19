java从入门到精通
第4章：常量与变量
	本章讲解Java中常量和变量的声明与应用、变量的命名规则以及作用范围等
	4.1 常量
		常量就是固定不变的两，一旦被定义，它的值就不能在被改变。
		4.1.1 声明常量
			语法：
				final 数据类型 常量名称[=值]
			常量通常使用大写字母，但并不是硬性要求，只是习惯
		4.1.2 常量应用实例
			public class TestFinal1
			{
				static final int YEAR = 365;
				public static void main(String[] args)
				{
					System.out.println("tow year "+2*YEAR+" day");
				}
			}
			解析：
				static final int YEAR = 365;
					当常量用于一个类的成员变量时，必须给常量赋值，否则会出现编译错误。
				输出:two year 730 day
	4.2 变量
		变量是利用声明的方式，将内存中的某个块保留下来以供程序使用。
		4.2.1 声明变量
			int num=3;
			char ch='z';
			声明一个变量时，编译器会在内存里开辟一块足以容纳此变量的内存空间给它。
			3是整数常量，z是字符串常量
		4.2.2 变量的命名规则
			变量也是一种标识符，所以它遵循标识符的命名规则：
				由任意顺序的大小写字母、数字、下划线和美元符号组成
				但标识符不能以数字开头
				不能是Java中的保留关键字
		4.2.3 变量的作用范围
			按照作用范围进行划分，变量分为成员变量和局部变量：
			成员变量：在类体中定义的变量为成员变量，它的所有范围是整个类
				public class Chengyuandemo
				{
					static int a=1;  //定义一个成员变量
					public static void main(String[] args){
						System.out.println("成员变量a的值为："+a);
					}
				}
			局部变量：Java可以在程序的任何地方声明变量，在循环里定义的变量就是局部变量
				public class Jubudemo
				{
					public static void main(String[] args)
					{
						int sum=0;
						for(int i=0;i<5;i++){
							sum = sum+i;
							System.out.println("i="+i+",sum="+sum);
						}
					}
				}
				解析：
					把i声明在循环里，因此i是局部变量，他的有效范围仅在for循环内
					sum是声明在main()方法的开始出，所以有效范围是main()方法内
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		