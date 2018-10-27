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
		p252
		
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	