java从入门到精通p167
第10章：类的封装、继承与多态
	10.1 类的封装
		10.1.1 封装的基本概念
		10.1.2 类的封装的实例
			面向对象法则中是不被允许直接访问类中的属性，属性类型改为private
			增加一些setXx()、getXx()方法来访问类中的属性
			封装的形式如下：
				封装属性： private 属性类型 属性名
				封装方法： private 方法返回类型 方法名(参数)
	10.2 类的继承
		10.2.1 继承的基本概念
			格式：
				class 子类名 extends 父类
			Java继承只能直接继承父类中的 公有属性和公有方法，而隐含地继承了私有属性
			Java中只允许单继承，而不允许多重继承，也就是一个子类只能有一个父类
			Java中允许多层继承
		10.2.2 实例
			class Person
			{
				String name;
				int age;
			}
			class Student extends Person
			{
				//继承person后，student类也有了name和age属性
				String school;
			}
			public class Test{
				public static void main(String[] args){
					Student s = new Student();
					s.name="jams";
					s.age=33;
					s.school="beijing";
					System.out.println(s.name+s.age+s.school);
				}
			} 
		10.3 类的继承专题研究
			10.3.1 子类对象的实例化过程
				子类对象在实例化时会默认先去调用父类中的无参构造方法，之后再调用本类中的相应构造方法
			10.3.2 super关键字的使用
				super主要的功能是完成子类调用父类中的内容，也就是调用父类中的属性或方法
				super也可以用于调用父类中的属性或方法
			10.3.3 限制子类的访问
				父类中声明属性或方法时加上"private"关键字后，表示私有，子类不能访问
			10.3.4 覆写
				当子类继承一个父类，而子类中的方法与父类中的方法的名称、参数个数、类型都完全相同时，就称子类覆写了父类的方法
		10.4 类的多态
			10.4.1 多态的基本概念
			10.4.2 类的多态实例	