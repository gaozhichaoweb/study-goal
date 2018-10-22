java从入门到精通p191
第11章：抽象类与接口
	Java可以创建一种类专门用来当作父类，这种类称为"抽象类"
	11.1 抽象类的基本概念
		Java可以创建一种类专门用来当作父类，这种类称为"抽象类"
		抽象类实际上也是一个类，只是与之前的普通类相比，其中多了抽象方法
		抽象方法是只声明而未实现的方法，所有抽象方法必须使用 abstract 关键字声明
		抽象方法的类也必须使用 abstract class 声明
		规则：
			抽象类和抽象方法都必须使用 abstract 关键字来修饰
			抽象类不能被直接实例化，也就是不能直接用 new 关键字去产生对象
			抽象方法只需声明，而不需要实现
			含有抽象方法的类必须被声明为抽象类，抽象类的子类必须覆写所有的抽象方法后才能被实例化，否则这个子类还是个抽象类
			
	11.2 抽象类实例
			abstract class Person
			{
				String name;
				int age;
				public abstract String talk();
			}
			class Student extends Person{}
	11.3 接口
		接口(interface)与抽象类非常相似，两点不同：
			接口里的数据 成员必须初始化，且数据成员均为常量
			接口里的方法必须全部声明为 abstract,全部为抽象方法
			 一个类只可以继承一个父类，但却可以实现多个接口
	11.4 接口实例
			interface Person
			{
				String name = "james";
				int age=25;
				public abstract String talk();
			}
			class Student implements Person{}
		
		
		